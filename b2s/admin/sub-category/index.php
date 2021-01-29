Edi<?php include '../pages/header.php' ?>
     <?php
     $resultdata =$con->query("select * from `tbl_sub_category` order by id desc" );
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
                                              <th>اسم القائمة الرئيسية بالعربي</th>
                                              <th>اسم القائمة الرئيسية بالانجليزي </th>
                                              <th>أجراءات</th>
                                            </tr>
                                          </thead>
                                          <tfoot>
                                           <tr>
                                              <th>#</th>
                                              <th>الاسم بالعربي</th>
                                              <th>الاسم بالانجليزي</th>
                                              <th>الصوره</th> 
                                              <th>اسم القائمة الرئيسية بالعربي</th>
                                              <th>اسم القائمة الرئيسية بالانجليزي </th>
                                              <th>أجراءات</th>
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            $i=1;
                                            foreach($result as $data){
                                            $mainid=$data['main_category_id'];
                                            $tbl_main_categoryresultdata =$con->query("select * from `tbl_main_category` where id=$mainid" );
                                             $main_name_ar=null;
                                             $main_name_en=null;
                                             
                                             while($tbl_main_categoryrow=mysqli_fetch_array($tbl_main_categoryresultdata))
                                            {
                                             $main_name_ar=$tbl_main_categoryrow['name_ar'];
                                             $main_name_en=$tbl_main_categoryrow['name_en'];
                                            }
                                            
                                            ?>
                                            <tr>
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $data['name_ar'] ?></td>
                                              <td><?php echo $data['name_en'] ?></td>
                                              <td><img src='<?php echo $data['image'] ?>' height=50 width=50 /> </td>
                                              <td><?php echo $main_name_ar ?></td>
                                              <td><?php echo $main_name_en ?></td>
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
               
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    
<?php include '../pages/footer.php' ?> 
    