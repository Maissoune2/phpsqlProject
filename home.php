<?php
$to      = 'maissounhala35@gmail.com';
$subject = 'I am a php mail tester';
$message = 'Hey!';
$headers = 'From: maissounhala35@gmail.com' . "\r\n" .
    'Reply-To: maissounhala35@gmail.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?>