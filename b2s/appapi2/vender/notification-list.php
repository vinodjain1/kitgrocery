<?php
include '../../config.php';

$vendor_id=$_GET['vendor_id'];
$result=array(); 

 
    
        $tbl_brandresultdata =$con->query("select * from `tbl_notification` where vendor_id='$vendor_id' or user_id='ALL' " );
        
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
    echo json_encode(array("status"=>'404',"message"=>'لاتوجد بيانات',"data"=>$result));
}

?>