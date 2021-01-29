<?php

include '../../config.php';


$userid=$_GET['userid'];
$pass=$_GET['password'];
$password=md5($pass);
$resultdata =$con->query("update `users` set password='$password' where `id` = '$userid'" );
 
if($resultdata > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'Password changed successfully'));
}
else
{
    echo json_encode(array("status"=>'102',"message"=>'Some thing wrong'));
}

?>