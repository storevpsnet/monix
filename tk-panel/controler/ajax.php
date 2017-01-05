<?php
// ************************************* //
//            Monix Tiketing System     //
//              http://monix.ir        //
// *************************************//


  if($_GET['ajax'] == "login_admin"){
   if($_SERVER['REQUEST_METHOD'] == "POST"){
	$username =  xss_cleaner(filter($_POST['tkcr5kf(user$name$input)']));
	$password =  passwordHash(xss_cleaner(filter($_POST['tkcr5kf(pass$word$input)'])));
	
	$query = $db->row("SELECT * FROM td_asmin WHERE  am_username = :username and am_password = :pass", array("username"=>$username,'pass' => $password));
	if($query > 0){
	  if($query['am_username'] == $username and $password == $query['am_password']) {
		 if($query['am_state'] == "1"){
		    $check = "1";
		    $_SESSION['admin_login'] = true;
		    $_SESSION['admin_id'] = $query['id_am'];
            update_last_log();  
		  }else{
		  $check = "2";
		  }
	    }else{
	 	 $check = "0";
	    }  
	 }else{
		$check = "0"; 
	 }
	 
	 $export = array('state_login' => $check);
	 echo json_encode($export);
   }
  }
 if($_SESSION['admin_login'] == true){ 
	
	if($_GET['ajax'] == "create_new_department"){
	  if($_SERVER['REQUEST_METHOD'] == "POST"){
		$data['f1'] = trim($_POST['f1']);
		$data['f2'] = trim($_POST['f2']);	
        $check = "0";
		$msg = "عملیات ناموفق"; 
		$ids = "0"; 
		 if(!empty($data['f1']) and !empty($data['f2'])){
		 $insert   =  $db->query("INSERT INTO td_Department(dep_title,dep_dicription,dep_state) VALUES(:dep_title,:dep_dicription,:dep_state)", 
		 array("dep_title"=>$data['f1'],"dep_dicription"=>$data['f2'],'dep_state'=>'1'));
	      if($insert > 0){ 
			  $check ="1"; 
			  $ids = $db->lastInsertId();
              $msg = "دپارتمان جدید با موفقیت ایجاد شد";			  
		  }
		 } 
		
		$export = array('state'=>$check,'msg'=>$msg,'title'=>$data['f1'],'dicription'=>$data['f2'],'id'=>$ids);   
		echo json_encode($export); 
	  } 
	}
	
	
	if($_GET['ajax'] == "edit_department"){
	 	  if($_SERVER['REQUEST_METHOD'] == "POST" and !empty($_GET['id_dep'])){
			$data['f1'] = trim($_POST['f1']);
		    $data['f2'] = trim($_POST['f2']);	
            $check = "0";
		    $msg = "عملیات ناموفق"; 
		    $ids = intval($_GET['id_dep']); 
		    if(!empty($data['f1']) and !empty($data['f2'])){
                $update = $db->query("UPDATE td_Department SET dep_title = :dep_title , dep_dicription = :dep_dicription WHERE id_dep = :id", 
				array("dep_title"=>$data['f1'],'dep_dicription'=>$data['f2'],"id"=>$ids));
				$msg = "دپارتمان با  موفقیت ویرایش شد";
				$check ="1";   	
            }  	
           $export = array('state'=>$check,'msg'=>$msg,'title'=>$data['f1'],'dicription'=>$data['f2'],'id'=>$ids);   
		   echo json_encode($export); 			
          }			  
	}
	
	if($_GET['ajax'] == "create_new_user"){ 
	 	  if($_SERVER['REQUEST_METHOD'] == "POST"){
			$data['f1'] = trim($_POST['f1']);
		    $data['f2'] = trim($_POST['f2']);	
			$data['f3'] = trim($_POST['f3']);
		    $data['f4'] = trim($_POST['f4']);	
			$data['f5'] = trim($_POST['f5']);
		    $data['f6'] = trim($_POST['f6']);	
			if(empty($data['f1'])){
				$msg = "نام کاربر را فراموش  نموده اید";
				$check ="0";
			}
			if(empty($data['f2'])){
				$msg = "نام کاربری را فراموش نموده اید";
				$check ="0";
			}
			if($data['f3'] !== $data['f4']){
				$msg = "رمز عبور ها با هم مطابقت ندارند";
				$check ="0";
			} 
			if(!filter_var($data['f5'], FILTER_VALIDATE_EMAIL)){
				$msg = "ایمیل وارد شده معتبر  نمیباشد";
				$check ="0";  
			} 
            if(check_last_username($data['f2']) =="1"){
				$msg = "این نام  کاربری قبلا گرفته شده";
				$check ="0";   				
			}		
            if(check_last_email($data['f5']) =="1"){
				$msg = "این ایمیل قبلا در پایگاه داده ثبت شده";
				$check ="0";   				
			}			
			  
			  if($check !=="0"){
				$insert = $db->query("INSERT INTO td_user(s_full_name,s_username,s_password,s_email,s_reg_in_date,s_reg_in_time,s_lastlog_time,s_state,s_dicription) VALUES
				(:s_full_name,:s_username,:s_password,:s_email,:s_reg_in_date,:s_reg_in_time,:s_lastlog_time,:s_state,:s_dicription)", 
				array("s_full_name"=>$data['f1'],"s_username"=>$data['f2'],'s_password'=>passwordHash($data['f3']),'s_email'=>$data['f5'],'s_reg_in_date'=>get_time_date('date_time'),'s_reg_in_time'=>time(),'s_lastlog_time'=>time(),'s_state'=>1,'s_dicription'=>$data['f6']));
				if($insert > 0){   
                   $check = "1";
		           $msg = "کاربر جدید با  موفقیت ایجاد شد"; 				  
			       $ids = $db->lastInsertId();			  
				 }   
			  }
			$export = array('state'=>$check,'msg'=>$msg,'id'=>$ids,'name'=>$data['f1'],'username'=>$data['f2'],'email'=>$data['f5']);   
		    echo json_encode($export);     
          }
    }
	
     if($_GET['ajax'] == "download_file"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){  
			$id=  xss_cleaner(filter($_POST['id_file'])); 
			$filename= str_replace('.zip','',$_POST['filename_s']);
			$filename_e = $filename.".zip";
			$file = $db->row("SELECT * FROM  td_file WHERE id_fl = '{$id}'  LIMIT 1 ");
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
      
     	if($_GET['ajax'] =="send_massage"){
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_SESSION['tiket_code'])){
            $code_msg  = get_last_code().rand(1,50000);  
            $users = user();
            $user_fullname  =  $users['am_fname']." ".$users['am_lname'];
              if($_SESSION['id_users'] == 0){
                  $_SESSION['id_users'] = "0"; 
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
					 $insert   =  $db->query("INSERT INTO  td_file(fl_filename,fl_code,fl_type,fl_min_path,fl_full_path,fl_user_id,fl_state,fl_timestamp,fl_size) VALUES
					 (:fl_filename,:fl_code,:fl_type,:fl_min_path,:fl_full_path,:fl_user_id,:fl_state,:fl_timestamp,:fl_size)", array("fl_filename"=>$fileName,"fl_code"=>$code_msg,'fl_type'=>'application/zip','fl_min_path'=>$min_path,'fl_full_path'=>$full_path,'fl_user_id'=>$_SESSION['id_users'],'fl_state'=>'1','fl_timestamp'=>time(),'fl_size'=>$fileSize));
					 $files =  $db->lastInsertId(); 
					 $check ="1"; 
			      }
  
			    
			  }		 
			 }   
			 
			 if($check !=="0"){ 
			 $insert= $db->query("INSERT INTO td_tiket(tk_massage,tk_parent,tk_user_id,tk_last_req,tk_file,tk_ip,tk_timestamp_in,tk_date_in,admin_id_res,code_msg) 
             VALUES(:tk_massage,:tk_parent,:tk_user_id,:tk_last_req,:tk_file,:tk_ip,:tk_timestamp_in,:tk_date_in,:admin_id_res,:code_msg) ",
             array("tk_massage"=>$data['f1'],"tk_parent"=>$_SESSION['tiket_code'],"tk_user_id"=>$_SESSION['id_users'],"tk_last_req" => '1',"tk_file" => $files,'tk_ip'=>get_client_ip(),'tk_date_in'=>jdate('Y-m-d H:i:s'),'tk_timestamp_in'=>time(),'admin_id_res'=>$_SESSION['admin_id'],'code_msg'=>$code_msg)); 
                 if($insert > 0){
                     $lastId = $db->lastInsertId();
                     $mail = new Send_email();
                     $mail->type = 'response_tiket';
                     $mail->db = new Db(); 
                     $mail->sends($_SESSION['id_users'],$lastId);
             $check = "1";   
	         $update   =  $db->query("UPDATE td_tiket SET tk_timestamp_res = :time,tk_state='3',admin_id_res = :admin_id_res ,tk_date_res =:date ,tk_last_req = '1' WHERE tk_code = :code and tk_parent='0' and  tk_user_id = :id_user",     array("id_user"=>$_SESSION['id_users'],"code"=>$_SESSION['tiket_code'],"time"=>time(),"date"=>jdate('Y-m-d H:i:s'),'admin_id_res'=>$_SESSION['admin_id']));
                 }else{
                     $msg = "ثبت اطلاعات نا موفق";
                 }
		   }  
		      
			 $export = array('check'=>$check,'name'=>$user_fullname,'msg'=>$msg,'massage_send'=>$data['f1'],'id_file'=>$files,'filename'=>$fileName,'date'=>convert(jdate('Y-m-d   H:i:s')),'time_stamps'=>convert(ago(time())),'file_size'=>formatSizeUnits($fileSize));
			 echo json_encode($export); 
        }			  
	}  
     
     if($_GET['ajax']  =="update_tiket"){
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_SESSION['tiket_code'])){
             if($_SESSION['id_users'] == 0){
               $_SESSION['id_users'] = "0"; 
              } 
             $msg =   "با موفقیت بروزرسانی شد ";
             $check = "1";
              $data['f1'] = trim($_POST['state_tiket']);
              $data['f2'] = trim($_POST['last_req']);
              if($data['f1'] > 4 or $data['f1'] < 0){
               $msg =   "وضعیت درخواست نا  معلوم !";
               $check = "0";     
              }
              if($data['f2'] > 1 or $data['f1'] < 0){
               $msg =   "خطا !";
               $check = "0";     
              }
             if($check !==""){
     $update   =  $db->query("UPDATE td_tiket SET tk_state= :tk_state,tk_last_req =:tk_last_req WHERE tk_code = :code and tk_parent='0' and  tk_user_id = :id_user",
array("id_user"=>$_SESSION['id_users'],"code"=>$_SESSION['tiket_code'],"tk_state"=>$data['f1'],'tk_last_req'=>$data['f2'])); 
             }
            
            $export = array('msg'=>$msg,'check'=>$check);
			 echo json_encode($export);      
        }
     }
     
     if($_GET['ajax'] == "check_username"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
            $allow_tabel = array('user','asmin');
            $allow_type = array('email','username'); 
              if (in_array($_POST['tabel'], $allow_tabel) and in_array($_POST['type'], $allow_type)) { 
              $check = check_last(trim($_POST['datas']),trim($_POST['type']),trim($_POST['tabel'])); 
              $export = array('state'=>$check);
              echo json_encode($export); 
                                  
            }else{
                die('Object Moved');
            }
        }
     }
    
     if($_GET['ajax'] == "new_operator_create"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
            header("Content-Type: text/plain"); 
            $data['f1'] = trim($_POST['f1']);
            $data['f2'] = trim($_POST['f2']);
            $data['f3'] = trim($_POST['f3']);
            $data['f4'] = trim($_POST['f4']);
            $data['f5'] = trim($_POST['f5']);
            $data['f6'] = trim($_POST['f6']);
            $data['f7'] = $_POST['f7']; 
              
            $check_username = check_last($data['f2'],'username','asmin'); 
            $check_email = check_last($data['f5'],'email','asmin');  
             
            if($check_username == "1"){
                $msg = "این نام کاربری از قبل گرفته شده";
                $check ="0";
            }
            if($check_email == "1"){
                $msg = "این ایمیل قبلا ثبت شده است !";
                $check ="0";
            } 
          if(!empty($data['f3'])) {
            if($data['f3'] !== $data['f4']){
                $msg = "رمز عبور های وارد شده مطابقت ندراند !";
                $check ="0";    
            }
           }else{  
                $msg = "لطفا رمز عبور را وارد نمایید";
                $check ="0";     
            }
            if(empty($data['f1'])){
                $msg = "لطفا نام اپراتور را وارد نمایید";
                $check ="0";    
            }
          
            if($data['f6'] > 2 or $data['f6'] < 0){
                $msg = "نوع مدیریتی اشتباه است!";
                $check ="0";    
            }  
            if($data['f6'] == "2"){
              if(count($data['f7']) < 1){ 
                $msg = "حد اقل یک دپارتمان جهت مدیریت انتخاب نمایید !";
                $check ="0";       
              }else{
                $type = implode(',',$data['f7']);
               }    
            }elseif($data['f6'] == "1"){
                $type = "0";
            } 
             
            if($check !=="0"){
               
           $insert= $db->query("INSERT INTO td_asmin(am_fname,am_username,am_email,am_password,am_state,am_type) VALUES(:am_fname,:am_username,:am_email,:am_password,:am_state,:am_type) ",
  array("am_fname"=>$data['f1'],"am_username"=>$data['f2'],"am_email"=>$data['f5'],"am_password"=>passwordHash($data['f4']),'am_state'=>'1','am_type'=>$type));  
            if($insert > 0){   
                $check = "1"; 
                $msg = "اپراتور جدید با موفقیت ایجاد شد"; 
                $ids = $db->lastInsertId();
            }else{
                $check = "0"; 
                $msg = "خطای غیر منتظره رخ داده است !";           
            }
            }
           $export = array('state'=>$check,'msg'=>$msg,'name'=>$data['f1'],'username'=>$data['f2'],'type'=>$type,'id'=>$ids);                        
           echo json_encode($export); 
            
        }
     }
     
    if($_GET['ajax'] == "change_pass_opera"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = intval($_POST['id']);
        $password = trim($_POST['password']);
        $db->query("UPDATE td_asmin SET am_password = :pass WHERE id_am = :id",array("pass"=>passwordHash($password),'id'=>$id));  
        $export = array('msg'=>'رمز عبور با موفقیت تغییر  کرد');
         echo json_encode($export); 
        }
    }
    if($_GET['ajax'] == "edit_opera"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
            $id = intval($_GET['id']);
            $data['f1'] = trim($_POST['f1']);
            $data['f2'] = trim($_POST['f2']);
            $data['f3'] = trim($_POST['f3']);
            $data['f4'] = trim($_POST['f4']);
            $data['f5'] = trim($_POST['f5']);
            $data['f6'] = $_POST['f6'];
            $check = "1";
           if(empty($data['f1'])){
                $msg = "لطفا نام اپراتور را وارد نمایید";
                $check ="0";    
            }
          
            if($data['f5'] > 2 or $data['f5'] < 0){
                $msg = "نوع مدیریتی اشتباه است!";
                $check ="0";    
            }  
            if($data['f5'] == "2"){
              if(count($data['f6']) < 1){ 
                $msg = "حد اقل یک دپارتمان جهت مدیریت انتخاب نمایید !";
                $check ="0";       
              }else{
                $type = implode(',',$data['f6']);
               }    
            }elseif($data['f5'] == "1"){
                $type = "0";
            } 
           if($check !=="0"){
               $db->query("UPDATE td_asmin SET am_fname = :fname,am_lname = :lname ,am_username = :username, am_email = :email, am_type = :type WHERE id_am = :id",array("fname"=>$data['f1'],'lname'=>$data['f2'],'username'=>$data['f3'],'email'=>$data['f4'],'type'=>$type,'id'=>$id));   
               $msg = "اپراتور مورد نظر با موفقیت ویرایش شد";
           }
           $export = array('state'=>$check,'msg'=>$msg); 
           echo json_encode($export); 
        }
    }


      
    if($_GET['ajax'] == "change_pass_user"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = intval($_POST['id']);
        $password = trim($_POST['password']);
        $db->query("UPDATE td_user SET s_password = :pass WHERE id_user = :id",array("pass"=>passwordHash($password),'id'=>$id));  
        $export = array('msg'=>'رمز عبور با موفقیت تغییر  کرد');
         echo json_encode($export); 
        }
    }

    if($_GET['ajax'] == "change_pass_opera"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
        $id = intval($_POST['id']);
        $password = trim($_POST['password']);
        $db->query("UPDATE td_asmin SET am_password = :pass WHERE id_am = :id",array("pass"=>passwordHash($password),'id'=>$id));  
        $export = array('msg'=>'رمز عبور با موفقیت تغییر  کرد');
         echo json_encode($export); 
        }
    }
    if($_GET['ajax'] == "edit_user"){
		if($_SERVER['REQUEST_METHOD'] == "POST"){
            $id = intval($_GET['id']);
            $data['f1'] = trim($_POST['f1']);
            $data['f2'] = trim($_POST['f2']);
            $data['f3'] = trim($_POST['f3']);
            $data['f4'] = trim($_POST['f4']);
            $check = "1";
            $user = $db->row("SELECT s_username,s_email FROM td_user WHERE id_user = :id", array('id' => $id));
           if(empty($data['f1'])){
                $msg = "لطفا نام کاربر را وارد نمایید";
                $check ="0";    
            }
          
           if($user['s_username'] !== $data['f2']){
            if(check_last_username($data['f2']) =="1"){
				$msg = "این نام  کاربری قبلا گرفته شده";
				$check ="0";   				
			}	
           }
           if($user['s_email'] !== $data['f3']){
            if(check_last_email($data['f3']) =="1"){
				$msg = "این ایمیل قبلا در پایگاه داده ثبت شده";
				$check ="0";   				
		 	}	
           }
        
           if($check !=="0"){
           $db->query("UPDATE td_user SET s_full_name = :fname,s_username =:username, s_email = :email,s_dicription = :dicription  WHERE id_user = :id",array("fname"=>$data['f1'],'username'=>$data['f2'],'email'=>$data['f3'],'dicription'=>$data['f4'],'id'=>$id));   
           $msg = "کاربر مورد نظر با موفقیت ویرایش شد";
           }
           $export = array('state'=>$check,'msg'=>$msg); 
           echo json_encode($export); 
        }
    }


      

 } // End  check Admin Login