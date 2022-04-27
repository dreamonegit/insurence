<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Http\Request;
use Storage;
use DB;
use App\Models\User;
use App\Models\Customers;
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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('insurance.stepone');
    }


    public function savecustomerdetails(Request $request){
        if ($request->input("hid") != 0) {
            $customers = Customers::where("id", $request->input("hid"))->first();
        } else {
            $customers = new Customers();
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
		return redirect('/admin/select-insurance');	
	}


	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function selectinsurance()
    {
        return view('insurance.steptwo');
    }



}
