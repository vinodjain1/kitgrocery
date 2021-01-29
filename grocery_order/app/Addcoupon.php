<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Addcoupon extends Model
{
	public $timestamps = false;
    protected $table = 'user_coupon';
    protected $fillable = ['coupen_id','title','admin_product_category','admin_product_sub_category','image','coupon_code','code','city','percentage','max_value',
    'min_value','use_per_user','payment_method','date_from','date_to','description'];
}
