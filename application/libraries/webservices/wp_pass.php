<?php
  require_once ('class-phpass.php');
  class SecurePassword {
        var $hasher ='';
        
          
       public function __construct(){
          $this->hasher = new PasswordHash(8, true);
       }
       
        /**
        * SecurePassword::check_user_has_password()
        * 
        * @param mixed $stored   //encrypt password
        * @param mixed $password // plain password
        * @return true / false
        * 
        * 
        * 
        */
        
       function check_user_has_password($stored, $password)
        {
           $rs = $this->hasher->CheckPassword($password,$stored);
           return $rs;
           
           
        }
        
        
      
        /**
        * Create a hash (encrypt) of a plain text password.
        *
        * For integration with other applications, this function can be overwritten to
        * instead use the other package password checking algorithm.
        *
        * @since 2.5
        * @global object $wp_hasher PHPass object
        * @uses PasswordHash::HashPassword
        *
        * @param string $password Plain text user password to hash
        * @return string The hash string of the password
        */
        
        function get_hash_password($password) {
          return $this->hasher->HashPassword( trim( $password ) );
        }
  
        
        
        
 
  }
?>