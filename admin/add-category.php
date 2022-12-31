<?php include "header.php"; 
include("/BITM/wamp/www/News-Site/config.php");
if(isset($_POST['save'])){
    // $catName = $_POST['cat'];
$sql = "insert into category(category_name) values('{$_POST["cat"]}')";
$result = mysqli_query($con, $sql) or die("Inser Query Failed");
header("location: http://localhost/News-Site/admin/category.php");
}

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add New Category</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST" autocomplete="off">
                      <div class="form-group">
                          <label>Category Name</label>
                          <input type="text" name="cat" class="form-control" placeholder="Category Name" required>
                      </div>
                      <input type="submit" name="save" class="btn btn-primary" value="Save" required />
                  </form>
                  <!-- /Form End -->
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
