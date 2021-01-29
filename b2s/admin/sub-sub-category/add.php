    <?php include '../pages/header.php'?>
      <?php
     $resultdata =$con->query("select * from `tbl_main_category`" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $tbl_main_categoryresult[]= $row;
        
                       
    }?> 
    
<script>
function get_sub_category(val) {
    $("#loader").show();
	$.ajax({
	type: "POST",
	url: "./api/get_sub_category.php",
	data:'main_id='+val,
	success: function(data){
		$("#sub_category").html(data);
		$("#loader").hide();
	}
	});
}
</script>
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
                    <h4 class="card-title">الاقسام</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="POST" id='dataform'>
                    
                      <div class="form-group">
                        <label for="exampleInputName1">اسم القائمة الرئيسية</label>
                    
                        <select class="form-control" id="main_category" name="main_category"   onChange="get_sub_category(this.value);">
                            <option value="">اختر الفئة</option>
                            <?php foreach($tbl_main_categoryresult as $data){?>
                             <option  value="<?php echo $data['id'] ?>" > <?php echo $data['name_ar'] .' , '. $data['name_en'] ?>  </option>
                              <?php  } ?>
                        </select>
                       
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1"> اسم الفئات</label>
                    
                        <select class="form-control" id="sub_category" name="sub_category" >
                            
                        </select>
                        <span id='loader' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      </div>   
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالعربي</label>
                        <input type="text" class="form-control" id="name_ar" name='name_ar' placeholder="Name" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالانجليزي</label>
                        <input type="text" class="form-control" id="name_en" name='name_en' placeholder="Name" required>
                      </div>
                      
                      <div class="form-group">
                        <label>تحميل الملف</label>
                        <input type="file" id='image' name='image' class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="submit">رفع</button>
                          </span>
                        </div>
                      </div>
                      
                      <!--<div class="form-group">-->
                      <!--  <label for="exampleTextarea1">Textarea</label>-->
                      <!--  <textarea class="form-control" id="exampleTextarea1" rows="4"></textarea>-->
                      <!--</div>-->
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">تقديم</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">اضيف بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none">! هناك خطأ ما</span>

                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>