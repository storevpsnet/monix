   <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
                      	          مدیریت درخواست ها
								  <form method="POST" class="form-inline pull-left" action="?route=manage_tiket" role="form">
								   <?php if($text){?> <div class="tags"><div style="margin-top: 1px;" onclick="window.location='?route=manage_tiket' " class="tag_remove"><i class="icon-remove"></i></div><label style="font-size: 13px;"><?php if($text){echo $text;}?></label></div> <?php }?>
                                    <div class="form-group">
                                        <input class="form-control" name="text" value="<?php if($text){echo $text;}?>" placeholder="کد،عنوان جهت جس جو " type="text">
                                    </div> 
                                    <button type="submit" class="btn btn-success">جستجو</button>
                                </form>
								 
                            </header>
		<div class="panel-body">
	 <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>
                                        <th><input type="checkbox" /></th>									
                                        <th>موضوع</th>
                                        <th>دپارتمان</th>
                                        <th>توسط</th>
                                        <th>آخرین بروزرسانی</th>  
                                        <th>آخرین پاسخ از</th>		
                                        <th>وضعیت</th>	
                                        <th>عمليات</th>											
                                    </tr>
                                </thead>
                                <tbody>
								
	 <?php  
     foreach($data as $row) {  
	  if(!empty($row['fl_code'])){
	   $img = "../".$row['fl_full_path'];
	  }else{
		$img =  "/tk-panel/theme/img/no-pic.png";  
	  }
	 ?>	 
                 <tr> 
                     <td <?php if($row['tk_state'] =="4"){ echo 'style="width: 0px;background-color: rgb(255, 150, 150)"';}?>><input type="checkbox" /></td>  
                    <td <?php if($row['tk_state'] =="4"){ echo 'style="background-color: rgb(255, 150, 150)"';}?> >#<?=$row['tk_code'];?>-<?=$row['tk_title'];?></td>   
                                        <td><?=$row['dep_title'];?></td>
                                         <td><?php if($row['tk_user_id'] == "0"){ echo "میهمان";}else{ echo $row['s_full_name'];}?></td>
                                        <td><?=ago($row['tk_timestamp_res']);?></td>
                                        <td><?=last_massage($row['tk_last_req']);?></td> 
										<td><?=state_tiket($row['tk_state']);?></td> 
                                        <td>  
										<a onclick="confirm_box('ایا از حذف این درخواست اطمینان دارید؟ با حذف  تیکت تمامی  فایل ها و پیام های مربوط به این درخواست  حذف خواهد شد ','?route=manage_tiket&delete_id=<?=$row['tk_code'];?>');"  href="#" class="btn btn-danger  btn-xs" href="#"><i class="icon-trash"></i></a>
										<a  class="btn btn-info  btn-xs" href="?route=show_tiket&id=<?=$row['tk_code'];?>"><i class="icon-eye-open"></i></a>  
										</td>								   			
                                    </tr>  
            <?php } ?>  
		                 </tbody> 
                     </table>	   
	 <?php echo $pages->page_links('?route=manage_tiket&');?>
	 
	     </div>
		 
		 
	     <section>
	   </div>
	   
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

