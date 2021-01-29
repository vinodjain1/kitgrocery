<?php

include '../../config.php';

$user_id=$_GET['user_id'];
 $result=array();
        $tbl_addressresultdata =$con->query("select * from `tbl_address` where user_id='$user_id'" );
         while($tbl_addressrow=mysqli_fetch_array($tbl_addressresultdata))
        {
          $result[]=$tbl_addressrow;
        }
         
    

if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    echo json_encode(array("status"=>'404',"message"=>'data not found',"data"=>$result));
}

?>