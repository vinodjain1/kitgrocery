<?php include '../pages/header.php' ?>
     <?php
     $resultdata =$con->query("select * from `tbl_payment_mode`" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
    }?> 
<!-- ///////////////////delete  up funcation////////////////// -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function deleteanimal(param1,param2){
 
  $.ajax({
   url: "api/delete.php",
   type: "POST",
   data: "id=" + param1 + "&status=" + param2 ,

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
                                 <!--<h4><a href='add.php' class="btn btn-outline-info">بي دي اف </a></h4>   -->
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                         <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>name</th> 
                                               <th>status</th> 
                                             <th>Action</th>
                                            </tr>
                                          </thead>
                                          <tfoot>
                                            <tr>
                                              <th>#</th>
                                              <th>name</th> 
                                              <th>status</th> 
                                              <th>Action</th>
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            $i=1;
                                            foreach($result as $data){?>
                                            <tr>
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $data['name'] ?></td> 
                                               <td>
                                                  <?php if($data['status'] == '1'){?>
                                                  
                                                  <p>Enable</p>
                                                  <?php } else {?>
                                                <p>Disable</p> 
                                                <?php } ?>
                                              </td>
                                              <td>
                                                  <?php if($data['status'] == '0'){?>
                                                  <button class="btn btn-outline-danger" onclick="deleteanimal(<?php echo $data['id'];?>, 1)">Disable</button> 
                                                  <?php } else {?>
                                                <button class="btn btn-info" onclick="deleteanimal(<?php echo $data['id'];?>, 0)">Enable</button>
                                                <?php } ?>
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
    