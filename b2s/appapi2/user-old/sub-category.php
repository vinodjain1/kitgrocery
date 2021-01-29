<?php
include '../../config.php';

$language=$_GET['language'];
$main_category_id=$_GET['main_category_id'];
$resultdata =$con->query("select * from `tbl_sub_category` where main_category_id='$main_category_id'" );

$result=array();

while($row=mysqli_fetch_array($resultdata))
{
    if($language == 'ar')
    {
        array_push($result,
        array(
        'id'=>$row['id'],
        'image'=>$row['image'],
        'name'=>$row['name_ar']
        ));
    }
    else if($language == 'en')
    {
        array_push($result,
        array(
            'id'=>$row['id'],
            'image'=>$row['image'],
            'name'=>$row['name_en']
        ));
    }
}
if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    echo json_encode(array("status"=>'404',"message"=>'data not found',"data"=>$result));
}
?>