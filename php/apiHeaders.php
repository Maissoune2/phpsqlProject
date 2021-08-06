<?php
header("Access-Control-Allow-Origin: *"); //لتحديد المواقع التي يسمح لها بالوصول
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Method: *");// تحديد طرق الوصول الى ال اي بي اي
header("Access-Control-Max-Age: 3600"); //تحديد مدة التخزين في الداكرة المخفية
header("Access-Control-Allow-Headers: *"); //اعطاء صلاحية تبادل البيانات دون ظهور الاخطاء

// $data = file_get_contents("php://input");

?>