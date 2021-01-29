<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class AddCart extends Model
{
	public $timestamps = false;
    protected $table = 'user_cart_management';
    protected $fillable = ['cart_id','device_id','inventory_id','supplier_id','product_sku','cart_status','date','location','price','product_name','product_image','quantity','mrp','unit_type','unit_amount','product_id'];
}
