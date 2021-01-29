<?php

include '../../config.php';

$language=$_GET['language'];
$keyword=$_GET['keyword'];
 
$result=array();
     
if($language == 'ar')
{
    $sub_categoryresultdata =$con->query("select * from `tbl_product` where name_ar  LIKE '$keyword%'" );
     while($sub_category_row=mysqli_fetch_array($sub_categoryresultdata))
    {
        array_push($result,
        array(
        'id'=>$sub_category_row['id'],
        'image'=>$sub_category_row['image'],
        'name'=>$sub_category_row['name_ar']
        ));
    }
}
else if($language == 'en')
{
    $sub_categoryresultdata =$con->query("select * from `tbl_product` where name_en  LIKE '$keyword%'" );
    while($sub_category_row=mysqli_fetch_array($sub_categoryresultdata))
    {
        array_push($result,
        array(
        'id'=>$sub_category_row['id'],
        'image'=>$sub_category_row['image'],
        'name'=>$sub_category_row['name_en']
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