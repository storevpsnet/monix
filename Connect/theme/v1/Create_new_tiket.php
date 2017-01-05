     
	
 
  <div class="col-lg-10" style="padding: 0;">
  
	 <ol class="breadcrumb">
     <li><a href="/">خانه</a></li>
     <li><a href="#" >مديريت درخواست ها</a></li>
     <li><a href="?route=Create_new_tiket" class="active">ايجاد درخواست جديد</a></li>	 
     </ol> 
    
	  <div class="content-page">
	    <?php  if(!isset($id_dep)){ ?>
	        <h4> دپارتمان  مورد نظر </h4>
			 
			<?php 
			 if(count($Department) > 0){
			 foreach($Department as $row){?>
			 <a  href="?route=Create_new_tiket&send_tiket&dep_id=<?=$row['id_dep'];?>">
	         <div class="alert alert-info" role="alert"> 
	         <strong><i class="fa fa-comment" aria-hidden="true"></i><?=$row['dep_title'];?></strong> </br>
	         <?=$row['dep_dicription'];?>
	        </div> 
			</a>
		   <?php }
			 }else{
				 echo '<div class="alert alert-warning" role="alert">
				 <strong>دپارتمانی موجود نیست !</strong></br>
				  متاسفانه دپارتمانی  جهت ارسال  درخواست  موجود  نیست
				</div>';
			  }
		     ?>
 

		<?php }?>
		
		<?php 
		 if(isset($id_dep) and !isset($_GET['show_code'])){
		  if(count($Department) > 0){			 
		  ?> 
		  <form action="<?=$_SERVER["REQUEST_URI"];?>" id="form-req" method="POST" enctype="multipart/form-data">
          <h4> ارسال درخواست </h4>
		  <div class="col-lg-5">
		  
		  			<div class="form-group">
			  <label> فایل ضمیمه  </label>
			  <input name="file" id="file_1" type="file"  >
			  <span style="display: inline-block;"  name="file" class="label label-info fa-number">پسوند  مجاز : .zip </br>
			   حجم مجاز : 1 مگابایت </span> 
			</div>
			
		  </div>
		  <div class="col-lg-7" style="float:right;">
		  
		       <div class="form-group">
      		    <label> موضوع درخواست </label>
      		    <input class="form-control" value="<?php if(isset($data['f1'])){echo $data['f1'];}?>" name="f1" placeholder="موضوع درخواست را وارد نمایید">
      		  </div>
		       <div class="form-group">
      		    <label> دپارتمان </label>
      		     <select   name="f2" style="padding: 0 10px;" class="form-control">
				  <?php foreach($Department_all as $row){ ?>
				   <option <?php if($row['id_dep'] == $id_dep){ echo "selected";}?> value="<?=$row['id_dep'];?>" > <?=$row['dep_title'];?></option>
				  <?php }?>
				 </select>
				 
      		  </div>			  
			  
			<div class="form-group">
      		    <label> اولویت </label>
      		     <select   name="f3" style="padding: 0 10px;" class="form-control">
				   <option <?php if(isset($data['f3'])){if($data['f3'] == "1"){ echo "selected";}}?> value="1" > کم</option>
				   <option <?php if(isset($data['f3'])){if($data['f3'] == "2"){ echo "selected";}}?> value="2" > متوسط</option>
				   <option <?php if(isset($data['f3'])){if($data['f3'] == "3"){ echo "selected";}}?> value="3" > زیاد</option>				   
				 </select> 
				  
      		  </div>
			  
			
		    <div class="form-group">
      		    <label> متن درخواست </label>
      		    <textarea   name="f4" class="form-control" rows="4"  placeholder="متن درخواست  خود را وارد نمایید"><?php if(isset($data['f4'])){echo $data['f4'];}?></textarea> 
      		</div>
			 

			
            <p>
			<button type="button" onClick="send_tikets()" class="btn btn-primary">ارسال درخواست</button>  
			<button type="reset" class="btn btn-default">از  نو</button>
			</p>
		  </div> 
		  </form>
        <?php  
			 }else{
				 echo '<div class="alert alert-warning" role="alert">
				 <strong>دپارتمانی موجود نیست !</strong></br>
				  متاسفانه دپارتمانی  جهت ارسال  درخواست  موجود  نیست
				</div>';
			  }
		     }  
		     ?>
 		  
		  <?php if(isset($id)){ 
			      if(count($get_code) > 0){		 
			?>
			  <div class="alert alert-success" role="alert">  
	         <strong>درخواست شما  ارسال شد</strong> <br> 
	         با تشکر  درخواست شما با   کد   <a href="?route=show_tiket&tiket_code=<?=$get_code['tk_code'];?>" class="fa-number">#<?=$get_code['tk_code'];?></a>  با  موفقیت  ارسال شد  منتظر  پاسخ از سوی  کارشناسان باشید      </div>
		  <?php }else{
			  echo '<div class="alert alert-warning" role="alert">
				 <strong>چیزی یافت نشد!</strong></br>
				  متاسفانه  درخواستی با این  ای دی  یافت نشد !
				</div>';
		      } }?>
		  
	</div>
	
	</div>