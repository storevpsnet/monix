       
	
 
  <div class="col-lg-10" style="padding: 0;">
  
	 <ol class="breadcrumb">
     <li><a href="/">خانه</a></li>
     <li><a href="#" >مدیریت  حساب</a></li>
     <li><a href="?route=setting_account" class="active">ویرایش حساب</a></li>	 
     </ol> 
    
	  <div class="content-page">
	   <h4> ویرایش حساب کاربری </h4>
	   
	   <div class="col-lg-6">
	   <div class="panel panel-default">
  
          <div class="panel-heading">ویرایش کلمه عبور</div>
		   <div class="panel-body">
         <form id="EditPass" action="?" >
           <?csrf_token();?> 
	        <div class="form-group">
            <label> رمز عبور  فعلی</label>
           <input class="form-control" name="my_password" type="text" placeholder="رمز عبور  فعلی را وارد نمایید">
           </div>
	        <div class="form-group">
            <label> رمز عبور جدید</label>
           <input class="form-control" name="password" type="password"  placeholder="رمز  عبور جدید را وارد نمایید">
           </div>
	        <div class="form-group">
            <label> تایپ مجدد رمز عبور</label>
           <input class="form-control" name="re-password" type="password"  placeholder="مجددا رمز  جدید را وارد نمایید">
           </div>
		   
		   <button type="button" onClick="EditMyPassword()" class="btn-chnage_pass btn btn-sm btn-primary">ویرایش رمز  عبور</button>
		   </div>
		   </form>
          </div>
	   </div>
	   
	  <div style="float:right;" class="col-lg-6">
	  	   <div class="panel panel-default">
          <div class="panel-heading">ویرایش اطلاعات کاربری</div>
		   <div class="panel-body">
		            <form id="frm_profile" action="?" >
           <?csrf_token();?> 

	   <div class="form-group">
       <label> نام کامل </label>
       <input class="form-control" name="input_fullname" value="<?=$user['s_full_name'];?>" placeholder="نام خود را وارد نماييد">
      </div>

	   <div class="form-group">
       <label> نام کاربری </label>
       <input class="form-control" name="input_username" value="<?=$user['s_username'];?>" placeholder="نام کاربری را وارد نمایید">
      </div>

	   <div class="form-group">
       <label> ایمیل </label>
       <input class="form-control" type="email" name="email" value="<?=$user['s_email'];?>" placeholder="ایمیل  خود را وارد نمایید">
      </div>
  
	   <div class="form-group">
       <label> توضیحات اضافی</label>
       <textarea class="form-control"  name="input_dicription" placeholder="توضیحات اضافی را وارد نمایید"><?=$user['s_dicription'];?></textarea>
      </div>
	  		   <button type="button" onClick="EditMyprofile()" class="btn_edit_profile btn btn-sm btn-primary">ویرایش اطلاعات کاربری</button>
           </form>
	  </div>
	  </div>
	  
     </div>
	  
	 </div>
	
  </div>