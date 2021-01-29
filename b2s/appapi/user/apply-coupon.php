<?php

include '../../config.php';

$coupon_code=$_GET['coupon_code']; 
$city_id=$_GET['city_id']; 
 

$resultdata =$con->query("select * from `tbl_coupon` where `code` = '$coupon_code' AND `city` = $city_id" );

$result=array();
$i=0;
while($row=mysqli_fetch_array($resultdata))
{
  
    //     array_push($result,
    //     array(
    //         'id'=>$row['id'],
    //         'title'=>$row['title'],
    //         'description'=>$row['description'],
    //         'percent'=>$row['percent'], 
    //         'image'=>$row['image'],
             
    //     ));
    // }
 $i=1;   
 
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$row));
}
if($i == 0)
{   
    $msg = $langs == 'en' ? "Coupon code not match" : "سيمة غير صالحة";
    echo json_encode(array("status"=>'404',"message"=> $msg ,"data"=>0));
}

?>