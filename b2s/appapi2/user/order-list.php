<?php
include '../../config.php';

$userid=$_GET['userid'];

  $ssqqll="SELECT * FROM `tbl_order` where user_id='$userid' order by id desc";
  

 
$resultdata =$con->query($ssqqll);


$result=array();

   while($row=mysqli_fetch_array($resultdata))
    {
        
        $orderid=$row['id'];
        $percent=$row['commission'];
        $tbl_order_itemprice=$row['pay_price'];
        
        $tbl_order_itemresult = $con->query("select * from `tbl_order_item` where order_id='$orderid'");
        $tbl_order_itemarr=0;
         
            while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
            {
        
            $tbl_order_itemarr=$tbl_order_itemarr + 1;
              
            }    
        
        //   $pricecommission=$tbl_order_itemprice* $percent/100; 
        //   $tbl_order_itemprice=$tbl_order_itemprice-$pricecommission;
        
        //Get order status
          $order_status = $row['status'];

          if($row['status']=='Yet to accept') {
            $order_status = $langs == 'en' ? $row['status'] : 'لم تقبل بعد';
          }

          if($row['status']=='Processing') {
            $order_status = $langs == 'en' ? $row['status'] : 'معالجة';
          }

          if($row['status']=='Accepted') {
            $order_status = $langs == 'en' ? $row['status'] : 'وافقت';
          }

          if($row['status']=='Completed') {
            $order_status = $langs == 'en' ? $row['status'] : 'منجز';
          }

          if($row['status']=='New Order') {
            $order_status = $langs == 'en' ? $row['status'] : 'طلب جديد';
          }

          if($row['status']=='On Road') {
            $order_status = $langs == 'en' ? $row['status'] : 'على الطريق';
          }

          if($row['status']=='Packed') {
            $order_status = $langs == 'en' ? $row['status'] : 'معباه';
          }

          if($row['status']=='Processed') {
            $order_status = $langs == 'en' ? $row['status'] : 'معالجتها';
          }
          
         array_push($result,
       array(
            'orderid'=>$row['id'],
            'user-id'=>$row['user_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'address'=>$row['location'],
            'status' =>$order_status,
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'],
            'distance'=>$row['distance'],
            'payment_mode'=>$row['payment_mode'],
             'orderprice'=>$tbl_order_itemprice,
             'no_of_item'=>$tbl_order_itemarr
                
          	));    
    }   
    
    if(count($result) > 0)
    {
        echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
    }
    else
    {
        $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
        echo json_encode(array("status"=>'404',"message"=>$msg,"data"=>$result));
    }

?>

