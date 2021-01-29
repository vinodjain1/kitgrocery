<?php
include '../../../config.php';


if (! empty($_POST["main_id"])) {
    
    $main_id = $_POST["main_id"];
    
    $resultdata =$con->query("select * from `tbl_sub_category` where main_category_id='$main_id'" );
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