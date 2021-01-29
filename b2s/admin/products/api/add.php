<?php
include '../../../config.php';

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

$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/products/'; // upload directory

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




$insert = $con->query("INSERT INTO `tbl_product`( `name_ar`, `name_en`, `last_price`, `price`, `quantity`, `unit`, `feature_image`, `description_ar`, `description_en`, `admin_product`, `location`, `sub_sub_category_id`, `status`, `brand_id`,`offer`) 
                                         VALUES ('$name_ar','$name_en','$lprice','$price','$quantity','$unit','$path','$description_ar','$description_en','$admin_product','$location','$sub_sub_category','$status','$brand','$off')");

if($insert > 0)
{ 
       $resultdata =$con->query("select * from `tbl_product` order by id desc limit 1" );
                 $id=null;
                 while($row=mysqli_fetch_array($resultdata))
                {
                   $id= $row['id'];
                }    
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/products/'; // upload directory
     
    
    $fileNames = array_filter($_FILES['files']['name']); 
    
    if(!empty($fileNames)){ 
         
        foreach($_FILES['files']['name'] as $key=>$val){ 
            // File upload path 
            $img = $_FILES['files']['name'][$key];
            // $tmp = $_FILES['files']['tmp_name'][$key];

             
             $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = rand(1000,1000000).$img;
        // check's valid format
		if(in_array($ext, $valid_extensions)) 
		{ 
		$path = $path.strtolower($final_image); 
// 		move_uploaded_file($tmp,'./../../'.$path);
		 if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], './../../'.$path)){ 
         $path=$baseimage.$path;    // Check whether file type is valid 
            
                     $insert = $con->query("INSERT INTO `gallery` (`product_id`, `image`) VALUES ('$id','$path')"); 
		 }
		    
		}
        }}
		
  echo '101';
}
else{
  echo '104';
}


?>