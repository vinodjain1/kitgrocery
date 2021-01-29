<?php include '../pages/header.php' ?>
     <?php
     $resultdata =$con->query("select * from `vender` order by id desc" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
    }?> 
<!-- ///////////////////delete  up funcation////////////////// -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function deleteanimal(param1){

  $.ajax({
   url: "api/delete.php",
   type: "POST",
   data: "id=" + param1 ,

   success: function(data)
      {
    // alert(data);
    if(data == 101)
    {
      location.reload(true);
    }
    
    else{
      alert(data);
    }
      }
      ,
     error: function(e) 
      {
   $("#successmessage").html("Some thing went  worng").fadeIn().style.color.red;
      }          
    });
}
</script>
                                                <style>
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
<!-- //////////////////delete   funcation//////////////////////////// -->
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="row page-titles">
                    <div class="col-md-6 col-8 align-self-center">
                        <h3 class="text-themecolor mb-0 mt-0">جدول البيانات</h3>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">الرئيسية </a></li>
                            <li class="breadcrumb-item active">جدول البيانات</li>
                        </ol>
                    </div>
                    
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            
                        
                            <div class="card-body">
                                 <h4><a href='add.php' class="btn btn-outline-info">اضافة </a></h4>    
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                         <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>الاسم</th>
                                              <th>البريد الالكتروني</th>
                                              <th>رقم الهاتف</th>
                                              <th>حالة الحساب</th>
                                              <th>اسم المتجر</th>
                                              
                                              <th>أجراءات</th>
                                            </tr>
                                          </thead>
                                          <tfoot>
                                            <tr>
                                              <th>#</th>
                                              <th>الاسم</th>
                                              <th>البريد الالكتروني</th>
                                              <th>رقم الهاتف</th>
                                              <th>حالة الحساب</th>
                                              <th>اسم المتجر</th>
                                              
                                              <th>أجراءات</th>
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            $i=1;
                                            foreach($result as $data){?>
                                           
                                            <tr>
                                             
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $data['name'] ?></td>
                                              <td><?php echo $data['email'] ?></td>
                                               <td><?php echo $data['phone'] ?></td>
                                                <?php if($data['account_status'] == 'deactive'){?>
                                                      <td style="background-color:#FF0000; color:#fff"><?php echo $data['account_status'] ?></td> 
                                                <?php  } else { ?>
                                                       <td><?php echo $data['account_status'] ?></td>
                                                <?php }?>
                                                   
                                              <td><?php echo $data['store_name'] ?></td>
                                               
                                              <td>
                                               <button class="btn btn-outline-info" data-toggle="modal" data-target=".bs-example-modal-lg<?php echo $data['id'] ?>" > التفاصيل</button>
                                               <a href="edit.php?id=<?php echo $data['id'];?>" ><button class="btn btn-outline-primary" >تعديل</button></a>
                                                <button class="btn btn-outline-danger" onclick="deleteanimal(<?php echo $data['id'];?>)">حذف</button>
                                                
                                              </td>
                                            </tr>
                                             <!-- sample modal content -->
                                                    <div class="modal bs-example-modal-lg<?php echo $data['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="myLargeModalLabel">تفاصيل اخرى</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <P><?php echo $data['address'] ?></P>
                                                                    <P><?php echo $data['city'] ?></P>
                                                                    <P><?php echo $data['account_holder_name'] ?></P>
                                                                    <P><?php echo $data['account_no'] ?></P>
                                                                    <P><?php echo $data['ifsc_code'] ?></P>
                                                                    <P><?php echo $data['account_type'] ?></P>
                                                                    <P><?php echo $data['bank_name'] ?></P>
                                                                    <P><?php echo $data['createAt'] ?></P>
                                                                    <p><?php echo $data['loginAt'] ?></p>
                                                                    
                                                                   <div class="row   mt-3">
                                                                       <?php 
                                                                       $id=$data['id'];  
                                                                       $resultdata =$con->query("select * from `tbl_images` where  vender_id='$id'  " );
                                                                         
                                                                         while($rowimage=mysqli_fetch_array($resultdata))
                                                                        {
                                                                       ?>
                                                                       <img src="<?php echo $rowimage['file_name'] ?>"class="col-md-10 "/> 
                                                                       <?php }?>
                                                                    </div> 
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">اغلاق</button>
                                                                </div>
                                                            </div>
                                                            <!-- /.modal-content -->
                                            <?php }?>
                                          </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                 
                <!-- ============================================================== -->
                 
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
  <script>
// When the user clicks on div, open the popup
function myFunction() {
  var popup = document.getElementById("myPopup");
  popup.classList.toggle("show");
}
</script>  
<?php include '../pages/footer.php' ?> 
     