<?php
include '../../../config.php';


$id=$_POST['id'];
$name=$_POST['name'];
$phone=$_POST['phone'];
 
 
$accountstatus=$_POST['accountstatus']; 
$storename=$_POST['storename'];
$city=$_POST['city'];
$address=$_POST['address'];
$accountholdername=$_POST['accountholdername'];
$accountno=$_POST['accountno'];
$ifsccode=$_POST['ifsccode'];
$bankname=$_POST['bankname'];
$accounttype=$_POST['accounttype'];
 

 $insert = $con->query("UPDATE `vender` SET  `store_name`='$storename',`name`='$name', `phone`='$phone',`address`='$address',`city`='$city',`account_status`='$accountstatus',`account_holder_name`='$accountholdername',`account_no`='$accountno',`ifsc_code`='$ifsccode',`account_type`='$accounttype',`bank_name`='$bankname'    WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
