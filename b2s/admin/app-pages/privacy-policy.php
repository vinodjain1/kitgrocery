 <?php include '../../config.php'?>
     <?php
     $resultdata =$con->query("select * from `tbl_pages` where id='1'" );
     $result=null;
     while($row=mysqli_fetch_array($resultdata))
    {
       $result= $row['content'];
    }?> 
<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title> </title>

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/font.css">

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/slicknav.css">

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/color-switcher.css">

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/animate.css">

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/owl.carousel.css">

<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/main.css">
<link rel="shortcut icon" href="../images/admin/logo.jpeg" />
<link rel="stylesheet" type="text/css" href="https://preview.uideck.com/items/nexusplus/assets/css/responsive.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<header id="header-wrap">
<nav class="navbar navbar-expand-lg bg-white fixed-top scrolling-navbar" style="top: 0px">
<div class="container">

<div class="navbar-header">
<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
<span class="lni-menu"></span>
</button>
</div>
<div class="collapse navbar-collapse" id="main-navbar">
<ul class="navbar-nav mr-auto w-100 justify-content-center">

</ul>

</div>
</div>

<ul class="mobile-menu">
</ul>

</nav>



</header>









<section class="services bg-light section-padding">
<div class="container">
   <center>
    <img src="../images/admin/logo.jpeg" alt="" style="height: 65px;width: 80px"> 
</center>
<div class="row">
<div class="col-12">


<h3 class="section-title">Privacy Policy</h3>
</div>

<div class="col-md-12 col-lg-12 col-xs-12">
<div class="services-item wow fadeInRight" data-wow-delay="0.2s">
 
    <?php echo $result; ?>
</div>
</div>
</div>

</div>
</div>
</section>



</footer>

<style type="text/css">
	p{
		color: #000;
		
	}
	li{
		color: #000;
	}
	.services-item .services-content h3 a {
    font-size: 18px;
    color: #fc8a00;
}
.section-title:before {
    position: absolute;
    content: '';
    height: 3px;
    width: 70px;
    margin-left: -90px !important;
    bottom: 40px;
    background-color: #fc8a00;
}
.section-title:after {
    position: absolute;
    content: '';
    height: 3px;
    width: 70px;
    margin-left: 15px !important;
    bottom: 40px;
    background-color: #fc8a00;
}
@media (max-width: 991px){
.section-title {
    position: relative;
    margin-top: 24px;
    margin-bottom: 10px;
    font-size: 22px;
}
}
</style>

<script src="https://preview.uideck.com/items/nexusplus/assets/js/jquery-min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/popper.min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/bootstrap.min.js"></script>

<script src="https://preview.uideck.com/items/nexusplus/assets/js/jquery.counterup.min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/waypoints.min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/wow.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/owl.carousel.min.js"></script>

<script src="https://preview.uideck.com/items/nexusplus/assets/js/main.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/form-validator.min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/contact-form-script.min.js"></script>
<script src="https://preview.uideck.com/items/nexusplus/assets/js/summernote.js"></script>
</body>
</html>
