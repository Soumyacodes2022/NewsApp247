<?php include "header.php";
include "config.php";
if($_SESSION["user_role"]== '0'){
    header("Location: {$hostname}/admin/post.php");               
}
if (isset($_POST['submit'])) {
    $userid = mysqli_real_escape_string($conn, $_POST['user_id']);
    $fname = mysqli_real_escape_string($conn, $_POST['f_name']);
    $lname = mysqli_real_escape_string($conn, $_POST['l_name']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);


    $sql = "UPDATE user SET first_name='{$fname}',last_name='{$lname}',username='{$username}', role='{$role}' WHERE user_id='{$userid}'";
    $result = mysqli_query($conn, $sql) or die('Query Unsuccessful');
    if($result){
    header("Location: {$hostname}/admin/users.php");
    }
    mysqli_close($conn);
}
?>
<div id="admin-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="admin-heading">Modify User Details</h1>
            </div>
            <div class="col-md-offset-4 col-md-4">
                <!-- Form Start -->
                <?php
                include "config.php";

                $userid = $_GET['id'];
                $sql1 = "SELECT * FROM user WHERE user_id = {$userid}";
                $result1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                ?>
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
                            <div class="form-group">
                                <input type="hidden" name="user_id" class="form-control" value="<?= $row1['user_id'] ?>" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="f_name" class="form-control" value="<?= $row1['first_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="l_name" class="form-control" value="<?= $row1['last_name'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" name="username" class="form-control" value="<?= $row1['username'] ?>" placeholder="" required>
                            </div>
                            <div class="form-group">
                                <label>User Role</label>
                                <select class="form-control" name="role" value="<?= $row1['role'] ?>">
                                    <?php
                                    if ($row1['role'] == 1) {
                                        echo "<option value='0'>normal User</option>
                                           <option value='1' selected>Admin</option>";
                                    } else {
                                        echo "<option value='0' selected>normal User</option>
                                            <option value='1'>Admin</option>";
                                    }
                                    ?>

                                </select>
                            </div>
                            <input type="submit" name="submit" class="btn btn-primary" value="Update" required />
                        </form>
                <?php
                    }
                }
                ?>
                <!-- /Form -->
            </div>
        </div>
    </div>
</div>
<?php include "footer.php"; ?>