     <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
                         مدیریت اپراتور ها
						<a href="javascript:void(0);" data-toggle="modal" data-target="#show_models" class="pull-left btn btn-success"><span class="icon-plus"></span> ایجاد اپراتور جدید </a>
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
                                        <th> مقام </th> 
                                        <th> آخرین ورود </th>  	
                                        <th>وضعيت</th>	  
                                        <th>عمليات</th>	 										
                                    </tr>
                                </thead>
                                <tbody>  
                                 <?php foreach($data as $row){ ?>
                                   <tr>
                                      <td><input type="checkbox" /></td>
                                      <td><?=$row['am_fname']." ".$row['am_lname'];?></td>
                                      <th><?=$row['am_username'];?></th>  
                                      <td><?=type_admin($row['am_type']);?></td>  
                                      <td><?=ago($row['am_lastlogin']);?></td> 
                                      <td><?=state_user($row['am_state']);?></td> 
                                      <td>
                                          <a onclick="confirm_box('آیا از حذف این کارمند اطمینان دارید؟','?route=manage_Operator&amp;delete_id=<?=$row['id_am'];?>');" class="btn btn-danger  btn-xs"><i class="icon-trash"></i></a>
                                          <a class="btn btn-info  btn-xs" href="?route=edit_Operator&amp;user_id=<?=$row['id_am'];?>"><i class="icon-pencil"></i></a>  
                                       </td>  
                                   </tr>
                                    
                                  <?php }?>

	  
	
		                         </tbody> 
                                </table>	     
	       <?php echo $pages->page_links('?route=manage_Operator&');?>
	 
	     </div>
		 
		 
	     <section>
	   </div>
	   
	   <div id="show_models" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">     
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">ایجاد اپراتور جدید</h4>
		
      </div>  
      <div class="modal-body">
	   
	    <form method="POST" id="frm_new_opera" action="">
 
      <div class="form-group">
      <label> نام </label>
      <input class="form-control" name="f1" placeholder="نام را وارد نمایید">
      </div>
	  
      <div class="form-group">
      <label> نام کاربري </label>
      <input class="form-control" onkeyup="check_user_name('asmin','username','[name=f2]')" name="f2" placeholder="نام کاربری"> 
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
       <input class="form-control" onkeyup="check_user_name('asmin','email','[name=f5]')" name="f5" placeholder="ایمیل کاربر" type="email">
       </div> 
   
       <div class="form-group">  
       <label> نوع مدیریتی </label>
         <select style="padding: 0px 10px;" onchange="change_type_opera()" name="f6" class="form-control" >
               <option  value="1"> مدیر کل (دسترسی به تمامی امکانات)  </option>
               <option value="2"> اپراتور (دسترسی به دپارتمان های مشخص) </option>               
         </select>
       </div> 
            
       <div class="form-group" style="display:none;" id="select_dep"> 
           <label>انتخاب بخش ها</label> 
           <select multiple="" name="f7[]" class="form-control">
              <?php foreach($dep as $row){ 
                echo "<option value=".$row['id_dep'].">".$row['dep_title']."</option>";
               }?>
            </select> 
           <span class="text-muted"> جهت انتخاب چند بخش کلید CNTRL را  نگه دارید سپس بخش مورد نظر را انتخاب نمایید</span>
       </div>   
		 
	   </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
	    <button type="button" onclick="create_new_opera()"  data-id="4" class="btn btn-send-message btn-primary">ایجاد اپراتور جدید</button>   
	    </form>   
      </div>   
    </div>

  </div>  
</div>

	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

