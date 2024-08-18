<?php
include "config.php";
session_start();

if(!isset($_SESSION["username"])){
    header("Location: {$hostname}/admin/");
}
$currentPage = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>ADMIN Panel</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="../css/bootstrap.min.css" />
        <!-- Font Awesome Icon -->
        <link rel="stylesheet" href="../css/font-awesome.css">
        <!-- Custom stlylesheet -->
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
        <!-- HEADER -->
        <div id="header-admin">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- LOGO -->
                    <div class="col-md-2">
                        <a href="post.php"><img class="logo" src="images/news.jpg"></a>
                        <p style="color: #fff; font-size: 18px; margin-top:5px; margin-bottom:-5px;font-weight: 600;">Hello <?= ($_SESSION["username"]) ?>,<?= $_SESSION["user_role"]== '1' ? "(ADMIN)" : ""; ?></p>    
                    </div>
                    <!-- /LOGO -->
                      <!-- LOGO-Out -->
                    <div class="col-md-offset-9  col-md-1">
                        <a href="logout.php" class="admin-logout" >logout</a>
                    </div>
                    <!-- /LOGO-Out -->
                </div>
            </div>
        </div>
        <!-- /HEADER -->
        <!-- Menu Bar -->
        <div id="admin-menubar">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                       <ul class="admin-menu">
                            <li class="<?= $currentPage=='post.php' ? 'active' : '' ?>">
                                <a href="post.php">Post</a>
                            </li>
                            <?php
                                if($_SESSION["user_role"]== '1'){
                            ?>
                            <li class="<?= $currentPage=='category.php' ? 'active' : '' ?>">
                                <a href="category.php">Category</a>
                            </li>
                            <li class="<?= $currentPage=='users.php' ? 'active' : '' ?>">
                                <a href="users.php">Users</a>
                            </li>
                            <?php
                            }
                            ?>
                            <li class="<?= $currentPage=='settings.php' ? 'active' : '' ?>">
                                <a href="settings.php">Settings</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <style>
       

    </style>
        <!-- /Menu Bar -->
