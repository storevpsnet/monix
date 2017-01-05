<?php
  
  require_once(ClASS_DIR.'paginator.class.php');
  $pages = new Paginator('10','p');
  $pages->set_total('100000'); 
  $rows =  $db->query("SELECT * FROM td_Department ORDER BY id_dep DESC");
  $total = count($rows); 
  $pages->set_total($total);   
  $data = $db->query("SELECT * FROM td_Department ORDER BY id_dep DESC ".$pages->get_limit()); 
 
 
  if(isset($_GET['id_edit'])){
   $id = intval($_GET['id_edit']);
   $edits = $db->row("SELECT * FROM td_Department WHERE id_dep = '{$id}' LIMIT 1");
   if(!empty($edits['id_dep'])){ 
	   $row = $edits;
    }else{  
	   header('location: ?route=Manage_Department');
    }  
  }
     
 $page_num = "10";
 $page_title = "مدیریت دپارتمان ها";