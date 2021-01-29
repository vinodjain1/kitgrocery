<?php include '../pages/header.php' ?>
     <?php
     $resultdata =$con->query("SELECT tbl_product.*,tbl_delivery_address.name_ar as address_ar,tbl_delivery_address.name_en as address_en FROM `tbl_product` LEFT JOIN tbl_delivery_address on tbl_product.location=tbl_delivery_address.id  order by tbl_product.id desc" );
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
                                <h6 class="card-subtitle">تصدير وحفظ البيانات </h6>
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                         <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>الاسم بالعربي</th>
                                              <th>الاسم بالانجليزي</th>
                                              <th>الصوره</th> 
                                              <th>Selling Price</th>
                                              <th>السعر</th>
                                              <!--<th>الكمية</th>-->
                                              <th>إيقاف ٪</th>
                                              <th>الحالة</th>
                                              <th>منتجات الموقع</th>
                                              <th>الموقع</th>
                                              <th>أجراءات</th>
                                            </tr>
                                          </thead>
                                          <tfoot>
                                            <tr>
                                              <th>#</th>
                                              <th>الاسم بالعربي</th>
                                              <th>الاسم بالانجليزي</th>
                                              <th>الصوره</th> 
                                              <th>Selling Price</th>
                                              <th>السعر</th>
                                              <!--<th>الكمية</th>-->
                                              <th>إيقاف ٪</th>
                                              <th>الحالةq</th>
                                              <th>منتجات الموقع</th>
                                              <th>الموقع</th>
                                              <th>أجراءات</th>
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            $i=1;
                                            foreach($result as $data){?>
                                            <tr>
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $data['name_ar'] ?></td>
                                              <td><?php echo $data['name_en'] ?></td>
                                              <td><img src='<?php echo $data['feature_image'] ?>' height=50 width=50 /> </td>
                                              <td><?php echo $data['last_price'] ?></td>
                                              <td><?php echo $data['price'] ?></td>
                                              <!--<td><?php echo $data['quantity'] ?></td>-->
                                              <td><?php echo $data['offer'] ?></td>
                                              <td><?php echo $data['status'] ?></td>
                                              <td><?php echo $data['admin_product'] ?></td>
                                              <td><?php echo $data['address_ar'] .','.$data['address_en']  ?></td>
                                              <td>
                                                 <a href="edit.php?id=<?php echo $data['id'];?>" ><button class="btn btn-outline-primary" >تعديل</button></a>
                                                <button class="btn btn-outline-danger" onclick="deleteanimal(<?php echo $data['id'];?>)">حذف</button>
                                                
                                              </td>
                                            </tr>
                                            <?php }?>
                                          </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                 
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    
<?php include '../pages/footer.php' ?> 
     