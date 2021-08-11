<?php


include_once 'apiHeaders.php';
include_once 'conf.php';
session_start();
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $email =trim(filter_input(INPUT_POST , 'email' , FILTER_SANITIZE_EMAIL));
    $password =trim(filter_input( INPUT_POST , 'password' , FILTER_SANITIZE_STRING));

    //check if the email already exist
    $checkEmail = $con->prepare("SELECT * FROM users WHERE email = ?");
    $checkEmail->bindParam( 1 ,$email);

    $checkEmail->execute();
    
    if ($checkEmail->rowCount() > 0) {
        $rows = $checkEmail->fetchObject();
if ($rows->activated === "1") {
    

        //echo 'valid email';
        //check the password
        $checkPass = $con->prepare("SELECT password FROM users WHERE email = ?");
        $checkPass->bindParam( 1 , $email);
        $checkPass->execute();
        $row = $checkPass->fetch();
        $hash = $row['password'];
        if (password_verify($password , $hash)) {
            //echo 'valid password';
            echo 'success';

            //get the user id when he logged in 
            $getid = $con->prepare("SELECT id FROM users WHERE email = ?");
            $getid->bindParam( 1 , $email);
            $getid->execute();
            $getid = $getid->fetch();
            $id = $getid['id'];
            $_SESSION['user_id'] = $id;      //store the id in a session variable
        } else {
            echo 'invalid password';
        }
    }else{
        $getcode = $con->prepare("SELECT security_code FROM users WHERE email = ?");
        $getcode->bindParam( 1 , $email);
        $getcode->execute();
        $getcode = $getcode->fetch();
        echo 'your account is not activated, click here to activate your account and then log in';
        echo '<a href="http://localhost/project1/php/activate.php?email='.$email.'&code='.$getcode['security_code'].'">activate now</a>';
    }
    } else {
        echo 'invalid email';
    }
    


} else {
    echo 'يجب ملء جميع البيانات';
}
