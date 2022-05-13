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
use App\Models\Life_Insurance;
use App\Models\State;
use Session;
use Redirect;
use Auth, Validator, Response;
class CustomerController extends Controller
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


    public function viewcustomer($id)
    {
            $this->data["customers"] = Customers::where("id", $id)->first();
            $this->data["get_insurance_details"] = Healthinsurance::where('customer_id', $id)->get();

            $this->data["state"] = $this->state->get();
            return view('admin.customer.view-customer',$this->data);
    }

   
}
