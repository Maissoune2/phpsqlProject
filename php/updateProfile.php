<?php
session_start();
include_once 'apiHeaders.php';
include_once 'conf.php';
echo 'hello';
if (
    !empty($_POST['fname']) 
    || 
    !empty($_POST['lname'])
    ||
    !empty($_POST['age']) 
    || 
    !empty($_POST['email']) 
    || 
    !empty($_POST['password'])
    )
    {
        //let's update the user information
        $update = $con->prepare("UPDATE 
        users 
        SET 
        fname = ? ,
        lname = ? ,
        age = ? , 
        email = ? , 
        password = ? WHERE id = ?
        ");

    //assign the data to variables and filter the inputs
    $fname =trim(filter_input(INPUT_POST , 'fname' , FILTER_SANITIZE_STRING)) ;
    $lname =trim(filter_input( INPUT_POST , 'lname' , FILTER_SANITIZE_STRING )); 
    $age =trim(filter_input(INPUT_POST , 'age' , FILTER_SANITIZE_STRING));
    $email =trim(filter_input(INPUT_POST , 'email' , FILTER_SANITIZE_EMAIL));
    $password =trim(filter_input( INPUT_POST , 'password' , FILTER_SANITIZE_STRING));
    $hashPass =password_hash($password , PASSWORD_BCRYPT); 


    $update->bindParam(1 ,$fname);
    $update->bindParam(2 ,$lname);
    $update->bindParam(3 ,$age);
    $update->bindParam(4 ,$email);
    $update->bindParam(5 ,$hashPass);
    $update->bindParam(6 ,$_SESSION['user_id']);



        $update->execute();
        echo 'success';
    }else{
        echo 'Nothing to update';
    }
?>