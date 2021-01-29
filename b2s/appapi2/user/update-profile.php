<?php

include '../../config.php';

$os=$_POST['os'];
if($os == 'android'){
    $userid=$_POST['userid'];
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $birthday=$_POST['birthday'];
    $sex=$_POST['sex'];
    $address=$_POST['address'];
    $city=$_POST['city'];   
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input"));
    $userid=$data->userid;
    $name=$data->name;
    $phone=$data->phone;
    $birthday=$data->birthday;
    $sex=$data->sex;
    $address=$data->address;
    $city=$data->city;
}

 
$resultdata =$con->query("update `users` set name='$name' ,  phone='$phone' ,  birthday='$birthday' ,  sex='$sex' ,  address='$address' ,  city='$city'   where `id` = '$userid'" );

$resultdata =$con->query("select * from `users` where `id` = '$userid'" );
 
$result=array();
while($row=mysqli_fetch_array($resultdata))
{
$result[]=$row;
}


if($resultdata > 0)
{
    $msg = $langs == 'en' ? 'Update Changed Successfully' : 'تم التحديث ';
    echo json_encode(array("status"=>'101',"message"=> $msg,"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'Some thing wrong' : 'حدث خطأ';
    echo json_encode(array("status"=>'102',"message"=> $msg));
    
}

?>