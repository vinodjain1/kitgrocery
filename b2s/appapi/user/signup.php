<?php
include '../../config.php';
$os=$_POST['os'];
if($os == 'android'){
    $name=$_POST['name'];
    $phone=$_POST['phone'];
    $email=$_POST['email'];
    $pass=$_POST['password'];
    $password=base64_encode($pass);
    $type='simple';    
}else{
    $arrdata=array();
    $data = json_decode(file_get_contents("php://input"));
    $name=$data->name;
    $phone=$data->phone;
    $email=$data->email;
    $pass=$data->password;
    $password=base64_encode($pass);
    $type='simple';
}




			
          $sql ="select * from `users` where email='$email' ";
            $result = mysqli_query($con,$sql);
            $noofuser=0;
            while($row = mysqli_fetch_array($result)){
             $noofuser=$noofuser + 1;
			}
	 	
			
			
if($noofuser == 0 ){
$insert = $con->query("INSERT INTO `users`(`name`, `email`, `password`, `phone`,`login_type`) VALUES
                                       ('$name','$email','$password','$phone','$type')");

                if($insert > 0)
                { 
                  $j->status  = "101";
                 $j->message = $langs == 'en' ? "Success" : "تم"; 
                }
                else{
                $j->status  = "104";
                $j->message = $langs == 'en' ? "Some thing wrong" : "حدث خطأ"; 
                
                }
}
else{
    $j->status  = "102";
    //$j->message = "Email Already Existed,البريد الالكتروني مسجل بالفعل"; 
    $j->message = $langs == 'en' ? 'Email Already Existed' : 'الالكتروني مسجل بالفعل';
}

echo json_encode($j);
 

?>