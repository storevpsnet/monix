      <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
               ایجاد درخواست جدید 
                            </header>
		<div class="panel-body">
           <?php if(!isset($_GET['show_code'])){?>
           <form id="frm_send_tiket" method="POST" enctype="multipart/form-data">
		 <div class="row"> 
             <div class="col-lg-6"> 
                 
                 <div class="form-group">
      		    <label> موضوع درخواست </label>
      		    <input class="form-control" value="" name="f4" placeholder="موضوع درخواست را وارد نمایید">
      		  </div>
                 
                 <div class="form-group">
      		    <label> متن درخواست </label>
      		    <textarea rows="4" name="f5" class="form-control" rows="4" placeholder="متن درخواست  خود را وارد نمایید"></textarea> 
      		</div> 
                
                 <div class="form-group">  
			  <label> فایل ضمیمه  </label>
			  <input name="file" id="file_1" type="file">
			  <span style="display: inline-block;" name="file" class="label label-info fa-number">پسوند  مجاز : .zip <br>
			   حجم مجاز : ۱ مگابایت </span> 
			</div>
                   
             </div>
		    <div class="col-lg-6">
   
                <div data-id="24" class="form-group">
                    <label>کاربر مورد نظر</label>
                     
                      <select multiple="" name="f1[]" class="form-control">
                        <?php foreach($user as $row) {?>
                         <option value="<?=$row['id_user'];?>"><?=$row['s_full_name'];?></option>
                          <?php }?>
                       </select> 
                    
                    <span class="text-muted">اگر برای چند  کاربر میخواهید درخواست ایجاد کنید  کلید  CTRL را نگه دارید سپس بر روی  کاربر  مورد نظر  کلیک نمایید</span>
                </div>   
                <div class="form-group">
                    <label><input type="checkbox" onClick="checkbox_users()" value="1" name="f2" /> بدون کاربر  </label> </br>  
                    <span class="text-muted">در صورتی میخواهید برای یک کاربر میهمان درخواست ایجاد نمایید چک باکس را تیک بزنید</span>
                  </div> 
              <div class="form-group">
                    <label> دپارتمان </label> 
                   <select class="form-control" name="f3" style="padding:0px 10px;">
                       <?php foreach($Department as $row){ ?>
                       <option value="<?=$row['id_dep'];?>"><?=$row['dep_title'];?></option>
                       <?php }?>
                        
                   </select>
                </div>  
                  <button data-id="16" onClick="open_tiket()" type="button" class="btn btn-info">ایجاد درخواست</button>
                  <button type="reset" class="btn btn-default">از  نو</button> 
                </form>
                <?php }else{?>
               
               <div class="alert alert-success" role="alert">  
	            <strong>تیکت پشتیبانی ایجاد شد</strong> <br>   
	            تیکت  جدید  با  کد  <a href="/tk-panel/?route=show_tiket&id=<?=$get_code['tk_code'];?>">#<?=convert($get_code['tk_code']);?></a> با موفقیت ایجاد شد. 
                 
               <?php }?>
             </div>
	 
			</div> <!-- /.row-->    
	     </div>
		 
		 
	     <section>
	   </div>
	   
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

 