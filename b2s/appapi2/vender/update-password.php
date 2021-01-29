<?php

include '../../config.php';

$old_password=$_GET['old_password'];
$userid=$_GET['userid'];
$pass=$_GET['password'];
$password=md5($pass);
$old_password_md=md5($old_password);
$resultdata =$con->query("select * from `vender` where `id` = '$userid' AND password='$old_password_md'" );
$old_password_val=0;    
     while($row=mysqli_fetch_array($resultdata))
    {
        $old_password_val=1;
    }
if($old_password_val == 1){
        $resultdata =$con->query("update `vender` set password='$password' where `id` = '$userid'" );
         
        if($resultdata > 0)
        {
            $msg = $langs == 'en' ? 'Password changed successfully' : ' تم تغيير كلمة المرور بنجاح';
            echo json_encode(array("status"=>'101',"message"=> $msg));
        }
        else
        {
            $msg = $langs == 'en' ? 'Some thing wrong' : 'حدث خطأ'; 
            echo json_encode(array("status"=>'102',"message"=> $msg));
        }
}
else{
     $msg = $langs == 'en' ? 'Your Old Password Wrong' : 'كلمة السر القديمة خطأ'; 
     echo json_encode(array("status"=>'103',"message"=> $msg));
}
?>