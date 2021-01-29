<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Userprofile extends Model
{
	public $timestamps = false;
	 protected $table = 'users';
     protected $fillable = ['dob','gender','name','phone','email','home_number','street_number','area_detail','land_mark','location','pin_code','city','address_type'];
}
