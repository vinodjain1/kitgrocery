<?php
include '../../config.php';

$user_id=$_GET['user_id'];
$result=array(); 

 
    
        $tbl_brandresultdata =$con->query("select * from `tbl_notification` where user_id='$user_id' or user_id='ALL' " );
        
        while($row=mysqli_fetch_array($tbl_brandresultdata))
        {
        $result[]=$row;
    }
     
if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'data not found' : 'جد بيانات';
    echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
}

?>