<?php
// ************************************* //
//            Monix Tiketing System     //
//              http://monix.ir        //
// *************************************//

 $_SESSION['token'] = md5(base64_decode(rand(1,500000)));

  if(isset($_GET['ajax'])){
	  require_once('controler/ajax.php');
  }
  
 $theme = se('website_template');
 define('THEME_NAME',$theme); 
 $theme_default = CONNECT_DIR."theme/{$theme}/";
 define('THEME_DEFAULT',$theme_default);
 $theme_path = "/Connect/theme/{$theme}";
 define('THEME_PATH',$theme_path);
 

	 
	 $route = htmlentities($_GET['route']);
	 $path = APP_DIR."/controler/".$route.".php";
	 if(preg_match("/^[a-zA-Z_]*$/", $route) == 1 ){
	  if(isset($_GET['route'])){ 
		if(is_file($path)){
		 $contlorer = $route.".php";
		}else{
	    $contlorer = "main.php";			
	    }  		   
	  }else{
	  $contlorer = "main.php";	   
	  }
	 }else{
		 $contlorer = "main.php";	
	 }
      define('VIEW',$contlorer);	
      define('route',$contlorer);