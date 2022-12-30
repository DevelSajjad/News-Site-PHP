<?php

    include("/BITM/wamp/www/News-Site/config.php");

    if(isset($_FILES['fileToUpload'])){
        $error = array();
        // echo "<pre>";
        //     print_r($_FILES['fileToUpload']);
        // echo "</pre>";
        $name = $_FILES['fileToUpload']['name'];
        $tmpName = $_FILES['fileToUpload']['tmp_name'];
        $type = $_FILES['fileToUpload']['type'];
        $size = $_FILES['fileToUpload']['size'];
        $fileExt = strtolower(end(explode('.',$name)));
        $ext = ["jpeg","jpg","png"];
        
        if(in_array($fileExt,$ext) === false){
           echo $error[] ="Upload Only jpeg jpg png"; 
        }
        if($size > 2097152){
            echo $error[] = "Upload Under 2 MB file";
        }
        // $nametime = time()."-".basename($name);
        // $target = "upload/".$nametime;
        // $new_img = $nametime;
        $nametime = time()."-".basename($name);
        $target = "upload/".$nametime;
        $new_img = $nametime;
        if(empty($error) == true){
            move_uploaded_file($tmpName,$target);
        }
    }
    session_start();
    $title = mysqli_real_escape_string($con, $_POST['post_title']);
    $description = mysqli_real_escape_string($con, $_POST['postdesc']);
    $category = $_POST['category'];
    $date = date("d M, Y");
    $author = $_SESSION['userId'];
    $sql = "insert into post(title,description,category,post_date,author,post_img)
            values('{$title}','{$description}','{$category}','{$date}','{$author}','{$new_img}');";
    $sql .= "update category set post = post + 1 where category_id = {$category}";

    if(mysqli_multi_query($con, $sql)){
        header("location: http://localhost/News-Site/admin/post.php");
    }else 
        echo "<div class='alert alert-danger'> Unsuccessful Add Post Query </div>";
?>