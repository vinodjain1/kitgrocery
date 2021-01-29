<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Driver extends Model
{
	public $timestamps = false;
	protected $table = 'tbl_drivers';
    protected $fillable = [
        'name','driver_id','phone', 'email', 'password','city_id','state','image',
    ];
}
