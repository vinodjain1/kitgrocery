<?php
include '../../../config.php';

$code=$_POST['code'];
$percent=$_POST['percent'];
$city=$_POST['city'];
$title=$_POST['title'];
$description=$_POST['description'];

/* old code 
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/coupon/'; // upload directory

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

*/

    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions

    $path = 'images/coupon/'; // upload directory

    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
    // can upload same image using rand function

    //$final_image = rand(1000,1000000).$img;
    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
        $salt_image  = time().rand(1111, 9999);
        $path = $path.$salt_image.'.'.$ext;    
       
        move_uploaded_file($tmp,'./../../'.$path);
    }
    
    $path=$baseimage.$path;
    
$sql ="select * from `tbl_coupon` where code='$code' ";
            $result = mysqli_query($con,$sql);
            $noofuser=0;
            while($row = mysqli_fetch_array($result)){
             $noofuser=$noofuser + 1;
			}
	 	
			

if($noofuser == 0 ){

$insert = $con->query("INSERT INTO `tbl_coupon`( `code`, `percent`, `city`, `title`, `description`, `image`) VALUES ('$code','$percent','$city','$title','$description','$path')");

if($insert > 0)
{ 
  echo '101';
}
else{
  echo '104';
}
}
else{
    echo '102';
}

?>