    <?php include '../pages/header.php'?>
     <?php
     $tbl_main_categoryresultdata =$con->query("select * from `tbl_main_category`" );
     $tbl_main_categoryresult=array();
     while($tbl_main_categoryrow=mysqli_fetch_array($tbl_main_categoryresultdata))
    {
       $tbl_main_categoryresult[]= $tbl_main_categoryrow;
        
    }?>
     <?php
     $resultdata =$con->query("select * from `tbl_sub_sub_category`" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
        
    }?>
    <?php
     $brandresultdata =$con->query("select * from `tbl_brand`" );
     $brandresult=array();
     while($brandrow=mysqli_fetch_array($brandresultdata))
    {
       $brandresult[]= $brandrow;
        
    }?>
       <?php
     $tbl_delivery_addressresultdata =$con->query("select * from `tbl_delivery_address`" );
     $tbl_delivery_addressresult=array();
     while($tbl_delivery_addressrow=mysqli_fetch_array($tbl_delivery_addressresultdata))
    {
       $tbl_delivery_addressresult[]= $tbl_delivery_addressrow;
        
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

    <script>
function get_sub_sub_category(val) {
    $("#subloader").show();
	$.ajax({
	type: "POST",
	url: "./api/get_sub_sub_category.php",
	data:'sub_id='+val,
	success: function(data){
		$("#sub_sub_category").html(data);
		$("#subloader").hide();
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
       
   }, 10000);
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
                    <h4 class="card-title">أضف منتج</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform' enctype="multipart/form-data">
                        
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالعربي</label>
                        <input type="text" class="form-control" id="name_ar" name='name_ar' placeholder="Name" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالانجليزي</label>
                        <input type="text" class="form-control" id="name_en" name='name_en' placeholder="Name" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">Selling Price</label>
                        <input type="text" class="form-control" id="lprice" name='lprice' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control"   placeholder="213" maxlength="10" placeholder="1000" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">السعر</label>
                        <input type="text" class="form-control" id="price" name='price' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" placeholder="421" maxlength="10" placeholder="600" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">الكمية</label>
                        <input type="text" class="form-control" id="quantity" name='quantity' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control"  placeholder="222" maxlength="10" placeholder="1000" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">وحدة</label>
                        <select  id="unit" name='unit' class="form-control" >
                            <option value='KG'>KG</option>
                            <option value='GRAM'>GRAM</option>
                            <option value='LITER'>LITER</option>
                            <option value='PACKET'>PACKET</option>
                            <option value='UNIT'>UNIT</option>
                            <option value='ML'>ML</option>
                        </select>
                       </div>
                      
                      <div class="form-group">
                        <label>صور العرض</label>
                        <input type="file" id='image' name='image' class="file-upload-default" required>
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info"  disabled placeholder="Upload Image" >
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-gradient-primary" type="submit">رفع</button>
                          </span>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleTextarea1"> الوصف بالعربي</label>
                        <textarea class="form-control" id="description_ar" name="description_ar" rows="4"></textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleTextarea1">الوصف بالانجليزي</label>
                        <textarea class="form-control" id="description_en" name="description_en" rows="4"></textarea>
                      </div>
                       
                       <div class="mb-2">
                        <label class="custom-control custom-radio">
                        <input id="admin_product" name="admin_product" type="checkbox" class="custom-control-input" value="Yes">
                       <span class="custom-control-label">حدد اذا كان المنتج يتم بيعه عن طريق المدير</span>
                       </label>
                        
                        </div>
                        <div class="form-group">
                        <label for="exampleInputName1"> % اطفاء</label>
                        <input type="text" class="form-control" id="off" name='off' onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control"   placeholder="20" maxlength="3"  required>
                      </div>
                        <div class="form-group">
                        <label for="exampleInputName1">اسم القائمة الرئيسية بالانجليزي </label>
                    
                        <select class="form-control" id="main_category" name="main_category"   onChange="get_sub_category(this.value);">
                            <?php foreach($tbl_main_categoryresult as $data){?>
                             <option  value="<?php echo $data['id'] ?>" > <?php echo $data['name_ar'] .' , '. $data['name_en'] ?>  </option>
                              <?php  } ?>
                        </select>
                       
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1"> اسم الفئات</label>
                    
                        <select class="form-control" id="sub_category" name="sub_category" onChange="get_sub_sub_category(this.value);">
                            
                        </select>
                        <span id='loader' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">اسم الفئة الفرعية</label>
                    
                        <select class="form-control" id="sub_sub_category" name="sub_sub_category" >
                            
                        </select>
                        <span id='subloader' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">اسم العلامة التجاري</label>
                    
                        <select class="form-control" id="brand" name="brand" >
                            <?php foreach($brandresult as $branddata){?>
                             <option  value="<?php echo $branddata['id'] ?>" > <?php echo $branddata['name_ar'] .' , '. $branddata['name_en'] ?>  </option>
                              <?php  } ?>
                        </select>
                       
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">الموقع</label>
                        <select class="form-control" id="location" name="location" >
                            <?php foreach($tbl_delivery_addressresult as $delivery_addressdata){?>
                             <option  value="<?php echo $delivery_addressdata['id'] ?>" > <?php echo $delivery_addressdata['name_ar'] .' , '. $delivery_addressdata['name_en'] ?>  </option>
                              <?php  } ?>
                         </select>
                       </div>
                       <div class="form-group">
                        <label for="exampleInputName1">الحالة</label>
                        <select class="form-control" id="status" name="status" >
                            <option  value="top">اعلى</option>
                             <option  value="All">الجميع</option> 
                         </select>
                       </div>
                       
                        <div class="form-group">
                        <label for="exampleInputName1">تحميل صور المعرض</label>
                       <input type="file" name="files[]" multiple >
                      </div>
                      
                      
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