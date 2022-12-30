<?php 
include("/BITM/wamp/www/News-Site/config.php");
    
session_start();

    session_unset();

    session_destroy();

    header("location: http://localhost/News-Site/admin/");
mysqli_close($con);
?>