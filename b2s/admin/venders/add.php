    <?php include '../pages/header.php'; ?>
<!-- ///////////////////add up funcation////////////////// -->
 

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    setInterval(() => {
       $("#successmessage").hide()
       $("#err").hide()
        $("#already").hide()
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
   $("#err").html("Some thing went wrong").fadeIn().style.color.red;
    
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
                    <h4 class="card-title">البائع</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform' enctype="multipart/form-data">
                        
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
                        <label for="exampleInputName1">اسم المتجر</label>
                        <input type="text" class="form-control" id="storename" name='storename' placeholder="gori" required>
                      </div>
                                               
                      <div class="form-group">
                        <label for="exampleTextarea1">العنوان</label>
                        <textarea class="form-control" id="address" name="address" rows="4"></textarea>
                      </div>
                      <!--<div class="form-group">
                        <label for="exampleInputName1">المدينة</label>
                        <input type="text" class="form-control" id="city" name='city' placeholder="jaipur" required>
                      </div>-->
                       <?php $resultdata =$con->query("select * from `tbl_delivery_address` where 1" ); ?>
                      <div class="form-group">
                        <label for="exampleInputName1">العنوان</label>
                        
                        <select class="form-control" id="city" name="city">
                            <?php while($row=mysqli_fetch_array($resultdata))
    { ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name_en'];?></option>
                            
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">اسم صاحب الحساب</label>
                        <input type="text" class="form-control" id="accountholdername" name='accountholdername' placeholder="raju kumar" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">رقم الحساب</label>
                        <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" id="accountno" name='accountno' placeholder="611492392942434" maxlength="20" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">رمز البنك</label>
                        <input type="text" class="form-control" id="ifsccode" name='ifsccode' placeholder="0192SBIN" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Bank Name</label>
                        <input type="text" class="form-control" id="bankname" name='bankname' placeholder="SBI" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">نوع الحساب</label>
                        <select id="accounttype" name="accounttype" class="form-control">
                            <option value='current'>تيار</option>
                            <option value='saving'>إنقاذ</option>
                             
                        </select>
                      </div>
                       <div class="form-group">
                        <label for="exampleInputName1">تحميل المستندات</label>
                       <input type="file" name="files[]" multiple >
                      </div>
                       
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">إرسال</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">تم الاضافة بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none"> ! هناك خطأ ما</span>
                      <span class="btn btn-danger" id="already" style="display:none">البريد الإلكتروني المستخدم بالفعل!</span>
                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
          
         <?php include '../pages/footer.php'?>