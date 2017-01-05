<?php
if(show_tikets() !== '0' ){
      $where_opera = " and id_dep IN (".show_tikets().")";
  }else{
      $where_opera = "";
  } 


 $Department = $db->query("SELECT * FROM td_Department WHERE dep_state = '1' {$where_opera} "); 
 $user = $db->query("SELECT * FROM td_user WHERE s_state = '1' "); 

    if(isset($_GET['show_code'])){
    $id = intval($_GET['show_code']);
	$get_code = $db->row("SELECT * FROM td_tiket WHERE id_tiket = '{$id}'  LIMIT 1 ");
	}   
 
 		if($_SERVER['REQUEST_METHOD'] == "POST"){
			 $data['f1'] = xss_cleaner(filter($_POST['f4']));
			 $data['f2'] = intval($_POST['f3']); 
			 $data['f4'] = xss_cleaner(filter($_POST['f5']));
               $array_allow = explode(',',show_tikets(),-1);
            if(in_array($data['f2'],$array_allow)){
             $files = "0";	
            if($_POST['f2'] !=="1"){ 
                $send_multi = "1";
            }else{
               $send_multi = "0";     
            }


           if(empty($data['f1'])){
			   $msg=  "<script > show_massage('موضوع درخواست را فراموش  نموده اید','danger') </script>"; 
               $check = "0";			   
		   }
  
           if(empty($data['f4'])){
			   $msg=  "<script > show_massage('متن درخواست را فراموش  نموده اید !','danger') </script>";
               $check = "0";			   
		   }
		   if($check !=="0"){ 
            if($send_multi !== "1"){
                
                
             if(!empty($_FILES['file']['name'])){ 
                  upload_files('0');
			 }
                
			 $insert= $db->query("INSERT INTO td_tiket(tk_code,tk_title,tk_massage,tk_olaviat,tk_departmen,tk_state,tk_parent,tk_user_id,tk_timestamp_in,tk_timestamp_res,tk_date_in,tk_date_res,tk_last_req,tk_file) 
			 VALUES(:tk_code,:tk_title,:tk_massage,:tk_olaviat,:tk_departmen,:tk_state,:tk_parent,:tk_user_id,:tk_timestamp_in,:tk_timestamp_res,:tk_date_in,:tk_date_res,:tk_last_req,:tk_file)",
			 array("tk_code"=>$_SESSION['code_request'],"tk_title"=>$data['f1'],"tk_massage"=>$data['f4'],"tk_olaviat"=>'1',"tk_departmen"=>$data['f2'],"tk_state"=>'1',"tk_parent"=>'0',"tk_user_id"=> '0',"tk_timestamp_in"=> time(),"tk_timestamp_res"=> time(),"tk_date_in"=> jdate('Y-m-d H:i:s'),"tk_date_res"=> jdate('Y-m-d H:i:s'),"tk_last_req" => '0',"tk_file" => $files));
                
                if($insert > 0){
				  $id= $db->lastInsertId();
				  Redirect("?route=create_tiket&send_tiket&show_code={$id}"); 
			  } 
                
            }elseif($send_multi == "1"){  
              foreach($_POST['f1']  AS $value) {       
		         if(!empty($value)){  
                 $_SESSION['code_request'] = get_last_code().rand(1,50000);         
                  if(!empty($_FILES['file']['name'])){ 
                  upload_files($value); 
			     }
                     
                  
			 $insert= $db->query("INSERT INTO td_tiket(tk_code,tk_title,tk_massage,tk_olaviat,tk_departmen,tk_state,tk_parent,tk_user_id,tk_timestamp_in,tk_timestamp_res,tk_date_in,tk_date_res,tk_last_req,tk_file,admin_id_res) 
			 VALUES(:tk_code,:tk_title,:tk_massage,:tk_olaviat,:tk_departmen,:tk_state,:tk_parent,:tk_user_id,:tk_timestamp_in,:tk_timestamp_res,:tk_date_in,:tk_date_res,:tk_last_req,:tk_file,:admin_id_res)",
			 array("tk_code"=>$_SESSION['code_request'],"tk_title"=>$data['f1'],"tk_massage"=>$data['f4'],"tk_olaviat"=>'1',"tk_departmen"=>$data['f2'],"tk_state"=>'1',"tk_parent"=>'0',"tk_user_id"=>intval($value),"tk_timestamp_in"=> time(),"tk_timestamp_res"=> time(),"tk_date_in"=> jdate('Y-m-d H:i:s'),"tk_date_res"=> jdate('Y-m-d H:i:s'),"tk_last_req" => '1',"tk_file" => $files,'admin_id_res'=>$_SESSION['admin_id']));    
                        }  
                      } 
                
                 if($insert > 0){
				  $id= $db->lastInsertId();
				  Redirect("?route=create_tiket&send_tiket&show_code={$id}"); 
			  } 
                
               }
               
			  
		   }
                
            }else{
              $msg=  "<script > show_massage('شما اجازه ایجاد درخواست در این دپارتمان را ندارید','danger') </script>";    
            }
		 }else{
			 $_SESSION['code_request'] = get_last_code().rand(1,50000);
		 }


 $page_num ="13";
 $page_title ="ایجاد درخواست جدید"; 