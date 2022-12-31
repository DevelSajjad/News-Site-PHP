<?php 
include("/BITM/wamp/www/News-Site/config.php");

if(empty($_FILES['logo']['name'])){
    $image = $_POST['old_logo'];
} else{
    $error = array();
    $image = $_FILES['logo']['name'];
    $tmpName = $_FILES['logo']['tmp_name'];
    $type = $_FILES['logo']['type'];
    $size = $_FILES['logo']['size'];
    $fileExt = end(explode('.',$image));
    $ext =["jpg","png","JPG"];
    if(in_array($fileExt, $ext) === false){
        $error[] = "Only Upload JPG or PNG File";
    }
    if($size > 2097152){
        $error[] = "Only Upload 2 MB File";
    }
    if(empty($error) == true){
        move_uploaded_file($tmpName,"images/".$image);
    }
}
$name = $_POST['website_name'];
$footer = $_POST['footer_desc'];
$sql = "update setting set webname = '{$name}', logo = '{$image}', footername = '{$footer}'";
$result = mysqli_query($con, $sql) or die("Unsuccessful Query");
if($result){
    header("location: http://localhost/News-Site/index.php");
}


?>