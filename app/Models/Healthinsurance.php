<?php

namespace App\Models;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Healthinsurance extends Authenticatable
{
    use Notifiable;
	
	protected $table="health_insurance";

	public static function getexpirynotification(){
		return self::where('insurance_expiry_date', '<', now()->addDays(10))->get();
		
	}
}
