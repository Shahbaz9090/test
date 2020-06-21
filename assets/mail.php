<?php

/**
 * @author 
 * @copyright 2014
 */


$to = "kg2989@gmail.com";
$subject = "Test mail";
$message = "Hello! This is a simple email message.";
$from = "kmrgrvtech@gmail.com";
$headers = "From:" . $from;
if(mail($to,$subject,$message,$headers)){
echo "Mail Sent.";    
    
}

?>