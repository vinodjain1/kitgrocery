<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Account extends Model
{
	public $timestamps = false;
     protected $table = 'tbl_account_detail';
     protected $fillable = ['supplier_id','account_id','shop_id','bank_name','account_type','account_number','ifsc_code','pan_number'];
}
