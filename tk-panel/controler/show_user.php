<?php
  if(isset($_GET['user_id'])){
   $id = intval($_GET['user_id']); 
   $user =  $db->row("SELECT * FROM td_user WHERE id_user = '{$id}' LIMIT 1");
   if(!empty($user['id_user'])){ 
   require_once(ClASS_DIR.'paginator.class.php'); 
   $pages = new Paginator('10','p');
   $pages->set_total('100000');  
  $rows =  $db->query("SELECT * FROM td_tiket 
   INNER JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  LEFT JOIN  td_user ON  td_tiket.tk_user_id = td_user.id_user
  WHERE tk_parent='0' and tk_user_id = '".$id."' ORDER BY tk_timestamp_res DESC");
  $total = count($rows); 
    
  //pass number of records to 
  $pages->set_total($total);     
  $data = $db->query("SELECT * FROM td_tiket  
  INNER JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  LEFT JOIN  td_user ON  td_tiket.tk_user_id = td_user.id_user 
  WHERE tk_parent='0' and tk_user_id = '".$id."' ORDER BY tk_timestamp_res DESC ".$pages->get_limit()); 
     
	 
	 
 $page_num ="12";
 $page_title = "مشاهده اطلاعات کاربر - ";
   }else{
	 header('location: ?route=manage_user');   
   }
  }else{  
	  header('location: ?route=manage_user');
  }
 