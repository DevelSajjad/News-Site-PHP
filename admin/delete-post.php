<?php
    // include("/BITM/wamp/www/CMSBlog/config.php");
    // $delete = $_GET['delete'];
    // $catID = $_GET['catId'];
    // $sql1 = "select * from post where post_id = {$delete}";
    // $result1 = mysqli_query($con, $sql1) or die("Unsuccess SQL 1");
    // if($row =mysqli_fetch_assoc($result1)){
        
    //     unlink("upload/".$row['post_img']);
    // }
    // $sql = "delete from post where post_id = {$delete};";
    // $sql .= "update category set post = post - 1 where category_id = {$catID}";
    // $result = mysqli_multi_query($con, $sql) or die("Unsuccessful Query");
    // if($result){
    //     header("location: http://localhost/CMSBlog/admin/post.php");
    //     mysqli_close($con);
    // }

    include("/BITM/wamp/www/News-Site/config.php");
    $delete = $_GET['delete'];
    $catId = $_GET['catId'];
    $sql1 = "select * from post where post_id = {$delete}";
    $result1 = mysqli_query($con, $sql1) or die("Unsuccessful SQL1");
    while($row = mysqli_fetch_assoc($result1)){
        unlink("upload/".$_POST['post_img']);
    }
    $sql = "delete from post where post_id = {$delete};";
    $sql .= "update category set post = post - 1 where category_id = {$catId}";
    $result = mysqli_multi_query($con, $sql) or die("unsuccessful");
    header("location: http://localhost/News-Site/admin/post.php");
?>