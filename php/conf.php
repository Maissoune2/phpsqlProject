<?php

//connect to database 

#database variables 

    $host = "localhost";
    $dbname = "meissoune";
    $username = "root";
    $password = "";

    $con = new PDO("mysql:host=".$host.";dbname=".$dbname.";" , $username , $password);

        if ($con) 
        {
            //echo 'success';
        } 
        else 
        {
            echo 'error';
        }
?>