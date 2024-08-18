<?php include 'header.php'; ?>
    <div id="main-content">
      <div class="container">
        <div class="row">
            <div class="col-md-8">
                <!-- post-container -->
                <div class="post-container">
                  <?php
                        if(isset($_GET['search'])){
                                ?>
                    <h2 class="page-heading">Search: <?=$_GET['search']?></h2>
                    <?php } 
                    include "config.php";

                    $limit = 3;
                    if(isset($_GET['page'])){
                    $pageNo = $_GET['page'];
                    }else{
                        $pageNo = 1;
                    }
                    $offset = ($pageNo - 1) * $limit;

                    $search_term = mysqli_real_escape_string($conn,$_GET['search']);

                    $sql = "SELECT * FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id  WHERE p.title LIKE '%{$search_term}%' OR p.description LIKE '%{$search_term}%' OR  c.category_name LIKE '%{$search_term}%' OR u.first_name LIKE '%{$search_term}%' OR u.last_name LIKE '%{$search_term}%' OR p.post_date LIKE '%{$search_term}%' ORDER BY p.post_date DESC LIMIT {$offset},{$limit}";
                    $result = mysqli_query($conn,$sql); 
                    if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                    ?>
                    
                    <div class="post-content">
                        <div class="row">
                            <div class="col-md-4">
                                <a class="post-img" href="single.php"><img src="admin/upload/<?= $row['post_img'] ?>" alt=""/></a>
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
                                            <a href='author.php?authid=<?= $row['author'] ?>'><?= $row['first_name']." ".$row['last_name']?></a>
                                        </span>
                                        <span>
                                            <i class="fa fa-calendar" aria-hidden="true"></i>
                                            <?= $row['post_date'] ?>
                                        </span>
                                    </div>
                                    <p class="description">
                                    <?= substr($row['description'],0,100)."..." ?>
                                    </p>
                                    <a class='read-more pull-right' href='single.php'>read more</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }
                    }else{
                        echo "<h2>No search record found!!</h2>";
                    }

                    
                    $sql2 = "SELECT * FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id  WHERE p.title LIKE '%{$search_term}%' OR p.description LIKE '%{$search_term}%' OR  c.category_name LIKE '%{$search_term}%' OR u.first_name LIKE '%{$search_term}%' OR u.last_name LIKE '%{$search_term}%' OR p.post_date LIKE '%{$search_term}%'";
                    $result2 = mysqli_query($conn, $sql2);if (mysqli_num_rows($result2) > 0) {

                        $total_records = mysqli_num_rows($result2);
                        $total_pages = ceil($total_records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($pageNo>1){
                        echo '<li><a href="search.php?search='.$search_term.'&page='.($pageNo-1).'"><span class="fa fa-long-arrow-left"></span> Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if($i==$pageNo){
                                $active = "active";
                            }
                            else{
                                $active = "";
                            }
                            echo "<li class={$active}><a href='search.php?search={$search_term}&page={$i}'>{$i}</a></li>";
                        }
                        if($pageNo<$total_pages){
                            echo '<li><a href="search.php?search='.$search_term.'&page='.($pageNo+1).'">Next<span class="fa fa-long-arrow-right"></span></a></li>';
                            } 
                        echo "</ul>";
                    }
                    ?>
                    <!-- For Testing -->
                    <!-- <ul class='pagination'>
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                    </ul> -->
                </div><!-- /post-container -->
            </div>
            <?php include 'sidebar.php'; ?>
        </div>
      </div>
    </div>
<?php include 'footer.php'; ?>
