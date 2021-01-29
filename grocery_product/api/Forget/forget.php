<?php
include('db.php');
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
$email_arr=array();
if (!$email) {
      $email_arr["status"]="0";
      $email_arr["messages"]="Your Email Address Is Not Proper.";
      echo json_encode($email_arr);
}else{
	$sel_query = "SELECT * FROM `tbl_users` WHERE email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
  	    if ($row==""){
	    $email_arr["status"]="0";
        $email_arr["messages"]="Your Email Address Not Exist";
        echo json_encode($email_arr);
		}else{
		        if ($results->num_rows > 0) {
		            $name=null;
                while($row1 = $results->fetch_assoc()) {
                    $name=$row1["name"];
                    //echo "id: " . $row1["fname"]. " - Name: " . $row1["fname"]. " " . $row1["fname"]. "<br>";
                }
                } else {
                   // echo "0 results";
                }
		        $expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
            	$expDate = date("Y-m-d H:i:s",$expFormat);
            	$key = md5(2418*2+$email);
            	$addKey = substr(md5(uniqid(rand(),1)),3,10);
            	$key = $key . $addKey;
                mysqli_query($con,
                "INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
                VALUES ('".$email."', '".$key."', '".$expDate."');");
                
                $output='<p>Dear '.$name.',</p>';
                $output.='<p>Please click on the following link to reset your password.</p>';
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<a href="kitsupdates.work/experts/api/Forget/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">kitsupdates.work/experts/api/Forget/reset-password.phpkey='.$key.'&email='.$email.'&action=reset</a>';		
                $output.='<p>-------------------------------------------------------------</p>';
                $output.='<p>Please be sure to copy the entire link into your browser.
                The link will expire after 1 day for security reason.</p>';
                $output.='<p>If you did not request this forgotten password email, no action 
                is needed, your password will not be reset. However, you may want to log into 
                your account and change your security password as someone may have guessed it.</p>';   	
                $output.='<p>Thanks,</p>';
                $output.='<p>AllPHPTricks Team</p>';
                $body = $output; 
                $subject = "Password Recovery";
                $email_to = $email;
                $fromserver = "noreply@experts.com"; 
                require("PHPMailer/PHPMailerAutoload.php");
                $mail = new PHPMailer();
                // $mail->IsSMTP();
                $mail->Host = "mail.experts.com"; // Enter your host here
                $mail->SMTPAuth = true;
                $mail->Username = "noreply@experts.com"; // Enter your email here
                $mail->Password = "password"; //Enter your passwrod here
                $mail->Port = 25;
                $mail->IsHTML(true);
                $mail->From = "noreply@experts.com";
                $mail->FromName = "AllPHPTricks";
                $mail->Sender = $fromserver; // indicates ReturnPath header
                $mail->Subject = $subject;
                $mail->Body = $body;
                $mail->AddAddress($email_to);
		        if(!$mail->Send()){
                 $email_arr["status"]="0";
                 $email_arr["messages"]=$mail->ErrorInfo;
                  echo json_encode($email_arr);
		        }else{
                      $email_arr["status"]="1";
                      $email_arr["messages"]="Open Your Email And Reset Password";
                       http_response_code(200);
                       echo json_encode($email_arr);
                	}
		    
		}
	}

}else{
        $email_arr["status"]="0";
        $email_arr["messages"]="Email not Found";
        echo json_encode($email_arr);
}
?>