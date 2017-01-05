<section id="main-content">
            <section class="wrapper">
			

<div class="col-lg-12">
                        <section class="panel">
                  
                            <div class="panel-body">

                                <form autocomplete="on" id="tkf_setting_account" action="?route=setting_account" 
								method="POST" role="form">

								<section class="panel">
                            <header class="panel-heading tab-bg-dark-navy-blue ">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#home"><i class="icon-user"></i> اطلاعات حساب</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#notfication"><i class="icon-bullhorn"></i> اعلان ها</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#private"><i class="icon-umbrella"></i> حریم خصوصی</a>
                                    </li>
                                    <li class="">
                                        <a data-toggle="tab" href="#support"><i class="icon-question-sign"></i> پشتیبانی</a>
                                    </li>
                                </ul>
                            </header>
                            <div class="panel-body">
                                <div class="tab-content">
                                    <div id="home" class="tab-pane active">
                                                                
								    <div class="row">
									
							<div class="col-lg-6">	
								   <div class="form-inline">
                                      <div class="form-group">
                                        <label>نام خانوادگی </label>
                                        <input class="form-control" name="tkf$(f$name_inputs)" value="<?php  echo $users['2'];?>" type="text">
                                       </div>
                                         <div class="col-lg-6 form-group">
                                         <label>نام</label>
                                         <input class="form-control" name="tkf$(l$name_inputs)"  value="<?php  echo $users['1'];?>" type="text">
                                        </div>				  
			  		                </div>
							 <div class="col-lg-12">
                                    <div class="form-group">
                                        <label>رایانامه (E-mail)</label>
                                        <input class=" form-control"  name="tkf$(E$mail_inputs)"  value="<?php  echo $users['8'];?>" placeholder="رایانامه خود را وارد  نمایید" type="email">
                                    </div>
								
								         <div class="form-group">
                                        <label>شماره همراه : (Cell-phone)</label>
                                        <input class=" form-control"  name="tkf$(tell$phone_inputs)"  value="<?php  echo $users['9'];?>" placeholder="رایانامه خود را وارد  نمایید" type="email">
                                         </div>
									
									<div class="form-group">
                                            <label>توضیحات :</label>
                                                <textarea  name="tkf$(decription$input)"  placeholder="حد اکثر : 1000 کاراکتر" class="form-control" cols="60" rows="5"><?php  echo $users['10'];?></textarea>
                                        </div>
										
								 </div><!-- /.col -->
								        </div><!-- /.col -->
										
										
										
										    <div class="col-lg-3">
										
									   <div class="form-group">
                                        <label>نام کاربری </label>
                                        <input class=" form-control"  name="tkf$(user$name_inputs)"   value="<?php  echo $users['11'];?>"  type="text">
                                         </div>
										 
										 
									   <div class="form-group">
                                        <label>رمز عبور فعلی </label>
                                        <input   value="" name="tkf$(pass$word_inputs)"  class="form-control" placeholder="رمز عبوری که با آن وارد شدید" type="password">
                                         </div>
										 
									    <div class="form-group">
                                        <label>رمز عبور جدید </label>
                                        <input class=" form-control" name="tkf$(new$pass$word_inputs)"  placeholder="رمز عبور قدرتمند استفاده نمایید" type="password">
                                         </div>
										 
								     <div class="form-group">
                                        <label>تایپ مجدد رمز عبور </label>
                                        <input class=" form-control" name="tkf$(re$pass$word_inputs)" placeholder="رمز عبور قدرتمند استفاده نمایید" type="password">
                                         </div>
										 
										<div style="text-align: justify;" class="alert alert-info fade in">
                                          <strong>توجه!</strong></br>
										  اگر شما نیاز به تغییر کلمه عبور  دارید فیلد های بالا را تکمیل  نمایید در غیر اینصورت نیازی به تکمیل  نمودن فیلد های بالا  نمیباشد.
                                        </div>
								
										     </div><!-- /.col -->
											 
									<div class="col-lg-3">
											<table class="table">
											    <tbody>
                                    <tr>
                                        <th>وضعیت حساب کاربری :</th>
                                        <td><?php  echo check_state($users['5']);?></td>
                                    </tr> 
									  <tr>
                                        <th>آخرین ورود :</th>
                                        <td><?php  echo ago($users['13']);?></td>
                                    </tr> 
									   <tr>
                                        <th>آخرین خروج :</th>
                                        <td><?php  echo ago($users['14']);?></td>
                                    </tr> 
																		   <tr>
                                        <th>ای پی لاگ:</th>
                                        <td><?php  echo $users['17'];?></td>
                                    </tr> 
								   <tr>
                                        <th style="display: inherit;">تصویر حساب کاربری :</th>
                                        <td class="profile_image" > <?php
										     if(get_file_upload('settings_other',$users['4'],$con) =="0"){
  												 echo '<img  src="/auth/user/theme/img/no-image.png" />';
											  }else{ 
											    $img = get_file_upload('settings_other',$users['4'],$con);
												$url = hashimage($img['8']);
											    echo '<img src="'.$url.'" />';
												}
												?></td>
                                    </tr> 
									
                                </tbody>
                                             </table>
											  
											  <div class="form-group">
                                        <label for="exampleInputFile">ویرایش تصویر کاربری</label>
                                        <input name="file" id="exampleInputFile" type="file">
                                        <p class="help-block">حد اکثر حجم مجاز :  90KB </br> پسوند  های  مجاز : .jpg,.png,.jpeg</p>
                                    </div>
									
                                    </div> <!-- /.col -->
									
                                           </div> <!-- /.row -->
										
										 </div> <!-- /#home -->
										 
								               <div id="notfication" class="tab-pane">
											     
												 <table class="table">
												 <thead> 
												   <th>اطلاع از </th>
												   <th>نحوه اطلاع رسانی </th>
												   <th style="text-align: left;">وضعیت </th>												   
												  </thead>
												  
											    <tbody>
												 
                                    <tr>
                                        <th> ایجاد فاکتور  جدید</th>
                                        <td>
										   <a  class="btn btn-xs  btn-success">پیامک</a>
							               </td>
									    <td>
                                            <input name="tkf(%f$1)" class="magic-checkbox" <?php if($nt['2']=="1"){echo "checked";}?> name="radio" id="1" value="1" type="checkbox">
                                            <label for="1"></label>  
												 </td>
                                    </tr> 
									
						            <tr>
                                        <th> تمدید سرویس</th>
                                        <td>
										   <a  class="btn btn-xs  btn-success">پیامک </a>
							               </td>
									    <td>
                                            <input  name="tkf(%f$2)" class="magic-checkbox" <?php if($nt['3']=="1"){echo "checked";}?> name="radio" id="2" value="1" type="checkbox">
                                            <label for="2"></label>  
												 </td>
                                    </tr> 
									
								   <tr>
                                        <th>فاکتور ماهانه</th>
                                        <td>
										   <a  class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									    <td>
                                            <input name="tkf(%f$3)" class="magic-checkbox"  <?php if($nt['4']=="1"){echo "checked";}?> name="radio" id="3" value="1"  type="checkbox">
                                            <label for="3"></label>  
												 </td>
                                    </tr> 
									
									<tr>
                                        <th>پاسخ به تیکت</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$4)" class="magic-checkbox"  <?php if($nt['5']=="1"){echo "checked";}?> name="radio" id="4" value="1"  type="checkbox">
                                                 <label for="4"></label>  
												 </td>
                                      </tr> 
									
									
																		<tr>
                                        <th>بسته شده تیکت</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$5)" class="magic-checkbox"  <?php if($nt['6']=="1"){echo "checked";}?> name="radio" id="5"  value="1"  type="checkbox">
                                                 <label for="5"></label>  
												 </td>
                                      </tr> 
									  
									  <tr>
                                        <th>فعال شدن سرویس</th>
                                          <td>
										   <a class="btn btn-xs  btn-success">پیامک</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$6)" class="magic-checkbox"  <?php if($nt['7']=="1"){echo "checked";}?> name="radio" id="6"  value="1"  type="checkbox">
                                                 <label for="6"></label>  
												 </td>
                                      </tr> 
									  
									   <tr>
                                        <th>حذف شدن سرویس</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$7)" class="magic-checkbox"  <?php if($nt['8']=="1"){echo "checked";}?> name="radio" id="7"  value="1"  type="checkbox">
                                                 <label for="7"></label>  
								 				 </td>
                                         </tr> 
									  
									   <tr>
                                        <th>لغو شدن سرویس</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$8)" class="magic-checkbox"  <?php if($nt['9']=="1"){echo "checked";}?> name="radio" id="8"  value="1"  type="checkbox">
                                                 <label for="8"></label>  
								 				 </td>
                                         </tr> 
										 
										 									   <tr>
                                        <th>دریافت  پیام خصوصی  جدید</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$9)" class="magic-checkbox"  <?php if($nt['10']=="1"){echo "checked";}?> name="radio" id="9"  value="1"  type="checkbox">
                                                 <label for="9"></label>  
								 				 </td>
                                         </tr> 
										 
								  <tr>
                                        <th>ایجاد اطلاعیه جدید</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$10)" class="magic-checkbox"  <?php if($nt['11']=="1"){echo "checked";}?> name="radio" id="10"  value="1"  type="checkbox">
                                                 <label for="10"></label>  
								 				 </td>
                                         </tr> 
								  <tr>
                                        <th>ورود به حساب</th>
                                          <td>
										   <a class="btn btn-xs  btn-warning">ایمیل</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$11)" class="magic-checkbox"  <?php if($nt['12']=="1"){echo "checked";}?> name="radio" id="11" value="1"  type="checkbox">
                                                 <label for="11"></label>  
								 				 </td>
                                         </tr> 							 
									
								  <tr>
                                        <th>تغییر  کلمه عبور</th>
                                          <td>
										   <a class="btn btn-xs  btn-success">پیامک</a>
							               </td>
									             <td>
                                                 <input  name="tkf(%f$12)" class="magic-checkbox"  <?php if($nt['13']=="1"){echo "checked";}?> name="radio" id="12" value="1"  type="checkbox">
                                                 <label for="12"></label>  
								 				 </td>
                                         </tr> 	
										 
                                </tbody>
                                             </table>
											 
											   </div><!-- /#notfication -->
											   
                 
				 							 <div id="private" class="tab-pane">
											    <div class="panel-group m-bot20" id="accordion">
                            <div class="panel panel-default">
                                <div style="background-color: rgb(73, 213, 169);" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a style="font-family: yekan;" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">مفهوم حریم خصوصی
                                      </a>
                                    </h4>
                                </div>
                                <div style="height: 0px;" id="collapseOne" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        حریم شخصی یا حریم خصوصی یعنی یک فرد یا گروه بتواند خود و یا اطلاعات مربوط به خود را مجزا کند و در نتیجه بتواند خود و یا اطلاعاتش را با انتخاب خویش در برابر دیگران آشکار کند. مرزها و محتوای آنچه خصوصی قلداد می‌شود در میان فرهنگ‌ها و اشخاص متفاوت است، اما تم اصلی آنها مشترک است. </br>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div style="background-color: rgb(73, 213, 169);" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a style="font-family: yekan;" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">حریم خصوصی اطلاعاتی
                                      </a>
                                    </h4>
                                </div>
                                <div id="collapseTwo" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        حریم خصوصی اطلاعاتی یا داده‌ای (یا حفاظت داده‌ها)، رابطه‌ای است بین جمع‌آوری و توزیع داده‌ها، تکنولوژی، انتظار عمومی از حریم خصوصی و مسائل قانونی و سیاسی در ارتباط با آنها است. نگرانی‌ها در مورد حریم خصوصی، در هنگام جمع‌آوری و نگهداری به صورت دیجیتال یا غیر دیجیتال داده‌ها و اطلاعاتی که فردی را به صورت خاص بازشناساند، خود را نشان می‌دهد. ریشه و اساس مشکل حریم خصوصی مربوط به افشاگری نامناسب و بدون کنترل داده‌های شخصی است. مشکلات حریم خصوصی اطلاعاتی در حقیقت مربوط به منابع مختلف و متنوع داده‌ها و اطلاعات می‌باشد.
                                 
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div style="background-color: rgb(73, 213, 169);" class="panel-heading">
                                    <h4 class="panel-title">
                                        <a style="font-family: yekan;" class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
										  حریم خصوصی  من در شرکت طراحی نوین شمال 
                                      </a>
                                    </h4>
                                </div>
                                <div id="collapseThree" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                 
                                    </div>
                                </div>
                            </div>
                        </div>

											   </div><!-- /#private -->
											   
											  <div id="support" class="tab-pane">
											  
									 <div class="alert alert-info fade in">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="icon-remove"></i>
                                    </button>
                                    <strong>پشتیبانی  24  ساعته از طریق  تیکت</strong></br>
									 پشتیبانی شرکت طراحی نوین شمال بصورت  24 ساعته در تمامی ایام هفته میباشد بصورت  تیکت چه در ایام تعطیل
                                </div>
								
								<div class="alert alert-success fade in">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="icon-remove"></i>
                                    </button>
                                    <strong>پشتیبانی آنلاین</strong> </br>
									 پشتیبانی آنلاین تنها در روز  های کاری صورت میگیرد بصورت 24 ساعته  که شما میتوانید با  انتخاب بخش  مورد نظر با  کارشناسان آن بخش  گفتگو نمایید  و به  حل مشکلات خود بپردازید
                             
                                </div>
								
								<div class="alert alert-warning fade in">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="icon-remove"></i>
                                    </button>
                                    <strong>پشتیبانی فوری (تلفنی)</strong> </br>
									شما میتوانید در تمامی ایام هفته چه در روز  های  تعطیل  و غیر کاری با شماره تماس  ذیل جهت مشاوره و یا  پشتیبانی  تماس  حاصل فرمایید تا در  کمترین زمان  ممکن مششکل شما رفع  گردد  توجه داشته باشید  <strong> تنها برای  موارد فوری با واحد پشتیبانی تماس  حاصل فرمایید</strong>
									همچنین شما  میتوانید در روز های  کاری با شماه ذیل   جهت رفع مشکلات  و یا  مشاوره تماس  حاصل فرمایید . 
                             
                                </div>
								<div class="alert alert-block alert-danger fade in">
                                    <button data-dismiss="alert" class="close close-sm" type="button">
                                        <i class="icon-remove"></i>
                                    </button>
                                    <strong>واحد پشتیبانی  حضوری </strong> </br>
 									در صورتی  که نیازمند  عقد قرار داد بصورت  حضوری میباشید و یا نیاز به پشتیبانی  داشته اید  که بصورت آنلاین رفع  نگردیده  است میتوانید در روز  های  کاری  به  آدرس  زیر  مراجعه فرمایید . </br>
									مازندران -  
                             
                                </div>
								
											   </div><!-- /#support -->
											   
								       </div>
                            </div>
                        </section>
								  
                                    <button onClick="save_data('tkf_setting_account');return false;" type="button" class="btn btn-info">ذخیره اطلاعات</button>
                                </form>

                            </div>
                        </section>
                    </div>
					
					
        </section>
		<style>
		 .profile_image > img{
		   width: 128px;
           height: 128px;
		   border-radius: 50%;
           padding: 5px;
           border: 1px solid rgb(221, 221, 221);
		 }
		 .profile_image > img:hover{
		   padding: 0px;
		   border: 1px solid rgb(54, 230, 0);
		 }
		 		</style>
</section>			