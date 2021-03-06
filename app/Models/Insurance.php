<?php

namespace App\Models;
use Auth;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Insurance extends Authenticatable
{
    use Notifiable;
	
	protected $table="insurance_type";
	
	public function countstaffcustomer(){
		
		return $this->hasMany('App\Models\Customers', 'id', 'customer_id')->where('staff_id',Auth::user()->id);
	}

}
