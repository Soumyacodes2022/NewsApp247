<?php
include "config.php";

if(isset($_FILES['fileToUpload'])){
    $error = array();
    $file_name = $_FILES['fileToUpload']['name'];
    $file_size = $_FILES['fileToUpload']['size'];
    $file_tmp_name = $_FILES['fileToUpload']['tmp_name'];
    $file_type = $_FILES['fileToUpload']['type'];
    $file_exploded = explode('.',$file_name);
    $ext = strtolower(end($file_exploded));
    $valid_ext = array('jpeg','jpg','png');

    if(in_array($ext,$valid_ext)===false){

        $error[] = "This File Extension is not valid, Please choose between any image (jpeg, jpg or png) format!";
    }
    if($file_size>3145728){
        $error[] = "File size should be within 3MB!";
    }
    $new_name=  time()."-". basename($file_name);
    $target = "upload/".$new_name;
    if(empty($error) == true){
        move_uploaded_file($file_tmp_name,$target);
    }
    else{
        if(count($error)==1){
            
            echo '<div class= "alert alert-danger">'. $error[0] .'</div>';
        }else{
        foreach($error as $err){
        echo '<div class= "alert alert-danger">'. $err .'</div>';
        }
    }
        die();
    }
}
session_start();
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);


$date= date("d M, Y H:i");
$author = $_SESSION["user_id"];


$sql = "INSERT INTO post(title,description,category,post_date,author,post_img)
        VALUES('{$title}','{$description}','{$category}','{$date}',{$author},'{$new_name}');";

$sql .= "UPDATE category SET post = post + 1  WHERE category_id={$category}";

$result = mysqli_multi_query($conn,$sql);

if($result){
    header("Location: {$hostname}/admin/post.php");
}
else{
    echo '<div class= "alert alert-danger">Query Failed</div>';
}

?>