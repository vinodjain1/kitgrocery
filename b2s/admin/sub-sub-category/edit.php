 <?php include '../pages/header.php'?>
     <?php
     $id=$_GET['id'];
     $resultdata =$con->query("select * from `tbl_sub_sub_category` where id='$id'" );
     $result=array();
     $subcatid=null;
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
       $subcatid=$row['sub_category_id'];
    }?> 
    
     <?php
     $tbl_sub_categoryresultdata =$con->query("select * from `tbl_sub_category`" );
     $tbl_sub_categoryresult=array();
     while($tbl_sub_categoryrow=mysqli_fetch_array($tbl_sub_categoryresultdata))
    {
       $tbl_sub_categoryresult[]= $tbl_sub_categoryrow;
    }?> 
    
    <?php
     $tbl_sub_categoryresultd =$con->query("select * from `tbl_sub_category` where id='$subcatid'" );
     $sub_categoryresult=null;
     $sub_categoryresultname=null;
     while($sub_categoryrow=mysqli_fetch_array($tbl_sub_categoryresultd))
    {
       $sub_categoryresult= $sub_categoryrow['id'] ;
       $maincatid=$sub_categoryrow['main_category_id'] ;
       $sub_categoryresultname=$sub_categoryrow['name_ar'] .','.$sub_categoryrow['name_en'];
    }?>
    
    
    <?php
     $tbl_main_categoryresultdata =$con->query("select * from `tbl_main_category`" );
     $tbl_main_categoryresult=array();
     while($tbl_main_categoryrow=mysqli_fetch_array($tbl_main_categoryresultdata))
    {
       $tbl_main_categoryresult[]= $tbl_main_categoryrow;
    }?> 
    
    <?php
     $tbl_main_categoryresultd =$con->query("select * from `tbl_main_category` where id='$maincatid'" );
     $main_categoryresult=null;
     $main_categoryresultname=null;
     while($main_categoryrow=mysqli_fetch_array($tbl_main_categoryresultd))
    {
       $main_categoryresult= $main_categoryrow['id'] ;
       $main_categoryresultname=$main_categoryrow['name_ar'] .','.$main_categoryrow['name_en'];
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
   }, 3000);
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
                    <h4 class="card-title">تعديل</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform'>
                      <?php foreach($result as $data){?>
                      <input type="hidden" class="form-control" id="id" name='id' value="<?php echo $data['id'];?>">
                      <div class="form-group">
                        <label for="exampleInputName1">اسم القائمة الرئيسية</label>
                    
                        <select class="form-control" id="main_category" name="main_category"   onChange="get_sub_category(this.value);">
                            <option value="<?php echo $main_categoryresult ?>" ><?php echo $main_categoryresultname ?></option>
                           
                            <?php foreach($tbl_main_categoryresult as $tbl_main_categoryresultdata){?>
                            
                            <?php if($tbl_main_categoryresultdata['id'] == $main_categoryresult){?>
                            
                            <?php } else{?>
                            
                            <option  value="<?php echo $tbl_main_categoryresultdata['id'] ?>"><?php echo $tbl_main_categoryresultdata['name_ar'] .' , '. $tbl_main_categoryresultdata['name_en'] ?></option>
                           
                            <?php } } ?>
                        </select>
                       
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1"> اسم الفئات</label>
                    
                        <select class="form-control" id="sub_category" name="sub_category" >
                           <option value="<?php echo $sub_categoryresult ?>" ><?php echo $sub_categoryresultname ?></option>  
                        </select>
                        <span id='loader' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      </div>  
                       
                      
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالعربي</label>
                        <input type="text" class="form-control" id="name_ar" name='name_ar' value="<?php echo $data['name_ar'];?>">
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالانجليزي</label>
                        <input type="text" class="form-control" id="name_en" name='name_en' value="<?php echo $data['name_en'];?>">
                      </div>
                      <?php }?>
                      <div class="form-group">
                          <img src="<?php echo $data['image'];?>" height=100 width=100/>
                        <label>رفع الملف</label>
                        <input type="file" id='image' name='image' class="file-upload-default">
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
                      <span class="btn btn-success" id="successmessage" style="display:none">تم  التحديث </span>
                      <span class="btn btn-danger" id="err" style="display:none">! هناك خطأ ما</span>

                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>