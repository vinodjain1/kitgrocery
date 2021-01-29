<?php
 $offset='+5:30';
$con=mysqli_connect("localhost","kamavvve_kamavvve","iAxMgdxVvaqo","kamavvve_marketplace");
$con->query("SET time_zone='".$offset."';");

$baseimage="https://kamakhyaits.com/b2s/admin/";

define( 'API_ACCESS_KEY', 'AAAAzvZT-DY:APA91bH86uEX0nmW3DKrcVVfSpJ2FQ94iKyEddaDvrziiK8EaFy0D-pqGx4U9vdXulYVmdGnXbk1stfkeUQe_U2BqwJHo6zntx_OwyDNDENJsylZEtPM7lFLD9jTbgbH90NIb3EJGd2N' );
// if ($con->connect_error) {
//     die("Connection failed: " . $con->connect_error);
// } 
// echo "Connected successfully"; 



if(isset($_REQUEST['language'])) {
    
    $langs = $_REQUEST['language'];
}else {
    
$data_language = json_decode(file_get_contents("php://input")); 
$langs = $data_language->language;
}

?>