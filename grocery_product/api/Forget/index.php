<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>experts</title>
<link rel='stylesheet' href='css/bootstrap.css' type='text/css' media='all' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Are Your Sour Reset Password</h2>   

<?php
include('db.php');
if(isset($_POST["email"]) && (!empty($_POST["email"]))){
$email = $_POST["email"];
$email = filter_var($email, FILTER_SANITIZE_EMAIL);
$email = filter_var($email, FILTER_VALIDATE_EMAIL);
if (!$email) {
  	$error .="<center><p>!! Your Email Address Is Not Proper!!</p></center>";
	}else{
	$sel_query = "SELECT * FROM `tbl_users` WHERE email='".$email."'";
	$results = mysqli_query($con,$sel_query);
	$row = mysqli_num_rows($results);
	if ($row==""){
		$error .= "<center><p>!! Your Email Address Not Exist!!</p></center>";
		}
	}
	if($error!=""){
	echo "<div class='error'>".$error."</div>
	<br /><a href='javascript:history.go(-1)'>Go Back</a>";
		}else{
	$expFormat = mktime(date("H"), date("i"), date("s"), date("m")  , date("d")+1, date("Y"));
	$expDate = date("Y-m-d H:i:s",$expFormat);
	$key = md5(2418*2+$email);
	$addKey = substr(md5(uniqid(rand(),1)),3,10);
	$key = $key . $addKey;
// Insert Temp Table
mysqli_query($con,
"INSERT INTO `password_reset_temp` (`email`, `key`, `expDate`)
VALUES ('".$email."', '".$key."', '".$expDate."');");

$output='<p>Dear user,</p>';
$output.='<p>Please click on the following link to reset your password.</p>';
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p><a href="kitsupdates.work/experts/api/Forget/reset-password.php?key='.$key.'&email='.$email.'&action=reset" target="_blank">kitsupdates.work/experts/api/Forget/reset-password.phpkey='.$key.'&email='.$email.'&action=reset</a></p>';		
$output.='<p>-------------------------------------------------------------</p>';
$output.='<p>Please be sure to copy the entire link into your browser.
The link will expire after 1 day for security reason.</p>';
$output.='<p>If you did not request this forgotten password email, no action 
is needed, your password will not be reset. However, you may want to log into 
your account and change your security password as someone may have guessed it.</p>';   	
$output.='<p>Thanks,</p>';
$output.='<p>AllPHPTricks Team</p>';
$body = $output; 
$subject = "Password Recovery - AllPHPTricks.com";

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
echo "Mailer Error: " . $mail->ErrorInfo;
}else{
echo "<div class='error'>
<center><p>!!Open Your Email And Reset Password!!</p></center>
</div><br /><br /><br />";
	}

		}	

}else{
?>
<form method="post" action="" name="reset"><br /><br />
<label><strong>Enter Your Email Address:</strong></label><br /><br />
<input type="email" class="form-control" name="email" placeholder="username@email.com" />
<br /><br />
<input type="submit" class="form-control" value="RESET PASSWORD" style="font-weight: 900;"/>
</form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<?php } ?>


<br /><br />

</div>
</body>
</html>