<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Useraddress extends Model
{
	public $timestamps = false;
    protected $table = 'user_address';
     protected $fillable = ['user_id','address_id','user_name','address_line_1','land_mark','city','pin_code','state','address_type'];
}
