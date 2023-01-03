<?php

    include("../config.php");
    
    $id = $_GET['delete'];
    $sql = "delete from category where category_id = {$id}";
    $result = mysqli_query($con, $sql);
    header("location: http://localhost/News-Site/admin/category.php");

?>