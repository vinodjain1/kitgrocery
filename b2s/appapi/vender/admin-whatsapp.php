<?php
include '../../config.php';
// echo base64_encode('12345');die;
$sql = "SELECT * FROM `admin` WHERE `email`='admin@gmail.com'";
$result = mysqli_query($con, $sql);
if($result > 0){
    while($row = mysqli_fetch_assoc($result)) {
      $phone = $row['phone'];
    }
    $j->phone = $phone;
    $j->status  = "101";
    $j->message = "data found";
   echo json_encode($j);
}else{
     $j->status  = "401";
   $j->message = $langs == 'en' ? "data not found." : "لاتوجد بيانات";
   echo json_encode($j);
}
 


?>