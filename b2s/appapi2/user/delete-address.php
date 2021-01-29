<?php
include '../../config.php';
 
//  $arrdata=array();
//  $data = json_decode(file_get_contents("php://input"));
$address_id =$_POST['address_id'];   
    
 
$insert = $con->query("DELETE FROM `tbl_address` WHERE `id`='$address_id'");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = $langs == 'en'? "Success" : "تم"; 
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ"; 
                
                }
 
echo json_encode($j);
 

?>