<?php
include "config.php";
if(empty($_FILES['new-image']['name'])){
    $new_name = $_POST['old-image'];
}
else{
    $error = array();

    $file_size = $_FILES['new-image']['size'];
    $file_tmp_name = $_FILES['new-image']['tmp_name'];
    $file_type = $_FILES['new-image']['type'];
    
    
    $file_name = $_FILES['new-image']['name'];
    $filename_parts= explode('.',$file_name);
    $ext = strtolower(end($filename_parts));
    $valid_ext = array("jpeg","jpg","png"); 

    if(in_array($ext,$valid_ext)===false){

        $error[] = "This File Extension is not valid, Please choose between any image (jpeg, jpg or png) format!";
    }
    if($file_size>3145728){
        $error[] = "File size should be within 3MB!";
    }
    $new_name=  time()."-". basename($file_name);
    $target = "upload/".$new_name;
    $image_name = $new_name;
    if(empty($error) == true){
        move_uploaded_file($file_tmp_name,$target);
    }
    else{
        print_r($error);
        die();
    }
}

$post_id = $_POST['post_id'];
$title = mysqli_real_escape_string($conn,$_POST['post_title']);
$description = mysqli_real_escape_string($conn,$_POST['postdesc']);
$category = mysqli_real_escape_string($conn,$_POST['category']);


$date = date("d M, Y H:i");

$sql = "UPDATE post SET title='{$title}',description='{$description}', category={$category},post_date='{$date}', post_img='{$image_name}' WHERE post_id= {$post_id};";

if($_POST['old_category']!= $_POST["category"]){
$sql .= "UPDATE category SET post = post - 1 WHERE category_id = {$_POST['old_category']};";
$sql .= "UPDATE category SET post = post + 1 WHERE category_id = {$_POST["category"]};";
}

$result = mysqli_multi_query($conn,$sql);
if($result){
    header("Location: {$hostname}/admin/post.php");
}
else{
    echo "Query Failed";
}

?>