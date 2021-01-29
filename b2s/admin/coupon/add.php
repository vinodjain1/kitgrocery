    <?php include '../pages/header.php' ;?>
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
        
        $("#already").show()
    }
    else{
       $("#err").show()
    }
      },
     error: function(e) 
      {
   $("#err").html("Some thing went  worng").fadeIn().style.color.red;
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
                    <h4 class="card-title">اضافة كوبون</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform'>
                        
                      <div class="form-group">
                        <label for="exampleInputName1">الشفرة</label>
                        <input type="text" class="form-control" id="code" name='code' placeholder="Code" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">نسبه مئويه %</label>
                        <input type="text" class="form-control" id="percent" name='percent' placeholder="20" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">عنوان</label>
                        <input type="text" class="form-control" id="title" name='title' placeholder="Title" required>
                      </div>
                      <?php $resultdata =$con->query("select * from `tbl_delivery_address` where 1" ); ?>
                      <div class="form-group">
                        <label for="exampleInputName1">لعنوان</label>
                        
                        <select class="form-control" name="city">
                            <?php while($row=mysqli_fetch_array($resultdata))
    { ?>
                            <option value="<?php echo $row['id'];?>"><?php echo $row['name_en'];?></option>
                            
                            <?php } ?>
                        </select>
                      </div>
                       
                       <div class="form-group">
                        <label for="exampleTextarea1">وصف</label>
                        <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label>تحميل الملف</label>
                        <input type="file" id='image' name='image' class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image" >
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="submit">رفع</button>
                          </span>
                        </div>
                      </div>
                      
                     
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">إرسال</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">اضيف بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none">هناك خطأ ما !</span>
                      <span class="btn btn-danger" id="already" style="display:none">رمز القسيمة موجود بالفعل!</span>
                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>