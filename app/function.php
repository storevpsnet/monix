<?php
// ************************************* //
//            Monix Tiketing System     //
//              http://monix.ir        //
// *************************************//
require_once('lib/jdf.php');

function removeslashes($string)
{
    $string=implode("",explode("\\",$string));
    return stripslashes(trim($string));
}
function xss_cleaner($input_str) {
    $return_str = str_replace( array('<','>',"'",'"',')','('), array('&lt;','&gt;','&apos;','&#x22;','&#x29;','&#x28;'), $input_str );
    $return_str = str_ireplace( '%3Cscript', '', $return_str );
    return $return_str;
}
function passwordHash($str){
    $hash=md5(crypt(Md5($str),HASH_CODE));
    return $hash;
}
function filter($post){
 
  $post= preg_replace('/(?:<|&lt;)\/?([a-zA-Z]+) *[^<\/]*?(?:>|&gt;)/', '',htmlspecialchars(strip_tags($post)));
   return $post;
}
function Redirect($loc){

 echo '<script type="text/javascript">
           window.location = "'.$loc.'"
      </script>';

  }
  function ago($time)
{
   $periods = array("ثانیه", "دقیقه", "ساعت", "روز", "هفته", "ماه", "سال", "خیلی وقت پیش");
   $lengths = array("60","60","24","7","4.35","12","10");

   $now = time();

       $difference     = $now - $time;
       $tense         = "";

   for($j = 0; $difference >= $lengths[$j] && $j < count($lengths)-1; $j++) {
       $difference /= $lengths[$j];
   }

   $difference = round($difference);

   if($difference != 1) {
       $periods[$j].= "";
   }

   return "$difference $periods[$j] پیش ";
}
function convert($string) {
    $persian = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹');
    $num = range(0, 9);
    return str_replace($num,$persian, $string); 
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
function check_val($username,$by,$tabel){
  $db = new Db();
  $user = $db->row("SELECT * FROM {$tabel} WHERE  {$by} = :username", array("username"=>$username));  
   if(count($user['id_us']) > 0){
	   $check ="1";
   }else{
	 $check ="0";  
   }
   
   return $check;
}

function get_user_informat(){
	$db = new Db();
	$user = $db->row("SELECT * FROM mo_user WHERE  id_us = :id", array("id"=>$_SESSION['user_id']));  
    
    return $user;
} 

function se($id){
	$db = new Db();
	$query = $db->row("SELECT * FROM td_setting WHERE  se_Key = :id", array("id"=>$id));  
	$data = $query['se_value'];
    return $data;	  
}

function get_last_code(){
	    $db = new Db(); 
		$query = $db->row("SELECT * FROM td_tiket ORDER BY id_tiket DESC ");  
		$export = intval($query['id_tiket']) + 1; 
		return $export;  
}

function state_tiket($state){
	switch($state){
		case '1':
		$export = '<span style="line-height: 20px;" class="label label-default">باز </span>';
		break;
		case '2':
		$export = '<span style="line-height: 20px;" class="label label-primary"> در انتظار پاسخ </span>';
		break;		
		case '3':
		$export = '<span style="line-height: 20px;" class="label label-success"> پاسخ داده شد </span>';
		break;	
		case '4': 
		$export = '<span style="line-height: 20px;" class="label label-danger"> بسته شده </span>';
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
function get_file($code){
	    $db = new Db(); 	
	 $tiket = $db->row("SELECT * FROM  td_file WHERE fl_code = '{$code}' and fl_user_id = '".$_SESSION['user_id']."' and fl_state ='1' LIMIT 1 ");
	  if(count($tiket['id_fl']) > 0){
		  return $tiket;
	  }else{
		  return '0';
	  }
}
function get_file_guest($code){
	    $db = new Db(); 	
	 $tiket = $db->row("SELECT * FROM  td_file WHERE fl_code = '{$code}' and fl_user_id = '0' and fl_state ='1' LIMIT 1 ");
	  if(count($tiket['id_fl']) > 0){
		  return $tiket;
	  }else{
		  return '0';
	  }
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
function users(){
		$db = new Db(); 
		$query = $db->row("SELECT * FROM td_user WHERE id_user ='".$_SESSION['user_id']."' ");  
		return $query;
}
function counter($query){
	  $db = new Db(); 
      $query = $db->query($query); 
	  $count = count($query);    
	  return $count;
}
function sendmail($type,$data){
	if($type == "code"){
     $msg = "با سلام ".$data['name']."گرامی  کد رهگیری شما :".$data['code'];
     $msg = wordwrap($msg,70);   
     mail($data['email'],"کد رهگیری -".se('site_title'),$msg);
	}
}
function csrf_token(){
	  $security = new \security\CSRF;
      $token = $security->set(3, 3600);    
	  echo '<input type="hidden" name="CSRF_TOKEN" value="'.$token.'" />';  
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
 
class SendMail {
    var $to; // Email to
    var $type; // Types Email
    var $SubjectMail; 
    var $data;
    var $body;
    var $title;
    function User_information(){
      $db = new Db();   
     return $db->row("SELECT * FROM  td_user WHERE id_user = :id and s_state = 1 ",array('id'=>$_SESSION['user_id']));   
    }
    function GetMailInformation(){
        return array('Host'=>se('SMTP_HOST'),'username'=>se('SMTP_username'),'password'=>se('SMTP_password'),'port'=>se('SMTP_port'));
    }
    function Mail_to(){
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
          $mail->Body    = $this->pattern_Email();
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
           $mail->Body    = $this->pattern_Email();
           $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
           $mail->send();
  
         }
    }

    function pattern_Email(){
       $species = $this->body;
       $user = $this->User_information();
       $data = $this->data;
       if($species == "change_password"){
         $out = '<div  style="direction: rtl;text-align:right;"><p>با سلام '.$user['s_full_name'].' عزیز </p><p>به استحضار شما میرسانیم که : </p><p>دقایقی پیش رمز عبور شما در سامانه ما  تغییر کرده است. </p><p> جهت ورود به سامانه <a href="http://'.$_SERVER['HTTP_HOST'].'">کلیک کنید</a></div>';
         return $out; 
       }
       if($species == "New_Support_Tiket"){
         $out = '<div  style="direction: rtl;text-align:right;"><p>با سلام '.$user['s_full_name'].' عزیز </p><p>به استحضار شما میرسانیم که : </p><p> درخواست شما با موفقیت ایجاد شد ، بزودی  یکی از  کارشناسان پاسخ شما را خواهند داد لطفا کمی صبر نمایید. </p><p>اطلاعات درخواست :</p><p>عنوان درخواست : '.$data['tiket_title'].'</p><p>تاریخ ایجاد : '.$data['date_create'].'</p><p>وضعیت درخواست :'.$data['state_tiket'].'</p><p>کد درخواست : <a href="http://'.$_SERVER['HTTP_HOST'].'/?route=show_tiket&tiket_code='.$data['tiket_code'].'">#'.$data['tiket_code'].'</a></p><p>با تشکر از صبر و بردباری شما.</p><p> جهت ورود به سامانه <a href="http://'.$_SERVER['HTTP_HOST'].'">کلیک کنید</a></div>';
         return $out;    
       }
       if($species == "New_Support_Tiket_forAdmin"){
         $out = '<div  style="direction: rtl;text-align:right;"><p>درخواست جدیدی کاربر  '.$user['s_full_name'].' ایجاد کرد </p><p>به استحضار شما میرسانیم که : </p><p> در سامانه پشتیبانی تیکت جدیدی ایجاد شد و در انتظار پاسخ میباشد </p><p>اطلاعات درخواست :</p><p>عنوان درخواست : '.$data['tiket_title'].'</p><p>تاریخ ایجاد : '.$data['date_create'].'</p><p>وضعیت درخواست :'.$data['state_tiket'].'</p><p>کد درخواست : <a href="http://'.$_SERVER['HTTP_HOST'].'/tk-panel/?route=show_tiket&id='.$data['tiket_code'].'">#'.$data['tiket_code'].'</a></p><p> جهت ورود به سامانه <a href="http://'.$_SERVER['HTTP_HOST'].'">کلیک کنید</a></div>';
         return $out;    
       }
       if($species == "New_Response_Tiket_forAdmin"){
         $out = '<div  style="direction: rtl;text-align:right;"><p>پاسخ جدیدی کاربر  '.$user['s_full_name'].' ارسال کرد </p><p>به استحضار شما میرسانیم که : </p><p> پاسخ جدید برای درخواست ایجاد نموده ارسال شد </p><p>پاسخ کاربر : '.$data['Msg'].'</p><p>اطلاعات درخواست :</p><p>عنوان درخواست : '.$data['tiket_title'].'</p><p>تاریخ ایجاد : '.$data['date_create'].'</p><p>وضعیت درخواست :'.$data['state_tiket'].'</p><p>کد درخواست : <a href="http://'.$_SERVER['HTTP_HOST'].'/tk-panel/?route=show_tiket&id='.$data['tiket_code'].'">#'.$data['tiket_code'].'</a></p><p> جهت ورود به سامانه <a href="http://'.$_SERVER['HTTP_HOST'].'">کلیک کنید</a></div>';
         return $out;    
       }
       

    }
}
class user {
   var $db; // DataBase
   function _clear($text){
     return htmlspecialchars(strip_tags($text));
   }
   function GetUser_Information(){
    return $this->db->row("SELECT * FROM  td_user WHERE id_user = :id and s_state = 1 ",array('id'=>$_SESSION['user_id']));
   }
   function update_last_log(){
    $this->db->query("UPDATE td_user SET s_lastlog_time = :s_lastlog_time,s_ip = :ip WHERE id_user = :id",array('s_lastlog_time'=>time(),'ip'=> get_client_ip(),'id'=>$_SESSION['user_id']));
   }
   function EditPassword($my_pass,$password,$re_password){
      $my_pass = $this->_clear($my_pass);
      $password = $this->_clear($password);
      $re_password = $this->_clear($re_password);
      $er_return = array();
      $user = $this->GetUser_Information();
      $check = 1; 
      if(!empty($password)){
         if($password !== $re_password){
            array_push($er_return,'رمز عبور ها با هم مطابقت ندارند');
            $check = 0;
         }else{
                if(passwordHash($my_pass) !== $user['s_password']){
                 array_push($er_return,'رمز عبور وارد شده  با رمز عبور فعلی تفاوت دارد');
                 $check = 0;
                }
            }
      }else{
        $check = 0;  
        array_push($er_return,'رمز عبور نباید خالی باشد!');
      }

      if($check < 1){
          return $er_return;
      }else{
           $this->db->query("UPDATE td_user SET s_password = :password WHERE id_user = :id and s_state = 1 ",array('id'=>$_SESSION['user_id'],'password'=>passwordHash($password)));
           $this->SendMailChangePass();
           return 'true';
      }

   }
    function SendMailChangePass(){
          $user = $this->GetUser_Information();
          $mails = new SendMail();
          $mails->to = $user['s_email'];
          $mails->type = se('mail_stamp');
          $mails->title = 'تغییر رمز عبور';
          $mails->SubjectMail = 'تغییر رمز عبور - '.se('site_title')."- Taghir Ramz Obor";
          $mails->body = 'change_password';
          $mails->Mail_to();
    }
 
    function send_mail_new_tiket($id){
       $user = $this->GetUser_Information();
       $tiket = $this->GetTiketInformation($id);
       $mails = new SendMail();
       $mails->to = $user['s_email'];
       $mails->type = se('mail_stamp');
       $mails->title = 'درخواست جدید -'.$tiket['tk_title'];
       $mails->SubjectMail = 'تیکت جدید - '.se('site_title')."- Tiket Jadid";
       $mails->body = 'New_Support_Tiket';
       $mails->data = array('tiket_code'=>$tiket['tk_code'],'tiket_title'=>$tiket['tk_title'],'date_create'=>substr($tiket['tk_date_in'],0,10),'state_tiket'=>state_tiket($tiket['tk_state']));
       $mails->Mail_to();

       $mails_admin = new SendMail();
       $mails_admin->to = se('admin_email');
       $mails_admin->type = se('mail_stamp');
       $mails_admin->title = 'درخواست جدید -'.$tiket['tk_title'];
       $mails_admin->SubjectMail = 'تیکت جدید - '.se('site_title')."- Tiket Jadid";
       $mails_admin->body = 'New_Support_Tiket_forAdmin';
       $mails_admin->data = array('tiket_code'=>$tiket['tk_code'],'tiket_title'=>$tiket['tk_title'],'date_create'=>substr($tiket['tk_date_in'],0,10),'state_tiket'=>state_tiket($tiket['tk_state']));
       $mails_admin->Mail_to();

    }
      function send_mail_tiket_response($id){
       $tiket = $this->GetTiketInformation($id);
       $tiket_parent = $this->GetTiketParentInformation($tiket['tk_parent']);
       $mails_admin = new SendMail();
       $mails_admin->to = se('admin_email');
       $mails_admin->type = se('mail_stamp');
       $mails_admin->title = 'پاسخ به -'.$tiket['tk_title'];
       $mails_admin->SubjectMail = 'پاسخ به تیکت - '.se('site_title')."- Pasokh Jadid";
       $mails_admin->body = 'New_Response_Tiket_forAdmin';
       $mails_admin->data = array('Msg'=>$tiket['tk_massage'],'tiket_code'=>$tiket['tk_parent'],'tiket_title'=>$tiket_parent['tk_title'],'date_create'=>substr($tiket_parent['tk_date_in'],0,10),'state_tiket'=>state_tiket($tiket_parent['tk_state']));
       $mails_admin->Mail_to();
    }
    
    function GetTiketInformation($id){
     return $this->db->row("SELECT * FROM  td_tiket WHERE tk_user_id = :id and id_tiket = :id_tiket ",array('id'=>$_SESSION['user_id'],'id_tiket'=>$id));
    }
    function GetTiketParentInformation($code){
     return $this->db->row("SELECT * FROM  td_tiket WHERE tk_user_id = :id and tk_code = :code and tk_parent = 0 ",array('id'=>$_SESSION['user_id'],'code'=>$code));
    }
    function Check_lastUsername($username){
     $user =  $this->db->row("SELECT s_username FROM  td_user WHERE s_username = :username ",array('username'=>$username)); 
        if(!empty($user['s_username'])){
         return 0;
        }else{
         return 1;
       }
    }
    function Check_lastEmail($email){
     $user =  $this->db->row("SELECT s_email FROM  td_user WHERE s_email = :email ",array('email'=>$email)); 
        if(!empty($user['s_email'])){
         return 0;
        }else{
         return 1;
       }
    }
    function validate_edit_pro($username,$name,$dicirption,$email){
            $min_len_username = se('min_len_username');
            $max_len_username = se('max_len_username');
            $max_len_dicirption = se('max_len_dicirption_user');
            $max_len_name = se('max_len_name');
            $data = array(
            'نام_کاربری' => $username,
            'نام_کامل' => $name,
            'توضیحات_اضافی' => $dicirption,
            'ایمیل' => $email
            );
            $validated = GUMP::is_valid($data, array(
	         'نام_کاربری' =>       "required|min_len,{$min_len_username}|max_len,{$max_len_username}",
             'نام_کامل' =>      "required|max_len,{$max_len_name}",
             'توضیحات_اضافی'  => "max_len,{$max_len_dicirption}",
             'ایمیل' =>      "required|valid_email"
            ));

             if($validated === true) {
	            return 1;
             } else {
	          return $validated;
            }
    }
    function Edit_profile($name,$username,$email,$diciprion){
        $name = $this->_clear($name);
        $username = $this->_clear($username);
        $email = $this->_clear($email);
        $diciprion = $this->_clear($diciprion);

        $user = $this->GetUser_Information();
        $check = 1;
        $validate_data = $this->validate_edit_pro($username,$name,$dicirption,$email);
   
        if($validate_data == 1){
             $er_return = array();
             // Check Last User 
            if($username !== $user['s_username']){
                    $check_username = $this->Check_lastUsername($username);
                   if($check_username < 1){
                    array_push($er_return,'نام کاربری قبلا گرفته شده است');
                    $check = 0;
                   }
            }
            if($email !== $user['s_email']){
              $check_email = $this->Check_lastEmail($email);  
              if($check_email < 1){
              array_push($er_return,'ایمیل وارد شده قبلا گرفته شده است');
              $check = 0;
              }
           }
          if($check == 1){
            $this->db->query("UPDATE td_user SET s_username = :username , s_email = :email , s_full_name = :fullname , s_dicription = :dicription WHERE id_user = :id and s_state = 1 ",array('id'=>$_SESSION['user_id'],'email'=>$email,'username'=>$username,'fullname'=>$name,'dicription'=>$diciprion));  
            return 'true';
          }else{
            return $er_return; 
          }
        }else{
            return $validate_data;
        }

    }
  
}

class setting {
    var $db;

    function send_tiket_ghost(){
        if(se('send_tiket_goust') == "1"){
            return '<a href="?Guest" type="button" class="btn  btn-warning"> ارسال  تیکت به عنوان مهمان  </a>';
        }else{
            return false;
        }
    }
    function create_account(){
        if(se('register_new_user') == "1"){
            return '<label>  حساب  کاربري  نداريد؟ </label><a onclick="$(\'#register\').show();$(\'#login\').hide();" href="#"> ايجاد حساب</a> ';
        }else{
            return false;
        }
    }

}


class register_user {
     var $db;

    function Check_lastUsername($username){
     $user =  $this->db->row("SELECT s_username FROM  td_user WHERE s_username = :username ",array('username'=>$username)); 
        if(!empty($user['s_username'])){
         return 0;
        }else{
         return 1;
       }
    }
    function Check_lastEmail($email){
     $user =  $this->db->row("SELECT s_email FROM  td_user WHERE s_email = :email ",array('email'=>$email)); 
        if(!empty($user['s_email'])){
         return 0;
        }else{
         return 1;
       }
    }

     function validate_user($name,$username,$password,$email,$dicription){
            $min_len_username = se('min_len_username');
            $max_len_username = se('max_len_username');
            $max_len_dicirption = se('max_len_dicirption_user');
            $max_len_name = se('max_len_name');
            $min_len_password = se('min_len_pass');
            $max_len_password = se('max_len_pass');
            $data = array(
            'نام_کاربری' => $username,
            'نام_کامل' => $name,
            'توضیحات_اضافی' => $dicription,
            'ایمیل' => $email,
            'رمز_عبور' => $password
            );
            $validated = GUMP::is_valid($data, array(
	         'نام_کاربری' =>       "required|min_len,{$min_len_username}|max_len,{$max_len_username}",
             'نام_کامل' =>      "required|max_len,{$max_len_name}",
             'توضیحات_اضافی'  => "max_len,{$max_len_dicirption}",
             'ایمیل' =>      "required|valid_email",
             'رمز_عبور' =>   "required|min_len,{$min_len_password}|max_len,{$max_len_password}",
            ));

             if($validated === true) {
	            return 1;
             } else {
	          return $validated;
            }
     }
   function _clear($text){
     return htmlspecialchars(strip_tags($text));
   } 
     function create_user($name,$username,$password,$email,$dicription){
         if(se('register_new_user') == "1"){
             $name = $this->_clear($name);
             $username = $this->_clear($username);
             $password = $this->_clear($password);
             $email = $this->_clear($email); 
             $dicription = $this->_clear($dicription);    
        $check =  $this->validate_user($name,$username,$password,$email,$dicription);
        if($check == 1){
          $er_return =  array();

          $check_username = $this->Check_lastUsername($username);
           if($check_username == 0){
               array_push($er_return,'نام کاربری قبلا گرفته شده');
               $check = 0;
           }

          $check_email = $this->Check_lastEmail($email);
           if($check_email == 0){
               array_push($er_return,'ایمیل قبلا گرفته شده است');
               $check = 0;
           }
              if($check == 0){
                  return $er_return;
              }else{ 
                 $this->db->query("INSERT INTO  td_user(s_full_name,s_username,s_password,s_email,s_reg_in_date,s_reg_in_time,s_lastlog_time,s_state,s_ip,s_dicription) VALUES(:s_full_name,:s_username,:s_password,:s_email,:s_reg_in_date,:s_reg_in_time,:s_lastlog_time,:s_state,:s_ip,:s_dicription)",
                   array("s_full_name"=>$name,
                   "s_username"=>$username,
                   "s_password"=> passwordHash($password),
                   "s_email"=> $email, 
                   "s_lastlog_time"=>time(),
                   "s_ip"=> get_client_ip(),  
                   "s_reg_in_time"=>time(),    
                   "s_reg_in_date"=> jdate('Y-m-d H:i:s'),
                   "s_dicription" => $dicription,
                   "s_state"=> '1'
                   ));
  		           $_SESSION['user_login'] = true; 
		           $_SESSION['user_id'] = $this->db->lastInsertId();;
                  return 'true'; 
              }
        }else{
            return $check;
        }
         }else{
             return 'false'; 
         }
     }
}