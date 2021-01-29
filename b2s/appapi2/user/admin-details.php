<?php

include '../../config.php';
 
$tbl_cartresultdata =$con->query("select * from `admin` " );

        while($tbl_cartdrow=mysqli_fetch_array($tbl_cartresultdata))
        {   
            echo json_encode(array("status"=>'101',"message"=>'data found',"data"=>$tbl_cartdrow));
        }     
 
?>