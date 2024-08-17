<?php include 'header.php'; 
include "config.php";

$post_id = $_GET['id'];
$sql = "SELECT p.post_id,p.title,p.description,c.category_name,p.post_date,u.first_name,u.last_name,p.category,p.post_img FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id WHERE p.post_id = {$post_id}";

$result = mysqli_query($conn,$sql);

?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                  <!-- post-container -->
                    <div class="post-container">
                  <?php
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                        <div class="post-content single-post">
                            <h3><?= $row['title'] ?></h3>
                            <div class="post-information">
                                <span>
                                    <i class="fa fa-tags" aria-hidden="true"></i>
                                    <?= $row['category_name'] ?>
                                </span>
                                <span>
                                    <i class="fa fa-user" aria-hidden="true"></i>
                                    <a href='author.php'><?= $row['first_name']." ".$row['last_name']  ?></a>
                                </span>
                                <span>
                                    <i class="fa fa-calendar" aria-hidden="true"></i>
                                    <?= $row['post_date']?>
                                </span>
                            </div>
                            <img class="single-feature-image" src="admin/upload/<?= $row['post_img'] ?>" alt=""/>
                            <p class="description">
                                <?= $row['description'] ?>
                            </p>
                        </div>
                     <?php
                            }
                        } else{
                            echo "<h2>No record Found!!</h2>";
                        }
                        ?>
                    </div>
                    <!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
    
<?php include 'footer.php'; ?>
