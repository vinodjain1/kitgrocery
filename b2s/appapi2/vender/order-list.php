<?php
include '../../config.php';

$userid=$_GET['userid'];
$city=$_GET['city'];
$status=$_GET['status'];
$latitude=null;
$longitude=null;
$raduis='50';


 $venderresult = $con->query("select * from `vender`  where `id`='$userid' AND `account_status` ='active'");
          //$rowvender['raduis'];
            while($rowvender=mysqli_fetch_array($venderresult))
            {
             $latitude=$rowvender['latitude'];
             $longitude=$rowvender['longitude'];
            }
            
            if($status == 'Yet to accept'){
                $ssqqll="SELECT * FROM `tbl_order` where   `status`='Yet to accept' and `city`='$city'  order by id desc";
            }
            else if($status == 'Processed' || $status == 'Accepted' || $status == 'On Road' || $status == 'Paid'|| $status == 'Cash on Delivery' )
            {
                $ssqqll="SELECT * FROM `tbl_order` where `vender_id`='$userid' AND `city`='$city'  AND ( `status`='Processed'  OR `status`='Accepted' OR `status`='On Road' OR `status`='Paid' OR `status`='Cash on Delivery')  order by id desc";
              
            }
            
// if($status == 'Yet to accept'){
//   $ssqqll="SELECT *, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(`latitude`)) ) ) AS distance FROM `tbl_order` where   `status`='Yet to accept' HAVING distance < $raduis  order by id desc";
  
// }else if($status == 'Processed' || $status == 'Accepted' || $status == 'On Road' || $status == 'Paid'|| $status == 'Cash on Delivery' ){
//   $ssqqll="SELECT *, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(`latitude`)) ) ) AS distance FROM `tbl_order` where `vender_id`='$userid' AND ( `status`='Processed'  OR `status`='Accepted' OR `status`='On Road' OR `status`='Paid' OR `status`='Cash on Delivery')   HAVING distance < $raduis  order by id desc";
  
// }
 
$resultdata =$con->query($ssqqll);


$result=array();

   while($row=mysqli_fetch_array($resultdata))
    {
        
        $orderid=$row['id'];
        $percent=$row['commission'];
        $tbl_order_itemprice=$row['pay_price'];
        //  $tbl_order_itemresult = $con->query("select * from `tbl_order_item` where order_id='$orderid'");
        // $tbl_order_itemprice=0;
        //     while($rowtbl_order_item=mysqli_fetch_array($tbl_order_itemresult))
        //     {
        
        //      $tbl_order_itemprice=$tbl_order_itemprice + $rowtbl_order_item['price'];
        //     }
            
        
          $pricecommission=$tbl_order_itemprice* $percent/100; 
          $tbl_order_itemprice=$tbl_order_itemprice-$pricecommission;
          
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
            'user-d'=>$row['user_id'],
             'user_name'=>$row['user_name'],
            'user_email'=>$row['user_email'],
            'user_phone'=>$row['user_phone'],
            'vender_id'=>$row['vender_id'],
            'address'=>$row['location'],
            'status' =>$order_status,
            'create_at'=>$row['create_at'],
            'latitude'=>$row['latitude'],
            'longitude'=>$row['longitude'],
             'distance'=>$row['distance'],
             'orderprice'=>$tbl_order_itemprice,
             'payment_mode'=>$row['payment_mode']
                
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

