<?php
 $id= intval($_GET['tiket_code']);       
 $tiket = $db->row("SELECT * FROM td_tiket 
 INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
 WHERE tk_user_id = '".$_SESSION['user_id']."' and tk_code = '{$id}' and tk_parent ='0' ");  
 $_SESSION['tiket_code'] = $id;
 
 $tiket_all = $db->query("SELECT * FROM td_tiket WHERE tk_user_id = '".$_SESSION['user_id']."'  and tk_parent ='{$id}' ");  
 
 if(count($tiket['id_tiket']) < 1){
	header('location:/');   
 }
 $page_num= "3";
 $page_title =" نمايش درخواست ".$tiket['tk_title']; 
 