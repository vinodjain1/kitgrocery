<?php
include '../../../config.php';

$id=$_POST['vender_id'];
$status=$_POST['status'];
$sqlquery = $con->query("update `tbl_transcation` set status='$status'  , pay_date=NOW() where `vender_id`='$id'");

if(isset($sqlquery)){
  echo '101';
}
else{
  echo 'Some thing went wrong';
}

?>