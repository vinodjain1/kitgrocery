<?php

include '../../config.php';

$language=$_GET['language']; 
$status=$_GET['status'];

$resultdata =$con->query("select * from `tbl_product` where `status` = '$status' order by id desc LIMIT 50" );

$result=array();

while($row=mysqli_fetch_array($resultdata))
{
    $brand_id=$row['brand_id'];
    if($language == 'ar')
    {
        $brand_name;
        $tbl_brandresultdata =$con->query("select * from `tbl_brand` where id='$brand_id'" );

        while($tbl_brandrow=mysqli_fetch_array($tbl_brandresultdata))
        {   
            $brand_name=$tbl_brandrow['name_ar'];
        }
        array_push($result,
        array(
            'id'=>$row['id'],
            'name'=>$row['name_ar'],
            'del_price'=>$row['last_price'],
            'price'=>$row['price'],
            'brand_name'=>$brand_name,
            'quantity'=>$row['quantity'],
            'unit'=>$row['unit'],
            'feature_image'=>$row['feature_image'],
            'description_ar'=>$row['description_ar'],
        ));
    }
    else if($language == 'en')
    {
        $brand_name;
        $tbl_brandresultdata =$con->query("select * from `tbl_brand` where id='$brand_id'" );
        while($tbl_brandrow=mysqli_fetch_array($tbl_brandresultdata))
        {
            $brand_name=$tbl_brandrow['name_en'];
        }
        array_push($result,
        array(
            'id'=>$row['id'],
            'name'=>$row['name_en'],
            'del_price'=>$row['last_price'],
            'price'=>$row['price'],
            'brand_name'=>$brand_name,
            'quantity'=>$row['quantity'],
            'unit'=>$row['unit'],
            'feature_image'=>$row['feature_image'],
            'description_en'=>$row['description_en'],
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
    echo json_encode(array("status"=>'404',"message"=> $msg, "data"=>$result));
}

?>