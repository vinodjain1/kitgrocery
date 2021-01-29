<?php session_start(); ?>
<?php
include '../../../config.php';

    $user_email =$_POST['email'];
    $pass=$_POST['password'];
    
   
    $user_password = md5($pass);
    $result= $con->query("SELECT * FROM `admin` where email='$user_email' AND password='$user_password' AND type='main'");
	
		if($result->num_rows==0){
          echo '104';
		}
		else{	
            while($row = mysqli_fetch_array($result))
            {
             
                $_SESSION["adminid"] =$row['id'];
                $_SESSION["adminname"] =$row['name'];
                $_SESSION["adminemail"] =$row['email'];
                $_SESSION["adminimage"] =$row['image'];
                
           
            }
            echo '101';
	 }
		     
        
        
?>