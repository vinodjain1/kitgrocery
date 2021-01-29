<?php
include '../../../config.php';

$id=$_POST['id'];

$sqlquery = $con->query("delete from `tbl_commission`  where `id`='$id'");

if(isset($sqlquery)){
  echo '101';
}
else{
  echo 'Some thing went wrong';
}

?>