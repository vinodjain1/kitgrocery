<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class UserSearch extends Model
{
	public $timestamps = false;
    protected $table = 'user_search_keyword';
    protected $connection = 'USER';
     protected $fillable = ['search_id','user_id','device_id','search_keyword','search_number','city_id','search_date','location'];
}
