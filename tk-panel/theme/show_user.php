     <section id="main-content">
  
       <section class="wrapper">
	
	    <div class="row">
		
		   <div class="col-lg-3">  
                        <!--progress bar start-->
                        <section class="panel">
                        <form id="edit_user_pro" action="?" >
                            <header class="panel-heading">
                             اطلاعات عمومی کاربر 							
                            </header>
                            <div class="panel-body">
                              <div class="form-group">
							       <label>نام کاربر</label>
                                   <input class="form-control" name="f1" value="<?=$user['s_full_name'];?>" placeholder="نام کاربر را وارد نمایید" type="text">
                              </div>
							  
                              <div class="form-group">
							       <label>نام کاربری</label>
                                   <input class="form-control" name="f2" value="<?=$user['s_username'];?>" placeholder="نام کاربری کاربر را وارد نمایید" type="text">
                              </div>

                              <div class="form-group">
							       <label>ایمیل</label>
                                   <input class="form-control" name="f3" value="<?=$user['s_email'];?>" placeholder="ایمیل کاربر را وارد نمایید" type="text">
                              </div>

                              <div class="form-group"> 
							       <label>توضیحات اضافی</label>
                                   <textarea class="form-control" name="f4" rows="4" placeholder="توضیحات اضافی  کاربر"><?=$user['s_dicription'];?></textarea>  
                              </div>    
							   
							  <button onClick="edit_user('<?=$user['id_user'];?>')" type="button" data-id="edit_pro" class="btn btn-sm btn-info"> ویرایش اطلاعات </button> 
							  <button type="reset" class="btn btn-sm btn-default"> از نو </button>	 
                              <a href="" class="btn btn-danger  btn-sm"><i class="icon-trash"></i></a> 					  		  
                            </div>
                            </form> 
                        </section>  
                    </div>
		
		   <div class="col-lg-3">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                             ویرایش کلمه عبور							
                            </header>
                            <div class="panel-body">

                              <div class="form-group">
							       <label>رمز عبور جدید</label>
                                   <input class="form-control" name="password" value="" placeholder="رمز عبور را وارد نمایید" type="password">
                              </div>

                              <div class="form-group">
							       <label>تایپ مجدد کلمه عبور</label>
                                   <input class="form-control" name="re-password" value="" placeholder="مجدد رمز عبور را وارد نمایید" type="text">
                              </div>  
    
							      
							  <button  data-id="edit_pass"  onClick="edit_pass_user('<?=$user['id_user'];?>')" class="btn btn-sm btn-info"> ویرایش کلمه عبور </button> 
							  <button type="reset" class="btn btn-sm btn-default"> از نو </button>								  
                            </div>
                        </section>  
						
						<div class=" state-overview">
                                    <section class="panel">
                                        <div class="symbol red">
                                            <i class="icon-tags"></i>
                                        </div>
                                        <div class="value">
                                            <h1><?=$total;?></h1>
                                            <p>تعداد  کل درخواست ها</p> 
                                        </div>
                                    </section>
                         </div>
						
                          <section class="panel">
                            <header class="panel-heading">
                             اطلاعات جانبی							
                            </header>
                            <div class="panel-body">
                				<div class="form-group">
							      <label> ای پی ادرس  :  </label> <?=$user['s_ip'];?> 
                              </div>
                				<div class="form-group">  
							      <label> تاریخ عضویت  :  </label> <?=str_replace(' ','@',substr($user['s_reg_in_date'],0,16));?></br>   - <?=ago($user['s_reg_in_time']);?>
                              </div>    
                				<div class="form-group">
							      <label> آخرین ورود  :  </label><?=ago($user['s_lastlog_time']);?>  
                              </div>							  
                            </div>
                        </section>
						
								 
                    </div>
					
					   <div class="col-lg-6">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                              درخواست ها							
                            </header>
                            <div class="panel-body">
 
                              <table class="table table-striped table-advance table-hover">
                                <thead> 
                                    <tr>								
                                        <th>موضوع</th>  
                                        <th>دپارتمان</th>
                                        <th>آخرین بروزرسانی</th>  
                                        <th>آخرین پاسخ از</th>		
                                        <th>وضعیت</th>  	
                                        <th>عمليات</th>											
                                    </tr>
                                </thead>
                                <tbody>
								<?php foreach($data as $row){?>
								 <tr>
								    <td>#<?=$row['tk_code'];?>-<?=$row['tk_title'];?></td>
								    <td><?=$row['dep_title'];?></td>
                                    <td><?=ago($row['tk_timestamp_res']);?></td>
                                    <td><?=last_massage($row['tk_last_req']);?></td> 
									<td><?=state_tiket($row['tk_state']);?></td> 
								    <td>   
									 <a href="" class="btn btn-danger  btn-xs" href="#"><i class="icon-trash"></i></a>
								     <a  class="btn btn-info  btn-xs" href="?route=show_tiket&id=<?=$row['tk_code'];?>"><i class="icon-eye-open"></i></a>  
									</td>									
								 </tr>
								<?php }?>

		                       </tbody> 
                           </table>	   
	                   <?php echo $pages->page_links('?route=show_user&');?>
	 
                            </div>
                        </section>  

								
								 
                    </div>

					
		</div>
		
	
	   </section>
	 </section> 
	 