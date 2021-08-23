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


?>
<form method="POST" id="additem">
    <div id="error">this is an error message!</div>
    <input type="text" name="item">
    <input type="submit" value="add item" id="addbtn">
</form>
<table>
    <tr>
        <td>item</td>
        <td>status</td>
        <td>delete</td>
    </tr>
    <tr>
        <td id="item"></td>
        <td>
            <form method="POST">
            <input name="status" type="submit" value="not yet">
            </form>
        </td>
        <td><form method="POST">
            <input name="delete" type="submit" value="delete">
            </form></td>
    </tr>
</table>
<?php     
        if (isset($_POST['status'])) {
            //change the status to done
            $updateStatus = $con->prepare("UPDATE todolist SET status = ? WHERE user_id =?");
            $done = 1;
            $updateStatus->bindParam(1 , $done);
            $updateStatus->bindParam(2 , $_SESSION['user_id']);
            $updateStatus->execute();
        }
        if (isset($_POST['delete'])) {
            //change the status to done
            $delete = $con->prepare("DELETE FROM todolist WHERE user_id = ?");
            $delete->bindParam(2 , $_SESSION['user_id']);
            $delete->execute();
        }
?>

<main id="content">

</main>

<?php
}else{
    echo 'you do not have permission to access to this page!';
        header("location:http://localhost/project1/public/view/login.html");
        die();
}
?>




<script src="../../javascript/todo.js"></script>
<script src="../../javascript/getItem.js"></script>
</body>
</html>