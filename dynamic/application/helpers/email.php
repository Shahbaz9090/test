<?php 
date_default_timezone_set('Asia/Kolkata');

function countactusFormat($name='',$email='',$mobile='',$message='')
{
	return $message1 = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Callgirlingurugram.com Contact us Email</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$email."'>Dear Admin </a>,</p> <p style='font-size: .9em'>Mr. ".$name." want to contact to you email ($email) and mobile No ($mobile)</p> <p>Call: <a href='tel:".$mobile."'>".$mobile."</a></p><p>Message: ".$message."</p><p>Email: <a href='mailto:".$email."'>".$email."</a></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";
	
}
function quickBook($name='',$email='',$mobile='')
{
	return $message1 = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Callgirlingurugram.com New Booking</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$email."'>Dear Admin </a>,</p> <p style='font-size: .9em'>Mr. ".$name." just booked a girl ($email) and mobile No ($mobile)</p> <p>Call: <a href='tel:".$mobile."'>".$mobile."</a></p><p>Email: <a href='mailto:".$email."'>".$email."</a></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";
	
}

function registerFormat()
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 1px;margin: auto;'> <div style='background-color: #f8402d;margin-top: 0px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;float: left;height: 50px;line-height: 40px' src='http://www.beautygirl.co.in/assets/img/New/email_logo.png'> <h3 style='text-align: center;color: white;line-height: 40px'>Beautygirl</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi Dear Admin,</p> <br> <p style='font-size: .9em'>A new profile has been submitted now on ".date('d-M-Y H:i:s').".</p> <p style='font-size: .9em'><b>Name :</b> $name</p> <p style='font-size: .9em'><b>Age :</b> 19 Years</p> <p style='font-size: .9em'>For more information goto <a href='http://www.beautygirl.co.in/profile_detail.php?id=$id'>Link</a></p> <p style='padding-top: 10px;'>Regards,</p> <p style='font-size: .9em;color: royalblue;'><a href='www.beautygirl.co.in'>Beautygirl</a> </p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";
}

function subscribeFormat()
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 60%;border:lightgray solid 1px;margin: auto;'> <div> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 5px 0 5px 3px;' src='http://www.basemusic.in/images/icons/basemusic_icon.png'> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi Dear subscriber,</p> <br> <p style='font-size: .9em'>Thank you for subscribe us . Now you shall recieve all notification</p> <p style='font-size: .9em'>For more information goto <a href='http://www.basemusic.in'>Link</a></p> <p style='padding-top: 10px;'>Regards,</p> <p  style='font-size: .9em;color: royalblue;'>Base music (opc) pvt. ltd.</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated mail</p> </footer> </div> </div> </body> </html>";

}

function signupMail($email,$link)
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Activate Your Account</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$email."'>".$email." </a>,</p> <p style='font-size: .9em'>Thanks for choosing <a target='_blank' href='http://adsite4u.com/'>adsite4u.com!</a></p> <p>To activate the Private Area, click :</p> <p style='font-size: .9em'><a href='".$link."'>".$link."</a></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";

}

function replyAd($sender,$reciever,$msg)
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Reply a user</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$reciever."'>".$reciever." </a>,</p> <p style='font-size: .9em'>A <a href='mailto:".$sender."'>".$sender."</a> say to you -</p> <p>".$msg."</p> <p style='font-size: .9em'></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";

}

function invite($sender,$reciever,$msg,$link)
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Invitation Email</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$reciever."'>".$reciever." </a>,</p> <p style='font-size: .9em'>Your friend <a href='mailto:".$sender."'>".$sender."</a> invite you on adsite4u</p><p>".$msg."</p> <p><p>Check profile, click :</p> <p style='font-size: .9em'><a href='".$link."'>".$link."</a></p> <p style='font-size: .9em'></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";

}
function adPosting($email,$link)
{
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Hot meetings in your city</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href='mailto:".$email."'>".$email." </a>,</p> <p style='font-size: .9em'>Thanks for choosing <a href=''>adsite4u.com!</a></p> <p>Your ad successfully post, click to manage :</p> <p style='font-size: .9em'><a href='".$link."'>".$link."</a></p> <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";


}
function passwordRecovery($email,$link)
{
	
	return $message = "<html> <head> <title></title> </head> <body style='padding: 0;margin: 0;font-family: segoe ui'> <div style='width: 90%;border:lightgray solid 0px;margin: auto;'> <div style='margin-top: 10px !important;'> <header style='border-bottom: 1px solid lightgray'> <img style='padding: 0px 0 0px 3px;height: 30px;line-height: 30px' src='http://adsite4u.com/media/logo/logo.png'> <h3 style='text-align: left;color: #666666;line-height: 40px'>Password Recovery</h3> </header> </div> <div style='padding: 10px;'> <p style='font-size: 1.1em;font-weight: 400;'>Hi <a href=''>".$email." </a>,</p> <p style='font-size: .9em'>click here for reset your Password <a href='".$link."'>".$link." </a></p>  <p style='padding-top: 10px;'>The team of adsite4u.com</p> </div> <div> <footer style='width: 95%;border-top: 1px dotted lightgray;margin: auto;'> <p style='font-size: .7em;text-align: center;'>This Email is self generated Email</p> </footer> </div> </div> </body> </html>";


}

 ?>