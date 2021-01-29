<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Product extends Model
{
	public $timestamps = false;
    protected $connection = 'product';
    protected $table = 'tbl_product';
    protected $fillable = ['product_name','category_id','sub_category_id','sku','mrp_price','selling_price','quantity','unit','image','description'];
}
