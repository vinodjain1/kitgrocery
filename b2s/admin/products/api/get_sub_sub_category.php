<?php
include '../../../config.php';


if (! empty($_POST["sub_id"])) {
    
    $sub_id = $_POST["sub_id"];
    
    $resultdata =$con->query("select * from `tbl_sub_sub_category` where sub_category_id='$sub_id'" );
     $result=array();
     while($row=mysqli_fetch_array($resultdata))
    {
       $result[]= $row;
        
    }
    ?>
<option value="">Select Category</option>
<?php
    foreach ($result as $state) {
        ?>
<option value="<?php echo $state["id"]; ?>"><?php echo $state["name_ar"]; ?>, <?php echo $state["name_en"]; ?></option>
<?php
    }
}
?>