<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Order_item extends Model
{
	public $timestamps = false;
    protected $table = 'user_order_item';
    protected $fillable = ['partial_order_id','order_id','product_sku','inventory_id','supplier_id','product_name','unit_type','unit_amount','customer_order_status','quantity','selling_price','supplier_amount','order_id','order_item_id','city','pin_code','address','order_date','order_status'];
}
