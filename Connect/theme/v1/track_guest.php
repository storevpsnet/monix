   <div class="col-lg-10" style="padding: 0;">
  
    <ol class="breadcrumb">  
     <li><a href="?Guest">خانه</a></li>
     <li><a class="active">پیگیری درخواست پشتیبانی</a></li>
   </ol>

   
  <div class="content-page">
  <?php if(!isset($_GET['show_tiket'])){
	 ?>

	   <div class="row">
	   <div class="col-lg-6 col-lg-offset-3">  
	  <form method="POST" action="" id="track_form">
	    <?php csrf_token();?>    
	   <div class="input-group" style="direction: ltr;">
	   <span class="input-group-btn">
	   <button class="btn btn-track btn-default" onClick="track()" type="button">بگرد!</button> 
	   </span>
	   <input class="form-control" style="text-align: right;" value="<?php if($id_track){ echo $id_track;}?>" name="track_code" placeholder="کد پیگیری را وارد نمایید"> 
	   </div> 
	   
	   <?php if(count($track['id_tiket']) < 1 and isset($id_track)){?>
	   <div style="margin-top:20px;" class="alert alert-danger" role="alert">
		   <strong>یافت نشد !</strong> </br>   
		   متاسفانه درخواستی با این کد رهگیری یافت نشد </div> 
	   <?php }?>
	   </div>
	   </form>  
	   </div> 
	 
  <?php }elseif(isset($_GET['show_tiket'])){  ?>
  
   <table class="table">
     <thead>
     <tr> 
	  <th>کد - موضوع</th> 
	  <th>دپارتمان</th> 
	  <th>اخرین بروزرسانی</th> 	  
	  <th>آخرین پاسخ از</th> 	
	  <th>وضعیت</th> 	  	
	  <th>عملیات</th> 		  
	  </tr> 
	  </thead>  
	  <tbody> 
 
		 <tr>
		    <td class="fa-number"><a class="btn btn-xs btn-primary" href="?route=show_tiket&tiket_code=<?=$tiket['tk_code'];?>"><?=$tiket['tk_code']."#-".$tiket['tk_title'];?></a></td>
		    <td  class="fa-number"><?=$tiket['dep_title'];?></td>
		    <td  class="fa-number"><?=ago($tiket['tk_timestamp_res']);?></td> 
		    <td ><?=last_massage($tiket['tk_last_req']);?></td> 			
		    <td ><?=state_tiket($tiket['tk_state']);?></td> 
		    <td><a href="?route=show_tiket&tiket_code=<?=$tiket['tk_code'];?>&close_tiket" class="btn btn-xs btn-default">بستن درخواست</a></td>			
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
		  <strong>  میهمان  </strong></br>
		  <span class="fa-number" style="font-size: 12px;font-family: wyekan;color: #989898;"> <?=$tiket['tk_date_in'];?></span> - <label class="fa-number" style="font-size: 12px;font-family: wyekan;color: #989898;"> <?=ago($tiket['tk_timestamp_in']);?></label>  </span>  
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
		  <strong>  میهمان  </strong></br>
		  <span class="fa-number" style="font-size: 12px;font-family: wyekan;color: #989898;"> <?=$row['tk_date_in'];?></span> - <label class="fa-number" style="font-size: 12px;font-family: wyekan;color: #989898;"> <?=ago($row['tk_timestamp_in']);?></label>  </span>  
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
			 $file = get_file_guest($row['tk_code']); 
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

	
	<button type="button" data-toggle="modal" data-target="#show_models"  class="new_tiket">
	 <p> ارسال پاسخ </p>
	 <i class="fa fa-plus" aria-hidden="true"></i>
	</button> 
	   
	<div  id="results"></div>
	 
	 

<!-- Modal -->  
<div id="show_models" class="modal fade" role="dialog">
  <div class="modal-dialog">
 
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">ارسال پاسخ جدید</h4>
      </div>  
      <div class="modal-body">
	   <form  id="message_form" method="POST">
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
			
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">انصراف</button>
	  <button type="button" onclick="send_new_massage()" class="btn btn-send-message btn-primary" >ارسال  پاسخ</button>
	  </form>
      </div>
    </div>
	
  <?php }?>
  
  </div>
  
  </div>