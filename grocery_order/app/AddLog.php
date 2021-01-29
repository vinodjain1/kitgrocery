<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AddLog extends Model
{
	public $timestamps = false;
    protected $table = 'user_cart_log';
    protected $fillable = ['cart_id','device_id','user_id','inventory_id','cart_status','date','location','price','product_image','product_name','quantity','mrp','unit_type','unit_amount','product_id','product_sku','supplier_id'];
}
