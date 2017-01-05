<?php
  require_once(ClASS_DIR.'paginator.class.php'); 
  $pages = new Paginator('10','p');
  $pages->set_total('100000'); 
  $rows =  $db->query("SELECT * FROM td_user ORDER BY id_user DESC");
  $total = count($rows); 
      
  //pass number of records to 
  $pages->set_total($total);    
  $data = $db->query("SELECT * FROM td_user ORDER BY id_user DESC ".$pages->get_limit()); 
  
  if(isset($_GET['delete_id'])){
	 $id =   intval($_GET['delete_id']);
	 $db->query("DELETE FROM td_user WHERE id_user = :id", array("id"=>$id));
	 $db->query("DELETE FROM  td_tiket WHERE tk_user_id = :id", array("id"=>$id));	
	 $db->query("DELETE FROM  td_file WHERE fl_user_id= :id", array("id"=>$id));		 
	 header('location: ?route=manage_user');  
  }
    
 $page_num = "4"; 
 $page_title = "مديريت کاربران";    