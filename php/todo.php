<?php
session_start();
include_once 'apiHeaders.php';
include_once 'conf.php';
echo 'hello';

if (!empty($_POST['item'])) {
    $addItem = $con->prepare("INSERT INTO todolist(item,status,user_id)
                            VALUES(:item,:status,:user_id)");
    $filter_text = trim(filter_input(INPUT_POST , 'item' , FILTER_SANITIZE_STRING));
    $defaultStatus = 0;
    $addItem->bindParam("item",$filter_text);
    $addItem->bindParam("status",$defaultStatus);
    $addItem->bindParam("user_id",$_SESSION['user_id']);

    if($addItem->execute()){
        echo 'success';
        }else{
            echo 'error';
        }

}else{
    echo 'nothing to submit';
}




?>