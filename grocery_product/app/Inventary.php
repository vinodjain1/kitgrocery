<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Inventary extends Model
{
	public $timestamps = false;
     protected $table = 'admin_product_inventary';
     protected $fillable = ['s_id','inventory_id','product_id','product_sku','variant_id','variant_sku','supplier_id','city_id','unit_amount','unit_type','packaging_type','mrp','discount_type','discount_amount','pin_code','availability','status'];
}
