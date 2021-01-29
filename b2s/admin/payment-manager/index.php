<?php include '../pages/header.php' ?>
     <?php
     $resultdata =$con->query("select * from `tbl_transcation`" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
    }?> 
<!-- ///////////////////delete  up funcation////////////////// -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
  function paymentstatus(param1,param2){

  $.ajax({
   url: "api/paymentstatus.php",
   type: "POST",
   data: "id=" + param1 + "&status=" + param2  ,

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
                                 <!--<h4><a href='add.php' class="btn btn-outline-info">Add</a></h4>   -->
                                 
                                <div class="table-responsive m-t-40">
                                    <table id="example23"
                                        class="display nowrap table table-hover table-striped table-bordered"
                                        cellspacing="0" width="100%">
                                         <thead>
                                            <tr>
                                              <th>#</th>
                                               <th>Order Id</th>
                                              <th>اسم المتجر</th>
                                              <th>كمية</th>
                                              <th>اسم صاحب الحساب </th>
                                              <th>رقم الحساب</th> 
                                              <th>رمز البنك</th> 
                                              <th>نوع الحساب</th> 
                                              <th>اسم البنك</th> 
                                              <th>وقت الطلب</th>
                                              <th>تم الدفع</th>
                                              <th>الحالة</th>
                                              <!--<th>أجراءات</th>-->
                                            </tr>
                                          </thead>
                                          <tfoot>
                                            <tr>
                                              <th>#</th>
                                               <th>Order Id</th>
                                              <th>اسم المتجر</th>
                                              <th>كمية</th>
                                              <th>اسم صاحب الحساب </th>
                                              <th>رقم الحساب</th> 
                                              <th>رمز البنك</th> 
                                              <th>نوع الحساب</th> 
                                              <th>اسم البنك</th> 
                                              <th>وقت الطلب</th>
                                              <th>تم الدفع</th>
                                              <th>الحالة</th>
                                              <!--<th>أجراءات</th>-->
                                            </tr>
                                          </tfoot>
                                          <tbody>
                                            <?php
                                            $i=1;
                                            foreach($result as $data){?>
                                            <?php 
                                            $venderid=$data['vender_id'];
                                            $storename=null;
                                            $resultdatavender =$con->query("select * from `vender` where  id='$venderid'  " );
                                               while($rowvender=mysqli_fetch_array($resultdatavender))
                                                  {
                                                      $storename=$rowvender['store_name'];
                                                      $accountholdername=$rowvender['account_holder_name'];
                                                      $accountno=$rowvender['account_no'];
                                                      $ifsccode=$rowvender['ifsc_code'];
                                                      $accounttype=$rowvender['account_type'];
                                                      $bankname=$rowvender['bank_name'];
                                                  }
                                                  ?>
                                            <tr>
                                              <td><?php echo $i++; ?></td>
                                              <td><?php echo $data['order_id'] ?></td>
                                              <td><?php echo $storename ?></td>
                                              <td><?php echo $data['amount'] ?></td>
                                              <td><?php echo $accountholdername ?></td>
                                              <td><?php echo $accountno ?></td>
                                              <td><?php echo $ifsccode ?></td>
                                              <td><?php echo $accounttype ?></td>
                                              <td><?php echo $bankname ?></td> 
                                              <td><?php echo $data['create_at'] ?></td>
                                              <td><?php echo $data['pay_date'] ?></td>
                                              <td><?php echo $data['status'] ?></td> 
                                              <!--<td>-->
                                              <!--   <?php if($data['status'] == 'payment complete') { ?>-->
                                              <!--  <button class="btn btn-outline-danger" onclick="paymentstatus(<?php echo $data['id'];?>,'order complete')">استرجع</button>-->
                                              <!--  <?php } else { ?>-->
                                              <!--  <button class="btn btn-outline-info" onclick="paymentstatus(<?php echo $data['id'];?>,'payment complete')">منجز</button>-->
                                              <!--  <?php } ?>-->
                                              <!--</td>-->
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
    