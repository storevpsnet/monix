<?php

  require_once(ClASS_DIR.'paginator.class.php'); 
  $pages = new Paginator('10','p');
  $pages->set_total('100000'); 
  $rows =  $db->query("SELECT * FROM td_asmin ORDER BY id_am DESC");
  $total = count($rows); 
      
  //pass number of records to 
  $pages->set_total($total);     
  $data = $db->query("SELECT * FROM td_asmin ORDER BY id_am DESC ".$pages->get_limit()); 
  

  $dep =  $db->query("SELECT * FROM td_Department WHERE dep_state = '1' ORDER BY id_dep  DESC"); 
  
  if(isset($_GET['delete_id'])){
    $id = intval($_GET['delete_id']);
    $db->query("DELETE FROM td_asmin WHERE id_am = :id", array("id"=>$id)); 
    header('location: /tk-panel/?route=manage_Operator');    
  }
 $page_num = "15";
 $page_title = "مدیریت اپراتور ها";    