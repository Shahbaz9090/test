<?php defined('BASEPATH') OR exit('No direct script access allowed');


  class Message extends CI_Controller {
    
      public static function __($message_type)
        {       
         switch($message_type)
          {
            
           case "ONLY_POST_METHOD":
           return "Not Acceptable.";
           break;
           
           case 'FALSE':
           return 'failed';
           break;
           
           case 'TRUE':
           return 'success';
           break;
           
           case 'API_KEY_NUMARIC':
           return 'Api key should be numaric.';
           break;
           
           case 'API_KEY_BLANK':
           return 'Api key should not be blank.';
           break;
           
           case 'USER_NAME_NOT_BLANK':
           return 'Username should not be blank';
           break;
           
           case 'USERNAME_NOT_EXITS':
           return 'User Name does not exits in our dataBase.';
           break;
           
           
           case 'USER_PASSWORD_NOT_MATCH':
           return 'Email and password does not match.';
           break;
           
           
           case 'PASSWORD_NOT_BLANK':
           return 'Password Should not be blank.';
           break;
           
           case 'PASSWORD_NOT_MATCH':
           return 'Password does not match.';
           break;
           
           case 'API_KEY_NOT_MATCH':
           return 'API key does not match';
           break;
           
           case 'PASSWORD_6_CHARCTER':
           return 'Password should be minimum 6 character.';
           break;
          
          case 'USER_ID_NOT_BLANK':
          return 'User Id Should not be blank.';
          break; 
          
          case 'USER_ID_NUMARIC':
          return 'User id should be numaric.';
          break;
          
          case 'OLD_PASSWORD_NOT_BLANK':
          return 'Old password should not be blank.';        
          break; 
           
          case 'OLD_PASSWORD_6_CHARCTER':
          return 'Old password should be minimum 6 character.';
          break; 
          
          case 'OLD_PASSWORD_NOT_EXITS':
          return 'Old password does not exists';
          break;
          
          case 'NEW_PASSWORD_6_CHARCTER':
          return 'New password should be minimum 6 character.';
          break;
          
          case 'NEW_PASSWORD_NOT_BLANK':
          return 'New password should not be blank.';
          break;
          
          
          case 'NEW_PASSWORD_NOT_CREATED':
          return 'New password not generated.'; 
          break;
          
          case 'SORRY_PASSWORD_NOT_CHANGE':
          return 'sorry password not change.'; 
          break;
           
          case 'CHANGE_PASSWORD':
          return 'Password change Succesfully.' ;
          break; 
           
           
          case 'EMAIL_ID_NOT_BLANK':
          return 'Email id should not be blank.'; 
          break;
          
          case 'EMAIL_ID_NOT_VALID':
          return 'Email id should not be Invalid.';
          break;
          
          case 'EMAIL_NOT_EXISTS':
          return 'Email address does not exist.';
          break;
          
          case 'MAIL_SEND':
          return 'The mail has been sent successfully.';
          break;
          case 'APPLIED ENQUIRY':
          return 'The Enquiry has been sent.';
          break;
		  case 'SORRY_MAIL_NOT_SEND':
          return 'The Mail has not been sent.';
          break;
		  case 'LOGIN SUCCESSFULLY':
		  return "login successfully !.";
		  break;
		  case 'APPLIED LOAN':
		  return "You have successfully applied for loan!.";
		  break;
		  case 'PASSWORD_RESET':
		  return 'please contact your teacher/parents for more details';
		  break;
		  
		  case 'TECHNICAL_ERROR':
		  return 'something may have gone  wrong, please try again';
		  break;
		  
		  case 'PASSWORD_RESET_MAIL_SENT':
		  return 'please check youe email id for more detail.';
          break;
		  
		  case 'UPDATE_PASSWORD':
		  return 'Your password updated successfully.';
		  break;
		  
		  case 'NOT_UPDATE_PASSWORD':
		  return "Sorry, Cant't change this time. Please try again.";
		  break;
		  
          case 'NOT_DATA_FOUND':
		  return "No Data Found.";
		  break;
		             
          default:
          return "Message type should be valid.";
          break;
     
          } 
     
      }
    }
  ?>


