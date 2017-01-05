<?php
 $id = intval($_GET['user_id']);
 $opera =  $db->row("SELECT * FROM td_asmin WHERE id_am = :id",array('id'=>$id));
 $Department = $db->query("SELECT id_dep,dep_title FROM td_Department WHERE dep_state = '1' "); 


  require_once(ClASS_DIR.'paginator.class.php'); 
   $pages = new Paginator('5','p');
   $pages->set_total('100000');  
  $rows =  $db->query("SELECT * FROM td_tiket
  INNER JOIN  td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  WHERE td_tiket.tk_parent = '0' and td_tiket.admin_id_res = ".$id); 
  $total = count($rows); 
    
  //pass number of records to 
  $pages->set_total($total);     
  $tiket = $db->query("SELECT * FROM td_tiket
  INNER JOIN  td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  WHERE td_tiket.tk_parent = '0' and td_tiket.admin_id_res = ".$id." ".$pages->get_limit()); 

 $page_num = "15";
 $page_title = "ویرایش اپراتور";  