 <?php include '../pages/header.php'?>
     <?php
     $id=$_GET['id'];
     $resultdata =$con->query("select * from `tbl_commission` where id='$id'" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
    }?> 
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
   url: "api/edit.php",
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
      location.reload(true);
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
                    <h4 class="card-title">الفئة الرئيسية</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                     <form class="forms-sample" action="#" methood="post" id='dataform'>
                      <?php
                        foreach($result as $data){?>
                        
                      <div class="form-group">
                        <label for="exampleInputName1">القيمة</label>
                        <input type="text" class="form-control" id="name" name='name' value="<?php echo $data['value'] ?>"  required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">نسبه مئويه %</label>
                      <input type="text" value="<?php echo $data['percent'] ?>" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" id="percent" name='percent' placeholder="12" maxlength="3" required>
                   </div>
                      
                     <?php }?>
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">تقديم</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">تم الاضافة بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none">هناك خطأ ما !</span>

                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>