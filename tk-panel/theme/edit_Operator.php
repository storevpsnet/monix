      <section id="main-content">
  
       <section class="wrapper">
	
	    <div class="row">  
		
		   <div class="col-lg-3">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                             اطلاعات عمومی اپراتور						
                            </header>
                            <form id="edit_opera_pro" action="?" method="POST" >
                            <div class="panel-body">
                              <div class="form-group">
							       <label>نام اپراتور</label>
                                   <input value="<?=$opera['am_fname'];?>" class="form-control" name="f1"  placeholder="لطفا نام اپراتور را وارد نمایید" type="text">
                              </div>
                              <div class="form-group">
							       <label>نام خانوادگی اپراتور</label>
                                   <input value="<?=$opera['am_lname'];?>" class="form-control" name="f2"  placeholder="لطفا نام اپراتور را وارد نمایید" type="text">
                              </div>
                              <div class="form-group">
							       <label>نام کاربری</label>
                                   <input class="form-control" name="f3" value="<?=$opera['am_username'];?>" placeholder="لطفا نام کاربری اپراتور را وارد کنید" type="text">
                              </div>

                              <div class="form-group">
							       <label>ایمیل</label>
                                   <input class="form-control" name="f4" value="<?=$opera['am_email'];?>" placeholder="لطفا ایمیل اپراتور را وارد نمایید" type="text">
                              </div>
<div class="form-group">  
       <label> نوع مدیریتی </label>
         <select style="padding: 0px 10px;" onchange="change_type_opera_f()" name="f5" class="form-control">
               <option <?php if($opera['am_type'] == "0"){ echo "selected";}?> value="1"> مدیر کل (دسترسی به تمامی امکانات)  </option>
               <option <?php if($opera['am_type'] !== "0"){ echo "selected";}?> value="2"> اپراتور (دسترسی به دپارتمان های مشخص) </option>               
         </select>
       </div> 
        <div class="form-group" <?php if($opera['am_type'] == "0"){  echo 'style="display:none;"';}?> id="select_dep"> 
           <label>انتخاب بخش ها</label>   
           <select multiple="" name="f6[]" class="form-control">
             <?php
               $opera_dep = explode(',',$opera['am_type']);
               foreach($Department as $row) {
               ?>
              <option <?php if(in_array($row['id_dep'],$opera_dep)){ echo "selected";}?>  value="<?=$row['id_dep'];?>"><?=$row['dep_title'];?></option>  
               <?php }?>
            </select> 
           <span class="text-muted"> جهت انتخاب چند بخش کلید CTRL را  نگه دارید سپس بخش مورد نظر را انتخاب نمایید</span>
       </div>
                                     
							   
       <button data-id="edit_pro" onClick="edit_operator(<?=$opera['id_am'];?>)" type="button" class="btn btn-sm btn-info"> ویرایش اطلاعات </button>  
       <a href="#" onclick="confirm_box('آیا از حذف این کارمند اطمینان دارید؟','?route=manage_Operator&delete_id=8');" class="btn btn-danger  btn-sm"><i class="icon-trash"></i></a> 					  		  
                            </div>
                        </section>  
                    </div>
	</form>  
					
			<div class="col-lg-3">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                             ویرایش کلمه عبور							
                            </header>
                            <div class="panel-body">

                              <div class="form-group">
							       <label>رمز عبور جدید</label>
                                   <input class="form-control" name="password" value="" placeholder="رمز عبور جدید را وارد نمایید" type="password">
                              </div>

                              <div class="form-group">
							       <label>تایپ مجدد کلمه عبور</label>
                                   <input class="form-control" name="re-password"  value="" placeholder="مجددا رمز جدید را وارد نمایید" type="password">
                              </div>  
    
							      
							  <button data-id="edit_pass" onClick="edit_pass(<?=$opera['id_am'];?>)" class="btn btn-sm btn-info"> ویرایش کلمه عبور </button> 
							  <button type="reset" class="btn btn-sm btn-default"> از نو </button>								  
                            </div>
                        </section>  
						  
						
                          <section class="panel">
                            <header class="panel-heading">
                             اطلاعات جانبی							
                            </header>
                            <div class="panel-body">
     
                				<div class="form-group">
							      <label> آخرین ورود  :  </label>3 هفته پیش   
                              </div>							  
                            </div>
                        </section>
						
								 
                    </div> 
            
             <div class="col-lg-6">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                              تاپیک های مشترک شده	 (<?=$total;?>)				
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
									

								<?php foreach($tiket as $row){?>
								 <tr>
								    <td>#<?=$row['tk_code'];?>-<?=$row['tk_title'];?></td>
								    <td><?=$row['dep_title'];?></td>
                                    <td><?=ago($row['tk_timestamp_res']);?></td>
                                    <td><?=last_massage($row['tk_last_req']);?></td> 
									<td><?=state_tiket($row['tk_state']);?></td> 
								    <td>   
									 <a href="#" class="btn btn-danger  btn-xs"><i class="icon-trash"></i></a>
								     <a  class="btn btn-info  btn-xs" href="/tk-panel/?route=show_tiket&id=<?=$row['tk_code'];?> "><i class="icon-eye-open"></i></a>  
									</td>									
								 </tr>
								<?php }?>

   
                                    
		                       </tbody> 
                           </table>	   
	                   	  <?php echo $pages->page_links('?route=edit_Operator&user_id='.$id."&");?> 
                            </div>
                        </section>  

								
								 
                    </div>
            
		</div>
		
	
	   </section>
	 </section> 
	 