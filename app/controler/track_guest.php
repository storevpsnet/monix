 <?php
  if($_SERVER['REQUEST_METHOD'] == "POST") {
    $token = $_POST['CSRF_TOKEN'];   
	 if($security->get($token)) {
      $security->delete($token);   
	   $id_track = intval($_POST['track_code']);    
	   $track = $db->row("SELECT * FROM td_tiket WHERE tk_code = '{$id_track}'  and tk_user_id ='0' ");
	   if(count($track['id_tiket']) > 0){
		  header('location:?Guest&track&show_tiket&tiket_code='.$track['tk_code']);
	   }
	 }else{
		 die('object Moved');  
	 }
  }
  

    if(isset($_GET['show_tiket'])){
   $id = intval($_GET['tiket_code']);   
 $tiket = $db->row("SELECT * FROM td_tiket 
 INNER JOIN td_Department ON td_tiket.tk_departmen =  td_Department.id_dep
 WHERE tk_user_id = '0' and tk_code = '{$id}' and tk_parent ='0' ");  
 $_SESSION['tiket_code'] = $id;
 
 $tiket_all = $db->query("SELECT * FROM td_tiket WHERE tk_user_id = '0'  and tk_parent ='{$id}' ");  
  
   if(count($tiket['id_tiket']) < 1){
	header('location:/');    
    }  
 
	} 