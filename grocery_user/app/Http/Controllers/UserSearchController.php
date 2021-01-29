<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\UserSearch;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
header('Access-Control-Allow-Origin:*');
class UserSearchController extends Controller
{
public function store(Request $request)
 {
     $arr = $request->all();
     UserSearch::create($arr);
     return response()->json(['status'=>200,'success'=>'User Seach Succcessfully store']);
 }
 
}