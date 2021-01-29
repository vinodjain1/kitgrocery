<?php
include '../../../config.php';

$name=$_POST['name'];
$phone=$_POST['phone'];
$email=$_POST['email'];
$pass=$_POST['password'];
$sex=$_POST['sex'];
$birthday=$_POST['birthday'];
$address=$_POST['address'];
$city=$_POST['city'];
$password=md5($pass);


			
          $sql ="select * from `users` where email='$email' ";
            $result = mysqli_query($con,$sql);
            $noofuser=0;
            while($row = mysqli_fetch_array($result)){
             $noofuser=$noofuser + 1;
			}
	 	
			
			
if($noofuser == 0 ){
$insert = $con->query("INSERT INTO `users`(`name`, `email`, `password`, `phone`, `birthday`, `sex`, `address`, `city`, `createAt`) VALUES
                                       ('$name','$email','$password','$phone','$birthday','$sex','$address','$city',NOW())");

                if($insert > 0)
                { 
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