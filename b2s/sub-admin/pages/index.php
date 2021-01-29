<?php include '../pages/header.php' ?>
        

 <?php
     $orderno=0;
     $resultdata =$con->query("select * from `tbl_order` " );
      
     while($row=mysqli_fetch_array($resultdata))
    {
       $orderno=$orderno+1;
    }
     $productno=0;
     $productresultdata =$con->query("select * from `tbl_product` " );
      
     while($row=mysqli_fetch_array($productresultdata))
    {
       $productno=$productno+1;
    }
    $usersno=0;
     $usersresultdata =$con->query("select * from `users` " );
      
     while($row=mysqli_fetch_array($usersresultdata))
    {
       $usersno=$usersno+1;
    }
    $vendersno=0;
     $vendersresultdata =$con->query("select * from `vender` " );
      
     while($row=mysqli_fetch_array($vendersresultdata))
    {
       $vendersno=$vendersno+1;
    }
    
    
    
    


?> 



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
                <!--<div class="row page-titles">-->
                <!--    <div class="col-md-6 col-8 align-self-center">-->
                <!--        <h3 class="text-themecolor mb-0 mt-0">Dashboard</h3>-->
                <!--        <ol class="breadcrumb">-->
                <!--            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>-->
                <!--            <li class="breadcrumb-item active">Dashboard</li>-->
                <!--        </ol>-->
                <!--    </div>-->
                <!--    <div class="col-md-6 col-4 align-self-center">-->
                <!--        <button class="right-side-toggle waves-effect waves-light btn-info btn-circle btn-sm float-right ml-2"><i class="ti-settings text-white"></i></button>-->
                <!--        <button class="btn float-right hidden-sm-down btn-success"><i class="mdi mdi-plus-circle"></i> Create</button>-->
                <!--        <div class="dropdown float-right mr-2 hidden-sm-down">-->
                <!--            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> January 2019 </button>-->
                <!--            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton"> <a class="dropdown-item" href="#">February 2019</a> <a class="dropdown-item" href="#">March 2019</a> <a class="dropdown-item" href="#">April 2019</a> </div>-->
                <!--        </div>-->
                <!--    </div>-->
                <!--</div>-->
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <!-- Row -->
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">البائعين</h4>
                                <div class="text-right">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-success"></i><?php echo $vendersno ;?></h2>
                                    <!--<span class="text-muted">Todays Income</span>-->
                                </div>
                                <!--<span class="text-success">80%</span>-->
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">المستخدمين</h4>
                                <div class="text-right">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-info"></i><?php echo $usersno ?></h2>
                                    <!--<span class="text-muted">Todays Income</span>-->
                                </div>
                                <!--<span class="text-info">30%</span>-->
                                <div class="progress">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: 30%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">المنتجات</h4>
                                <div class="text-right">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-up text-purple"></i> <?php echo $productno ;?></h2>
                                    <!--<span class="text-muted">Todays Income</span>-->
                                </div>
                                <!--<span class="text-purple">60%</span>-->
                                <div class="progress">
                                    <div class="progress-bar bg-purple" role="progressbar" style="width: 60%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-3 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">الطلبات</h4>
                                <div class="text-right">
                                    <h2 class="font-light mb-0"><i class="ti-arrow-down text-danger"></i> <?php echo $orderno ;?></h2>
                                    <!--<span class="text-muted">Todays Income</span>-->
                                </div>
                                <!--<span class="text-danger">80%</span>-->
                                <div class="progress">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: 80%; height: 6px;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                 
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            

<?php include '../pages/footer.php' ?>