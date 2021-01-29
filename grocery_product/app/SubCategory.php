<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class SubCategory extends Model
{
	public $timestamps = false;
     protected $table = 'admin_product_sub_category';
     protected $fillable = ['product_category_id','product_sub_category_id','product_sub_category_name','featured_image'];
}
