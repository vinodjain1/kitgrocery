<?php
include '../../config.php';

$userid=$_GET['userid'];
$productid=$_GET['productid']; 

 
$delete = $con->query("DELETE FROM `tbl_cart` where `user_id`='$userid' and `product_id`='$productid'");

                if($delete > 0)
                { 
                 $j->status  = "101";
                 $j->message = $langs == 'en' ? "Item delete Successfully" : "تم حذف المنتج بنجاح"; 
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ"; 
                
                }
 
echo json_encode($j);
 

?>