    <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
                      	            مدیریت کابران 
  
							  	 <a href="javascript:void(0);" data-toggle="modal" data-target="#show_models" class="pull-left btn btn-success"><span class="icon-plus"></span>  ایجاد کاربر جدید </a>
                            </header>
		<div class="panel-body">
		  
									 <form method="POST" class="form-inline" action="?route=Manage_news" role="form">
								   <?php if($text){?> <div class="tags"><div style="margin-top: 1px;" onclick="window.location='?route=Manage_news' " class="tag_remove"><i class="icon-remove"></i></div><label style="font-size: 13px;"><?php if($text){echo $text;}?></label></div> <?php }?>
                                    <div class="form-group">
                                        <input class="form-control" name="text" value="<?php if($text){echo $text;}?>" placeholder="نام،نام کاربری جهت جستجو" type="text">
                                    </div> 
                                    <button type="submit" class="btn btn-success">جستجو</button>
                                </form>
								
	 <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" /></th>									
                                        <th>نام</th>
                                        <th>نام کاربري</th>
                                        <th>ايميل</th>
                                        <th>اي پي</th>  
                                        <th>تاريخ عوضيت</th>		
                                        <th>وضعيت</th>	
                                        <th>عمليات</th>	 										
                                    </tr>
                                </thead>
                                <tbody>  
								 <?php foreach($data as $row){?>
								   <tr> 
                                        <td><input type="checkbox" /></td>									
                                        <th><?=$row['s_full_name'];?></th>
                                        <td><?=$row['s_username'];?></td>
                                        <td><?=$row['s_email'];?></td>
                                        <td><?=$row['s_ip'];?></td>    
                                        <td><?=ago($row['s_reg_in_time']);?></td>		
                                        <td><?=state_user($row['s_state']);?></td>	
                                        <td> 
										<a onclick="confirm_box('ایا میخواهید این کاربر را  حذف نمایید؟ در صورت حذف کاربر  تمام فایل ها و درخواست های این کاربر  حذف خواهد شد','?route=manage_user&delete_id=<?=$row['id_user'];?>');" class="btn btn-danger  btn-xs"><i class="icon-trash"></i></a>
										<a class="btn btn-info  btn-xs" href="?route=show_user&user_id=<?=$row['id_user'];?>"><i class="icon-pencil"></i></a>
										 
										</td>	 		  		 						 
                                    </tr>  
								 <?php }?>   
	  
	
		                         </tbody> 
                                </table>	   
	 <?php echo $pages->page_links('?route=manage_user&');?>
	 
	     </div>
		 
		 
	     <section>
	   </div>
	   
	   <div id="show_models" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">ایجاد کاربر جدید</h4>
		
      </div>  
      <div class="modal-body">
	  
	    <form method="POST" id="frm_new_user" action="">
 
      <div class="form-group">
      <label> نام کامل </label>
      <input class="form-control" name="f1" placeholder="نام کاربر">
      </div>
	  
      <div class="form-group">
      <label> نام کاربري </label>
      <input class="form-control" name="f2" placeholder="نام کاربری">
      </div>
       <div class="form-group"> 
       <label> رمز عبور </label>
       <input class="form-control"  name="f3" placeholder="رمز عبور" type="password">
       </div>
       <div class="form-group"> 
       <label> تایپ مجدد رمز عبور </label>
       <input class="form-control"  name="f4" placeholder="مجددا رمز  عبور را وارد نمایید" type="password">
       </div>	   
       <div class="form-group"> 
       <label> ايميل </label>
       <input class="form-control"  name="f5" placeholder="ایمیل کاربر" type="email">
       </div> 
	
       <div class="form-group">    
       <label> توضيحات اضافي </label>
       <textarea class="form-control" name="f6" placeholder="توضيحات اضافي "></textarea>
       </div>   
	  
		 
	   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
	    <button type="button" onclick="new_user()"  data-id="3" class="btn btn-send-message btn-primary">ایجاد کاربر</button>
	    </form>  
      </div>   
    </div>

  </div>  
</div>

	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

