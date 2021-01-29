<?php

include '../../config.php';
include './fcm-message.php';
$orderid=$_POST['orderid'];

 $sql ="select * from `tbl_order` where id='$orderid' ";
            $result = mysqli_query($con,$sql);
             $vender_id=null;
             $percent=null;
             $user_id=null;
              $payment_mode=null;
             $tbl_order_itemprice=null;
            while($row = mysqli_fetch_array($result)){
             $vender_id=$row['vender_id'];
             $percent=$row['commission'];
            $tbl_order_itemprice=$row['pay_price'];
            $user_id=$row['user_id'];
            $payment_mode=$row['payment_mode'];
			}
	    	$pricecommission=$tbl_order_itemprice* $percent/100; 
            $tbl_order_itemprice=$tbl_order_itemprice-$pricecommission;	
			if($payment_mode == 'Cash on Delivery')
			{
             $insert = $con->query("INSERT INTO `tbl_transcation`( `vender_id`, `order_id`, `amount`, `status`, `create_at`) VALUES ('$vender_id','$orderid','$tbl_order_itemprice','Cash on Delivery',NOW())");
			}else{
			     $insert = $con->query("INSERT INTO `tbl_transcation`( `vender_id`, `order_id`, `amount`, `status`, `create_at`) VALUES ('$vender_id','$orderid','$tbl_order_itemprice','Paid',NOW())");
           	}
                if($insert > 0)
                { 
                 
                 if($payment_mode == 'Cash on Delivery')
        			{
                       $update = $con->query("update `tbl_order` set `status`='Cash on Delivery' where id='$orderid'");
                       $paymenttitle=$paymenttitlecash;
                       $paymentbody=$paymentbodycash;
        			}else{
                        $update = $con->query("update `tbl_order` set `status`='Paid' where id='$orderid'");        
                    }
           	
    
  
    $insert = $con->query("INSERT INTO `tbl_notification`( `title_ar`, `description_ar`, `title_en`, `description_en`, `order_id`, `user_id`, `vendor_id`, `create_at`, `update_at`) VALUES 
                                         ('$paymenttitle','$paymentbody','$paymenttitle','$paymentbody','$orderid','$user_id','$vender_id',NOW(),NOW())");

  /////////////////////////////////fcm//////////////////////
  $ordervenderid=null;
    $resultdatatbl_order =$con->query("select * from `tbl_order` where id='$orderid'");
    while($rowtbl_order = mysqli_fetch_array($resultdatatbl_order)){
        $orderuserid=$rowtbl_order['user_id'];
        $ordervenderid=$rowtbl_order['vender_id'];
    }
     $resultdata =$con->query("select * from `users` where id=$orderuserid");
    while($row = mysqli_fetch_array($resultdata)){
    $fcmtoken=$row['fcmToken'];
    

    
$data = array("to" => $fcmtoken,
                  "notification" => array( "title" => "$paymenttitle", "body" => $paymentbody,"icon" => $icon),
                    "data"=>array("code"=> $paymentcode, "key1"=> $orderid,"key2"=> $paymentbody )
                  );                                                                    
            $data_string = json_encode($data); 
            
             "The Json Data : ".$data_string; 
            
            $headers = array
            (
                 'Authorization: key=' . API_ACCESS_KEY, 
                 'Content-Type: application/json'
            );                                                                                 
                                                                                                                                 
            $ch = curl_init();  
            
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
            curl_setopt( $ch,CURLOPT_POST, true );  
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                                 
            $result = curl_exec($ch);
    }
    
    $venderresultdata =$con->query("select * from `vender` where id=$ordervenderid");
    while($venderrow = mysqli_fetch_array($venderresultdata)){
    $venderfcmtoken=$venderrow['fcmtoken'];
    

    
$data = array("to" => $venderfcmtoken,
                  "notification" => array( "title" => "$venderpaymenttitle", "body" => $venderpaymentbody,"icon" => $icon),
                    "data"=>array("code"=> $venderpaymentcode, "key1"=> $orderid,"key2"=> $venderpaymentbody )
                  );                                                                    
            $data_string = json_encode($data); 
            
             "The Json Data : ".$data_string; 
            
            $headers = array
            (
                 'Authorization: key=' . API_ACCESS_KEY, 
                 'Content-Type: application/json'
            );                                                                                 
                                                                                                                                 
            $ch = curl_init();  
            
            curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );                                                                  
            curl_setopt( $ch,CURLOPT_POST, true );  
            curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);                                                                  
                                                                                                                                 
            $result = curl_exec($ch);
    }
            /////////////////////////////////fcm//////////////////////
                 $j->status  = "101";
                 $j->message = "Success"; 
                }
                else{
                 $j->status  = "104";
                 $j->message = "Some thing wrong"; 
                
                }
echo json_encode($j);
?>