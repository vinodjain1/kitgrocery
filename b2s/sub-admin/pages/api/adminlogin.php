<?php session_start(); ?>
<?php
include '../../../config.php';

    $user_email =$_POST['email'];
    $pass=$_POST['password'];
    
   
    $user_password = md5($pass);
    $result= $con->query("SELECT * FROM `admin` where email='$user_email' AND password='$user_password' AND type='sub'");
	
		if($result->num_rows==0){
          echo '104';
		}
		else{	
            while($row = mysqli_fetch_array($result))
            {
             
                $_SESSION["subadminid"] =$row['id'];
                $_SESSION["subadminname"] =$row['name'];
                $_SESSION["subadminemail"] =$row['email'];
                $_SESSION["subadminimage"] =$row['image'];
                
           
            }
            echo '101';
	 }
		     
        
        
?>