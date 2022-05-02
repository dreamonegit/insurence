<?php

namespace App\Models;
use App\Models\User;
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
		return $staff->name;
		
	}
}
