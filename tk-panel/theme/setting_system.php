   <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 <form action="/tk-panel/?route=setting_system" method="POST">
		 <header class="panel-heading"> 
                      	     <?=$page_title;?>	
                                   <div class="pull-left">
                                       <button class="btn btn-success" type="submit">بروزرسانی تنظیمات</button>
                                   </div> 
                            </header>
		<div class="panel-body">
	          <!--- GENERAL SETTING -->
	         <div class="row">
                  
                 <div class="col-lg-6">
                     <h4 style="font-family: yekan;border-bottom: 1px solid #ddd;padding-bottom: 10px;color: #ff3f00;font-size: 16px;">تنظیمات اصلی</h4>
                     <div class="form-group">
                         <label> عنوان سیستم</label>
                         <input name="f1"  type="text" class="form-control" value="<?=se('site_title');?>" placeholder="عنوان سایت را وارد کنید">
                         <span class="text-muted">عنوان سیستم در  قسمت  تایتل سایت  نمایش داده میشود</span>
                     </div>

                     <div class="form-group">
                         <label>حداکثر حجم پیوست فایل</label>
                         <input name="f2"  type="text" class="form-control" value="<?=se('max_len_file');?>" placeholder="حداکثر حجم پیوست فایل را وارد نمایید">
                         <span class="text-muted">حجم را بصورت  بایت وارد نمایید،هر بایت 1024 بیت است</span>
                     </div>
                     <div class="row">
                     <div class="form-group col-lg-6">
                         <input  name="f3" value="1" <?php if(se('send_tiket_goust') == "1"){ echo "checked";}?> type="checkbox" />
                         <label>ارسال تیکت مهمان (فعال)</label></br>
                         <span class="text-muted">اگر تیک خورده باشد مهمان میتواند تیکت ارسال  نماید</span>
                     </div>

                     <div class="form-group col-lg-6">
                         <input name="f4" value="1" <?php if(se('register_new_user') == "1"){ echo "checked";}?> type="checkbox" />
                         <label>عضویت کاربران (فعال)</label></br>
                         <span class="text-muted">اگر تیک خورده باشد کاربر میتواند عضو سیستم شود</span>
                     </div>
                    </div>
              <h4 style="font-family: yekan;border-bottom: 1px solid #ddd;padding-bottom: 10px;color: #ff3f00;font-size: 16px;">محدودیت ها </h4> 
                     <div class="row">
                     <div class="form-group col-lg-6">
                         <label> حداقل طول رمز عبور </label>
                         <input name="f5"  type="text" value="<?=se('min_len_pass');?>" class="form-control" placeholder="بصورت  عددی  وارد کنید">
                         <span class="text-muted">حداقل طول رمز عبور برای حساب کاربری</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label> حد اکثر طول رمز عبور </label>
                         <input name="f6"  type="text" value="<?=se('max_len_pass');?>" class="form-control" placeholder="بصورت  عددی  وارد کنید">
                         <span class="text-muted">حداکثر طول رمز عبور برای حساب کاربری</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label>حد اقل طول نام کاربری</label>
                         <input name="f7"  type="text" value="<?=se('min_len_username');?>" class="form-control" placeholder="بصورت  عددی  وارد کنید ">
                         <span class="text-muted">حد اقل طول  نام کاربری در ایجاد حساب</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label>حداکثر طول نام کاربری</label>
                         <input name="f8"  type="text" value="<?=se('max_len_username');?>" class="form-control" placeholder="بصورت  عددی  وارد کنید ">
                         <span class="text-muted">حداکثر طول  نام کاربری در ایجاد حساب</span>
                     </div>

                  </div> <!-- ./row -->
                     <div class="form-group">
                         <label>حداکثر طول توضیحات اضافی</label>
                         <input name="f9"  type="text"  value="<?=se('max_len_dicirption_user');?>" class="form-control" placeholder="بصورت  عددی  وارد کنید ">
                         <span class="text-muted">حداکثر طول توضیحات اضافی</span>
                     </div>

                 </div>

                 <div class="col-lg-6">
 
                      <h4 style="font-family: yekan;border-bottom: 1px solid #ddd;padding-bottom: 10px;color: #ff3f00;font-size: 16px;"> تنظیمات ایمیل </h4>
                     <div class="form-group">
                         <label> ایمیل مدیریت </label>
                         <input name="f10"  type="text"  value="<?=se('admin_email');?>"  class="form-control" placeholder="عنوان سایت را وارد کنید">
                         <span class="text-muted">تمامی پاسخ  ها و تیکت های  جدید به این ایمیل  ارسال میشود</span>
                     </div>
           
                      <div class="form-group">
                         <input name="f11"  value="1" <?php if(se('mail_stamp') == "1"){ echo "checked";}?>  type="checkbox" />
                         <label>ارسال ایمیل از طریق  SMTP </label></br>
                         <span class="text-muted">اگر تیکت خورده باشد فعال است ، شما باید پس از فعال  کردن اطلاعات زیر را تکمیل  نمایید</span>
                     </div>
 
                   <div class="row" style="border: 1px solid #ddd;border-radius: 5px;padding: 5px;">
                     <div class="form-group col-lg-6">
                         <label> نام کاربری </label>
                         <input name="f12" style="direction:ltr;text-align:left;"  type="text" value="<?=se('SMTP_username');?>" class="form-control" placeholder="نام کاربری ورود به SMTP">
                         <span class="text-muted">نام کاربری را  وارد نمایید ضروری میباشد</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label> رمز عبور </label>
                         <input name="f13" style="direction:ltr;text-align:left;"  type="password" value="<?=se('SMTP_password');?>" class="form-control" placeholder="رمز عبور ورود به SMTP">
                         <span class="text-muted">رمز عبور ضروری میباشد باید وارد نمایید</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label>پرت SMTP</label>
                         <input name="f14" type="text" style="direction:ltr;text-align:left;"  value="<?=se('SMTP_port');?>" class="form-control" placeholder="بصورت عددی میباشد">
                         <span class="text-muted">لطفا Port را وارد نمایید</span>
                     </div>
                     <div class="form-group col-lg-6">
                         <label>HOST</label>
                         <textarea name="f15"  class="form-control" style="direction:ltr;text-align:left;" placeholder="لطفا با نقطه ویرگول (;) از  هم جدا نمایید"><?=se('SMTP_HOST');?></textarea>
                         <span class="text-muted">آدرس HOST و با نقطه ویرگول (;) از هم جدا  نمایید</span>
                     </div>

                  </div> <!-- ./row -->

                  </div>
 
              </div> <!-- ./row -->
	     </div>
		  </form>
		 
	     <section>
	   </div>
	   
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

