
 <div class="page-wapper">
  <div class="col-lg-10" style="padding: 0;">
  
    <ol class="breadcrumb">
     <li><a href="/">خانه</a></li>
     <li><a class="active">داشبرد</a></li>
   </ol>

  
  <div class="content-page">
  
  <div class="widget-box">
  
      <div class="widget purpel">
       <p class="fa-number"> <?=$all_request;?> </p> 
       <span> همه درخواست ها </span>
     </div>

      <div class="widget green">
       <p class="fa-number"> <?=$open_request_total;?> </p>
       <span> درخواست  های باز </span>
     </div>
   
      <div class="widget orange">
       <p class="fa-number"> <?=$close_request_total;?> </p>
       <span> درخواست های بسته </span>
     </div>  


	 
	 
  </div>
  
  <div class="panel panel-default">

  <div class="panel-heading">درخواست های باز</div>

  <!-- Table -->
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
       <?php  foreach($open_tiket as $row) { ?>
		 <tr> 
		    <td class="fa-number"><a class="btn btn-xs btn-primary" href="?route=show_tiket&tiket_code=<?=$row['tk_code'];?>"><?=$row['tk_code']."#-".$row['tk_title'];?></a></td>
		    <td  class="fa-number"><?=$row['dep_title'];?></td>
		    <td  class="fa-number"><?=ago($row['tk_timestamp_res']);?></td> 
		    <td ><?=last_massage($row['tk_last_req']);?></td> 			
		    <td ><?=state_tiket($row['tk_state']);?></td> 
		    <td><a href="?route=show_tiket&tiket_code=<?=$row['tk_code'];?>" class="btn btn-xs btn-danger">مشاهده</a></td>			
         </tr>		 
		   
	   <?php }	?>  
	  </tbody> 
	  </table>
  
   </div>



  </div> 
  <!-- Content --> 
  
  </div>
  
</div>

 