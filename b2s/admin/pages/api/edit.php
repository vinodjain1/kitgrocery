<?php
include '../../../config.php';



$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
$phone=$_POST['phone'];
 $path=null;
$pass=null;
        
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
    $sql ="select * from `admin` where id='1' ";
            $result = mysqli_query($con,$sql);
           
            while($row = mysqli_fetch_array($result)){
             $path=$row['image'];
			}
}
if($password != null){
 
    $pass=md5($password);
}
else{
    $sql ="select * from `admin` where id='1' ";
            $result = mysqli_query($con,$sql);
           
            while($row = mysqli_fetch_array($result)){
             $pass=$row['password'];
			}
}


 $insert = $con->query("UPDATE `admin` SET  `name`='$name',`email`='$email',`password`='$pass',`phone`='$phone',`image`='$path' ");

if($insert > 0){

  echo '101';
}
else{
  echo '104';
}

?>