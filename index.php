<?php
 session_start();

 define('APP_NAME','Monix');
 define('VER_NO','1.0');
 define('ROOT_DIR', realpath(dirname(__FILE__)).DIRECTORY_SEPARATOR);
 define('APP_DIR', ROOT_DIR .'app'.DIRECTORY_SEPARATOR);
 define('ClASS_DIR', APP_DIR .'class'.DIRECTORY_SEPARATOR);
 define('CONNECT_DIR', ROOT_DIR .'Connect'.DIRECTORY_SEPARATOR);
 define('LANG_DIR', CONNECT_DIR .'lang'.DIRECTORY_SEPARATOR); 
 
  require_once(ClASS_DIR.'Db.class.php');  
  require_once(ClASS_DIR.'security.csrf.php');    
  require_once(ClASS_DIR.'PHPMailerAutoload.php');   
  require_once(ClASS_DIR.'validate.class.php');   
  require_once(ClASS_DIR.'paging.class.php');
  $security = new \security\CSRF;
  $token = $security->set(3, 3600);
  $mail = new PHPMailer;   
  $db = new Db();
  $vt = new GUMP();
  require_once(LANG_DIR.'fa.php'); 
  require_once(APP_DIR.'function.php');  
  require_once(APP_DIR.'app.php'); 
  $setting = new setting();
  $setting->db = new Db();
  if(isset($_GET['logout'])){
	   if($_SESSION['user_login'] == true){
       session_destroy();   
       session_unset();  
	   Redirect('/');
      } 
  }
 if(!isset($_GET['ajax'])){
	if(isset($_SESSION['user_login'])){
	   $user = users();
       require_once(ROOT_DIR.'app/controler/'.route);
       require_once(THEME_DEFAULT.'header.php');
       require_once(THEME_DEFAULT.VIEW);
       require_once(THEME_DEFAULT.'footer.php');
     }else{
	  if(!isset($_GET['Guest'])){
	  require_once(THEME_DEFAULT."login.php");
	  }else{  
        if(se('send_tiket_goust') == "1"){  
	     require_once(ROOT_DIR.'app/controler/Guest.php');  
	     require_once(THEME_DEFAULT."Guest.php"); 
        }else{
            header('location: /');
        } 
	  }
    }
 
}  