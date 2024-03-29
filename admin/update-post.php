<?php include "header.php"; 

    if($_SESSION['role'] == 0){
        $edit = $_GET['edit'];
        $sql2 = "select author from post where post_id = {$edit}";
        $result2 = mysqli_query($con, $sql2) or die("unsuccessful sql2");
        $row2 = mysqli_fetch_assoc($result2);
        if($row2['author'] != $_SESSION['userId']){
            header("location: http://localhost/News-Site/admin/post.php");
        }
    }

?>
<div id="admin-content">
  <div class="container">
  <div class="row">
    <div class="col-md-12">
        <h1 class="admin-heading">Update Post</h1>
    </div>
    <div class="col-md-offset-3 col-md-6">
        <!-- Form for show edit-->
        <?php
            
            $edit = $_GET['edit'];
            $sql = "select * from post where post_id = {$edit}";
            $result = mysqli_query($con, $sql) or die("Unsuccessful SQL");
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_assoc($result)){

                
            
        ?>
        <form action="updatePost.php" method="POST" enctype="multipart/form-data" autocomplete="off">
            <div class="form-group">
                <input type="hidden" name="post_id"  class="form-control" value="<?php echo $row['post_id'] ?>" placeholder="">
            </div>
            <div class="form-group">
                <label for="exampleInputTile">Title</label>
                <input type="text" name="post_title"  class="form-control" id="exampleInputUsername" value="<?php echo $row['title'] ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"> Description</label>
                <textarea name="postdesc" class="form-control"  required rows="5">
                    <?php echo $row['description'] ?>
                </textarea>
            </div>
            <div class="form-group">
                <?php 
                    $sql1 = "select * from category";
                    $result1 = mysqli_query($con, $sql1) or die("Unsuccessful SQL1");
                    if(mysqli_num_rows($result1)){
                   
                ?>
                <label for="exampleInputCategory">Category</label>
                <select class="form-control" name="category">
                    <?php 
                         while($row1 = mysqli_fetch_assoc($result1)){
                            if($row['category'] == $row1['category_id']){
                                $select = "selected";
                            }else $select = "";
                                echo  "<option {$select} value='{$row1['category_id']}'>{$row1['category_name']}</option>";
                        }
                    
                    ?>
                </select>
                <input type="hidden" name="old_category" value="<?php echo $row['category']; ?>"/>
            </div>
            <?php } ?>
            <div class="form-group">
                <label for="">Post image</label>
                <input type="file" name="new-image"> <br>
                <img  src="upload/<?php echo $row['post_img'];  ?>" height="150px">
                <input type="hidden" name="old-image" value="<?php echo $row['post_img'];  ?>">
            </div>
            <input type="submit" name="submit" class="btn btn-primary" value="Update" />
        </form>
        <?php 
            } 
                
                } 
        ?>
        <!-- Form End -->
      </div>
    </div>
  </div>
</div>
<?php include "footer.php"; ?>
