<?php

namespace App\Models;
use App\Models\User;
use Auth, Validator, Response;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Customers extends Authenticatable
{
    use Notifiable;
	
	protected $table="customers";

	public static function getstaffname($staffid){
		
		$staff = User::where('id',$staffid)->first();
		if(isset($staff->name)){
			return $staff->name;
		}	
	}
	public static function getcustomername($id){
		$customer = self::where('id',$id)->first();
		if(isset($customer->first_name)){
			return $customer->first_name;
		}			
	}
}
