<?php
include '../../config.php';

$userid=$_GET['userid'];
$productid=$_GET['productid']; 

 
$delete = $con->query("DELETE FROM `tbl_cart` where `user_id`='$userid' and `product_id`='$productid'");

                if($delete > 0)
                { 
                 $j->status  = "101";
                 $j->message = "Item delete Successfully"; 
                }
                else{
                $j->status  = "104";
                $j->message = "Some thing wrong"; 
                
                }
 
echo json_encode($j);
 

?>