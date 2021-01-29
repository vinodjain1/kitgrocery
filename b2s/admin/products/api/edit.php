<?php
include '../../../config.php';


$id=$_POST['id'];
$name_ar=$_POST['name_ar'];
$name_en=$_POST['name_en'];
$lprice=$_POST['lprice'];
$price=$_POST['price'];
$quantity=$_POST['quantity'];
$unit=$_POST['unit'];
$description_ar=$_POST['description_ar'];
$description_en=$_POST['description_en'];
if($_POST['admin_product'] ==null){
    $admin_product='No';
    }else{
    $admin_product=$_POST['admin_product'];
    }
    $off=$_POST['off'];
$sub_sub_category=$_POST['sub_sub_category'];
$location=$_POST['location'];
$status=$_POST['status'];
$brand=$_POST['brand']; 
 $path=null;

        
if($_FILES['image']['name'] != null){

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/maincategory/'; // upload directory

$img = $_FILES['image']['name'];
$tmp = $_FILES['image']['tmp_name'];
// get uploaded file's extension
$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
// can upload same image using rand function
$final_image = rand(1000,1000000).$img;
// check's valid format
		if(in_array($ext, $valid_extensions)) 
		{ 
		$path = $path.strtolower($final_image); 
		move_uploaded_file($tmp,'./../../'.$path);
		}
 $path=$baseimage.$path;
}
else{
    $sql ="select * from `tbl_product` where id='$id' ";
            $result = mysqli_query($con,$sql);
           
            while($row = mysqli_fetch_array($result)){
             $path=$row['feature_image'];
			}
}

 $insert = $con->query("UPDATE `tbl_product` SET  `name_ar`='$name_ar',`name_en`='$name_en',`last_price`='$lprice',`price`='$price',`quantity`='$quantity',`unit`='$unit',`feature_image`='$path',`description_ar`='$description_ar',`description_en`='$description_en',`admin_product`='$admin_product',`location`='$location',`offer`='$off',`sub_sub_category_id`='$sub_sub_category',`status`='$status',`brand_id`='$brand'   WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
