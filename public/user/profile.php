<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php

session_start();
if (isset($_SESSION['user_id'])){
    echo 'success';
    include_once '../../php/conf.php';

    $getuser = $con->prepare("SELECT * FROM users WHERE id = ?");
    $getuser->bindParam( 1 , $_SESSION['user_id']);
    $getuser->execute();
    $row = $getuser->fetch();
?>

<form method="POST" id="update" enctype="multipart/form-data">
                <header class="err_msg" id="error">هنا يتم عرض رسالة الخطا</header>
                    <div class="field">
                        <label>الاسم الاول:</label>
                        <input name="fname" type="text" value="<?php echo $row['fname'] ?>">
                    </div>
                    <div class="field">
                        <label>اسم العائلة:</label>
                        <input name="lname" type="text" value="<?php echo $row['lname'] ?>">
                    </div>
                <div class="field">
                        <label>تاريخ الميلاد:</label>
                        <input name="age" type="date" value="<?php echo $row['age'] ?>" >
                    </div>
                    <div class="field">
                        <label>البريد الالكتروني:</label>
                        <input name="email" type="email" value="<?php echo $row['email'] ?>">
                    </div>
                    <div class="field">
                        <label>كلمة المرور:</label>
                        <input minlength="8" name="password" type="password" placeholder="update your password">
                    </div>
                    <div class="field file">
                        <label>اختر صورة لبروفايلك:</label>
                        <input name="img" type="file" value="<?php echo $row['image'] ?>">
                    </div>
                    <div class="btn">
                        <input id="editBtn" type="submit" value="تعديل الحساب">
                    </div>
                    <div class="link">
                        <p><a href="user_dash.php">Back to home page</a></p>
                    </div>
            </form>


<?php
}else{
    echo 'you do not have permission to access to this page!';
        header("location:http://localhost/project1/public/view/login.html");
        die();
}
?>


<script src="../../javascript/updateProfile.js"></script>




</body>
</html>