    <?php include '../pages/header.php'; ?>
<!-- ///////////////////add up funcation////////////////// -->
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    setInterval(() => {
       $("#successmessage").hide()
       $("#err").hide()
   }, 5000);
</script>
<script>
$(document).ready(function (e) {
    
$("#dataform").on('submit',(function(e) {
  $("#btnsubmit").hide();
   $("#loading").show();
  e.preventDefault();
   $.ajax({
   url: "api/add.php",
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
         // alert(data)
    
     $("#btnsubmit").show(); 
      $("#loading").hide();
    if(data == 101)
    {
     
     $("#successmessage").show()
     $("#dataform")[0].reset(); 
     $("#message").html("").fadeIn();
      window.location.href = "#";
    }
    else if(data == 102){
        $("#already").show();
    }
    else{
       $("#err").show();
    }
      },
     error: function(e) 
      {
   $("#err").html("Some thing went  wrong").fadeIn().style.color.red;
      }          
    });
 }));
});
</script>
<!-- //////////////////add new doctor//////////////////////////// -->
        <!-- partial -->
              <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
         
       
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">المستخدمين</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform'>
                        
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم</label>
                        <input type="text" class="form-control" id="name" name='name' placeholder="Jhon doe" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">البريد الالكتروني</label>
                        <input type="text" class="form-control" id="email" name='email' placeholder="jhon@gmail.com" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">الرقم السري</label>
                        <input type="password" class="form-control" id="password" name='password' placeholder="*********" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">رقم الهاتف</label>
                        <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" id="phone" name='phone' placeholder="9999999999" maxlength="10" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">تاريخ الميلاد</label>
                        <input type="date" class="form-control" id="birthday" name='birthday' placeholder="12-02-2001" required>
                      </div>
                       <div class="mb-2">
                        <label class="custom-control custom-radio">
                        <input id="sex" name="sex" type="radio" class="custom-control-input" value="male">
                       <span class="custom-control-label"></span>
                       </label>
                        <label class="custom-control custom-radio">
                           <input id="sex" name="sex" type="radio" class="custom-control-input" value="female">ذكر
                                 <span class="custom-control-label">انثى</span>
                            </label>
                        </div>                       
                      
                      <div class="form-group">
                        <label for="exampleTextarea1">العنوان</label>
                        <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">المدينة</label>
                        <input type="text" class="form-control" id="city" name='city' placeholder="jaipur" required>
                      </div>
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">تقديم</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">تم الاضافة بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none">! هناك خطأ ما</span>
                      <span class="btn btn-danger" id="already" style="display:none">! البريد الإلكتروني المستخدم بالفعل</span>
                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
          
         <?php include '../pages/footer.php'?>