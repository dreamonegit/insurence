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
use App\Models\Motorinsurance;
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
    		return view('insurance.stepone');
    	}

    }

    public function savecustomerdetails(Request $request){
        if(empty(Session::get('customer_id'))){
        	$customers = new Customers();
        } else {
            $customers = Customers::where("id", Session::get('customer_id'))->first();
        }		
        $customers->first_name = $request->input('first_name');		
		$customers->last_name = $request->input('last_name');
		$customers->mobile = $request->input('mobile');
        $customers->email = $request->input('email');		
		$customers->address = $request->input('address');
		$customers->city = $request->input('city');
        $customers->state = $request->input('state');		
		$customers->country = $request->input('country');
		$customers->status = $request->input('status');
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
    		$this->data["insurance"] = Insurance::where("id", Session::get('insurance_type'))->first();

        	return view('insurance.steptwo',$this->data);
        }
    }


    public function saveselectinsurance(Request $request){
        if(empty(Session::get('insurance_type'))){
        	$Insurance = new Insurance();
        } else {
            $Insurance = Insurance::where("id", Session::get('insurance_type'))->first();
        }		
      
      	$Insurance->customer_id = Session::get('customer_id');
		$Insurance->insurance_type = $request->input('insurance_type');
		$Insurance->status = '0';
        $Insurance->save();

        Session::put('insurance_type', $Insurance->id);

        //check type and redirect
        if($request->input('insurance_type') == '1')
        {
        	return redirect('/insurance/health-insurance');	
        }
        else if($request->input('insurance_type') == '2')
        {
        	return redirect('/insurance/motor-insurance');	
        }
        else
        {

        }
	}


	public function healthinsurance(Request $request)
    {
    	//save here
    	return view('insurance.health');
    }

    public function motorinsurance(Request $request)
    {
    	//save here
    	return view('insurance.motor');
    }


    public function savehealthinsurance(Request $request){
        
        $healthinsurance = new Healthinsurance();      
      	$healthinsurance->insurance_type_id = Session::get('insurance_type');
		$healthinsurance->insurance_type = $request->input('insurance_type');
		$healthinsurance->previous_year = $request->input('previous_year');
		$healthinsurance->remarks = $request->input('remarks');
		$healthinsurance->status = '1';
        $healthinsurance->save();

        return redirect('/insurance/insurance-complete');	
	}


	 public function savemotorinsurance(Request $request){
        
        $motorinsurance = new Motorinsurance();   
        $motorinsurance->insurance_type_id = Session::get('insurance_type');   
      	$motorinsurance->insurance_type = Session::get('insurance_type');
		$motorinsurance->vehicle_type = $request->input('vehicle_type');
		$motorinsurance->previous_year = $request->input('previous_year');
		$motorinsurance->remarks = $request->input('remarks');
        $motorinsurance->save();

        return redirect('/insurance/insurance-complete');	
	}

	public function insurance_complete(Request $request)
    {
    	return view('insurance.complete');
    }

}
