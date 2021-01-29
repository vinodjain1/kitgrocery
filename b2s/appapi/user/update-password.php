<?php

include '../../config.php';


$userid=$_GET['userid'];
$pass=$_GET['password'];
$password=md5($pass);
$resultdata =$con->query("update `users` set password='$password' where `id` = '$userid'" );
 
if($resultdata > 0)
{
    $msg = $langs == 'en' ? 'Password changed successfully' : 'تم تغيير كلمة المرور بنجاح';
    echo json_encode(array("status"=>'101',"message"=> $msg));
}
else
{
    $msg = $langs == 'en' ? 'Some thing wrong' : 'حدث خطأ';
    echo json_encode(array("status"=>'102',"message"=> $msg));
}

?>