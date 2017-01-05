     <section id="main-content">
  
     <section class="wrapper">
	  
	 
	    <div class="col-lg-12">
         <section class="panel">
		 
		 <header class="panel-heading"> 
                      	     
			  	  
                            </header>
		<div class="panel-body">
		<?php if(!isset($_GET['plugin'])){ ?>  
        <?php if(isset($msg)){ echo $msg;}?>  
	   <table class="table table-striped table-advance table-hover">
                                <thead>
                                    <tr>								
                                        <th>نام</th>
	                                    <th> توضیحات </th>  	 								
                                        <th style="width: 100px;"></th>											
                                        <th style="width: 100px;"></th>
                                        <th style="width: 100px;"></th>	   										
                                    </tr>
                                </thead>  
                                <tbody> 	 		   
	                             <?php mon_get_all_plugin();?> 
		                         </tbody> 
                                </table>	   						
	          
	  
		<?php }else{ $hooks->do_action('plugin_configure'); }?>   
	     </div>
		 
		 
	     <section>
	   </div>
	   
	 </section> <!--/.wrapper-->
	 
   </section> <!--/.main-content-->
   

  