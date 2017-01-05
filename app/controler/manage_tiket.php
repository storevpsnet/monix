 <?php
  if(!isset($_GET['open_tiket'])){
    $page_num = "4";
    $page_title ="همه درخواست  ها";   
  
    $pages = new Paginator('10','p');
    $pages->set_total('100000'); 
    $rows =  $db->query("SELECT * FROM td_tiket 
    INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
    WHERE tk_user_id = '".$_SESSION['user_id']."'   ORDER BY id_tiket DESC");
     $total = count($rows); 
    
  //pass number of records to 
   $pages->set_total($total);   
   $open_tiket = $db->query("SELECT * FROM td_tiket 
    INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
    WHERE tk_user_id = '".$_SESSION['user_id']."'   ORDER BY id_tiket DESC ".$pages->get_limit()); 

  }else{  
    $pages = new Paginator('10','p');
    $pages->set_total('100000'); 
    $rows =  $db->query("SELECT * FROM td_tiket 
    INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
    WHERE tk_user_id = '".$_SESSION['user_id']."' and tk_state !='4'  ORDER BY id_tiket DESC");
     $total = count($rows); 
    
  //pass number of records to 
   $pages->set_total($total);   
   $open_tiket = $db->query("SELECT * FROM td_tiket 
    INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
    WHERE tk_user_id = '".$_SESSION['user_id']."' and tk_state !='4'  ORDER BY id_tiket DESC ".$pages->get_limit()); 

    $page_num = "5";
    $page_title ="درخواست های باز";   	
  }
 