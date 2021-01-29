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
        $commission=0;
        $commission=$row['commission'];
       if($language == 'ar'){
         $tbl_order_itemresult = $con->query("select name_ar,description_ar,price,image,quantity,no_of_item,unit from `tbl_order_item` where order_id='$orderid'");
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
            'user-d'=>$row['user_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'address'=>$row['location'],
            'status' =>$row['status'],
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'],
             'distance'=>$row['distance'],
             'payment_mode'=>$row['payment_mode'],
             'products'=>$tbl_order_itemarr,
             'total_price' =>$totalprice  
          	)); 
       }
       else if($language == 'en'){
           
         $tbl_order_itemresult = $con->query("select name_en,description_en,price,image,quantity,no_of_item,unit from `tbl_order_item` where order_id='$orderid'");
        $tbl_order_itemarr=array();
        $totalprice=0;
            while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
            {
        
             $tbl_order_itemarr[]=$rowtbl_order_item;
             $totalprice=$totalprice+$rowtbl_order_item['price'];
            }
           $commissionprice= $totalprice* $commission/100;
           $totalprice=$totalprice-$commissionprice;
           
         array_push($result,
       array(
            'orderid'=>$row['id'],
            'user-d'=>$row['user_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'address'=>$row['location'],
            'status' =>$row['status'],
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'],
             'distance'=>$row['distance'],
             'payment_mode'=>$row['payment_mode'],
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
        $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
        
        echo json_encode(array("status"=>'404',"message"=> $msg, "data"=>$result));
    }

?>

