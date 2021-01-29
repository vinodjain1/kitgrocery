<?php

include '../../config.php';
//  $os=$_POST['os'];
// echo "asdfasd";
// if($os == 'android'){
$_POST['name'];
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

$latitude=$_POST['latitude'];

$longitude=$_POST['longitude'];

$password=base64_encode($pass); 
// }else{
//   $arrdata=array();
//     $data = json_decode(file_get_contents("php://input"));
//     $name=$data->name;
    
// $phone=$data->phone;
// echo $email=$data->email;
// $pass=$data->password;
// $storename=$data->storename;
// $city=$data->city;
// $address=$data->address;
// $accountholdername=$data->accountholdername;
// $accountno=$data->accountno;
// $ifsccode=$data->ifsccode;
// $bankname=$data->bankname;
// $accounttype=$data->accounttype;
// $latitude=$data->latitude;
// $longitude=$data->longitude;
// $password=base64_encode($pass);
// }


// echo $email;die;
$sql ="select * from `vender` where email='$email' ";

$result = mysqli_query($con,$sql);

$noofuser=0;
// echo $email;die;
while($row = mysqli_fetch_array($result)){
if($row['email'] == $email){
  $noofuser= $noofuser+1;
  break;
}else{
  $noofuser=0;
}

}



if($noofuser == 0 ){

$insert = $con->query("INSERT INTO `vender`( `store_name`,`name`,`email`,`password`, `phone`, `address`, `city`, `account_status`, `account_holder_name`, `account_no`, `ifsc_code`, `account_type`, `bank_name`,`latitude`,`longitude` ,`createAt` ) VALUES

('$storename','$name','$email','$password','$phone','$address','$city' ,'deactive','$accountholdername','$accountno','$ifsccode','$accounttype','$bankname','$latitude','$longitude',NOW())");



if($insert > 0)

{



$resultdata =$con->query("select * from `vender` order by id desc limit 1" );

$venderid=null;

while($row=mysqli_fetch_array($resultdata))

{

$venderid= $row['id'];

}
$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp' , 'pdf' , 'doc' , 'ppt'); // valid extensions
$path2 = 'images/venders/'; // upload directory
     
    $fileNames=array();
    $fileNames = array_filter($_FILES['files']['name']); 
  
    if(!empty($fileNames)){ 
          for ($key = 0; $key < count($_FILES['files']['name']); $key++) {
        
            // File upload path 
            $img = $_FILES['files']['name'][$key];
            // $tmp = $_FILES['files']['tmp_name'][$key];

             $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
        // can upload same image using rand function
        $final_image = rand(1000,1000000).$img;
        // check's valid format

		if(in_array($ext, $valid_extensions)) 
		{ 
		$path1 = $path2.strtolower($final_image); 
        
		 move_uploaded_file($_FILES["files"]["tmp_name"][$key], './../../'.$path1); 
         $path=$baseimage.$path1;    // Check whether file type is valid 
           
                     $insert = $con->query("INSERT INTO `tbl_images` (`vender_id`,`file_name`, `uploaded_on`) VALUES ('$venderid','$path',NOW())");
		 }
		    
		
        }
        
    }




$j->status = "101";

$j->message = $langs == 'en' ? "Success" : "تم";

}

else{

$j->status = "104";

$j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ";



}

}

else{

$j->status = "102";

$j->message = $langs == 'en' ? "Email Already Existed" : "البريد الالكتروني مسجل بالفعل";

}



echo json_encode($j);









?>