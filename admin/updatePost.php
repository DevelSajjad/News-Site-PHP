<?php
// include("/BITM/wamp/www/CMSBlog/config.php");
// if(empty($_FILES['new-image']['name'])){
//     $image = $_POST['old-image'];
// }else{
//     $error = array();
//     $image = $_FILES['new-image']['name'];
//     $tmpName = $_FILES['new-image']['tmp_name'];
//     $size = $_FILES['new-image']['size'];
//     $type = $_FILES['new-image']['type'];
//     $fileExt = end(explode('.',$image));
//     $ext = ['JPG','jpg','png'];
//     if(in_array($fileExt,$ext) === false){
//         $error[] = "Upload Only JPG or PNG File";
//     }
//     if($size > 2097152){
//         $error[] ="Image file under 2mb"; 
//     }
//     if(empty($error) == true){
//         move_uploaded_file($tmpName,"upload/".$image);
//     }
// }
    
//     echo $sql = "update post set title = '{$_POST["post_title"]}',description = '{$_POST["postdesc"]}', category = {$_POST["category"]}, post_img = '{$image}'
//         where post_id = {$_POST["post_id"]}";

//     $result = mysqli_query($con, $sql) or die("Unsuccessful Query");
//     header("location: http://localhost/CMSBlog/admin/post.php");
//     mysqli_close($con);

include("/BITM/wamp/www/News-Site/config.php");
if(empty($_FILES['new-image']['name'])){
    $nametime = $_POST['old-image'];
}else{
    $error = array();
    $image = $_FILES["new-image"]['name'];
    $tmp_name = $_FILES['new-image']['tmp_name'];
    $size = $_FILES['new-image']['size'];
    $tye = $_FILES['new-image']['type'];
    $fileExt = end(explode('.',$image));
    $ext = ['jpg','png','JPG'];
    if(in_array($fileExt,$ext)=== false){
        $error[]= "Only Upload jpg png";
    }
    if($size > 2097152 ){
        $error[] = "Only Upload 2 mb picture";
    }
    $nametime = time()."-".$image;
    $target = "upload/".$nametime;
    $new_img = $nametime;
    if(empty($error) == true){
        move_uploaded_file($tmp_name,$target);
    }
}
$sql = "update post set title='{$_POST["post_title"]}',description='{$_POST["postdesc"]}',category={$_POST["category"]},post_img='{$new_img}'
        where post_id = {$_POST["post_id"]};";
        if($_POST['category'] != $_POST['old_category']){
            $sql .= "update category set post = post - 1 where category_id = {$_POST['old_category']};";
            $sql .= "update category set post = post + 1 where category_id = {$_POST['category']};";
        }
        $result = mysqli_multi_query($con, $sql) or die("Unsuccessful Query");
            header("location: http://localhost/News-Site/admin/post.php");
        

?>