<?php include "header.php"; 
    include("/BITM/wamp/www/CMSBlog/config.php");
    
    // if($_SESSION['role'] == 0){
    //     header("location: http://localhost/CMSBlog/admin/post.php");
    // }

?>
  <div id="admin-content">
      <div class="container">
          <div class="row">
              <div class="col-md-10">
                  <h1 class="admin-heading">All Users</h1>
              </div>
              <div class="col-md-2">
                  <a class="add-new" href="add-user.php">add user</a>
              </div>
              <div class="col-md-12">
                <?php 
                include("/BITM/wamp/www/CMSBlog/config.php");
                if(isset($_GET['page'])){
                    $page = $_GET['page'];
                }else{
                    $page = 1;
                }
                $limit = 3;
                $offset = ($page - 1) * $limit;
                $sql = "select * from user order by user_id limit {$offset},{$limit}";
                $result = mysqli_query($con,$sql) or die("Unsuccessful Query");
                if(mysqli_num_rows($result) > 0){
                  
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Full Name</th>
                          <th>User Name</th>
                          <th>Role</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>
                      <?php 
                        while($row = mysqli_fetch_assoc($result)){
                      ?>
                      <tbody>
                          <tr>
                              <td class='id'><?php echo $row['user_id'] ?></td>
                              <td><?php echo $row['first_name'].' '.$row['last_name'] ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td><?php 
                                if($row['role'] == 1) {
                                    echo "Admin";
                                }else echo "Normal User";
                              ?></td>
                              <td class='edit'><a href='update-user.php?edit_id=<?php echo $row['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-user.php?delete_id=<?php echo $row['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>
                      <?php } ?>
                  </table>
                  <?php 
                      
                    }
                    //Pagination

                    $sql1 = "select * from user";
                    $result1 = mysqli_query($con, $sql1) or die("Unsuccessful Query1");
                    if(mysqli_num_rows($result1) > 0){
                            echo " <ul class='pagination admin-pagination'>";
                            if($page > 1){
                                echo '<li><a href="users.php?page='.($page - 1).'">Prev</a></li>';
                            }
                            $total_record = mysqli_num_rows($result1);
                            $total_page = ceil($total_record / $limit);
                            for($i = 1; $i <= $total_page; $i++){
                                if($i == $page){
                                    $active = "active";
                                }else{
                                    $active = "";
                                }
                                echo "<li class='{$active}'><a href='users.php?page={$i}'>{$i} </a></li>";
                            } 
                            if($total_page > $page){
                                echo '<li><a href="users.php?page='.($page + 1).'"> Next </a></li>';
                            }
                        echo "</ul>";
                    }
                  ?>
                 
                      <!-- <li class="active"><a>1</a></li>
                      <li><a>2</a></li>
                      <li><a>3</a></li>
                  </ul> -->
              </div>
          </div>
      </div>
  </div>
