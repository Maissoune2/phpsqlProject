<link rel="stylesheet" href="../css/style2.css">
<div class="container">
<?php
if (isset($_GET['code']) && isset($_GET['email'])) {  //التاكد من ادا كان المستخدم قد وصل الى هده الصفحة عن طريق الضغط على الرابط المرسل اليه عن طريق البريد الالكتروني
    //الاتصال بقاعدة البيانات
    include_once 'conf.php';
    $email = filter_input(INPUT_GET , 'email' , FILTER_SANITIZE_EMAIL);//filter the email

    $check = $con->prepare("SELECT * FROM users 
                            WHERE email = :email");  //التاكد ان كان هدا الحساب مفعل سابقا ام لا
    
    $check->bindParam("email",$email);
    $check->execute();
    
    if ($check->rowCount() > 0) {  //التاكد من وجود حساب بنفس الايميل

        $user = $check->fetchObject();

        if ($user->activated === "1") {   //التاكد من حالة الحساب ان كان مفعلا ام لا
            echo '<div style="text-align:center; padding: 15px; 
            margin-top:15px; font-weight: 800; font-size: 16px; 
            border:1px solid #dc3545; background:#f3bdc1;  
            border-radius:8px;">هدا الحساب مفعل سابقا</div>';  

        }else{
            //ان لم يكن الحساب مفعلا سابقا سيتم عرض زر يسمح للمستخدم بتفعيل حسابه

        echo '<form method="POST"><button style="border: none; outline:none; width:200px;
        padding:10px; background:#343a40; color:#f8f9fa;
        border:1px solid #000; 
        border-radius:8px; font-weight:800; cursor:pointer; 
        font-size:16px;" name="active" type="submit">تفعيل الحساب</button></form>';
        
        if (isset($_POST['active'])) { //عندما يقوم المستخدم بالضغط على زر التفعيل
            $sql4 = $con->prepare("SELECT email , security_code  FROM users 
            WHERE email = :email AND security_code = :code");

            $sql4->bindParam("email",$email);
            $sql4->bindParam("code",$_GET['code']);

            $sql4->execute();

            if ($sql4->rowCount() > 0) {  //ان تم العثور على سطر بنفس البيانات الموجودة في الرابط فهدا يعني صحة البيانات
            //نقوم بتحديث عمود security_code 
            // وجعل عمود activated = true 
            // اي نقوم يجعل حالة الحساب مفعلة 
            $sql5 = $con->prepare("UPDATE users 
            SET security_code = :newcode , activated = true
            WHERE email = :email AND security_code = :code");

            $newcode = md5(rand($min=256458 , $max=256317892155255)); //انشاء كود حماية عشوائي وتشفيره

            $sql5->bindParam("newcode",$newcode);
            $sql5->bindParam("email" , $email);
            $sql5->bindParam("code",$_GET['code']);

            if ($sql5->execute()) { 
            echo '<div style="text-align:center; padding: 15px; 
            margin-top:15px; font-weight: 800; font-size: 16px; 
            border:1px solid #dc3545; background:#f3bdc1;  
            border-radius:8px;">لقد تم تفعيل حسابك بنجاح</div>';
            echo '<a href="../public/view/login.html"><button style="
            width:200px;border:none;outline:none;border-radius:8px;margin:15px 0;
            background:#343a40;padding:10px;cursor:pointer;font-weight:800;font-size:16px;">تسجيل الدخول</button></a>'; //السماح للمستخدم بتسجيل الدخول
            } else {
            echo '<div style="text-align:center; padding: 15px; 
            margin-top:15px; font-weight: 800; font-size: 16px; 
            border:1px solid #dc3545; background:#f3bdc1;  
            border-radius:8px;">تم اكتشاف حدوث اخطاء، لم يتم تفعيل الحساب</div>';
            }

            }else{
                echo '<div style="text-align:center; padding: 15px; 
                margin-top:15px; font-weight: 800; font-size: 16px; 
                border:1px solid #dc3545; background:#f3bdc1;  
                border-radius:8px;">بيانات غير صحيحة</div>';
            }
        }    
    }
}else{
    echo '<div style="text-align:center; padding: 15px; 
                margin-top:15px; font-weight: 800; font-size: 16px; 
                border:1px solid #dc3545; background:#f3bdc1;  
                border-radius:8px;">حساب غير موجود سابقا</div>';
}

} else {
    echo '<div style="text-align:center; padding: 15px; 
                margin-top:15px; font-weight: 800; font-size: 16px; 
                border:1px solid #dc3545; background:#f3bdc1;  
                border-radius:8px;">الرجاء الاطلاع على ايميلك من اجل تفعيل الحساب</div>';
}

?>
</div>



