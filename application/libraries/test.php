<?php
$to      = 'bohra.sharad@gmail.com';
$subject = 'Test mail';
$message = 'hello';
$headers = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
echo "Run".date('d-m-Y H;i:s');
?> 
