
<?php
include '../../config.php';

$userid=$_GET['userid'];
$productid=$_GET['productid'];
$quantity=$_GET['quantity'];

$sql ="select * from `tbl_cart` where product_id='$productid' and user_id='$userid' ";
            $result = mysqli_query($con,$sql);
            $quantityold=0;
            while($row = mysqli_fetch_array($result)){
             $quantityold=$row['quantity'];
			}
	 	
			
			
if($quantityold > 0 ){
    $quantitynew=$quantityold + $quantity;
    $update = $con->query("update  `tbl_cart` set  `quantity`='$quantitynew' where `product_id`='$productid' and `user_id`='$userid'");

                if($update > 0)
                { 
                  $j->status  = "101";
                 
                 $cart_msg = $langs == 'en' ? "updated successfully" : "تمت الاضافة بنجاح ، عدد الطلبات في السلة $"; 
                  
                   $j->message = $langs == 'en' ? "Your Cart total quantity is $quantitynew $cart_msg " : " $quantitynew   تمت الاضافة بنجاح ، عدد الطلبات في السلة  ";
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "لانوجد بيانات";
                
                }
}
else{
$insert = $con->query("INSERT INTO `tbl_cart`(`product_id`, `quantity`, `user_id`) VALUES('$productid','$quantity','$userid')");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = $langs == 'en' ? "Cart added successfully" : "تمت الاضافة "; 
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "لانوجد بيانات"; 
                
                }
}
echo json_encode($j);
 

?>