<?php

 if($_SERVER['REQUEST_METHOD'] == "POST")
 {
    if($_SESSION['token']){
	  $username =  filter($_POST['tkcr5kf(user$name$input)']);
	  $password =  passwordHash(filter($_POST['tkcr5kf(pass$word$input)']));
	   $token =    xss_cleaner($_POST['_CSRF_TOKEN']);
	  
	     if($_SESSION['token'] == $token){
	         if(!empty($username) and !empty($password)){
				$check = check_user_login($con,$username,$password);
				 if($check == "0"){
					 $msg= '<script>swal("خطا در ورود", "نام کاربری و یا رمز عبور اشتباه است", "warning")</script>';
				 }else{
				Redirect(url()); 
				 }
	
			 }
		 }else{
		  header('HTTP/1.0 403 Forbidden');
          die('You are forbidden!');
	      }
	 }else{
		  header('HTTP/1.0 403 Forbidden');
          die('You are forbidden!');
	 }
 }
	