<?php include '../pages/header.php'; ?>
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
     $("#dataform")[0].reset(); 
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
 
<!--///////////////////////////////////google place api///////////////////////////-->

<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<!--///////////////////////////////////google place api///////////////////////////-->
    <script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key={API_KEY}&sensor=false&libraries=places"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'));
             
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                console.log(place)
                var address = place.formatted_address;
                // var latitude = place.geometry.location.a;
                // var longitude = place.geometry.location.b;
                // var mesg = "Address: " + address;
                // mesg += "\nLatitude: " + latitude;
                // mesg += "\nLongitude: " + longitude;
             // alert(mesg);
              
              var geocoder = new google.maps.Geocoder();
               // var address = "new york";
                
                geocoder.geocode( { 'address': address}, function(results, status) {
                
                  if (status == google.maps.GeocoderStatus.OK) {
                    var latitude = results[0].geometry.location.lat();
                    var longitude = results[0].geometry.location.lng();
                   // alert(latitude);
                document.getElementById("fulladdress").value=address;
                document.getElementById("lat").value=latitude;
                document.getElementById("lng").value=longitude;
                  } 
                });

              
                
            });
        });
    </script>
   
<!--///////////////////////////////////google place api............//////////////////////-->
<!--///////////////////////////////////google place api............//////////////////////-->
        <!-- partial -->
              <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
         
       
              <div class="col-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">الاقسام</h4>
                    <!--<p class="card-description"> Basic form elements </p>-->
                    <form class="forms-sample" action="#" methood="post" id='dataform'>
                        
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالعربي</label>
                        <input type="text" class="form-control" id="name_ar" name='name_ar' placeholder="Name" required>
                      </div>
                       
                      <div class="form-group">
                        <label for="exampleInputName1">الاسم بالانجليزي</label>
                        <input type="text" class="form-control" id="name_en" name='name_en' placeholder="Name" required>
                      </div>
                      
                      <!--<div class="form-group">-->
                      <!--  <label for="exampleInputName1">عنوان</label>-->
                      <!--    <input type="text"  class="form-control" name="txtPlaces" id="txtPlaces"     placeholder="Enter a location" autocomplete="off" />                       -->
                      <!-- </div>-->
                        
                       <!-- <div class="form-group">-->
                       <!-- <label for="exampleInputName1">عنوان</label>-->
                       <!--   <input type="text"   class="form-control" name="fulladdress" id="fulladdress"   placeholder="Enter a location" autocomplete="off" />                       -->
                       <!--</div>-->
                       <div class="form-group">
                        <label for="exampleInputName1">خط العرض</label>
                          <input type="text"   class="form-control" name="lat" id="lat"   />                      
                       </div>
                       <div class="form-group">
                        <label for="exampleInputName1">خط الطول</label>
                          <input type="text"   class="form-control" name="lng" id="lng"  />                    
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