<?php

  $query = "SELECT * FROM `td_user_notfication`  WHERE `nt_user_id`='".$_SESSION['user_id']."'  LIMIT 1 ";
  $nt = selects($con,$query,'no_while');
  
 


 $page_num = "1";
 $page_title = "تنظیمات حساب  کاربری";