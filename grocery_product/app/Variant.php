<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Variant extends Model
{
	public $timestamps = false;
     protected $table = 'admin_product_variant';
     protected $fillable = ['id','variant_id','variant_sku','product_id','product_sku','unit_type','unit_amount','minimum_margin','discount_amount'];
}
