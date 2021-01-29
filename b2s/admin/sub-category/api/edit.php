<?php
include '../../../config.php';


$id=$_POST['id'];
$name_ar=$_POST['name_ar'];
$name_en=$_POST['name_en'];
$main_category=$_POST['main_category'];
 $path=null;

        
if($_FILES['image']['name'] != null){

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/subcategory/'; // upload directory

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
    $sql ="select * from `tbl_sub_category` where id='$id' ";
            $result = mysqli_query($con,$sql);
           
            while($row = mysqli_fetch_array($result)){
             $path=$row['image'];
			}
}

 $insert = $con->query("UPDATE `tbl_sub_category` SET  `name_ar`='$name_ar',`name_en`='$name_en',`image`='$path',`main_category_id`='$main_category'  WHERE  id='$id'");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>
