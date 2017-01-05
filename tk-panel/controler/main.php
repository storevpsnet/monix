<?php

  require_once(ClASS_DIR.'paginator.class.php'); 
  if(show_tikets() !== '0' ){
      $where_opera = " and tk_departmen IN (".show_tikets().")";
  }else{
      $where_opera = "";
  } 
  $pages = new Paginator('5','p');
  $pages->set_total('10000'); 
  $rows =  $db->query("SELECT tk_code,tk_title,tk_timestamp_res,tk_last_req,tk_state,dep_title FROM td_tiket 
  LEFT JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep 
  WHERE td_tiket.tk_parent = '0'  and td_tiket.tk_state < 4 {$where_opera} ORDER BY td_tiket.tk_timestamp_res DESC");
  $total = count($rows); 
    
  //pass number of records to 
  $pages->set_total($total);   
  $tiket = $db->query("SELECT tk_code,tk_title,tk_timestamp_res,tk_last_req,tk_state,dep_title  FROM td_tiket 
  LEFT JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep 
  WHERE td_tiket.tk_parent = '0'  and td_tiket.tk_state < 4 {$where_opera} ORDER BY td_tiket.tk_timestamp_res DESC ".$pages->get_limit()); 


 $total_open_tiket =  $db->query("SELECT tk_title FROM td_tiket  WHERE tk_parent = '0'  and tk_state < 4 {$where_opera} "); 
 $total_open_tiket = count($total_open_tiket);
 $total_tiket =  $db->query("SELECT tk_title FROM td_tiket   WHERE tk_parent = '0'  {$where_opera} "); 
 $total_tiket = count($total_tiket);  
 $total_tiket_any =  $db->query("SELECT tk_title FROM td_tiket WHERE tk_parent > 0  {$where_opera} "); 
 $total_tiket_any = count($total_tiket_any);  
 $total_asmin =  $db->query("SELECT am_fname FROM td_asmin "); 
 $total_asmin = count($total_asmin);