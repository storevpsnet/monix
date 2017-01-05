<?php
// ************************************* //
//            Monix Tiketing System     //
//              http://monix.ir        //
// *************************************//

    function get_time_date($type){

	switch($type)
		{
			case 'date':        
			  $date =  jdate('Y-m-d');
			break;

			case 'time':
                          $date =  jdate('H:i:s');
			break;
                      
			case 'date_time':
			  $date =  jdate('Y-m-d H:i:s');

			break;

		}
       
      return $date;
   
}



function Redirect($loc){

 echo '<script type="text/javascript">
           window.location = "'.$loc.'"
      </script>';
   header('location:'.$loc);
  }

function getUserIP(){
    if (!empty($_SERVER['HTTP_CLIENT_IP']))
    {
    $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
    {
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
    $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}
function random_code(){
   $rand_1= rand(1,1000);
	$rand_2= rand(1,2000);	
    $export =  md5($rand_1.$rand_2."تکفا طرح"); 
	
	return $export;
 }
 
function xss_cleaner($input_str) {
    $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
	
    return $return_str;
}

function filter($data){
	
	 $export = htmlentities(strip_tags(Trim($data)));
	 
  return $export;
}
 
function mon_get_path_plugin($file){
	return realpath($file);      
}
function isValidUsername($str){
    return !preg_match('/[^A-Za-z0-9.#\\-$]/', $str);
}

function isValidEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}
function passwordHash($str){
    $hash=md5(crypt(Md5($str),HASH_CODE));
    return $hash;
}

function save_spamer($con){
	
	  $values = array(
	  'ip_spam' => getUserIP(),
	  'time_stam' => time(),
	  'date_spam' => jdate('Y-m-d H:i:s'),
	  'url_page' => url(),
	  'user_id' => $_SESSION['admin_id']
	  );
	  Mysql::insert($values, 'td_spamer',$con);
}

function ago($time)
{
   $periods = array("ثانیه", "دقیقه", "ساعت", "روز", "هفته", "ماه", "سال", "دهه");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "دقیقه";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "";
   }

   return "$difference $periods[$j] پیش ";
}

  function url(){
  return sprintf(
    "%s://%s%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME'],
    $_SERVER['REQUEST_URI']
  );
}
  
    function hashimage($url,$type){

         $img= base64_encode(file_get_contents($url));
         $src = 'data:image/'.$type.';base64,'.$img;
      return $src;
    }
      
	function  insert_log($type,$code_er) {
		$db = new Db(); 
		$code = array(
		'1' => 'ورود به پنل  مدیریت  نا موفق',
		'2' => 'ورود به پنل  مدیریت موفق'	
		);
		$subject = $code[$code_er];
     	$insert = $db->query("INSERT INTO td_log(lo_subject,lo_type,lo_ip,lo_date,lo_time) VALUES(:sub,:ty,:ip,:da,:ti)", array("sub"=>$subject,"ty"=>$type,"ip"=>getUserIP(),"da"=>get_time_date('date_time'),"ti"=>time()));  
	}
	
	

function creat_folder_upload($dir){
	$y = jdate('Y');
	$m = jdate('m');
	$y_dir = $dir."/".$y."/";
	$m_dir = $y_dir.$m."/";	
	if(!is_dir($y_dir)){
 	 mkdir($y_dir);	
	}
	if(!is_dir($m_dir)){
	 $m = mkdir($m_dir);	
	}
	return $m_dir;
}
function insert_file_up($filename,$file_type,$file_size,$file_min_path,$file_full_path,$file_code,$file_site_id) {
	    $db = new Db(); 
		$insert = $db->query("INSERT INTO td_file(fl_filename,fl_type,fl_size,fl_min_path,fl_full_path,fl_user_id,fl_code,fl_site_id
		,fl_state,fl_date_upload,fl_time_upload,fl_state_download,fl_state_delete) 
		VALUES(:fl_filename,:fl_type,:fl_size,:fl_min_path,:fl_full_path,:fl_user_id,:fl_code,:fl_site_id
		,:fl_state,:fl_date_upload,:fl_time_upload,:fl_state_download,:fl_state_delete)",
		array("fl_filename"=>$filename,"fl_type"=>$file_type,"fl_size"=>$file_size,"fl_min_path"=>$file_min_path,"fl_full_path"=>$file_full_path,"fl_user_id"=>$_SESSION['admin_id'],'fl_code'=>$file_code,'fl_site_id'=>$file_site_id
		,'fl_state'=>'1',"fl_date_upload"=>get_time_date('date_time'),"fl_time_upload"=>time(),'fl_state_download'=>'1','fl_state_delete'=>'1'));  
		
		if($insert > 0 ){
		$id = $db->lastInsertId();
		}
		
		return $id;
}
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' kB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

function state_tiket($state){
	switch($state){
		case '1':
		$export = '<span style="line-height: 20px;" class="btn  btn-xs btn-default">باز </span>';
		break;
		case '2':
		$export = '<span style="line-height: 20px;" class="btn  btn-xs btn-primary"> در انتظار پاسخ </span>';
		break;		
		case '3':
		$export = '<span style="line-height: 20px;" class="btn btn-xs btn-success"> پاسخ داده شد </span>';
		break;	
		case '4': 
		$export = '<span style="line-height: 20px;" class="btn btn-xs btn-danger"> بسته شده </span>';
		break;		
	}
	
	return $export;
}
function last_massage($last){
		switch($last){
		case '0': 
		$export = '<span style="color:#d46016;"> کاربر </span>';
		break;
		case '1':
		$export = '<span style="color:green">کارمند</span>';
		break;			
	}
	
	return $export;
}
function states($state){ 
			switch($state){
		case '0':    
		$export = '<span class="btn btn-danger  btn-xs"> غیر فعال</span>';
		break;
		case '1':
		$export = '<span  class="btn btn-success  btn-xs"> فعال </span>';
		break;			
	} 
    return $export;
}
 
  function state_user($state){
		switch($state){ 
		case '0':
		$export = '<span  class="btn btn-danger  btn-xs">غیر فعال</span>';
		break;
		case '1':
		$export = '<span  class="btn btn-success  btn-xs"> فعال </span>';
		break;		
		case '2': 
		$export = '<span class="btn btn-warning  btn-xs"> بلاک شده </span>';
		break;		
	}
	
	return $export;
}
function check_last_username($username){
	 $db = new Db(); 	  
	 $person = $db->row("SELECT * FROM  td_user WHERE  	s_username = :username " ,array("username"=>$username));	  
	  if(!empty($person['id_user'])){
		  $check ="1";
	  }else{
		 $check ="0";  
	  }
	  
	  return $check; 
}
function check_last_email($email){ 
	 $db = new Db(); 	  
	 $person = $db->row("SELECT * FROM  td_user WHERE  	s_email = :email " ,array("email"=>$email));	  
	  if(!empty($person['id_user'])){
		  $check ="1";
	  }else{
		 $check ="0";  
	  }
	  
	  return $check; 
}
function check_last($data,$type,$tabel){
    $db = new Db(); 	
    switch($type){ 
		case 'username':
		  if($tabel =="asmin"){
              $by = "am_username";
          }elseif($tabel =="user"){
              $by = "s_username";   
          }
		break;
		case 'email':
		  if($tabel =="asmin"){
              $by = "am_email";
          }elseif($tabel =="user"){
              $by = "s_email";   
          }
            
		break;		
	
	 }
	 $person = $db->row("SELECT * FROM  td_{$tabel} WHERE  {$by} = :data " ,array("data"=>$data));	  
	  if(!empty($person[$by])){
		  $check ="1";
	    }else{
		 $check ="0";  
	   }
	  return $check; 
}

  function type_admin($state){
		switch($state){ 
		case '0':
		$export = '<span  class="btn btn-danger  btn-xs"> مدیریت </span>';
		break;
		case '1':
		$export = '<span  class="btn btn-success  btn-xs"> فعال </span>';
		break;		
		case '2': 
		$export = '<span class="btn btn-warning  btn-xs"> بلاک شده </span>';
		break;	
        default :
        $export = '<span class="btn btn-info  btn-xs"> اپراتور </span>';
        break;	         
	}
	
	return $export;
}

function get_file($code){
	    $db = new Db(); 	
	 $tiket = $db->row("SELECT * FROM  td_file WHERE fl_code = '{$code}' and fl_state ='1' LIMIT 1 ");
	  if(count($tiket['id_fl']) > 0){
		  return $tiket;
	  }else{
		  return '0';
	  }
}
function convert($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($num,$persian, $string); 
}  
function last_massage_nocolor($last){
		switch($last){
		case '0': 
		$export = 'کاربر ';
		break;
		case '1':
		$export = 'کارمند';
		break;			
	}
	
	return $export;
}
function user(){
	    $db = new Db(); 	
	    $user = $db->row("SELECT * FROM  td_asmin WHERE id_am = '".$_SESSION['admin_id']."' and am_state ='1' LIMIT 1 ");
	    return $user;   
}
function get_admin_name($id){
        $db = new Db(); 	
	    $user = $db->row("SELECT * FROM  td_asmin WHERE id_am = '{$id}' and am_state = '1' LIMIT 1 ");
        if(!empty($user['am_fname'])){
	    return $user['am_fname']." ".$user['am_lname'];   
        }else{ 
         return "ناشناس!";   
        } 
}
function get_last_code(){
	    $db = new Db(); 
		$query = $db->row("SELECT * FROM td_tiket ORDER BY id_tiket DESC ");  
		$export = intval($query['id_tiket']) + 1; 
		return $export;  
} 

function  upload_files($id){
             	 $db = new Db();
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
					 array("fl_filename"=>$fileName,"fl_code"=>$_SESSION['code_request'],'fl_type'=>'application/zip','fl_min_path'=>$min_path,'fl_full_path'=>$full_path,'fl_user_id'=>intval($id),'fl_state'=>'1','fl_timestamp'=>time(),'fl_size'=>$fileSize));
					 $files =  $db->lastInsertId();
			      } 

			    
			  }		
    
    return $files; 
}
function se($id){
	$db = new Db();
	$query = $db->row("SELECT * FROM td_setting WHERE  se_Key = :id", array("id"=>$id));  
	$data = $query['se_value'];
    return $data;	  
}


function show_tikets(){
   $db = new Db(); 
   $user = $db->row("SELECT * FROM  td_asmin WHERE  id_am = ".$_SESSION['admin_id']);
   return $user['am_type']; 
} 

class SendMail {
    var $to; // Email to
    var $type; // Types Email
    var $SubjectMail; 
    var $data;
    var $body;
    var $title;
    function User_information($id){
      $db = new Db();   
     return $db->row("SELECT * FROM  td_user WHERE id_user = :id and s_state = 1 ",array('id'=>$id));   
    }
    function GetMailInformation(){
        return array('Host'=>se('SMTP_HOST'),'username'=>se('SMTP_username'),'password'=>se('SMTP_password'),'port'=>se('SMTP_port'));
    }
    function Mail_to($id){
         $mail = new PHPMailer;
         if($this->type == "1"){
          $dt = $this->GetMailInformation();
          $mail->isSMTP();                                      // Set mailer to use SMTP
          $mail->Host = $dt['Host'];  // Specify main and backup SMTP servers
          $mail->SMTPAuth = true;                               // Enable SMTP authentication
          $mail->Username = $dt['username'];                 // SMTP username
          $mail->Password = $dt['password'];                           // SMTP password
          $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
          $mail->Port = $dt['port'];                                    // TCP port to connect to
          $form = "info@".$_SERVER['HTTP_HOST'];
          $mail->setFrom($form, se('site_title')."-".$this->title);
          $mail->addAddress($this->to, $this->to);             // Name is optional
          $mail->addReplyTo('no-reply@example.com', 'noreply');
          $mail->addCC($form, se('site_title')."-".$this->title);
          $mail->addBCC($this->to, $this->to); 
          $mail->isHTML(true);                                  // Set email format to HTML
          $mail->Subject = $this->SubjectMail;
          $mail->Body    = $this->pattern_Email($id);
          $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
          $mail->send();
         }else{
           $form = "info@".$_SERVER['HTTP_HOST'];
           $mail->setFrom($form, se('site_title')."-".$this->title);
           $mail->setLanguage('fa', CLASS_DIR.'language/');
           $mail->addReplyTo('no-reply@example.com', 'noreply');
           $mail->CharSet = 'UTF-8';
           $mail->addAddress($this->to, $this->to);
           $mail->Subject = $this->SubjectMail;   
           $mail->Body    = $this->pattern_Email($id);
           $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
           $mail->send();
  
         }
    }

    function pattern_Email($id){
       $species = $this->body;
       $user = $this->User_information($id);
       $data = $this->data;

       if($species == "Response_Tiket"){
         $out = '<div  style="direction: rtl;text-align:right;"><p>با سلام '.$user['s_full_name'].' عزیز </p><p>به استحضار شما میرسانیم که : </p><p> به درخواست شما پاسخ داده شد. </p><p>پاسخ : '.$data['Msg'].'</p><p>اطلاعات درخواست :</p><p>عنوان درخواست : '.$data['tiket_title'].'</p><p>تاریخ ایجاد : '.$data['date_create'].'</p><p>وضعیت درخواست :'.$data['state_tiket'].'</p><p>کد درخواست : <a href="http://'.$_SERVER['HTTP_HOST'].'/?route=show_tiket&tiket_code='.$data['tiket_code'].'">#'.$data['tiket_code'].'</a></p><p>با تشکر از صبر و بردباری شما.</p><p> جهت ورود به سامانه <a href="http://'.$_SERVER['HTTP_HOST'].'">کلیک کنید</a></div>';
         return $out;    
       }
    }
}
class Send_email{
      var $type;
      var $db;
	  function sends($id,$tiket_id){
		  if($this->type == "response_tiket"){
              $user = $this->GetUser_Information($id);
              $tiket = $this->GetTiketInformation($user['id_user'],$tiket_id);
			  $parent = $this->GetTiketParentInformation($id,$tiket['tk_parent']);
              $mails = new SendMail();
              $mails->to = $user['s_email'];
              $mails->type = se('mail_stamp');
              $mails->title = 'پاسخ داده شد -'.$tiket['tk_title'];
              $mails->SubjectMail = 'پاسخ داده شد - '.se('site_title')."- Pasokh Dade Shod";
              $mails->body = 'Response_Tiket';
			  $mails->data = array('Msg'=>$tiket['tk_massage'],'tiket_code'=>$parent['tk_code'],'tiket_title'=>$parent['tk_title'],'date_create'=>substr($parent['tk_date_in'],0,10),'state_tiket'=>state_tiket($parent['tk_state']));
              $mails->Mail_to($id);
		  }

	  }
	  function GetUser_Information($id){
        return $this->db->row("SELECT * FROM  td_user WHERE id_user = :id and s_state = 1 ",array('id'=>$id));   
      }
	  function GetTiketInformation($for,$id){
       return $this->db->row("SELECT * FROM  td_tiket WHERE tk_user_id = :id and id_tiket = :id_tiket ",array('id'=>$for,'id_tiket'=>$id));
      }
      function GetTiketParentInformation($id,$code){
       return $this->db->row("SELECT * FROM  td_tiket WHERE tk_user_id = :id and tk_code = :code and tk_parent = 0 ",array('id'=>$id,'code'=>$code));
      }  
}

class se_save {
	var $db;
	function create_key($id,$group){
	 $insert = $this->db->query("INSERT INTO td_setting(se_Key,se_group) VALUES (:se_Key,:se_group)",array("se_Key"=>$id,"se_group"=>$group));
	 if($insert > 0){
		 return 1;
	 }else{
		 return 0;
	 }	 			 
	}
    function check_id($id,$group){
	 $check = $this->db->row("SELECT se_Key FROM td_setting WHERE se_Key = :id and se_group = :group ",array('id'=>$id,'group'=>$group));   
	 if(empty($check['se_Key'])){
		$checks =  $this->create_key($id,$group);
		return $checks;
	 }else{
		 return 1;
	 }
	}
	function save_se($id,$data,$group){
      $id = $this->filter($id);
      $data = $this->filter($data);
      $group = $this->filter($group);
	  $check = $this->check_id($id,$group);
       if($check > 0){
		 $this->db->query("UPDATE td_setting SET se_value = :se_value WHERE se_Key = :se_Key and se_group = :se_group ",array('se_Key'=>$id,'se_group'=>$group,'se_value'=>$data));   
	   }
	}
    function filter($data){
	  $export = htmlentities(strip_tags(Trim($data)));
      return $export;
     }   
}

   function update_last_log(){
	$db = new Db();
    $db->query("UPDATE  td_asmin SET am_lastlogin = :s_lastlog_time  WHERE id_am = :id",array('s_lastlog_time'=>time(),'id'=>$_SESSION['user_id']));
   }