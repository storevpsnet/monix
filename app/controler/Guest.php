 <?php  
  if(se('send_tiket_goust') == "1"){  
    if(isset($_GET['show_code'])){  
	$id = intval($_GET['show_code']);     
	$get_code = $db->row("SELECT * FROM td_tiket WHERE id_tiket = '{$id}' and  tk_user_id = '".$_SESSION['user_id']."' LIMIT 1 ");
       if(empty($get_code['id_tiket'])){
          header('location: /');  
       }  
	}   
	if(isset($_GET['send_tiket'])){    
	    $id_dep =intval($_GET['dep_id']);         
		$where = "WHERE dep_state = '1' and id_dep = '{$id_dep}' ";
		$Department_all = $db->query("SELECT * FROM td_Department WHERE dep_state = '1'  ");
		
		 if($_SERVER['REQUEST_METHOD'] == "POST"){
			 $token = $_POST['CSRF_TOKEN'];   
	         if($security->get($token)) {  
             $security->delete($token);    
			 $data['f1'] = xss_cleaner(filter($_POST['f1']));
			 $data['f2'] = xss_cleaner(filter($_POST['f2'])); 
			 $data['f3'] = xss_cleaner(filter($_POST['f3']));
			 $data['f4'] = xss_cleaner(filter($_POST['f4']));
			 $data['f5'] = xss_cleaner(filter($_POST['f5']));
             $files = "0";			 
             if(!empty($_FILES['file']['name'])){ 
				$fileName = "tk_".get_last_code().rand(1,1000)."_".date('Y-m-d')."_".$_FILES['file']['name'];
                $fileTmpLoc = $_FILES['file']['tmp_name'];
			    $dir = $_SERVER['DOCUMENT_ROOT']."/Connect/upload/zip/"; 
			    $fileDirectory = $dir.basename(str_replace(' ','-',$_FILES['file']['name']));
			    $allowed_ext = 'application/zip';   
			    $fileSize = $_FILES['file']['size']; 
			    $fileError = $_FILES['file']['error'];	
			    $filetype = $_FILES['file']['type'];					
                $min_path = "../Connect/upload/zip/{$fileName}";	 	
                $full_path = "http://".$_SERVER["HTTP_HOST"]."/Connect/upload/zip/{$fileName}";					
                if(!$fileTmpLoc){
       			  $msg=  "<script > show_massage('خطای غیر  منتظره !','danger') </script>";
      			  exit();
                  $check = "0";					  
   			     }
                else
        		  if(!$fileSize > 1048576){
              		$msg=  "<script > show_massage('حجم  فایل  نباید بیشتر از  1 مگابایت باشد','danger') </script>";
           			unlink($fileTmpLoc);
           			exit();
                    $check = "0";						
       			   }
        			else   
           			   if($filetype !== $allowed_ext){
              			$msg= "<script > show_massage('تنها فایل های  zip قابل بارگذاری  میباشند','danger') </script>";
              			unlink($fileTmpLoc);
              			exit();
                        $check = "0";							
           			   }
					   else
                		if($fileError > 0){
                 		$msg=  "<script > show_massage('خطایی  پیش  امد  لطفا  مجددا امتحان نمایید','danger') </script>";
                 		unlink($fileTmpLoc);
						exit();
	                    $check = "0";						
						}
						else{
   			        if(file_exists($dir. $fileName))
   			        {
     		 	     $msg=  "<script > show_massage('فایلی با این  نام موجود میباشد لطفا مجددا امتحان نمایید','danger') </script>";
                     $check = "0";						 
   			       }
   			      else{
					 move_uploaded_file($fileTmpLoc, $dir .$fileName);
					 $insert   =  $db->query("INSERT INTO 
					 td_file(fl_filename,fl_code,fl_type,fl_min_path,fl_full_path,fl_user_id,fl_state,fl_timestamp,fl_size) VALUES
					 (:fl_filename,:fl_code,:fl_type,:fl_min_path,:fl_full_path,:fl_user_id,:fl_state,:fl_timestamp,:fl_size)", 
					 array("fl_filename"=>$fileName,"fl_code"=>$_SESSION['code_request'],'fl_type'=>'application/zip','fl_min_path'=>$min_path,'fl_full_path'=>$full_path,'fl_user_id'=>'0','fl_state'=>'1','fl_timestamp'=>time(),'fl_size'=>$fileSize));
					 $files =  $db->lastInsertId();
			      }

			    
			  }		 
			 }

           if(empty($data['f1'])){
			   $msg=  "<script > show_massage('موضوع درخواست را فراموش  نموده اید','danger') </script>";
               $check = "0";			   
		   }
           if($data['f3'] < 0 or $data['f3'] > 3 ){
			   $msg=  "<script > show_massage('اولویت بندی  اشتباه!','danger') </script>"; 
               $check = "0";			   
		   }
           if(empty($data['f4'])){
			   $msg=  "<script > show_massage('متن درخواست را فراموش  نموده اید !','danger') </script>";
               $check = "0";			   
		   }
		   if (!filter_var($data['f5'], FILTER_VALIDATE_EMAIL)) {
			   $msg=  "<script > show_massage('لطفا یک ایمیل  معتبر  وارد  نمایید','danger') </script>";
               $check = "0";	
             }
		   if($check !=="0"){ 
			 $insert= $db->query("INSERT INTO td_tiket(tk_email,tk_code,tk_title,tk_massage,tk_olaviat,tk_departmen,tk_state,tk_parent,tk_user_id,tk_timestamp_in,tk_timestamp_res,tk_date_in,tk_date_res,tk_last_req,tk_file) 
			 VALUES(:tk_email,:tk_code,:tk_title,:tk_massage,:tk_olaviat,:tk_departmen,:tk_state,:tk_parent,:tk_user_id,:tk_timestamp_in,:tk_timestamp_res,:tk_date_in,:tk_date_res,:tk_last_req,:tk_file)",
			 array("tk_email"=>$data['f5'],"tk_code"=>$_SESSION['code_request'],"tk_title"=>$data['f1'],"tk_massage"=>$data['f4'],"tk_olaviat"=>$data['f3'],"tk_departmen"=>$data['f2'],"tk_state"=>'1',"tk_parent"=>'0',"tk_user_id"=> '0',"tk_timestamp_in"=> time(),"tk_timestamp_res"=> time(),"tk_date_in"=> jdate('Y-m-d H:i:s'),"tk_date_res"=> jdate('Y-m-d H:i:s'),"tk_last_req" => '0',"tk_file" => $files));
			  if($insert > 0){  
				  $id= $db->lastInsertId();
				  Redirect("?Guest&send_tiket&dep_id=1&show_code={$id}");
				  $data = array('code'=>$_SESSION['code_request'],'title'=>$data['f1'],'email'=>$data['f5'],'name'=>"میهمان");
                  sendmail('code',$data);				  
			  }
		    } 
		   }else{
			   die('object Moved');   
		   } // End  check CSRF 
		 }else{
			 $_SESSION['code_request'] = get_last_code().rand(1,50000);
		 }
		 
		 // End Check POST REQ
	}else{
		$where = "WHERE dep_state = '1'"; 
	}
   $Department = $db->query("SELECT * FROM td_Department {$where} "); 
  }else{
	  header('location: /');
  }