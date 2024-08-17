<?php include "header.php"; 
include "config.php";
$limit = 3;
if(isset($_GET['page'])){
$pageNo = $_GET['page'];
}else{
    $pageNo = 1;
}
$offset = ($pageNo - 1) * $limit;
if($_SESSION["user_role"]== '1'){
    $sql = "SELECT p.post_id,p.title,c.category_name,p.post_date,u.first_name,u.last_name,p.category FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id ORDER BY p.post_id DESC LIMIT {$offset},{$limit}";
}
else if($_SESSION["user_role"]== '0'){
    $sql = "SELECT p.post_id,p.title,c.category_name,p.post_date,u.first_name,u.last_name,p.category FROM post p LEFT JOIN category c ON p.category=c.category_id LEFT JOIN user u ON p.author = u.user_id WHERE u.user_id= {$_SESSION["user_id"]} ORDER BY p.post_id DESC LIMIT {$offset},{$limit}";
}

$result = mysqli_query($conn,$sql);

?>
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
                      <tbody>
                        <?php
                        if(mysqli_num_rows($result)>0){
                            while($row = mysqli_fetch_assoc($result)){
                            ?>
                          <tr>
                              <td class='id'><?= $row['post_id'] ?></td>
                              <td><?= $row['title'] ?></td>
                              <td><?= $row['category_name'] ?></td>
                              <td><?= $row['post_date'] ?></td>
                              <td><?= $row['first_name']." ". $row['last_name'] ?></td>
                              <td class='edit'><a href='update-post.php?id=<?= $row['post_id'] ?>'><i class='fa fa-edit'></i></a></td>
                              <td class='delete'><a href='delete-post.php?id=<?= $row['post_id'] ?>&catid=<?= $row['category'] ?>'><i class='fa fa-trash-o'></i></a></td>
                          </tr>
                          <?php
                            }
                        }
                        else {
                            echo "<p style='color:black; text-align:center; font-size:20px; margin-top:10px'>No DATA to show</p>";
                        }
                          ?>
                          
                      </tbody>
                  </table>
                  <?php
                  $sql1 = "SELECT * FROM post";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {

                        $total_records = mysqli_num_rows($result1);
                        $total_pages = ceil($total_records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($pageNo>1){
                        echo '<li><a href="post.php?page='.($pageNo-1).'"><span class="fa fa-long-arrow-left"></span> Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if($i==$pageNo){
                                $active = "active";
                            }
                            else{
                                $active = "";
                            }
                            echo "<li class={$active}><a href='post.php?page={$i}'>{$i}</a></li>";
                        }
                        if($pageNo<$total_pages){
                            echo "<li><a href='post.php?page=".($pageNo+1)."'>Next <span class='fa fa-long-arrow-right'></span></a></li>";
                            }
                        echo "</ul>";
                    }
                    ?>
                  
              </div>
          </div>
      </div>
  </div>
<?php include "footer.php"; ?>
