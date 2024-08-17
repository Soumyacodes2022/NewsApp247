<?php include "header.php";
include "config.php";
if($_SESSION["user_role"]== '0'){
    header("Location: {$hostname}/admin/post.php");               
}

$limit = 3;
if (isset($_GET['page'])) {
    $pageNo = $_GET['page'];
} else {
    $pageNo = 1;
}

$offset = ($pageNo - 1) * $limit;
$sql = "SELECT * FROM category ORDER BY category_id DESC LIMIT {$offset},{$limit}";
$result = mysqli_query($conn, $sql);



?>


<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-10">
                <h1 class="admin-heading">All Categories</h1>
            </div>
            <div class="col-md-2">
                <a class="add-new" href="add-category.php">add category</a>
            </div>
            <div class="col-md-12">
                <table class="content-table">
                    <thead>
                        <th>S.No.</th>
                        <th>Category Name</th>
                        <th>No. of Posts</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                                <tr>
                                    <td class='id'><?= $row['category_id'] ?></td>
                                    <td><?= $row['category_name'] ?></td>
                                    <td><?= $row['post'] ?></td>
                                    <td class='edit'><a href='update-category.php?id=<?= $row['category_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-category.php?id=<?= $row['category_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        <?php
                            }
                        } else {
                            echo "<p style='color:black; text-align:center; font-size:20px; margin-top:10px'>No DATA to show</p>";
                        }
                        ?>

                    </tbody>
                </table>
                <?php
                echo "<ul class='pagination admin-pagination'>";


                $sql1 = "SELECT * FROM category";
                $result = mysqli_query($conn, $sql1);


                if (mysqli_num_rows($result) > 0) {
                    $total_rows =  mysqli_num_rows($result);
                    $total_pages = ceil($total_rows / $limit);
                    if ($pageNo > 1) {
                        echo "<li><a href='category.php?page=" . ($pageNo - 1) . "'><span class='fa fa-long-arrow-left'></span> Prev</a></li>";
                    }
                    for ($i = 1; $i <= $total_pages; $i++) {
                        if ($i == $pageNo) {
                            $active = "active";
                        } else {
                            $active = "";
                        }
                        echo "<li class='$active'><a href='category.php?page={$i}'>{$i}</a></li>";
                    }
                    if ($pageNo < $total_pages) {
                        echo "<li><a href='category.php?page=" . ($pageNo + 1) . "'>Next <span class='fa fa-long-arrow-right'></span></a></li>";
                    }
                    echo "</ul>";
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>