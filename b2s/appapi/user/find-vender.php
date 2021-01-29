<?php

include '../../config.php';

   $latitude=$_GET['latitude'];
   $longitude=$_GET['longitude'];
// $resultdata =$con->query("select * from `tbl_address` where id='$address_id'");
$raduis=50;
// while($row=mysqli_fetch_array($resultdata))
// {
//     $latitude=$row['latitude'];
//   $longitude=$row['longitude'];
    
// }
$ssqqll="SELECT *, ( 3959 * acos( cos( radians($latitude) ) * cos( radians( `latitude` ) ) * cos( radians( `longitude` ) - radians($longitude) ) + sin( radians($latitude) ) * sin(radians(`latitude`)) ) ) AS distance FROM `vender` where `account_status`='active' HAVING distance < $raduis  order by id desc";
  
 $result=array();
        $tbl_addressresultdata =$con->query($ssqqll);
         while($tbl_addressrow=mysqli_fetch_array($tbl_addressresultdata))
        {
          $result[]=$tbl_addressrow;
        }
         
    

if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? "data not found" : "وجد بيانات";
    echo json_encode(array("status"=>'404',"message"=> $msg, "data"=>$result));
}

?>