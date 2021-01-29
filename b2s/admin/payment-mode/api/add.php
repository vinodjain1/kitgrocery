<?php
include '../../../config.php';

$name_ar=$_POST['name_ar'];
$name_en=$_POST['name_en'];
 

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




$insert = $con->query("INSERT INTO `tbl_main_category`(`name_ar`,`name_en`, `image`) VALUES ('$name_ar','$name_en','$path')");

if($insert > 0)
{ 
  echo '101';
}
else{
  echo '104';
}


?>