<?php
header("Access-Control-Allow-Origin: *"); //لتحديد المواقع التي يسمح لها بالوصول
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Method: *");// تحديد طرق الوصول الى ال اي بي اي
header("Access-Control-Max-Age: 3600"); //تحديد مدة التخزين في الداكرة المخفية
header("Access-Control-Allow-Headers: *"); //اعطاء صلاحية تبادل البيانات دون ظهور الاخطاء


$database = new PDO("mysql:host=localhost;dbname=meissoune;" , "root" , "");
session_start();
$sql2 = $database->prepare("SELECT * FROM students WHERE user_id = ?");
$sql2->bindParam( 1 , $_SESSION['user_id']);
$sql2->execute();
$sql2 = $sql2->fetchAll(PDO::FETCH_ASSOC);
print_r(json_encode($sql2));