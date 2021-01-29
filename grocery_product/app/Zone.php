<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Zone extends Model
{
	public $timestamps = false;
     protected $table = 'admin_zone';
     protected $fillable = ['zone_id','city_id','pin_code','zone_name','driver_name'];
}
