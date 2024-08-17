<?php

include "config.php";
if($_SESSION["user_role"]== '0'){
    header("Location: {$hostname}/admin/post.php");               
}
$userid = $_GET['id'];
$sql = "DELETE FROM user WHERE user_id='{$userid}'";
$result = mysqli_query($conn, $sql);
if($result){
header("Location: {$hostname}/admin/users.php");
}
else{
    echo "<p style='color:red; margin:10px 0; text-align:center;'> Could not delete </p>";
}
mysqli_close($conn,$sql);


?>