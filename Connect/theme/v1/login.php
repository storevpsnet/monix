<html>
<head>
  <meta charset="utf-8">
  <title><?=se('site_title');?></title>
   <meta name="viewport" content="width=device-width, minimum-scale=0.25, maximum-scale=1.6, initial-scale=1.0" />
    <link href="<?=THEME_PATH;?>/css/home.css" rel="stylesheet" type="text/css"/>
    <script type="text/javascript" src="<?=THEME_PATH;?>/js/home.js"></script>
			
  </head>
    <body>
	
	
  <div class="box-login main">
     <div class="head box">
	   <p class="texthead"> <?=se('site_title');?> </p> 
	 </div>
  <div class="box_login">

  
       <div id="register" style="display:none;">
	   
	    <div class="form-group"> 
        <h4 class="f-iran"> ايجاد حساب جديد </h4> 
       </div>

	 <form   id="register_user" method="POST" action="?" >
	   <?php csrf_token();?>    
	   <div  ></div>
 
      <div class="form-group">
      <label> نام کامل </label>
      <input class="form-control" name="f1" placeholder="نام خود را وارد نماييد">
      </div>
	  
      <div class="form-group">
      <label> نام کاربري </label>
      <input class="form-control" name="f2" placeholder="نام کاربري  وارد نماييد">
      </div>
       <div class="form-group"> 
       <label> رمز عبور </label>
       <input class="form-control"  name="f3"  type="password"  placeholder="رمز عبور را وارد نماييد">
       </div>
       <div class="form-group"> 
       <label> ايميل </label>
       <input class="form-control" name="f4"  type="email"   placeholder="ايميل  را وارد نماييد">
       </div> 
	
       <div class="form-group"> 
       <label> توضيحات اضافي </label>
       <textarea class="form-control" name="f5" placeholder="توضيحات اضافي "></textarea>
       </div> 
	   
	   
      <button onClick="register_user()" type="button" class="register_btn btn  btn-primary"> ايجاد حساب  </button> 
	    </form> 
	    <label>  حساب کاربري  داريد؟  </label> 
	   <a onclick="$('#register').hide();$('#login').show();"  href="#">ورود به حساب </a> 
	   
	   
	   </div> 
	   
	<div id="login">
	   <div class="form-group">  
        <h4 class="f-iran"> ورود به سيستم </h4> 
       </div>

	 <form  id="login_input" method="POST" action="" >
	   <?php csrf_token();?>   
	   
      <div class="form-group">
      <label> نام کاربري </label>
      <input class="form-control" value="demo" name="input_username" placeholder="نام کاربري  وارد نماييد">
      </div>
       <div class="form-group"> 
       <label> رمز عبور </label>
       <input class="form-control" value="123456" name="input_password" type="password" placeholder="رمز عبور را وارد نماييد">
        </div>
   
     <button onClick="login_send();" type="button" class="btn btn-login btn-primary"> ورود به ناحيه کاربري </button> 
      <?=$setting->send_tiket_ghost();?>
	    </form> 
	    <?=$setting->create_account();?>
     </div>
    
  </div>
 


 </div>
 
 