<!DOCTYPE html>
<html>
<head>
 <title>Login form</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
 
</head>
<body>
 <div class="container">
 <div class="row mt-5">
 <div class="col-6 align-self-center">
 <h2>Login Form</h2>
 <hr>
 <form method="post" action="http://localhost:8000/login">
 <div class="form-group">
 <div class="form-group row">
 <label  class="col-sm-2 col-form-label">Username</label>
 <div class="col-sm-10">
 <input type="text" class="form-control" id="txtuser" name="email" value="">
 </div>
 </div>
 </div>
 <div class="form-group">
 <div class="form-group row">
 <label  class="col-sm-2 col-form-label">Password</label>
 <div class="col-sm-10">
 <input type="password" class="form-control" name="password" id="txtpass" value="">
 </div>
 </div>
 </div>
 <button type="submit" id="btnlogin" class="btn btn-primary mb-2">Login</button>
 <a role="button" href="register.php"  class="btn btn-primary mb-2 float-right active">Register</a>
 
 </form>
 <div class="alert hidden informasi" role="alert"  ></div>
 </div>
 </div>
 </div>
</body>
<script
src="https://code.jquery.com/jquery-3.3.1.min.js" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" ></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"  ></script>