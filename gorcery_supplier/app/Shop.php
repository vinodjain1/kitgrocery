<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Shop extends Model
{
	public $timestamps = false;
     protected $table = 'tbl_shop_detail';
     protected $fillable = ['supplier_id','shop_id','shop_name','gst_number','reg_number','category','pin_code','shop_type','week_off','address'];
}
