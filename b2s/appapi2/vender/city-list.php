<?php
include '../../config.php';

$language=$_GET['language'];
$result=array(); 

 
    if($language == 'ar')
    {
        $brand_name;
        $tbl_brandresultdata =$con->query("select * from `tbl_delivery_address` " );
        
        while($row=mysqli_fetch_array($tbl_brandresultdata))
        {
          
        array_push($result,
        array(
        'id'=>$row['id'],
        'name'=>$row['name_ar'], 
        'latitude'=>$row['latitude'],
        'longitude'=>$row['longitude'],
        
        ));
        }
    }
    else if($language == 'en')
    {
        
        $brand_name;
        $tbl_brandresultdata =$con->query("select * from `tbl_delivery_address` " );
        
        while($row=mysqli_fetch_array($tbl_brandresultdata))
        {
          
        array_push($result,
        array(
        'id'=>$row['id'],
        'name'=>$row['name_en'], 
        'latitude'=>$row['latitude'],
        'longitude'=>$row['longitude']
        ));
        }
}
if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'data not found' : 'لاتوجد بيانات';
    echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
}

?>