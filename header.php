<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>News</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <!-- Font Awesome Icon -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Custom stlylesheet -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<!-- HEADER -->
<div id="header">
    <!-- container -->
    <div class="container">
        <!-- row -->
        <div class="row">
            <!-- LOGO -->
            <div class=" col-md-offset-4 col-md-4">
                <a href="index.php" id="logo"><img src="images/news.jpg"></a>
            </div>
            <!-- /LOGO -->
        </div>
    </div>
</div>
<!-- /HEADER -->
<!-- Menu Bar -->
<div id="menu-bar">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <ul class='menu'>
                    <?php 
                            include "config.php";
                            $sql = "SELECT category_id,category_name FROM category WHERE post>0";
                            if(isset($_GET['cid'])){
                            $cid = $_GET['cid'];
                            }
                            $result = mysqli_query($conn,$sql);
                            if(mysqli_num_rows($result)>0){
                                while($row = mysqli_fetch_assoc($result)){
                      
                      ?>
                            <li><a class="<?= $row['category_id']==$cid ? 'active' : '' ?>" href='category.php?cid=<?= $row['category_id'] ?>'><?= $row['category_name'] ?></a></li>
                    <?php
                                }
                            }
                    ?>
                <li style="position:absolute; right:10px;"><a href='<?= $hostname ?>'><span title="Home" class="fa fa-home"></span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- /Menu Bar -->
