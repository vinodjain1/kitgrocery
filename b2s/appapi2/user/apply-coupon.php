<?php

include '../../config.php';

$coupon_code=$_GET['coupon_code']; 
 $resultdata=null;

$resultdata =$con->query("select * from `tbl_coupon` where `code` = '$coupon_code'" );
$result=array();
$i=0;
if($resultdata->num_rows > 0){
while($row=mysqli_fetch_array($resultdata))
{
 $result['code']= $row['code'];
 $result['percent']= $row['percent'];
 $result['title']= $row['title'];
 $result['description']= $row['description'];
 $result['image'] = $row['image'];
}
$msg = $langs == 'en' ? "data found" : " حدث خطأ";
 echo json_encode(array("status"=>'101',"message"=> $msg,"data"=>$result));
}else{
   $msg = $langs == 'en' ? "Coupon code not match" : "سيمة غير صالحة";
    echo json_encode(array("status"=>'404',"message"=> $msg ,"data"=>0));
}

?>