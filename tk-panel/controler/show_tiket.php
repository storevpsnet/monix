<?php
  if(show_tikets() !== '0' ){
      $where_opera = " and tk_departmen IN (".show_tikets().")";
  }else{
      $where_opera = "";
  } 

 $id= intval($_GET['id']);        
 $tiket = $db->row("SELECT * FROM td_tiket 
 LEFT JOIN td_user ON td_tiket.tk_user_id = td_user.id_user
 INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
 WHERE  tk_code = '{$id}' and tk_parent ='0' {$where_opera} ");  
 $_SESSION['tiket_code'] = $id;
   
 $tiket_all = $db->query("SELECT * FROM td_tiket 
 LEFT JOIN td_user ON td_tiket.tk_user_id = td_user.id_user 
 WHERE  tk_user_id = '".$tiket['tk_user_id']."' and  tk_parent ='{$id}' ");  
  
 if($tiket['tk_user_id'] !=="0"){
 $tiket_all_user = $db->query("SELECT * FROM td_tiket WHERE  tk_user_id = '".$tiket['tk_user_id']."' and  tk_parent ='0' and tk_state != '4' and tk_code != '".$id."' {$where_opera}  ORDER BY tk_timestamp_res DESC LIMIT 10 ");   
 }
 
  $_SESSION['id_users'] = intval($tiket['tk_user_id']); 
 
 if(count($tiket['id_tiket']) < 1){  
	header('location:/');     
 }
  
 $page_num = "3";     
 $page_title= "نمایش درخواست | ".$tiket['tk_title']; 