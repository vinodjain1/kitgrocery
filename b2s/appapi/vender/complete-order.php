<?php
include '../../config.php';

$userid=$_GET['userid'];

 
 $ssqqll="SELECT * FROM `tbl_order` where  status='Completed' and `vender_id`= $userid   order by id desc";
//  $ssqqll = "SELECT * FROM `tbl_order`";
$resultdata =$con->query($ssqqll);


$result=array();

   while($row=mysqli_fetch_array($resultdata))
    {
        
        $orderid=$row['id'];
         $tbl_order_itemresult = $con->query("select * from `tbl_order_item` where order_id='$orderid'");
        $tbl_order_itemprice=0;
        $productarr=array();
            while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
            {
             $productarr[]=$rowtbl_order_item;
             $tbl_order_itemprice=$tbl_order_itemprice + $rowtbl_order_item['price'];
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
             'products'=>$productarr,
             'orderprice'=>$tbl_order_itemprice
                
          	));    
    }   
    
    if(count($result) > 0)
    {
        echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
    }
    else
    {
        $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
        echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
    }

?>
