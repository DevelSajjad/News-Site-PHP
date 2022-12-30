<?php include "header.php"; ?>
  <div id="admin-content">
      <div class="container">
          <div class="row">

              <div class="col-md-10">
                  <h1 class="admin-heading">All Posts</h1>
              </div>

              <div class="col-md-2">
                  <a class="add-new" href="add-post.php">add post</a>
              </div>

              <div class="col-md-12">
                <?php 
                    include("/BITM/wamp/www/News-Site/config.php");
                    if (isset($_GET['page'])){
                        $page = $_GET['page'];
                    } else {
                        $page = 1;
                    }
                    
                    $limit = 3;
                    $offset = ($page - 1)* $limit;
                    
                    if ($_SESSION['role'] == 1) {
                        $sql = "select * from post
                    left join category on post.category = category.category_id
                    left join user on post.author = user.user_id order by post_id desc limit {$offset},{$limit} ";
                    
                    $result = mysqli_query($con, $sql) or die("Unsuccessful SQL");
                    } elseif ($_SESSION['role'] == 0) {
                        $sql = "select * from post
                    left join category on post.category = category.category_id
                    left join user on post.author = user.user_id 
                    where post.author = {$_SESSION['userId']} order by post_id desc limit {$offset},{$limit} ";
                    
                    $result = mysqli_query($con, $sql) or die("Unsuccessful SQL");
                    }
                    if (mysqli_num_rows($result) > 0) {

                    
                ?>
                  <table class="content-table">
                      <thead>
                          <th>S.No.</th>
                          <th>Title</th>
                          <th>Category</th>
                          <th>Date</th>
                          <th>Author</th>
                          <th>Edit</th>
                          <th>Delete</th>
                      </thead>

                      <?php
                        $offset += 1;
                        while($row = mysqli_fetch_assoc($result)){
                      ?>

                      <tbody>
                          <tr>
                              <td class='id'><?php echo $offset ?></td>
                              <td><?php echo $row['title']; ?></td>
                              <td><?php echo $row['category_name']; ?></td>
                              <td><?php echo $row['post_date']; ?></td>
                              <td><?php echo $row['username'] ?></td>
                              <td class='edit'><a href='update-post.php?edit=<?php echo $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?delete=<?php echo $row['post_id'] ?>&catId=<?php echo $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                      </tbody>
                      <?php $offset++; } ?>
                  </table>
                  <?php } ?>
                            
                    <?php 
                        $sql1 = "select * from post";
                        $result1 = mysqli_query($con, $sql1);
                        if (mysqli_num_rows($result1)) {
                            
                            $totalPage = mysqli_num_rows($result1);
                            $numberPage = ceil($totalPage / $limit); 
                     
                            echo '<ul class="pagination admin-pagination">';
                            if($page > 1)
                            echo '<li> <a href="post.php?page='.($page -1).'"> Prev </a> </li>';
                    ?>

                    <!-- <li class="active"><a>1</a></li> -->
                    <?php
                            for ($i = 1; $i <= $numberPage; $i++) {
                                if ($page == $i ) {
                                    $active = "active";
                                } else
                                $active ="";

                                echo "<li class='{$active}'><a href='post.php?page={$i}'>{$i}</a></li>";
                            } 
                            if ($page < $totalPage) {
                                echo '<li> <a href="post.php?page='.($page + 1).'"> Next </a> </li>';
                            }        
                    ?>  
                  </ul>

                  <?php } ?>
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
