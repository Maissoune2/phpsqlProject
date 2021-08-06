<?php
//signup system with php , fetch api , sql with mysql database

include_once 'apiHeaders.php';
//check if the input fields are !empty
if (!empty($_POST['fname']) && !empty($_POST['lname']) && !empty($_POST['age'] && !empty($_POST['email']) && !empty($_POST['password']))) 
{
    //assign the data to variables and filter the inputs
    $fname = filter_input(INPUT_POST , 'fname' , FILTER_SANITIZE_STRING);
    $lname =filter_input( INPUT_POST , 'lname' , FILTER_SANITIZE_STRING ); 
    $age =filter_input(INPUT_POST , 'age' , FILTER_SANITIZE_STRING);
    $email =filter_input(INPUT_POST , 'email' , FILTER_SANITIZE_EMAIL);
    $password =filter_input( INPUT_POST , 'password' , FILTER_SANITIZE_STRING);
    $hashPass = password_hash($password , PASSWORD_BCRYPT);  //تشفير كلمة المرور

    // check if the email already exist or !exist
    include_once 'conf.php';
    $sql1 = $con->prepare("SELECT * FROM users WHERE email = :email");
    $sql1->bindParam("email",$email);
    $sql1->execute();
    if ($sql1->rowCount() > 0) {
        echo $email.'--بريد الكتروني مستخدم سابقا';
    } else {
        //check if the user upload an image with the extensions png jpg jpeg
        if (isset($_FILES['img'])) {
            $img_name = $_FILES['img']['name'];
            $tmp_name = $_FILES['img']['tmp_name'];
        //explode the file and get the img extension 
            $explode_img = explode(".",$img_name);
            $ext_img = end($explode_img); //here we get the last extension
        
        $extensions = ["png" , "jpg" , "jpeg"]; //some valid extensions
        if (in_array($ext_img , $extensions) === true) {
            $current_time = time(); //we'll get the current time
            //change the img name to the current time to give each one a unique name
            $img_new_name = $current_time.$img_name;
            //let's move uploaded file to our particular directory
            if (move_uploaded_file($tmp_name , "../images/" .$img_new_name)) { //if the image was added successfuly to our folder
                //let's insert the user data into our database
                $sql2 = $con->prepare("INSERT INTO users(fname, lname, age, email, password, status, security_code, creating_date, image)
                VALUES(:fname, :lname, :age, :email, :password, 'user', :security_code, :creating_date, :image)");
                
                $sql2->bindParam("fname",$fname);
                $sql2->bindParam("lname",$lname);
                $sql2->bindParam("age",$age);
                $sql2->bindParam("email",$email);
                $sql2->bindParam("password",$hashPass);
            
                $code = rand(time(),1000); //انشاء رمز مميز لكل مستخدم جديد unique_id
                $sql2->bindParam("security_code",$code);
            
                date_default_timezone_set("Africa/Algiers");
                $creating_date = date("l d  F  Y / H : i : s"); //تخزين تاريخ وتوقيت التسجيل في الموقع بتوقيت الجزائر العاصمة
                $sql2->bindParam("creating_date",$creating_date);
                $sql2->bindParam("image",$img_new_name);

                //send confirmation email
                include_once 'mail.php';  //الاتصال بصفحة اعدادات الارسال 

                $mail->setFrom('youremail@example.com', 'your name');  //تحديد ايميل المرسِل
                $mail->addAddress($email); //تحديد ايميل المستخدم كمستقبل للرسالة
                $mail->Subject ='رسالة تفعيل الحساب';  
                //ارسال رسالة تحتوي على رابط الى صفحة التفعيل 
                $mail->Body    = '<div dir="rtl">
                <h1>تهانينا ، لقد حصلت على عضوية في موقعنا</h1>
                <h2>نرجو منك تفعيل الحساب بالضغط على الزر الموجود اسفل :</h2>
                <a href="http://localhost/project1/public/view/activate.html?code='.$code.'&email='.$email.'">
                <button style="width:100px; text-align:center; padding:15px; border:none;outline:none;background-color:#333;color:#fff;border-radius:8px;"  type="button">اضغط لتفعيل الحساب</button></a>
                </div>';
                if ($sql2->execute() && $mail->send()) {
                    echo 'لقد تم ارسال رسالة تفعيل حسابك الى بريد الالكتروني،الرجاء الاطلاع عليها';
                } else {
                    echo 'تم اكتشاف حدوث اخطاء،الرجاء المحاولة لاحقا';
                }
                    
        } else {
                echo 'تم اكتشاف وجود اخطاء، الرجاء المحاولة لاحقا';
            }
            
        } else {
            echo 'الرجاء تحديد صورة بصيغة -- png / jpg / jpeg';
        }
        

        } else {
            echo 'من فضلك قم بتحديد صورة';
        }
        
    }
    
} 
else 
{
    echo 'ملء جميع البيانات اجباري';
}



?>