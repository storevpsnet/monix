<html>
<head>
  <meta charset="utf-8">
  <title><?=se('site_title');?><?php if(isset($page_title)){ echo "|{$page_title}";}?></title>
   <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
    <link href="<?=THEME_PATH;?>/css/home.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=THEME_PATH;?>/js/home.js"></script>
			
  </head>
    <body> 
	
     
	 <div class="main-container">
	 <div class="row" style="margin: 0px;">
	  <div class="side-right col-lg-2">
	   <div class="search-box">
	    <input type="text" placeholder="جستجو..." >
	    <i class="fa fa-search" aria-hidden="true"></i>
	   </div>
	  
	   <ul class="menu-tab active">
     	  <li> <i class="fa fa-tachometer" aria-hidden="true"></i><a href="#"> داشبرد </a> 
		   <ul>
		     <li <?php if(!$page_num){ echo 'class="current"';}?> ><a href="/"> میزکار  </a> </li>
		     <li <?php if(isset($page_num) and $page_num=="1"){ echo 'class="current"';}?>><a href="?route=Create_new_tiket"> ایجاد درخواست جدید </a></li>					 
		   </ul>
	    </li> 
          
	   </ul>
	    

	   <ul class="menu-tab">
     	  <li> <i class="fa fa-ticket" aria-hidden="true"></i><a href="#"> مدیریت درخواست ها </a> 
		   <ul> 
		     <li <?php if(isset($page_num) and $page_num =="5"){ echo 'class="current"';}?>><a href="?route=manage_tiket&open_tiket"> درخواست های باز  </a> </li>
		     <li <?php if(isset($page_num) and $page_num =="4"){ echo 'class="current"';}?>><a href="?route=manage_tiket" > همه درخواست ها </a></li>				 
		   </ul>
	    </li>
         
	   </ul>

	   <ul class="menu-tab">
     	  <li  > <i class="fa fa-cog" aria-hidden="true"></i><a href="#"> مدیریت  حساب </a> 
		   <ul>  
		     <li <?php if(isset($page_num) and $page_num =="6"){ echo 'class="current"';}?>><a href="?route=setting_account"> ویرایش حساب </a> </li>
		   </ul>
	    </li>
         
	   </ul>
	   
	 <ul class="menu-tab">
     	  <li> <i class="fa fa-sign-out" aria-hidden="true"></i> <a href="?logout"> خروج </a> </li>
         
	   </ul>
	   
	   
	 </div> 
	 