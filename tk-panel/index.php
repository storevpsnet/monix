<?php

   session_start();

   $roots = str_replace('tk-panel','',__DIR__);
   define('APP_NAME','TakfaPanelUser');
   define('ROOT_DIR', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
   define('APP_DIR', ROOT_DIR .'app'.DIRECTORY_SEPARATOR);
   define('ClASS_DIR', APP_DIR .'class'.DIRECTORY_SEPARATOR);
   define('UPLOAD_DIR', $roots.'Connect/upload'.DIRECTORY_SEPARATOR);
   
   
   require_once(ClASS_DIR.'Db.class.php');
   require_once(ClASS_DIR.'security.csrf.php');   
   require_once(ClASS_DIR.'PHPMailerAutoload.php');   
   $security = new \security\CSRF;
   $token = $security->set(3, 3600);  
   $db = new Db(); 
   $mail = new PHPMailer;   
   require_once(APP_DIR.'jdf.php');
   require_once(APP_DIR.'function.php'); 
   require_once(ROOT_DIR.'app.php');
  
   if(isset($_GET['logout'])){  
      if($_SESSION['admin_login'] == true){
       session_destroy();   
       session_unset(); 
	   Redirect('/tk-panel/');
      }
	}
   if(!isset($_GET['ajax'])){	  
	 if($_SESSION['admin_login'] == true){
      $user = user();
      require_once(ROOT_DIR.'controler/'.route);
      require_once(ROOT_DIR.'theme/header.php');
      require_once(ROOT_DIR.'theme/'.VIEW);
      require_once(ROOT_DIR.'theme/footer.php');
     }else{
     require_once(ROOT_DIR.'controler/'.route);
     require_once(ROOT_DIR.'theme/'.VIEW);
     }
   }

