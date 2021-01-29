<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>FireOnlineStudey. Are Your Want To Reset Password</title>
<link rel='stylesheet' href='css/bootstrap.css' type='text/css' media='all' />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all' />
</head>
<body>
<div style="width:700px; margin:50 auto;">
<center><img src="logo.jpg" style="height:210px;width:210px;border-radius:50%;"></center>
<h2>Are Your Want To Reset Password</h2>   
<?php
include('db.php');
if (isset($_GET["key"]) && isset($_GET["email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$email = $_GET["email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($con,"
SELECT * FROM `password_reset_temp` WHERE `key`='".$key."' and `email`='".$email."';");
$row = mysqli_num_rows($query);
if ($row==""){
$error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link from the email, 
or you have already used the key in which case it is deactivated.</p>
<p><a href="https://www.allphptricks.com/forgot-password/index.php">Click here</a> to reset password.</p>';
	}else{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
	?>

    <br />
	<form method="post" action="" name="update">
	<input type="hidden" name="action" value="update" />
	<br /><br />
	<label><strong>Enter New Password:</strong></label><br />
	<input type="password" class="form-control" name="pass1" id="pass1" maxlength="15" placeholder="New Password" required />
    <br /><br />
	<label><strong>Re-Enter New Password:</strong></label><br />
	<input type="password" class="form-control" name="pass2" id="pass2" placeholder="Confirm Password" maxlength="15" required/>
    <br /><br />
	<input type="hidden" name="email" value="<?php echo $email;?>"/>
	<input type="submit" id="reset" class="form-control" value="RESET PASSWORD" style="font-weight: 900;"/>
	</form>
<?php
}
		}
if($error!=""){
	echo "<div class='error'>".$error."</div><br />";
	}			
} // isset email key validate end


if(isset($_POST["email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_real_escape_string($con,$_POST["pass1"]);
$pass2 = mysqli_real_escape_string($con,$_POST["pass2"]);
$email = $_POST["email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
		$error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
		}
	if($error!=""){
		echo "<div class='error'>".$error."</div><br />";
		}else{

$pass1 = md5($pass1);
mysqli_query($con,
"UPDATE `tbl_users` SET `password`='".$pass1."', `created_at`='".$curDate."' WHERE `email`='".$email."';");	

mysqli_query($con,"DELETE FROM `password_reset_temp` WHERE `email`='".$email."';");		
	
echo '<div class="error"><center><p>Congratulations! Your password has been updated successfully.</p></center>
</div><br />';
		}		
}
?>
</div>
</body>
</html>