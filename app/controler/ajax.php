<?php

if($_GET['ajax'] == "login_user"){
   if($_SERVER['REQUEST_METHOD'] == "POST"){
	  $token = $_POST['CSRF_TOKEN'];   
	  if($security->get($token)) {
       $security->delete($token);     
	   $username =  xss_cleaner(filter($_POST['input_username']));
	   $password =  passwordHash(xss_cleaner(filter($_POST['input_password'])));
	
	$query = $db->row("SELECT * FROM  td_user WHERE  s_username = :username and s_password = :pass", array("username"=>$username,'pass' => $password));
	if($query > 0){
	  if($query['s_username'] == $username and $password == $query['s_password']) {
		 if($query['s_state'] == "1"){
		    $check = "1";
		    $_SESSION['user_login'] = true; 
		    $_SESSION['user_id'] = $query['id_user'];
			$log = new user();
			$log->db = new Db();
			$log->update_last_log(); 
			
		  }else{
		  $check = "2";
		  }
	    }else{ 
	 	 $check = "0";
	    } 
	 }else{
		$check = "0"; 
	 }
	 
	  }else{
		$check ="0";   
	  }  
	 $export = array('state_login' => $check);
	 echo json_encode($export);
   }
  }
   

    if(!isset($_SESSION['user_id'])){
		$_SESSION['user_id'] = '0';
	}
	if($_GET['ajax'] =="send_massage"){
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_SESSION['tiket_code'])){
             $code_msg = get_last_code().rand(1,50000);  
		   	 $user = users(); 
			 if($_SESSION['user_id'] == "0"){
			   $user_fullname = "میهمان";
			 }else{
				 $user_fullname = $user['s_full_name'];
			 }
			 $data['f1'] = xss_cleaner(filter($_POST['f1']));
			 if(empty($data['f1'])){
				 $check = "0";
			 }
			 $fileName ="";
			 $files = "0";	
             $msg ="";
             $fileSize = 0;			 
             if(!empty($_FILES['file']['name'])){ 
				$fileName = "tk_".get_last_code().rand(1,1000)."_".date('Y-m-d')."_".$_FILES['file']['name'];
                $fileTmpLoc = $_FILES['file']['tmp_name'];
			    $dir = $_SERVER['DOCUMENT_ROOT']."/Connect/upload/zip/"; 
			    $fileDirectory = $dir.basename(str_replace(' ','-',$_FILES['file']['name']));
			    $allowed_ext = 'application/zip';   
			    $fileSize = $_FILES['file']['size']; 
			    $fileError = $_FILES['file']['error'];		  
                $min_path = "../Connect/upload/zip/{$fileName}";	 	
                $full_path = "http://".$_SERVER["HTTP_HOST"]."/Connect/upload/zip/{$fileName}";					
                if(!$fileTmpLoc){
       			  $msg=  "خطای غیر  منتظره !";
      			  exit();
                  $check = "0";					  
   			     }
                else
        		  if(!$fileSize > 1048576){
              		$msg=  "حجم  فایل  نباید بیشتر از  1 مگابایت باشد";
           			unlink($fileTmpLoc);
           			exit();
                    $check = "0";						
       			   }
        			else 
           			   if($allowed_ext != $allowed_ext){
              			$msg= "تنها فایل های  zip قابل بارگذاری  میباشند";
              			unlink($fileTmpLoc);
              			exit();
                        $check = "0";							
           			   }
					   else
                		if($fileError > 0){
                 		$msg=  "خطایی  پیش  امد  لطفا  مجددا امتحان نمایید";
                 		unlink($fileTmpLoc);
						exit();
	                    $check = "0";						
						}
						else{
   			        if(file_exists($dir. $fileName))
   			        {
     		 	     $msg=  "فایلی با این  نام موجود میباشد لطفا مجددا امتحان نمایید";
                     $check = "0";						 
   			       }
   			      else{
					 move_uploaded_file($fileTmpLoc, $dir .$fileName);
					 $insert   =  $db->query("INSERT INTO 
					 td_file(fl_filename,fl_code,fl_type,fl_min_path,fl_full_path,fl_user_id,fl_state,fl_timestamp,fl_size) VALUES
					 (:fl_filename,:fl_code,:fl_type,:fl_min_path,:fl_full_path,:fl_user_id,:fl_state,:fl_timestamp,:fl_size)", 
					 array("fl_filename"=>$fileName,"fl_code"=>$code_msg,'fl_type'=>'application/zip','fl_min_path'=>$min_path,'fl_full_path'=>$full_path,'fl_user_id'=>$_SESSION['user_id'],'fl_state'=>'1','fl_timestamp'=>time(),'fl_size'=>$fileSize));
					 $files =  $db->lastInsertId();
					 $check ="1"; 	 
			      }

			    
			  }		 
			 }
			 
			 if($check !=="0"){ 
			 $insert= $db->query("INSERT INTO td_tiket(tk_massage,tk_parent,tk_user_id,tk_last_req,tk_file,tk_ip,tk_timestamp_in,tk_date_in,code_msg) 
			 VALUES(:tk_massage,:tk_parent,:tk_user_id,:tk_last_req,:tk_file,:tk_ip,:tk_timestamp_in,:tk_date_in,:code_msg) ",
			 array("tk_massage"=>$data['f1'],"tk_parent"=>$_SESSION['tiket_code'],"tk_user_id"=> $_SESSION['user_id'],"tk_last_req" => '0',"tk_file" => $files,'tk_ip'=>get_client_ip(),'tk_date_in'=>jdate('Y-m-d H:i:s'),'tk_timestamp_in'=>time(),'code_msg'=>$code_msg));
             if($insert > 0){
		     	  $id= $db->lastInsertId();
				  $send_mail = new user();
				  $send_mail->db = new Db();
				  $send_mail->send_mail_tiket_response($id);
			  } 
			 $check = "1";
	         $update   =  $db->query("UPDATE td_tiket SET tk_timestamp_res = :time,tk_state='1' ,tk_date_res =:date ,tk_last_req = '0' WHERE tk_code = :code and tk_parent='0' and  tk_user_id = :id_user", array("id_user"=>$_SESSION['user_id'],"code"=>$_SESSION['tiket_code'],"time"=>time(),"date"=>jdate('Y-m-d H:i:s')));
		   }   
		      
			 $export = array('check'=>$check,'name'=>$user_fullname,'msg'=>$msg,'massage_send'=>$data['f1'],'id_file'=>$files,'filename'=>$fileName,'date'=>convert(jdate('Y-m-d H:i:s')),'time_stamps'=>convert(ago(time())),'file_size'=>formatSizeUnits($fileSize));
			 echo json_encode($export); 
        }			  
	}  
	if($_GET['ajax'] == "download_file"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){  
			$id=  xss_cleaner(filter($_POST['id_file'])); 
			$filename= str_replace('.zip','',$_POST['filename_s']);
			$filename_e = $filename.".zip";
			$file = $db->row("SELECT * FROM  td_file WHERE id_fl = '{$id}' and fl_user_id = '".$_SESSION['user_id']."' and fl_filename = '{$filename_e}' and fl_state ='1' LIMIT 1 ");
			$filename= $file['fl_filename']; 
			$dir = $_SERVER['DOCUMENT_ROOT']."/Connect/upload/zip/";
   			if(is_file($dir.$filename)){

  		     header("Pragma: public");  
   	         header("Expires: 0");
  		     header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
  		     header("Cache-Control: public");
  		     header("Content-Description: File Transfer");
  		     header("Content-type: application/zip");
  		     header("Content-Disposition: attachment; filename=\"".$filename."\"");
  		     header("Content-Transfer-Encoding: binary");
  		     header("Content-Length: ".filesize($dir.$filename));
             $file = fopen($dir.$filename, 'rb');
              if ( $file !== false ) {
               while ( !feof($file) ) {
                echo fread($file, 4096);
               }
               fclose($file); 
             }
            }else{
              echo "<script > show_massage('فایل  مورد  نظر  یافت نشد !','danger') </script>";
             }
		 
		}
	}


	if($_GET['ajax'] == "change_password"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){  
			$token = $_POST['token'];   
	        if($security->get($token)) {
              $user = new user();
			  $user->db = new Db();
			  $change_pass = $user->EditPassword($_POST['my_pass'],$_POST['pass'],$_POST['re_pass']);
			  if($change_pass !== 'true'){
			    echo  implode(' ',$change_pass);
			  }else{
			    echo $change_pass;
			  }
	        }
		}
	}
	if($_GET['ajax'] == "edit_profile"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){  
			$token = $_POST['CSRF_TOKEN'];   
	        if($security->get($token)) {
              $user = new user();
			  $user->db = new Db();
			  $edit_profile = $user->Edit_profile($_POST['input_fullname'],$_POST['input_username'],$_POST['email'],$_POST['input_dicription']);
			  if($edit_profile !== 'true'){
			    echo  implode(' ',$edit_profile);
			  }else{
			    echo $edit_profile;
			  }
	        }
		}
	}
	
	if($_GET['ajax'] == "register_user"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){  
			$token = $_POST['CSRF_TOKEN'];   
	        if($security->get($token)) {
              $reg = new register_user();
			  $reg->db = new Db();
			  $reg_user = $reg->create_user($_POST['f1'],$_POST['f2'],$_POST['f3'],$_POST['f4'],$_POST['f5']);
			  if($reg_user !== 'true'){
			    echo  implode(' ',$reg_user);
			  }else{
			    echo $reg_user;
			  }
	        }
		}
	}
	

	
