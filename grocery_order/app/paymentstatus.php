<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class paymentstatus extends Model
{
	public $timestamps = false;
    protected $table = 'user_order_table';
    protected $fillable = ['order_id','user_id','payment_id','status','payment_date'];
}
