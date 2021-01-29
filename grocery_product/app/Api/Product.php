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
     protected $table = 'admin_product';
     protected $fillable = ['product_id','product_sku','product_name','product_category_id','product_sub_category_id','featured_image','gallery_image','brand_id','description'];
}
