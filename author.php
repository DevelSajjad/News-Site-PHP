<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                    <?php 
                        if(isset($_GET['auth'])){
                            $auth = $_GET['auth'];
                        
                    $sql1 = "select * from post join user on post.author = user.user_id
                             where post.author = {$auth}";
                    $result1 = mysqli_query($con, $sql1) or die("unsuccessful sql1");
                    $row1 = mysqli_fetch_assoc($result1);
                
                    ?>
                  <h2 class="page-heading"><?php echo $row1['username']; ?></h2>
                  <?php 
                   
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                    }else{
                        $page = 1;
                    }
                    $limit = 3;
                    $offset = ($page - 1) * $limit;
                    
                    $sql = "select * from post left join category on post.category = category.category_id 
                            left join user on post.author = user.user_id 
                            where post.author ={$auth}  limit {$offset}, {$limit}";
                    $result = mysqli_query($con, $sql) or die("Unsuccessful SQL");
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){     
                  ?>
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php"><img src="admin/upload/<?php echo $row['post_img'] ?>" alt=""/></a>
                            </div>
                            <div class="col-md-8">
                                <div class="inner-content clearfix">
                                    <h3><a href='single.php?id=<?php echo $row['post_id'] ?>'><?php echo $row['title']; ?></a></h3>
                                    <div class="post-information">
                                        <span>
                                            <i class="fa fa-tags" aria-hidden="true"></i>
                                            <a href='category.php?cid=<?php echo $row['category']; ?>'><?php echo $row['category_name']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-user" aria-hidden="true"></i>
                                            <a href='author.php?auth=<?php echo $row['author']; ?>'><?php echo $row['username']; ?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?php echo $row['post_date']; ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?php echo substr($row['description'],0,130) ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php?id=<?php echo $row['post_id'] ?>'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php                  
                            }
                        }   
                    
                   
                    if(mysqli_num_rows($result1) > 0){
                        $numPage = mysqli_num_rows($result1);
                        $totalPage = ceil($numPage / $limit);
                        echo "<ul class='pagination'>";
                        for($i = 1; $i <= $totalPage; $i++){
                            if($page == $i){
                                $active = "active";
                            }else{
                                $active = "";
                            }
                            echo "<li class='{$active}'><a href='author.php?auth={$auth}&page={$i}'>{$i}</a></li>";
                                    
                        }
                        echo "</ul>";
                    }
                }
                    ?>
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
