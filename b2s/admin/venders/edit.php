 <?php include '../pages/header.php'?>
     <?php
     $id=$_GET['id'];
     $resultdata =$con->query("select * from `vender` where id='$id'" );
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
                    <h4 class="card-title">تعديل</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform'>
                      <?php foreach($result as $data){?>
                      <input type="hidden" class="form-control" id="id" name='id' value="<?php echo $data['id'];?>">
                      
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم</label>
                        <input type="text" class="form-control" id="name" name='name' value="<?php echo $data['name'];?>" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">البريد الالكتروني</label>
                        <input type="text" readonly class="form-control" id="email" name='email' value="<?php echo $data['email'];?>" required>
                      </div>
                      
                       
                      <div class="form-group">
                        <label for="exampleInputName1">رقم الهاتف</label>
                        <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" id="phone" name='phone' value="<?php echo $data['phone'];?>" maxlength="10" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">اسم المتجر</label>
                        <input type="text" class="form-control" id="storename" name='storename' value="<?php echo $data['store_name'];?>" required>
                      </div>
                                               
                      <div class="form-group">
                        <label for="exampleTextarea1">العنوان</label>
                        <textarea class="form-control" id="address" name="address" rows="4"> <?php echo $data['address'];?></textarea>
                      </div>
                      <!--<div class="form-group">
                        <label for="exampleInputName1">المدينة</label>
                        <input type="text" class="form-control" id="city" name='city' placeholder="jaipur" value="<?php echo $data['city'];?>" required>
                      </div>-->
                       <?php $resultdata =$con->query("select * from `tbl_delivery_address` where 1" ); ?>
                      <div class="form-group">
                        <label for="exampleInputName1">العنوان</label>
                        
                        <select class="form-control" id="city" name="city">
                            <?php while($row=mysqli_fetch_array($resultdata))
                                { ?>
                            <option value="<?php echo $row['name_en'];?>" <?php if($data['city'] == $row['name_en']){ echo "selected=selected";}?>><?php echo $row['name_en'];?></option>
                            
                            <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">اسم صاحب الحساب</label>
                        <input type="text" class="form-control" id="accountholdername" name='accountholdername' value="<?php echo $data['account_holder_name'];?>" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">رقم الحساب</label>
                        <input type="text" onkeyup="if (/\D/g.test(this.value)) this.value = this.value.replace(/\D/g,'')" class="form-control" id="accountno" name='accountno' value="<?php echo $data['account_no'];?>" maxlength="20" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">رقم 0الحساب</label>
                        <input type="text" class="form-control" id="ifsccode" name='ifsccode' value="<?php echo $data['ifsc_code'];?>" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">اسم البنك</label>
                        <input type="text" class="form-control" id="bankname" name='bankname' value="<?php echo $data['bank_name'];?>" required>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputName1">نوع الحساب</label>
                        <select id="accounttype" name="accounttype" class="form-control">
                            
                            <option value='<?php echo $data['account_type'];?>'><?php echo $data['account_type'];?></option>
                            <?php if($data['account_type'] == 'current'){?>
                            <option value='saving'>إنقاذ</option>
                            <?php } else{?>
                             <option value='current'>تيار</option>
                             <?php }?>
                             
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label for="exampleInputName1">حالة الحساب</label>
                        <select id="accountstatus" name="accountstatus" class="form-control">
                            
                            <option value='<?php echo $data['account_status'];?>'><?php echo $data['account_status'];?></option>
                            <?php if($data['account_status'] == 'active'){?>
                            <option value='deactive'>غير نشط</option>
                            <?php } else{?>
                             <option value='active'>نشط</option>
                             <?php }?>
                             
                        </select>
                      </div>
                      <span id='loading' style="display:none"><img src="../images/admin/loading.gif" height=30 width=30  /></span>
                      <button type="submit" class="btn btn-primary" id="btnsubmit">إرسال</button>
                      <!--<button class="btn btn-light">Cancel</button>-->
                      <span class="btn btn-success" id="successmessage" style="display:none">تم التحديث بنجاح</span>
                      <span class="btn btn-danger" id="err" style="display:none"> ! هناك خطأ ما</span>

                    </form>
                  </div>
                  
                </div>
                 
              </div>
             
         <?php } ?>
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>