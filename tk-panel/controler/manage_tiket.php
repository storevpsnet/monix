<?php
   $page_num = "3";
   $page_title = "مديريت  درخواست ها";
  require_once(ClASS_DIR.'paginator.class.php');
  
   if($_POST and !empty($_POST['text'])){
	    $text = xss_cleaner(filter($_POST['text']));	
		$search_exploded = explode (" ",$text);
        $x = 0; 
        foreach( $search_exploded as $search_each ) {
             $x++;
             $construct = " ";
             if( $x == 1 )
                    $construct .= "and td_tiket.tk_title LIKE '%$search_each%' OR td_tiket.tk_code LIKE '%$search_each%'  ";
             else
                    $construct .= "and td_tiket.tk_title LIKE '%$search_each%' OR td_tiket.tk_code LIKE '%$search_each%' ";
        }
	}else{
		$construct="";  
	}
	
  if(show_tikets() !== '0' ){
      $where_opera = " and tk_departmen IN (".show_tikets().")";
  }else{
      $where_opera = "";
  } 

  if(isset($_GET['delete_id'])){
    $codes = intval($_GET['delete_id']);
    $db->query("DELETE FROM td_tiket WHERE tk_code = :id", array("id"=> $codes));
    $db->query("DELETE FROM td_file WHERE fl_code = :id", array("id"=> $codes)); 
    header('location:?route=manage_tiket'); 
  }
   if(isset($_GET['state'])){
       $allow = array('1','3','2','4');
       $state = intval($_GET['state']);
       if(in_array($state,$allow)){
         $where_state = "and tk_state=".$state;
          $page_num = "14";
         $page_title = "درخواست های باز";
       }else{
        header('location:?route=manage_tiket');     
       }
   }else{
       $where_state = "";

   }
  $pages = new Paginator('10','p');
  $pages->set_total('100000'); 
  $rows =  $db->query("SELECT * FROM td_tiket 
  INNER JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  LEFT JOIN  td_user ON  td_tiket.tk_user_id = td_user.id_user
  WHERE tk_parent='0' {$where_opera} {$where_state} {$construct}  ORDER BY tk_timestamp_res DESC");
  $total = count($rows); 
    
  //pass number of records to 
  $pages->set_total($total);   
  $data = $db->query("SELECT * FROM td_tiket  
  INNER JOIN td_Department ON td_tiket.tk_departmen = td_Department.id_dep
  LEFT JOIN  td_user ON  td_tiket.tk_user_id = td_user.id_user
  WHERE tk_parent='0' {$where_opera} {$where_state} {$construct} ORDER BY tk_timestamp_res DESC ".$pages->get_limit()); 
 

      

