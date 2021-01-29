<?php
include '../../config.php';

$orderid=$_GET['orderid'];
$language=$_GET['language'];
 
 $ssqqll="SELECT * FROM `tbl_order` where id='$orderid' order by id desc";
//  $ssqqll = "SELECT * FROM `tbl_order`";
$resultdata =$con->query($ssqqll);


$result=array();

   while($row=mysqli_fetch_array($resultdata))
    {
       if($language == 'ar'){
         $tbl_order_itemresult = $con->query("select name_ar,description_ar,price,image,quantity,unit,no_of_item from `tbl_order_item` where order_id='$orderid'");
        $tbl_order_itemarr=array();
        $totalprice=0;
            while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
            {
        
             $tbl_order_itemarr[]=$rowtbl_order_item;
             $totalprice=$totalprice+$rowtbl_order_item['price'];
            }
            
         array_push($result,
       array(
            'orderid'=>$row['id'],
            'vender_id'=>$row['vender_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'address'=>$row['location'],
            'coupon_code'=>$row['coupon_code'],
            'coupon_percent'=>$row['coupon_percent'],
            'pay_price'=>$row['pay_price'], 
            'status' =>$row['status'],
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'], 
             'products'=>$tbl_order_itemarr,
             'total_price' =>$totalprice  
          	)); 
       }
       else if($language == 'en'){
           
         $tbl_order_itemresult = $con->query("select name_en,description_en,price,image,quantity,unit,no_of_item from `tbl_order_item` where order_id='$orderid'");
        $tbl_order_itemarr=array();
        $totalprice=0;
            while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
            {
        
             $tbl_order_itemarr[]=$rowtbl_order_item;
             $totalprice=$totalprice+$rowtbl_order_item['price'];
            }
            
         array_push($result,
       array(
            'orderid'=>$row['id'],
            'vender_id'=>$row['vender_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'address'=>$row['location'],
            'coupon_code'=>$row['coupon_code'],
            'coupon_percent'=>$row['coupon_percent'],
            'pay_price'=>$row['pay_price'], 
            'status' =>$row['status'],
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'], 
             'products'=>$tbl_order_itemarr,
             'total_price' =>$totalprice  
          	)); 
       }
    }   
    
    if(count($result) > 0)
    {
        echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
    }
    else
    {
        $msg = $langs == 'en' ? 'data not found' : 'لاتوجد ب';
        echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
    }

?>

