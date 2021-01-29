<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Userlist extends Model
{
	public $timestamps = false;
    protected $table = 'users';
     protected $fillable = ['name','user_id','user_type','last_name','email','password','phone','dob','gender','image','api_token'];
}
