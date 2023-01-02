<div id ="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    include("/BITM/wamp/www/News-Site/config.php");
                    $sql = "select footername from setting";
                    $result = mysqli_query($con, $sql);
                    $row = mysqli_fetch_assoc($result);
                ?>
                <span><?php echo $row['footername'] ?></span>
            </div>
        </div>
    </div>
</div>
</body>
</html>
