<!-- ///////////////////login up funcation////////////////// -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function (e) {
 $("#form").on('submit',(function(e) {
   $("#loading").show();
  e.preventDefault();
  $.ajax({
   url: "api/adminlogin.php",
   type: "POST",
   data:  new FormData(this),
   contentType: false,
         cache: false,
   processData:false,
   beforeSend : function()
   {
    //$("#preview").fadeOut();
    $("#err").fadeOut();
   },
   success: function(data)
      {
        
    if(data == 101)
    {
    
     $("#form")[0].reset(); 
     $("#message").html("").fadeIn();
     
  window.location.href = "index.php";
    }
    
    else{
     $("#successmessage").html("! User not Vaild :)").fadeIn().style.color.red;
    }
      },
     error: function(e) 
      {
   $("#successmessage").html("Some thing went  worng").fadeIn().style.color.red;
      }          
    });
 }));
});
</script>
<!-- //////////////////login//////////////////////////// -->

<head>
<style>
input[type=text],[type=password], select {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}

input[type=submit] {
  width: 100%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}

input[type=submit]:hover {
  background-color: #45a049;
}

 
</style>

</head>
  <body class="login-page" style="margin:0px" >
 
 <div style="background-image: url('https://marketplace.canva.com/EAD297uecnM/2/0/1600w/canva-rainbow-gradient-pink-orange-and-blue-zoom-virtual-background-VwJMC37j5jQ.jpg'); height:100%; background-size: cover;">     
      
      
    
<div class="row" style=" width: 33%;  padding: 10px;    margin-left: 33%; ">
<div class="col-md-12">
<div class="card">
      
<div class="card-header" style="margin-top:30%;">
<center>
    <div class="login-logo" style="margin: auto;margin-top:30%">
        
          <img src="https://kamakhyaits.com/b2s/admin/images/admin/432144boy.png" height=100; width=100 >
         
      </div>
      
      <h5 class="card-header-text">دخول المشرف</h5></div>
      </center> 
<div class="card-block">
<div id="wizard">
<section>
    
<form method="post" id="form"  enctype="multipart/form-data" novalidate>
<label for="fname">البريد الالكتروني</label>
    <input type="text" id="email" name="email" placeholder="market@gmail.com">

    <label for="lname">الرقم السري</label>
    <input type="password" id="password" name="password" placeholder="*****">
 <input type="submit" value="Login">

<span class="successmessage" id="successmessage" style="color:red"></span>
 
</form>
 <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=50 width=50  /></span>
</section>
</div>
</div>
</div>
</div>
</div>
</div>
  </body>
</html>