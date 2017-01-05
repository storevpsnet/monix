     <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-8">
          <section class="panel">
		 <header class="panel-heading"> 
                            نمایش درخواست  
                            </header> 
              
		    <div class="panel-body">
	      
	 <table class="table">
     <thead>
     <tr> 
	  <th>کد - موضوع</th> 
	  <th>دپارتمان</th> 
	  <th>اخرین بروزرسانی</th> 	  
	  <th>آخرین پاسخ از</th> 	
	  <th>وضعیت</th> 	  			  
	  </tr> 
	  </thead>   
	  <tbody> 
 
		 <tr>
		    <td class="fa-number"><a class="btn btn-xs btn-primary" href="?route=show_tiket&tiket_code=<?=$tiket['tk_code'];?>"><?=$tiket['tk_code']."#-".$tiket['tk_title'];?></a></td>
		    <td  class="fa-number"><?=$tiket['dep_title'];?></td>
		    <td  class="fa-number"><?=ago($tiket['tk_timestamp_res']);?></td> 
		    <td ><?=last_massage($tiket['tk_last_req']);?></td> 			
		    <td ><?=state_tiket($tiket['tk_state']);?></td>  		
         </tr>		 
		   

	  </tbody> 
	  </table>
	  
                
           	  <div class="tiket_parent">
	   <div class="icon-user">
	   <i class="fa fa-user" aria-hidden="true"></i>
	   </div> 
	   <div class="type-sender">  <?=last_massage_nocolor($tiket['tk_last_req']);?> </div>
	   <div class="panel-content">
	   <div class="started"> مشکل </div>
	    <p> 
		  <strong> <?php if($tiket['tk_user_id'] !== 0) { echo $tiket['s_full_name'];}else{ echo "میهمان";} ?>   </strong></br>  
		  <span class="fa-number" style="font-size: 12px;color: #989898;"> <?=$tiket['tk_date_in'];?></span> - <label class="fa-number" style="font-size: 12px;color: #989898;"> <?=ago($tiket['tk_timestamp_in']);?></label>  </span>  
	    </p>  
		 <p>
		      <?php
               $lines = explode("\n", $tiket['tk_massage']);
               foreach( $lines as  $line )
               {
                echo $line . '<br/>';
                 }
               ?>
		 </p> 
		 <p>
		  <?php if($tiket['file'] !=="0"){
			 $file = get_file($tiket['tk_code']); 
			  if($file !== "0"){
		   ?> 
		   <a id="file-<?=$file['id_fl'];?>" onClick="download_file('<?=$file['id_fl'];?>','<?=$file['fl_filename'];?>')" class="donwload-btn btn btn-xs btn-danger"> [فایل ضمیمه] - <?=formatSizeUnits($file['fl_size']);?> </a>
		  <?php } }?>
		 </p>
	   </div> 
	   
	  </div>
	
	  

	   <?php  foreach($tiket_all as $row){
		?>
	 <div class="tiket_parent <?php if($row['tk_last_req'] == "1"){ echo "admin-message";}?>">  
	   <div class="icon-user">
	   <i class="fa fa-user" aria-hidden="true"></i>
	   </div> 
	   <div class="type-sender">  <?=last_massage_nocolor($row['tk_last_req']);?> </div>
	   <div class="panel-content">
	    <p>
		  <strong>
              
              <?php   if($row['tk_last_req'] == "0" and $tiket['tk_user_id'] !== 0){echo  $row['s_full_name'];}elseif($row['tk_last_req'] == "1"){ echo  get_admin_name($row['admin_id_res']);}elseif($tiket['tk_user_id'] == 0) { echo "میهمان";}?>
            </strong></br>    
		  <span class="fa-number" style="font-size: 12px;color: #989898;"> <?=$row['tk_date_in'];?></span> - <label class="fa-number" style="font-size: 12px;color: #989898;"> <?=ago($row['tk_timestamp_in']);?></label>  </span>  
	    </p> 
		 <p>
		      <?php
               $lines = explode("\n", $row['tk_massage']);
               foreach( $lines as  $line )
               {
                echo $line . '<br/>';
                 }
               ?>
		 </p> 
		 <p>
		  <?php if($row['file'] !=="0"){
			 $file = get_file($row['code_msg']); 
			  if($file !== "0"){
		   ?> 
		   <a id="file-<?=$file['id_fl'];?>" onClick="download_file('<?=$file['id_fl'];?>','<?=$file['fl_filename'];?>')" class="donwload-btn btn btn-xs btn-danger"> [فایل ضمیمه] - <?=formatSizeUnits($file['fl_size']);?> </a>
		  <?php } }?>
		 </p>
	   </div> 
	   
	  </div>  
	   <?php }?>
	   
	   	  	<div class="result_send_new">
	    </div>


	        </div>
		  
		 
        </section>
	   </div>

     <div class="col-lg-4">
          <section class="panel">
		      <header class="panel-heading"> 
                  اختیارات
              </header> 
              
		    <div class="panel-body">
	        
               <div class="form-group">
                <label>تغییر وضعیت : </label>
                   <select style="padding:0px 10px;" name="state_tiket" class="form-control">
                       <option <?php if($tiket['tk_state'] == 1 ){echo "selected";}?> value="1"> باز</option> 
                       <option <?php if($tiket['tk_state'] == 3 ){echo "selected";}?> value="3"> پاسخ داده شد </option>
                       <option <?php if($tiket['tk_state'] == 2 ){echo "selected";}?> value="2"> در انتظار پاسخ </option> 
                       <option <?php if($tiket['tk_state'] == 4 ){echo "selected";}?> value="4"> بسته شد </option>        
                   </select> 
               </div>  

               <div class="form-group">
                <label>آخرین پاسخ از : </label>
                   <select style="padding:0px 10px;" name="last_req" class="form-control">
                       <option <?php if($tiket['tk_last_req'] == 0 ){echo "selected";}?> value="0"> کاربر </option> 
                       <option <?php if($tiket['tk_last_req'] == 1){echo "selected";}?>  value="1"> کارمند </option>         
                   </select>
               </div>
                 
                <button type="button" data-id="32" onclick="update_tiket()" class="btn  btn-sm btn-info">بروزرسانی</button>
                <a href="#" class="pull-left" style="color:red;"> حذف درخواست </a>
	        </div>
		  
		  
        </section>
         
         <?php  if($tiket['tk_user_id'] !== 0){ 
                 if(count($tiket_all_user) > 0){
                 ?>
           
         <section class="panel">  
		      <header class="panel-heading"> 
                  آخرین  تیکت های باز کاربر  
              </header>  
              
		    <div class="panel-body">
	        <table class="table">
     <thead>
     <tr> 
	  <th>موضوع</th> 
	  <th>اخرین بروزرسانی</th> 	  		
	  <th></th> 
	  </tr> 
	  </thead>   
	  <tbody> 
       <?php foreach($tiket_all_user as $row){ ?>
		 <tr>
		   <td><?=$row['tk_title'];?></td> 
		   <td><?=ago($row['tk_timestamp_res']);?></td>
           <td><a class="btn btn-info  btn-xs" href="?route=show_tiket&amp;id=<?=$row['tk_code'];?>"><i class="icon-eye-open"></i></a></td>
         </tr>		 
        <?php }?>  

	  </tbody> 
	  </table>
                
	        </div>
		  
		  
        </section>
         <?php } } ?> 
         
	   </div> 
         
          <button type="button" data-toggle="modal" data-target="#show_models" class="new_tiket">
	 <p> ارسال پاسخ </p>
	 <i class="icon-plus" aria-hidden="true"></i>
	</button>
  
<div id="show_models" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">×</button>
        <h4 class="modal-title">ارسال پاسخ جدید</h4>
      </div>  
      <div class="modal-body">
	   <form id="message_form" method="POST">
        <div class="form-group">
      		    <label> پاسخ :  </label>
      		    <textarea name="f1" class="form-control" rows="4" placeholder="پاسخ خود را وارد نمایید ... "></textarea> 
      		</div>
			<div class="form-group">
			  <label> فایل ضمیمه  </label>
			  <input name="file" id="file_1" type="file">
			  <span style="display: inline-block;" name="file" class="label label-info fa-number">پسوند  مجاز : .zip <br>
			   حجم مجاز : ۱ مگابایت </span> 
			</div>
			
      </form></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
	  <button type="button" onclick="send_new_massage()" class="btn btn-send-message btn-primary">ارسال  پاسخ</button>
	  
      </div>
    </div>

  </div>
</div>
 
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

  