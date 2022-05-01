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
use Session;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$this->data['healthusercount'] = $this->insurance->where('insurance_type',1)->count();
		$this->data['motorusercount'] = $this->insurance->where('insurance_type',2)->count();
		$this->data['lifeusercount'] = $this->insurance->where('insurance_type',3)->count();
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
	public function listcustomerdetails(){
	$this->data["customers"] = Customers::where('status','1')->get();
	return view('admin.customer.list-customerdetails',$this->data);
	}
	public function addcustomerdetails(){
    $this->data["state"] = $this->state->get();	
	return view('admin.customer.add-customerdetails',$this->data);
	}
	public function savecustomerdetails(Request $request){
        if ($request->input("hid") != 0) {
            $customers = Customers::where("id", $request->input("hid"))->first();
        } else {
            $customers = new Customers();
        }		
        $customers ->first_name = $request->input('first_name');		
		$customers->last_name = $request->input('last_name');
		$customers->mobile = $request->input('mobile');
        $customers->email = $request->input('email');		
		$customers->address = $request->input('address');
		$customers->city = $request->input('city');
        $customers->state = $request->input('state');		
		$customers->country = $request->input('country');
		$customers->status = $request->input('status');
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
}
