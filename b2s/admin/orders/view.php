 <?php include '../pages/header.php'?>
     <?php
     $id=$_GET['id'];
     $resultdata =$con->query("select * from `tbl_order_item` where order_id='$id'" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
    }
    $total=0;
    ?> 
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
                                              <th>الاسم بالعربي</th>
                                              <th>الاسم بالانجليزي</th>
                                              <th>الصوره</th>
                                              <th>الكمية</th> 
                                              <th>السعر</th> 
                                               
                                            </tr>
                                          </thead>
                                          <tfoot>
                                           <tr>
                                              <th>#</th>
                                              <th>الاسم بالعربي</th>
                                              <th>الاسم بالانجليزي</th>
                                              <th>الصوره</th>
                                              <th>الكمية</th> 
                                              <th>السعر</th> 
                                               
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
                                               <td><img src="<?php echo $data['image'] ?>" height=50 width=50 /></td>
                                               <td><?php echo $data['quantity'] ?></td>
                                              <td><?php echo $data['price'] ?></td> 
                                              
                                            </tr>
                                            <?php
                                            $total=$total+$data['price'];
                                            }?>
                                          </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            Total Price:- <?php echo $total; ?>
                        </div>
                       
                    </div>
                </div>
             
         
          </div>
          <!-- content-wrapper ends -->
         <?php include '../pages/footer.php'?>