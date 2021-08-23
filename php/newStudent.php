<?php
//signup system with php , fetch api , sql with mysql database
session_start();
include_once 'apiHeaders.php';
//check if the input fields are !empty
if (
!empty($_POST['fname'])
&&
!empty($_POST['lname']) 
&& 
!empty($_POST['age']) 
&&
!empty($_POST['schoolYear']) 
&& 
!empty($_POST['phoneNumber'])
) 
{
    //assign the data to variables and filter the inputs
    $fname =trim(filter_input(INPUT_POST , 'fname' , FILTER_SANITIZE_STRING)) ;
    $lname =trim(filter_input( INPUT_POST , 'lname' , FILTER_SANITIZE_STRING )); 
    $age =trim(filter_input(INPUT_POST , 'age' , FILTER_SANITIZE_STRING));
    $schoolYear =trim(filter_input(INPUT_POST , 'schoolYear' , FILTER_SANITIZE_EMAIL));
    $phoneNumber =trim(filter_input( INPUT_POST , 'phoneNumber' , FILTER_SANITIZE_STRING));

    // check if the student account already exist or !exist
    include_once 'conf.php';
    $sql1 = $con->prepare("SELECT * FROM students WHERE PhoneNumber = ? AND fname = ? AND lname = ?");
    $sql1->bindParam(1,$phoneNumber);
    $sql1->bindParam(2,$fname);
    $sql1->bindParam(3,$lname);
    $sql1->execute();
    if ($sql1->rowCount() > 0) {
        echo $fname.'&nbsp;'.$lname .'طالب مسجل سابقا';
    } else {
                //let's insert the user data into our database
                $sql2 = $con->prepare("INSERT INTO students
                (fname, lname,
                age, schoolYear,
                PhoneNumber, user_id,
                code, creation)
                VALUES(:fname, :lname,
                :age, :schoolYear,
                :PhoneNumber,:user_id,
                :code, :creation)");
                
                $sql2->bindParam("fname",$fname);
                $sql2->bindParam("lname",$lname);
                $sql2->bindParam("age",$age);
                $sql2->bindParam("schoolYear",$schoolYear);
                $sql2->bindParam("PhoneNumber",$phoneNumber);
                $sql2->bindParam("user_id",$_SESSION['user_id']);
                $code = rand(time(),1000); //انشاء رمز مميز لكل مستخدم جديد unique_id
                $sql2->bindParam("code",$code);
            
                date_default_timezone_set("Africa/Algiers");
                $creating_date = date("l d  F  Y / H : i : s"); //تخزين تاريخ وتوقيت التسجيل في الموقع بتوقيت الجزائر العاصمة
                $sql2->bindParam("creation",$creating_date);
                if ($sql2->execute()) {
                    echo 'success';
                }else{
                    echo 'error';
                }
    }
} 
else 
{
    echo 'ملء جميع البيانات اجباري';
}



?>