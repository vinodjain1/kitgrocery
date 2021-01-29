<?php
include '../../../config.php';

$id=$_POST['id'];
$status=$_POST['status'];
$sqlquery = $con->query("update `tbl_transcation` set status='$status'  , pay_date=NOW() where `id`='$id'");

if(isset($sqlquery)){
  echo '101';
}
else{
  echo 'Some thing went wrong';
}

?>