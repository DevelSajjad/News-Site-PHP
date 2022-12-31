<?php include "header.php"; 
    error_reporting(0);
    if(isset($_POST['save'])){
      include("/BITM/wamp/www/News-Site/config.php");
      $fname = mysqli_real_escape_string($con, $_POST['fname']);
      $lname = mysqli_real_escape_string($con, $_POST['lname']);
      $user  = mysqli_real_escape_string($con, $_POST['user']);
      $email = mysqli_real_escape_string($con, $_POST['email']);
      $pass  = mysqli_real_escape_string($con, md5($_POST['password']));
      $role  = mysqli_real_escape_string($con, $_POST['role']);
      $sql = "select username from user where username = '{$user}'";
      $result = mysqli_query($con,$sql) or die("Unsuccessful Query");
      
      $validEmail = filter_var($email, FILTER_VALIDATE_EMAIL);

      if(mysqli_num_rows($result) > 0){
        echo "UserName Already Exist";
      } elseif (empty($email)) {
        $emt = "Please Enter Your Email";
    } elseif (!$validEmail) {
        $valid = "Please Enter Valid Email";
    }
      else {
        $sql1 = "insert into user(first_name,last_name,username,email,password,role)
        values('{$fname}','{$lname}','{$user}','{$email}','{$pass}','{$role}')";
        
        if(mysqli_query($con,$sql1)){
            header("location: http://localhost/News-Site/admin/users.php");
        }
      }
      
    }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-12">
                  <h1 class="admin-heading">Add User</h1>
              </div>
              <div class="col-md-offset-3 col-md-6">
                  <!-- Form Start -->
                  <form  action="<?php $_SERVER['PHP_SELF']  ?>" method ="POST" autocomplete="off">
                      <div class="form-group">
                          <label>First Name</label>
                          <input type="text" name="fname" class="form-control" placeholder="First Name" required>
                      </div>
                          <div class="form-group">
                          <label>Last Name</label>
                          <input type="text" name="lname" class="form-control" placeholder="Last Name" required>
                      </div>
                      <div class="form-group">
                          <label>User Name</label>
                          <input type="text" name="user" class="form-control" placeholder="Username" required>
                      </div>
                      
                      <div class="form-group">
                          <label>Email</label> <span style="color: red;"> <?php echo ":". $emt; ?></span>
                          <input type="email" name="email" class="form-control" placeholder="Email" required>
                      </div>
                        <span style="color: red;"> <?php echo $valid; ?></span>
                      <div class="form-group">
                          <label>Password</label>
                          <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>
                      <div class="form-group">
                          <label>User Role</label>
                          <select class="form-control" name="role" >
                              <option value="0">Normal User</option>
                              <option value="1">Admin</option>
                          </select>
                      </div>
                      <input type="submit"  name="save" class="btn btn-primary" value="Save" />
                  </form>
                   <!-- Form End-->
               </div>
           </div>
       </div>
   </div>
<?php include "footer.php"; ?>
