<?php 
include("/BITM/wamp/www/News-Site/config.php");

$page = basename($_SERVER['SCRIPT_NAME']);
switch($page){
    case "single.php":
        if(isset($_GET['id'])){
            $sql = "select * from post where post_id = {$_GET['id']}";
            $result = mysqli_query($con, $sql) or die("Unsuccessful Query");
            $value = mysqli_fetch_assoc($result);
            $titlePage = $value['title']." Page";
        }else{
            $titlePage = "No Page";
        }
        break;
    case "category.php":
        if(isset($_GET['cid'])){
            $sql = "select *  from category where category_id = {$_GET['cid']}";
            $result = mysqli_query($con, $sql);
            $value = mysqli_fetch_assoc($result);
            $titlePage = $value['category_name']." Page";
        }else{
            $titlePage = "No Page";
        }
        break;

        case "author.php":
            if(isset($_GET['auth'])){
                $sql = "select *  from user where user_id = {$_GET['auth']}";
                $result = mysqli_query($con, $sql);
                $value = mysqli_fetch_assoc($result);
                $titlePage = $value['username']." Page";
            }else{
                $titlePage = "No Page";
            }
            break;
        case "search.php":
            if(isset($_GET['search'])){
                $titlePage = "Search Page";
            }else{
                $titlePage = "No Page";
            }
            break;
            default:
            
            $sql = "select webname from setting";
            $result = mysqli_query($con,$sql);
            $value = mysqli_fetch_assoc($result);
       
                $titlePage = $value['webname'];
                break;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?php echo $titlePage; ?></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <?php
                  
                    $sql = "select logo from setting";
                    $result3 = mysqli_query($con,$sql);
                    $logo = mysqli_fetch_assoc($result3);
                    if($logo['logo'] == ""){
                        $logoImg = $titlePage;
                    }else{
                        $logoImg = $logo['logo'];
                    }
                ?>
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="admin/images/<?php echo $logoImg;  ?>"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<?php 
    // include("/BITM/wamp/www/News-Site/config.php");
    if(isset($_GET['cid'])){
        $cid = $_GET['cid'];
    }
    
    $sql = "select * from category where post > 0";
    $result = mysqli_query($con, $sql) or die("unsuccess sql");
    if(mysqli_num_rows($result) > 0){

   
?>
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <?php 
                    echo "<li> <a href= 'index.php'> Home </a> </li>";
                      while($row = mysqli_fetch_assoc($result)){
                        $active = "";
                        if(isset($_GET['cid'])){
                            if($row['category_id'] == $cid){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                        }
                        echo "<li><a class='{$active}'  href='category.php?cid={$row['category_id']}'>{$row['category_name']}</a></li>";
                      } 
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php  } ?>
<!-- /Menu Bar -->
