<?php
include '../../config.php';
$orderid=$_GET['orderid'];
$language=$_GET['language'];
 
 $ssqqll="SELECT * FROM `tbl_coupon` order by id desc";
$resultdata =$con->query($ssqqll);


$result=array();

   while($row=mysqli_fetch_array($resultdata))
    {
            
         array_push($result,
       array(
            'id'=>$row['id'],
            'code'=>$row['code'],
             'percent'=>$row['percent'],
            'title'=>$row['title'],
            'description'=>$row['description'],
            'image'=>$row['image']
          	)); 
     
    } 
     if(count($result) > 0)
    {
        echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
    }
    else
    {
        $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
        echo json_encode(array("status"=>'404',"message"=> $msg, "data"=>$result));
    }
  

?>

