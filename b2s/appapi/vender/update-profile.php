<?php

include '../../config.php';

$os=$_POST['os'];
if($os == 'android'){ 
 

$userid=$_POST['userid'];
$name=$_POST['name'];
$phone=$_POST['phone'];
$address=$_POST['address'];
$city=$_POST['city']; 
$account_holder_name=$_POST['account_holder_name'];
$account_no=$_POST['account_no'];
$ifsc_code=$_POST['	ifsc_code'];
$account_type=$_POST['account_type'];
$bank_name=$_POST['bank_name'];
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input"));  
    $userid=$data->userid;
    $name=$data->name;
    $phone=$data->phone;
    $address=$data->address;
    $city=$data->city; 
    $account_holder_name=$data->account_holder_name;
    $account_no=$data->account_no;
    $ifsc_code=$data->ifsc_code;
    $account_type=$data->account_type;
    $bank_name=$data->bank_name;
} 
 
$updateresultdata =$con->query("update `vender` set `name`='$name' ,  `phone`='$phone' ,  address='$address' ,  city='$city' 
  ,account_holder_name='$account_holder_name',account_no='$account_no',ifsc_code='$ifsc_code',account_type='$account_type',bank_name='$bank_name'
where `id` = '$userid'" );

$resultdata =$con->query("select * from `vender` where `id` = '$userid'" );
 
$result=array();
while($row=mysqli_fetch_array($resultdata))
{
$result[]=$row;
}


if($updateresultdata > 0)
{
    $msg = $langs == 'en' ? 'Update Changed Successfully' : ' تم التحديث بنجاح';
    echo json_encode(array("status"=>'101',"message"=> $msg,"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'Some thing wrong' : ' حدث خطأ';
    echo json_encode(array("status"=>'102',"message"=> $msg));
}

?>