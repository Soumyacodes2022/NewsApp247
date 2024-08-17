<?php

include "config.php";
if($_SESSION["user_role"]== '0'){
    header("Location: {$hostname}/admin/post.php");               
}
$categoryid = $_GET['id'];
$sql = "DELETE FROM category WHERE category_id='{$categoryid}'";
$result = mysqli_query($conn, $sql);
if($result){
header("Location: {$hostname}/admin/Category.php");
}
else{
    echo "<p style='color:red; margin:10px 0; text-align:center;'> Could not delete </p>";
}
mysqli_close($conn,$sql);



?>