<?php
// ************************************* //
//            Monix Tiketing System     //
//              http://monix.ir        //
// *************************************//

   if(isset($_GET['ajax'])){
   require_once('controler/ajax.php');
   die();
   }
   
 if(isset($_SESSION['admin_login'])){
    if(show_tikets() !== '0') {
	    $allow_operator = array('manage_tiket','create_tiket','show_tiket','main','edit_profile');
    }else{
			$allow_operator = array();
		}
	 $route = htmlentities($_GET['route']);
	 $path = "controler/".$route.".php";
  
	 if(preg_match("/^[a-zA-Z_]*$/", $route) == 1 ){
	  if($_GET['route']){
        if(count($allow_operator) < 1){
	      	if(is_file($path)){
		        $contlorer = $route.".php";
	      	}else{
	        $contlorer = "main.php";			
	        }  
				}else{
				 if(in_array($route,$allow_operator)){
	         if(is_file($path)){
		        $contlorer = $route.".php";
	      	  }else{
	          $contlorer = "main.php";			
	        }	  
				 }else{
					 $contlorer = "main.php";
				 }

				}
	  }else{
	      $contlorer = "main.php";	   
	   }
  
    }else{
	 $contlorer = "login.php";
    }
 }else{
	  $contlorer = "login.php";
 }
      define('VIEW',$contlorer);	
      define('route',$contlorer);