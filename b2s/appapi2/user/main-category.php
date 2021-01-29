<?php
include '../../config.php';

$language=$_GET['language'];

$resultdata =$con->query("select * from `tbl_main_category`" );

$result=array();

while($row=mysqli_fetch_array($resultdata))
{
    $main_category_id=$row['id'];

    $tbl_sub_categoryresultdata =$con->query("select * from `tbl_sub_category` where main_category_id='$main_category_id'" );
    
   
     $tbl_sub_categoryresult=array();
    while($tbl_sub_categoryrow=mysqli_fetch_array($tbl_sub_categoryresultdata))
    {
        if($language == 'ar')
        {
            array_push($tbl_sub_categoryresult,
            array(
            'id'=>$tbl_sub_categoryrow['id'],
            'image'=>$tbl_sub_categoryrow['image'],
            'name'=>$tbl_sub_categoryrow['name_ar']
            ));
        }
        else if($language == 'en')
        {
            array_push($tbl_sub_categoryresult,
            array(
                'id'=>$tbl_sub_categoryrow['id'],
                'image'=>$tbl_sub_categoryrow['image'],
                'name'=>$tbl_sub_categoryrow['name_en']
            ));
        }
    }
    if($language == 'ar')
    {
        array_push($result,
        array(
            'id'=>$row['id'],
            'image'=>$row['image'],
            'name'=>$row['name_ar'],
            'sub_category_data'=>$tbl_sub_categoryresult
        ));
    }
    else if($language == 'en')
    {
        array_push($result,
        array(
            'id'=>$row['id'],
            'image'=>$row['image'],
            'name'=>$row['name_en'],
            'sub_category_data'=>$tbl_sub_categoryresult
        ));
    }
}
if(count($result) > 0)
{
    echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$result));
}
else
{
    $msg = $langs == 'en' ? 'data not found' : 'لاتوجد ب';
    echo json_encode(array("status"=>'404',"message"=> $msg,"data"=>$result));
}

?>