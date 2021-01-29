
<?php $path = $_GET['path'];
// echo $path;die;
if (file_exists($path)){
    if(unlink($path)){
       echo "File deleted";
    }
}else{
     echo "File is not exists";
} 
?>
