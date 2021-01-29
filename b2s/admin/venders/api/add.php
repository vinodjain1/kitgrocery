<?php
include '../../../config.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$pass=$_POST['password'];
$storename=$_POST['storename'];
$city=$_POST['city'];
$address=$_POST['address'];
$accountholdername=$_POST['accountholdername'];
$accountno=$_POST['accountno'];
$ifsccode=$_POST['ifsccode'];
$bankname=$_POST['bankname'];
$accounttype=$_POST['accounttype'];
$password=md5($pass);


			
          $sql ="select * from `vender` where email='$email' ";
            $result = mysqli_query($con,$sql);
            $noofuser=0;
            while($row = mysqli_fetch_array($result)){
             $noofuser=$noofuser + 1;
			}
	 	
			
			
if($noofuser == 0 ){
$insert = $con->query("INSERT INTO `vender`( `store_name`,`name`,`email`,`password`, `phone`, `address`, `city`, `account_status`, `account_holder_name`, `account_no`, `ifsc_code`, `account_type`, `bank_name`, `createAt` ) VALUES
                                            ('$storename','$name','$email','$password','$phone','$address','$city' ,'active','$accountholdername','$accountno','$ifsccode','$accounttype','$bankname',NOW())");

                if($insert > 0)
                { 
                   
                $resultdata =$con->query("select * from `vender` order by id desc limit 1" );
                 $venderid=null;
                 while($row=mysqli_fetch_array($resultdata))
                {
                   $venderid= $row['id'];
                }    
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path = 'images/venders/'; // upload directory
     
    
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
            
                     $insert = $con->query("INSERT INTO `tbl_images` (`vender_id`,`file_name`, `uploaded_on`) VALUES ('$venderid','$path',NOW())"); 
		} 
		}
            }
             
        } 
         
         echo '101';
                
         
                }
                else{
                 echo '404';
                
                }
}
else{
    echo '102';
}

 
 

?>