<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Storage;
use DB;
use App\Models\User;
use App\Models\Customers;
use App\Models\Insurance;
use App\Models\Healthinsurance;
use App\Models\State;
use Session;
use Redirect;
use Auth, Validator, Response;
class InsuranceController extends Controller
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

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	if(empty(Session::get('customer_id')))
    	{
		    $this->data["state"] = $this->state->get();
    		return view('insurance.stepone',$this->data);
    	}
    	else
    	{
    		$this->data["customers"] = Customers::where("id", Session::get('customer_id'))->first();
			$this->data["state"] = $this->state->get();
    		return view('insurance.stepone',$this->data);
    	}

    }

    public function savecustomerdetails(Request $request){

             
        
        

        if(empty(Session::get('customer_id'))){
        	$customers = new Customers();

            $validator  =   Validator::make($request->all(), [
                    'first_name' => 'required',
                    'mobile' => 'required|digits:10',
                    'email' => 'required|email|unique:customers'
             ]);       

        } else {
            $customers = Customers::where("id", Session::get('customer_id'))->first();

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
        }

        if ($validator->fails()) {
               $messages = $validator->messages();
               return redirect()->back()->withErrors($messages)->withInput($request->all()); 
        } 

		$customers->staff_id = Auth::user()->id;		
        $customers->first_name = $request->input('first_name');		
		$customers->last_name = $request->input('last_name');
		$customers->mobile = $request->input('mobile');
        $customers->email = $request->input('email');		
		$customers->address = $request->input('address');
		$customers->city = $request->input('city');
        $customers->state = $request->input('state');		
		$customers->country = $request->input('country');
		$customers->status = '0';
        $customers->save();
		Session::put('customer_id', $customers->id);

		return redirect('/insurance/select-insurance');	
	}


	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function selectinsurance(Request $request)
    {
    	//save here
    	if(empty(Session::get('insurance_type')))
    	{
    		return view('insurance.steptwo');
    	}
    	else
    	{
    		$this->data["insurance"] = Healthinsurance::where("id", Session::get('insurance_type'))->first();

        	return view('insurance.steptwo',$this->data);
        }
    }


    public function saveselectinsurance(Request $request){
        if(empty(Session::get('insurance_type'))){
        	$Insurance = new Healthinsurance();
        } else {
            $Insurance = Healthinsurance::where("id", Session::get('insurance_type'))->first();
        }
		$Insurance->staff_id = Auth::user()->id;		
		$Insurance->created_user_id = Auth::user()->id;
      	$Insurance->customer_id = Session::get('customer_id');
		$Insurance->insurance_type = $request->input('insurance_type');
		$Insurance->vehicletype = $request->input('vehicletype');
		$Insurance->status = '1';
		$Insurance->insurance_date = $request->input('insurance_date');
		$Insurance->insurance_expiry_date = $request->input('insurance_expiry_date');
		$Insurance->sm_ssm_name = $request->input('sm_ssm');
		$Insurance->payonehub_code = $request->input('advisor_code');
		$Insurance->policybazaar_code = $request->input('policybazaar_code');
		$Insurance->advisor_name = $request->input('advisor_name');
		$Insurance->application_no = $request->input('application_no');
		$Insurance->company_name = $request->input('company_name');
		$Insurance->insurance_expiry_date = $request->input('insurance_expiry_date');
        $Insurance->save();

        Session::put('insurance_type', $Insurance->id);

        //check type and redirect
        
        return redirect('/insurance/health-insurance');	
        
	}


	public function healthinsurance(Request $request)
    {
    	if(empty(Session::get('insurance_type'))){
    		return view('insurance.health');
        } else {
            $this->data["insurance"] = Healthinsurance::where("id", Session::get('insurance_type'))->first();

        	return view('insurance.health',$this->data);
        }		

    	
    }

  

    public function savehealthinsurance(Request $request){
        if(empty(Session::get('insurance_type'))){
        	$Insurance = new Healthinsurance();
        } else {
            $Insurance = Healthinsurance::where("id", Session::get('insurance_type'))->first();
        }	

		$Insurance->staff_id = Auth::user()->id;
		$Insurance->plan_name = $request->input('plan_name');
		$Insurance->sum_assured = $request->input('sum_assumed');
		$Insurance->emi = $request->input('emi');
		$Insurance->emi_month = $request->input('emi_month');
		$Insurance->emi_due = $request->input('emi_due');
		$Insurance->premium_paying_term = $request->input('premium_term');
		$Insurance->policy_term = $request->input('policy_term');
		$Insurance->gross_premium = $request->input('gross_premium');
		$Insurance->net_premium = $request->input('net_premium');
		$Insurance->policy_no = $request->input('policy_no');
		$Insurance->status = '1';
        $Insurance->save();
        
        if(Session::get('customer_id')){
            $customers = Customers::where("id", Session::get('customer_id'))->first();
        } 
        $customers->status = '1';
        $customers->save();

        Session::put('insurance_type', '');
        Session::put('customer_id', '');

        return redirect('/insurance/insurance-complete');	
	}


	public function insurance_complete(Request $request)
    {
    	return view('insurance.complete');
    }

    public function editinsurance($id)
    {
    	$Insurance = Healthinsurance::where("id", $id)->first();
    	Session::put('insurance_type', $id);
    	Session::put('customer_id', $Insurance->customer_id);

    	return redirect('/insurance/select-insurance');	
    }

}
