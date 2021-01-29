<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Order extends Model
{
	public $timestamps = false;
    protected $table = 'user_order_table';
    protected $fillable = ['order_id','user_id','order_date','order_time','total_amount','discount_id','discount_amount','city_id','pin_code','address','payment_type'];
}
