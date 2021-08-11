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
    if (isset($_SESSION['user_id'])) { echo 'success'; ?>
        
        
    <?php
    } else {
        echo 'you do not have permission to access to this page!';
        header("location:http://localhost/project1/public/view/login.html");
        die();
    }
    ?>
</body>
</html>