<?php

include '../../config.php';


$userid=$_GET['userid'];

$resultdata =$con->query("select * from `vender` where `id` = '$userid'" );
 
$result=array();
while($row=mysqli_fetch_array($resultdata))
{
$result[]=$row;
}
if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'data not found' : ' لاتوجد بيانات';
    
    echo json_encode(array("status"=>'404',"message"=> $msg, "data"=>$result));
}

?>