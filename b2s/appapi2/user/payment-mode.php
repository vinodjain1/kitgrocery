<?php
include '../../config.php';

$result=array(); 
    $con->query('SET NAMES "utf8"');
    $tbl_payment_modedata =$con->query("SELECT * FROM `tbl_payment_mode`  where status='1'");
       
        while($row=mysqli_fetch_array($tbl_payment_modedata))
        {
             
             
         array_push($result,
        array(
        'id'=>$row['id'],
        'name'=>$langs == 'ar' ? $row['name_ar'] : $row['name'],
        'payment_mode'=> $row['name']
         
        ));
        
        }
     
if(count($result) > 0)
{
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
}

?>