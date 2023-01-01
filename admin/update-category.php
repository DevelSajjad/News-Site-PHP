<?php include "header.php"; 
        $id = $_GET['edit'];
        // $catName = $_POST[]
        if(isset($_POST['update'])){

            $sql1 = "update category set category_name = '{$_POST["cat_name"]}' where category_id = {$id}";
            $result1 = mysqli_query($con, $sql1);
            if($result1){
                header("location: http://localhost/News-Site/admin/category.php");
            }else{
                echo "<h2>Unsuccessful sql1</h2>";
            }
        }
    ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="adin-heading"> Update Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                <?php 
                    $sql = "select * from category where category_id = {$id}";
                    $result = mysqli_query($con, $sql) or die("Unsuccesful");
                    if(mysqli_num_rows($result)> 0){
                        while($row = mysqli_fetch_assoc($result)){ 
                ?>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method ="POST">
                      <div class="form-group">
                          <input type="hidden" name="cat_id"  class="form-control" value="<?php echo $row['category_id']; ?>" placeholder="">
                      </div>
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat_name" class="form-control" value="<?php echo $row['category_name']; ?>"  placeholder="" required>
                      </div>
                      <input type="submit" name="update" class="btn btn-primary" value="Update" required />
                  </form>
                  <?php }} ?>
                </div>
              </div>
            </div>
          </div>
<?php include "footer.php"; ?>
