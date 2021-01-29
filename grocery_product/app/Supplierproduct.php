<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Supplierproduct extends Model
{
	public $timestamps = false;
     protected $table = 'supplier_product';
     protected $fillable = ['supplier_product_id','supplier_id','variant_sku','product_sku','product_name','product_category_id','unit_amount','unit_type','product_sub_category_id','mrp','discount_type','brand_id'
     ,'description','discount_amount','selling_price','total_quantity_offered','expiry_date','additional_note','product_quantity','city_id'];
}
