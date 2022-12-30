<?php
include("/BITM/wamp/www/CMSBlog/config.php");
$delete_id = $_GET['delete_id'];
$sql = "delete from user where user_id = {$delete_id}";
$result = mysqli_query($con, $sql) or die("Unsuccessful Delete SQL");
header("location: http://localhost/CMSBlog/admin/users.php");
?>