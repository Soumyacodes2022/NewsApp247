<?php include "header.php";
include "config.php";
if($_SESSION["user_role"]== '0'){
    header("Location: {$hostname}/admin/post.php");               
}
$limit = 3;
if(isset($_GET['page'])){
$pageNo = $_GET['page'];
}else{
    $pageNo = 1;
}
$offset = ($pageNo - 1) * $limit;

$sql = "SELECT * FROM user ORDER BY user_id DESC LIMIT {$offset},{$limit}";
$result = mysqli_query($conn, $sql);

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
                    <table class="content-table">
                        <thead>
                            <th>S.No.</th>
                            <th>Full Name</th>
                            <th>User Name</th>
                            <th>Role</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </thead>
                        <tbody>
                            <?php
                            if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                                <tr>
                                    <td class='id'><?= $row['user_id'] ?></td>
                                    <td><?= $row['first_name'] . " " . $row['last_name'] ?></td>
                                    <td><?= $row['username'] ?></td>
                                    <td><?= ($row['role'] == 1) ?  "Admin" :  "User" ?></td>
                                    <td class='edit'><a href='update-user.php?id=<?= $row['user_id'] ?>'><i class='fa fa-edit'></i></a></td>
                                    <td class='delete'><a href='delete-user.php?id=<?= $row['user_id'] ?>'><i class='fa fa-trash-o'></i></a></td>
                                </tr>
                        </tbody>
                <?php
                            }
                        }
                        else {
                            echo "<p style='color:black; text-align:center; font-size:20px; margin-top:10px'>No DATA to show</p>";
                        }
                ?>
                    </table>
                    <?php

                    $sql1 = "SELECT * FROM user";

                    $result1 = mysqli_query($conn, $sql1);

                    if (mysqli_num_rows($result1) > 0) {

                        $total_records = mysqli_num_rows($result1);
                        $total_pages = ceil($total_records / $limit);

                        echo "<ul class='pagination admin-pagination'>";
                        if($pageNo>1){
                        echo '<li><a href="users.php?page='.($pageNo-1).'"><span class="fa fa-long-arrow-left"></span> Prev</a></li>';
                        }
                        for ($i = 1; $i <= $total_pages; $i++) {
                            if($i==$pageNo){
                                $active = "active";
                            }
                            else{
                                $active = "";
                            }
                            echo "<li class={$active}><a href='users.php?page={$i}'>{$i}</a></li>";
                        }
                        if($pageNo<$total_pages){
                            echo "<li><a href='users.php?page=".($pageNo+1)."'>Next <span class='fa fa-long-arrow-right'></span></a></li>";
                            }
                        echo "</ul>";
                    }
                    ?>


                </div>
            </div>
        </div>
    </div>
    <?php include "footer.php"; ?>