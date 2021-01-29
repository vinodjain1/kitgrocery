<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use App\Account;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class FcmnotificationController extends Controller
{
    
    public function pushnotificationandroidCartitemcount($device_id=null, $message=null, $user_id=null) {

		//API URL of FCM
		$url = 'https://fcm.googleapis.com/fcm/send';

		/*api_key available in:
		Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
		$api_key = 'f1f7e26de011b33f84e016d49354f96175ffd869ff34b1698daccc9dfa8732b8';
					
		$fields = array (
			'registration_ids' => array ('eSuUQltRNEA6tXQiXzMGcb:APA91bHQ80lHrE7xnWx9v-VXrxMyL4_hvwAx0oafZhOTPKZi5PCdHbpBlmAP7smFVqcCDiaK9QT04dlmFgA9DKd8x5qFQR1kr_dKy84H04sQMNYaAVfRtPhdRJB5qYn4v__6kAl6Mdjw'),
			'data' => array ("message" => '3')
		);

		//header includes Content type and api key
		$headers = array(
			'Content-Type:application/json',
			'Authorization:key='.$api_key
		);
					
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
		$result = curl_exec($ch);
		if ($result === FALSE) {
			die('FCM Send Error: ' . curl_error($ch));
		}
		curl_close($ch);
		
		
		return $result;
	}
    
    
}