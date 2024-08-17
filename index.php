<?php include 'header.php'; 
include "config.php";
$limit = 3;
if(isset($_GET['page'])){
$pageNo = $_GET['page'];
}else{
    $pageNo = 1;
}
$offset = ($pageNo - 1) * $limit;

$sql = "SELECT p.post_id,p.title,p.description,c.category_id,c.category_name,p.post_date,u.first_name,u.last_name,p.category,p.post_img FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id ORDER BY p.post_date DESC LIMIT {$offset},{$limit}";

$result = mysqli_query($conn,$sql);

?>
    <div id="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <!-- post-container -->
                    <div class="post-container">
                        <div class="post-content">
                        <?php
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                            <div class="row">
                                <div class="col-md-4">
                                    <a class="post-img" href="single.php?id=<?= $row['post_id'] ?>"><img src="admin/upload/<?= $row['post_img'] ?>" alt=""/></a>
                                </div>
                                <div class="col-md-8">
                                    <div class="inner-content clearfix">
                                        <h3><a href='single.php?id=<?= $row['post_id'] ?>'><?= $row['title'] ?></a></h3>
                                        <div class="post-information">
                                            <span>
                                                <i class="fa fa-tags" aria-hidden="true"></i>
                                                <a href='category.php?cid=<?= $row['category_id'] ?>'><?= $row['category_name'] ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-user" aria-hidden="true"></i>
                                                <a href='author.php'><?= $row['first_name']." ".$row['last_name']  ?></a>
                                            </span>
                                            <span>
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                                <?= $row['post_date'] ?>
                                            </span>
                                        </div>
                                        <p class="description">
                                        <?= substr($row['description'], 0 , 100). "..."?>
                                        </p>
                                        <a class='read-more pull-right' href='single.php?id=<?= $row['post_id'] ?>'>read more</a>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            }else{
                                echo "<h2>You have no New Posts!</h2>";
                            }
                            ?>
                        </div>
                        
                        <?php
                  $sql1 = "SELECT * FROM post";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {

                        $total_records = mysqli_num_rows($result1);
                        $total_pages = ceil($total_records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($pageNo>1){
                        echo '<li><a href="index.php?page='.($pageNo-1).'"><span class="fa fa-long-arrow-left"></span> Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if($i==$pageNo){
                                $active = "active";
                            }
                            else{
                                $active = "";
                            }
                            echo "<li class={$active}><a href='index.php?page={$i}'>{$i}</a></li>";
                        }
                        if($pageNo<$total_pages){
                            echo "<li><a href='index.php?page=".($pageNo+1)."'>Next <span class='fa fa-long-arrow-right'></span></a></li>";
                            }
                        echo "</ul>";
                    }
                    ?>
                    </div><!-- /post-container -->
                </div>
                <?php include 'sidebar.php'; ?>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>
