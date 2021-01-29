<?php
include '../../config.php';

 
$address_id=$_POST['address_id'];
 			
 
$insert = $con->query("delete from tbl_address where id='$address_id'");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = "Success"; 
                }
                else{
                $j->status  = "104";
                $j->message = "Some thing wrong"; 
                
                }
 
echo json_encode($j);
 

?>