<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Storage;
use DB;
use App\Models\User;
use App\Models\Customers;
use App\Models\State;
use App\Models\Insurance;
use App\Models\Healthinsurance;
use Carbon\Carbon;
use Session;
use App\Exports\StaffExports;
use App\Exports\CustomerExports;
use Maatwebsite\Excel\Facades\Excel;
use Redirect;
use Auth, Validator, Response;
class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
		$this->customers = new Customers();
		$this->state = new State();
		$this->insurance = new Insurance();
		$this->insurancelist = new Healthinsurance();
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		if(Auth::user()->role!=1){
			$this->data['healthusercount'] = $this->insurancelist->where('insurance_type',1)->where('status','1')->where('staff_id',Auth::user()->id)->count();
			//echo "<pre>"; print_r($this->data['healthusercount']); exit;
			$this->data['motorusercount'] = $this->insurancelist->where('insurance_type',2)->where('status','1')->where('staff_id',Auth::user()->id)->count();
			$this->data['lifeusercount'] = $this->insurancelist->where('insurance_type',3)->where('status','1')->where('staff_id',Auth::user()->id)->count();
			$this->data['countweek'] = $this->insurancelist->where('status','1')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->where('staff_id',Auth::user()->id)->count();
			$this->data['countmonth'] = $this->insurancelist->where('status','1')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->where('staff_id',Auth::user()->id)->count();
			$this->data['countyear'] = $this->insurancelist->where('status','1')->whereYear('created_at', date('Y'))->where('staff_id',Auth::user()->id)->count();
		}else{
			$this->data['healthusercount'] = $this->insurancelist->where('status','1')->where('insurance_type',1)->with('countstaffcustomer')->count();
			$this->data['motorusercount'] = $this->insurancelist->where('status','1')->where('insurance_type',2)->count();
			$this->data['lifeusercount'] = $this->insurancelist->where('status','1')->where('insurance_type',3)->count();
			$this->data['countweek'] = $this->insurancelist->where('status','1')->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
			$this->data['countmonth'] = $this->insurancelist->where('status','1')->whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
			$this->data['countyear'] = $this->insurancelist->where('status','1')->whereYear('created_at', date('Y'))->count();
		}
        return view('admin.index',$this->data);
    }
	public function liststaff(){
		$this->data['user'] = User::where('role',2)->get();
		return view('admin.staff.liststaff',$this->data);
	}
	public function addstaff(Request $request){
		if($request->id){
			$this->data['user'] = User::where('id',$request->id)->first();
			return view('admin.staff.staff',$this->data);
		}else{
			return view('admin.staff.staff');
		}
	}
	public function savestaff(Request $request){
		if($request->input('hid')){
			$validator  =   Validator::make($request->all(), [
					'mobile' => 'required|digits:10'
			 ]); 
		}else{
			$validator  =   Validator::make($request->all(), [
					'mobile' => 'required|digits:10',
					'email' => 'required|email|unique:users'
			 ]); 			
		}
		if ($validator->fails()) {
			   $messages = $validator->messages();
			   return redirect()->back()->withErrors($messages)->withInput($request->all()); 
		} 
		if($request->input('hid')){
			$user = User::where('id',$request->input('hid'))->first();
		}else{
			$user = new User;
		}
		$user->name 	= $request->input('name'); 
		$user->email 	= $request->input('email'); 
		$user->mobile 	= $request->input('mobile');
		$user->password = Hash::make($request->input('password'));
		$user->plain 	= $request->input('password');
		$user->status 	= $request->input('status');
		$user->role 	= 2;
		$image = $profile_images = '';   
		   if ($request->file('profile_image')) {
				$image = $request->file('profile_image');
				$profile_images = 'profile_image' . time() . '_' . $image->getClientOriginalName();
				$image_resize = Image::make($image->getRealPath());              
				$image_resize->save(storage_path('app/public/profile/' .$profile_images));
				$user->profile_image = $profile_images;
			}
		$user->save();
		return redirect('admin/list-staff')->with('message', 'Successfully staff added...'); 			
	}
	public function deletestaff($id){
		$user = User::where('id',$id)->delete();
		return redirect('/admin/list-staff')->withErrors(['sucessfully staff Deleted']);
	}
	public function listcustomerdetails($id=''){
		if(Auth::user()->role!=1){
			$this->data["customers"] = Customers::select(
                            "customers.*", 
                            "state.StateName as state_name"
                        )->leftJoin("state", "state.StateID", "=", "customers.state")->where('status','1')->where('staff_id',Auth::user()->id)->get();
		}else{
			//$this->data["customers"] = Customers::get();
			if($id)
			{
				$this->data["customers"] = Customers::select(
	                            "customers.*", 
	                            "state.StateName as state_name"
	                        )
	                        ->leftJoin("state", "state.StateID", "=", "customers.state")->where('status','1')
	                        ->where('staff_id',$id)
	                        ->where('is_deleted','0')
	                        ->get();
			}
			else
			{
				$this->data["customers"] = Customers::select(
	                            "customers.*", 
	                            "state.StateName as state_name"
	                        )
	                        ->leftJoin("state", "state.StateID", "=", "customers.state")->where('status','1')->where('is_deleted','0')->get();
	        }
		}

		$this->data['cid'] = $id;
		return view('admin.customer.list-customerdetails',$this->data);
	}
	public function addcustomerdetails(){
		$this->data["state"] = $this->state->get();	
		return view('admin.customer.add-customerdetails',$this->data);
	}
	public function savecustomerdetails(Request $request){
        if ($request->input("hid") != 0) {
            $customers = Customers::where("id", $request->input("hid"))->first();

            if($customers->email != $request->input('email'))
            {
                $validator  =   Validator::make($request->all(), [
                        'first_name' => 'required',
                        'mobile' => 'required|digits:10',
                        'email' => 'required|email|unique:customers'
                 ]);  
            }
            else
            {
                $validator  =   Validator::make($request->all(), [
                        'first_name' => 'required',
                        'mobile' => 'required|digits:10',
                        'email' => 'required|email'
                 ]);  
            }     
            
        } else {
            $customers = new Customers();

            $validator  =   Validator::make($request->all(), [
                        'first_name' => 'required',
                        'mobile' => 'required|digits:10',
                        'email' => 'required|email|unique:customers'
                 ]);  
        }	

        if ($validator->fails()) {
               $messages = $validator->messages();
               return redirect()->back()->withErrors($messages)->withInput($request->all()); 
        } 	

        $customers ->first_name = $request->input('first_name');		
		$customers->last_name = $request->input('last_name');
		$customers->mobile = $request->input('mobile');
        $customers->email = $request->input('email');		
		$customers->address = $request->input('address');
		$customers->city = $request->input('city');
        $customers->state = $request->input('state');		
		$customers->country = $request->input('country');
		//$customers->status = $request->input('status');
        $customers->save();
		return redirect('/admin/list-customerdetails')->with('message', 'successfully customer details added...');	
	}
     public function editcustomerdetails($id)
    {
        $this->data["customers"] = $this->customers->where("id", $id)->first();
		$this->data["state"] = $this->state->get();	
        return view('admin.customer.add-customerdetails',$this->data);
    }
	public function deletecustomerdetails($id){
		$customers = Customers::where('id',$id)->delete();
		return redirect('/admin/list-customerdetails')->withErrors(['sucessfully customer details Deleted']);
	}
	
	public function myprofile(Request $request){
		if ($request->isMethod('post')){
			$user = User::where('id',auth::user()->id)->first();
			$user->name = $request->input('name'); 
			$user->email = $request->input('email'); 
			$user->mobile = $request->input('mobile'); 
		    $user->password = Hash::make($request->input('password'));
		    $user->plain = $request->input('password'); 
			$user->status = $request->input('status');
			$image = $profile_images = '';   
		   if ($request->file('profile_image')) {
				$image = $request->file('profile_image');
				$profile_images = 'Profile_image' . time() . '_' . $image->getClientOriginalName();
				$image_resize = Image::make($image->getRealPath());              
				$image_resize->save(storage_path('app/public/profile/' .$profile_images));
				 $user->profile_image = $profile_images;
				//echo $profile_images; exit;
			}
			$user->save();
			return redirect()->back()->with('message', 'Successfully profile is update...'); 			
		}else{
			$this->data['title'] = 'My Profile';
			return view('admin.mypofile', $this->data);			
		} 		
	}
	public function exportstaff(Request $request){
		
		 return Excel::download(new StaffExports($request->all()), 'staff.xlsx');
		
	}
	public function exportcustomerdetails(Request $request){
		
		 return Excel::download(new CustomerExports($request->all()), 'customer.xlsx');
		
	}
	 public function logout(){
		
		Session::flush();
		
		return redirect('/');	
	}
}
