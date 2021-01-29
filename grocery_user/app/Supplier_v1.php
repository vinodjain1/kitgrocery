<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Supplier extends Model
{
	public $timestamps = false;
     protected $table = 'suppliers';
     protected $fillable = ['name','supplier_id','user_type','email','phone','dob','adhar_number','password','api_token','address'];
}
