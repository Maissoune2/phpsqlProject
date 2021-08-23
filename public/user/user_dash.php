<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الصفحة الرئيسية</title>
</head>
<body>
    <!-- this page is the user dashboard  -->
    <!-- so he can update his/here profile and access to other available features -->
    <?php
    session_start();
    if (isset($_SESSION['user_id'])) { echo 'success'; 
    
    //we won't get the user details to display it 
include_once '../../php/conf.php';
    $getUser = $con->prepare("SELECT * FROM users WHERE id = ?");
    $getUser->bindParam( 1 , $_SESSION['user_id']);
    $getUser->execute();
    $row = $getUser->fetch();
    ?>

        <div class="profile">
            <div class="user-info">
                <img width="80px" height="80px" src="../../images/<?php   echo $row['image'];    ?>">
                <div class="name">
                    <span><?php   echo $row['fname'];    ?></span>&nbsp; <span><?php   echo $row['lname'];    ?></span>
                    <br>
                    <span><?php   echo $row['email'];    ?></span>
                </div>
            </div>
        </div>

        <div class="features">
            <a href='profile.php'>Edit your Profile</a>
            <hr>
            <a href="todolist.php">To Do List</a>
            <hr>
            <a href="newStudent.html">Add New Student</a>
            <hr>
            <a href="showStudent.html">Show Students list</a>
        </div>
    <?php
    } else {
        echo 'you do not have permission to access to this page!';
        header("location:http://localhost/project1/public/view/login.html");
        die();
    }
    ?>
</body>
</html>