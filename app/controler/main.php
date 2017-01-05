<?php
 $open_tiket = $db->query("SELECT * FROM td_tiket 
 INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
 WHERE tk_user_id = '".$_SESSION['user_id']."' and  tk_state != '4' and dep_state = '1' ORDER BY tk_timestamp_res DESC LIMIT 0,10"); 

 $all_request = counter("SELECT id_tiket FROM td_tiket WHERE tk_parent='0' and tk_user_id='".$_SESSION['user_id']."' ");   
 $open_request_total = counter("SELECT id_tiket FROM td_tiket WHERE tk_parent='0' and tk_user_id='".$_SESSION['user_id']."' and tk_state !='4' ");   
 $close_request_total = counter("SELECT id_tiket FROM td_tiket WHERE tk_parent='0' and tk_user_id='".$_SESSION['user_id']."' and tk_state ='4' ");   