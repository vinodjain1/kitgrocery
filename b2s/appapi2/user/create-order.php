<?php
include '../../config.php';
include './fcm-message.php';

//  echo "adsfdsf";die;
$arrdata=array();
 $data = json_decode(file_get_contents("php://input"));
$userid=$data->userid;
// $latitude=$data->latitude; 
// $longitude=$data->longitude;
$location=$data->location;
 $city=$data->city;
$arrdata=$data->itemarr;
$coupon_code=$data->coupon_code;
$coupon_percent=$data->coupon_percent;
$pay_price=$data->pay_price;
$payment_mode=$data->payment_mode;
$fcmtoken=null;
$raduis=50;
$resultdata =$con->query("select * from `users` where id='$userid'");
 
while($row = mysqli_fetch_array($resultdata)){
     
    $username=$row['name'];
    $useremail=$row['email'];
    $userphone=$row['phone'];
    $fcmtoken=$row['fcmToken'];
}			
        
	 	
   
$tbl_commission =$con->query("select * from `tbl_commission` order by id desc limit 1");
 
while($tbl_commissionrow = mysqli_fetch_array($tbl_commission)){
     
    $percent=$tbl_commissionrow['percent'];
     
}    
 
    
 		
 
$insert = $con->query("INSERT INTO `tbl_order`( `user_name`, `user_email`, `user_phone`, `user_id`,`city`, `location`, `status`, `create_at`,`coupon_code`,`coupon_percent`,`pay_price`,`payment_mode`,`commission`) VALUES 
                                         ('$username','$useremail','$userphone','$userid','$city','$location','Yet to accept',NOW(),'$coupon_code','$coupon_percent','$pay_price','$payment_mode','$percent')");

                if($insert > 0)
                { 
                    $resultdatatbl_order =$con->query("select * from `tbl_order` order by id desc limit 1");
                   $orderid=null;
                    while($rowtbl_order = mysqli_fetch_array($resultdatatbl_order)){
                      $orderid= $rowtbl_order['id']; 
                    }
                    foreach($arrdata as $val){
                    $productid= $val->id; 
                    $productquantity= $val->quantity; 
                    $productunit= $val->unit;
                    $productnoitem= $val->item;
                    $productprice= $val->price; 
                    
                    $resultdata =$con->query("select * from `tbl_product` where id='$productid'");
                 
                    while($row = mysqli_fetch_array($resultdata)){
                         
                        $name_ar=$row['name_ar'];
                        $name_en=$row['name_en'];
                        $description_ar=$row['description_ar'];
                        $description_en=$row['description_en'];
                        $feature_image=$row['feature_image']; 
                         
                          
                $insert = $con->query("INSERT INTO `tbl_order_item`( `order_id`, `name_ar`, `name_en`, `quantity`,`unit`,`no_of_item`, `price`, `description_ar`, `description_en`, `image`, `product_id`) 
                                                        VALUES ('$orderid','$name_ar','$name_en','$productquantity','$productunit','$productnoitem','$productprice','$description_ar','$description_en','$feature_image','$productid')");
                
                    }
                  $delete = $con->query("DELETE FROM `tbl_cart` where `user_id`='$userid'");

                
                }
                $insert = $con->query("INSERT INTO `tbl_notification`( `title_ar`, `description_ar`, `title_en`, `description_en`, `order_id`, `user_id`, `vendor_id`, `create_at`, `update_at`) VALUES 
                                         ('$vendercreateoredrtitle','$vendercreateoredrtitle','$vendercreateoredrtitle','$vendercreateoredrtitle','$orderid','$userid','ALL',NOW(),NOW())");

                $ssqqllfcm="SELECT *, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(`latitude`)) ) ) AS distance FROM `vender` where   `account_status`='active' HAVING distance < $raduis  order by id desc";
                $resultdatafcm =$con->query($ssqqllfcm);
                while($rowfcm=mysqli_fetch_array($resultdatafcm))
                {
                    $fcmtokenvender=$rowfcm['fcmtoken'];
                     /////////////////////////////////fcm//////////////////////
                        $data = array("to" => $fcmtokenvender,
                              "notification" => array( "code"=> "$vendercreateoredrcode","title" => "$vendercreateoredrtitle", "body" => "$vendercreateoredrbody","icon" => "$icon"),
                              "data"=>array("code"=> $vendercreateoredrcode, "key1"=> $orderid,"key2"=> $pay_price ));
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
            /////////////////////////////////fcm//////////////////////
                }
                /////////////////////////////////fcm//////////////////////
                $resultdata =$con->query("select * from `users` where id='$userid'");
 
while($row = mysqli_fetch_array($resultdata)){
     
  
    $fcmtoken=$row['fcmToken'];

                           $data = array("to" => $fcmtoken,
                              "notification" => array( "code"=> "$createoredrcode","title" => "$createoredrtitle", "body" => "$createoredrbody","icon" => "$icon"),
                              "data"=>array("code"=> $createoredrcode, "key1"=> $orderid,"key2"=> $pay_price ));
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
            /////////////////////////////////fcm//////////////////////
}
                $j->status  = "101";
                $j->message = $langs == 'en' ? "Success" : "تم";
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ";
                
                }
 

echo json_encode($j);
 

?>