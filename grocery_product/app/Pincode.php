<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Pincode extends Model
{
	public $timestamps = false;
     protected $table = 'admin_city_pincode';
     protected $fillable = ['id','pincode_id','city_id','pincode','pin_service_state'];
}
