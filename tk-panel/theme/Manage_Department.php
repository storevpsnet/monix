     <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
                      	     
								  <form method="POST" class="form-inline pull-left" action="?route=Manage_news" role="form">
								   <?php if($text){?> <div class="tags"><div style="margin-top: 1px;" onclick="window.location='?route=Manage_news' " class="tag_remove"><i class="icon-remove"></i></div><label style="font-size: 13px;"><?php if($text){echo $text;}?></label></div> <?php }?>
                                    <div class="form-group">
                                        <input class="form-control" name="text" value="<?php if($text){echo $text;}?>" placeholder="کد،عنوان جهت جس جو " type="text">
                                    </div> 
                                    <button type="submit" class="btn btn-success">جستجو</button>
                                </form>
							  	 
                            </header>
		<div class="panel-body">
		 <div class="row">
		  
	 <div class="col-lg-3">
				  <form id="frm-dep-create" method="POST" >
				  <div class="form-group">
				     <label class="control-label">عنوان دپارتمان</label>
                     <input name="f1" class="form-control" name="text" value="<?php if($id){ echo $row['dep_title'];}?>" placeholder="عنوان دپارتمان را  وارد نمایید " type="text">
                   </div>

				  <div class="form-group">  
				     <label  class="control-label">عنوان دپارتمان</label> 
                     <textarea rows="4"  name="f2" class="form-control" placeholder="توضیح  کوتاه دپارتمان را وارد نمایید "><?php if($id){ echo $row['dep_dicription'];}?></textarea> 
                   </div>   
        
				   <button type="button" data-id="2" onclick="<?php if($id){ echo "edit_department('{$row['id_dep']}');";}else{ echo "create_department();";}?>" class="btn btn-info"><?php if($id){ echo "ویرایش دپارتمان";}else{ echo "ایجاد دپارتمان";}?> </button>
				   <?php if($id){ ?>     
				   <a href="?route=Manage_Department" class="btn btn-warning">انصراف</a> 
				   <?php }?>
				   <button type="reset" class="btn btn-default">از نو</button>
               				   
				 </div>
   
				 
		  <div class="col-lg-9">  
	   <table class="table table-striped table-advance table-hover">
                                <thead>  
                                    <tr>
                                        <th><input type="checkbox" /></th>									
                                        <th>عنوان دپارتمان</th>
                                        <th>تعداد تيکت ها </th>
                                        <th>توضيح کوتاه</th>
                                        <th>وضعيت</th>  
                                        <th>عمليات</th>	 										
                                    </tr>
                                </thead>
                                <tbody>
								 <?php foreach($data as $row){?>
								   <tr class="last_display">
                                        <td><input type="checkbox" /></td>	  								
                                        <td data-id="title-dep-<?=$row['id_dep'];?>" ><?=$row['dep_title'];?></td>
                                        <td>0</td>         
                                        <td ><p data-id="deicription-dep-<?=$row['id_dep'];?>" style="white-space: nowrap; width: 320px;overflow: hidden;height: 20px;text-overflow: ellipsis;"><?=$row['dep_dicription'];?></p></td>	 		
                                        <td><?=states($row['dep_state']);?></td>	  
                                        <td> 
										<a href="" class="btn btn-danger  btn-xs"><i class="icon-trash"></i></a>    
										<a class="btn btn-info  btn-xs" href="?route=Manage_Department&id_edit=<?=$row['id_dep'];?>"><i class="icon-pencil"></i></a>
										</td>	 										
                                    </tr>   
								 <?php }?>
	
	
		                         </tbody> 
                                </table>	   						
	              <?php echo $pages->page_links('?route=Manage_Department&');?>
	             </div> 
				   
			
				</form> 
				</div> <!-- /.row-->    
	     </div>
		 
		 
	     <section>
	   </div>
	   
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

 