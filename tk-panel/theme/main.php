<? if(!defined('APP_NAME')){die(header('HTTP/1.0 403 Forbidden'));}?>
  <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol terques">
                              <i class="icon-user"></i>
                          </div>
                          <div class="value">
                              <h1><?=number_format($total_open_tiket);?></h1>
                              <p>درخواست های باز</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol red">
                              <i class="icon-tags"></i>
                          </div>
                          <div class="value">
                              <h1><?=number_format($total_tiket);?></h1>
                              <p>تعداد تیکت ها</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="icon-shopping-cart"></i>
                          </div>
                          <div class="value">
                              <h1><?=number_format($total_asmin);?></h1>
                              <p>تعداد کارمندان</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="icon-bar-chart"></i>
                          </div>
                          <div class="value">
                              <h1><?=number_format($total_tiket_any);?></h1>
                              <p>تعداد کل  پاسخ های داده شده</p>
                          </div>
                      </section>
                  </div>
              </div>
              <!--state overview end-->

            <div class="row">
                
                <div class="col-lg-12">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                               درخواست های باز  (<?=$total;?>)
                            </header>
                            <div class="panel-body">
 
                              <table class="table table-striped table-advance table-hover">
                                <thead> 
                                    <tr>								
                                        <th>موضوع</th>  
                                        <th>دپارتمان</th>
                                        <th>آخرین بروزرسانی</th>  
                                        <th>آخرین پاسخ از</th>		
                                        <th>وضعیت</th>  	  
                                        <th>عمليات</th>											
                                    </tr>
                                </thead>
                                <tbody>
								
                              <?php foreach($tiket as $row){?>
								 <tr>
								    <td>#<?=$row['tk_code'];?>-<?=$row['tk_title'];?></td>
								    <td><?=$row['dep_title'];?></td>
                                    <td><?=ago($row['tk_timestamp_res']);?></td>
                                    <td><?=last_massage($row['tk_last_req']);?></td> 
									<td><?=state_tiket($row['tk_state']);?></td> 
								    <td>   
									 <a href="#" class="btn btn-danger  btn-xs"><i class="icon-trash"></i></a>
								     <a  class="btn btn-info  btn-xs" href="/tk-panel/?route=show_tiket&id=<?=$row['tk_code'];?>"><i class="icon-eye-open"></i></a>  
									</td>									
								 </tr>
								<?php }?>
                                    
		                       </tbody> 
                           </table>	   
	            
                            <?php echo $pages->page_links('?');?>  
                            </div>
                        </section>  

								
								 
                    </div>
                
                
                   <div class="col-lg-6">  
                        <!--progress bar start-->
                        <section class="panel">
                            <header class="panel-heading">
                              آخرین اخبار  مونیکس
                            </header>
                            <div class="panel-body">
 
                             
      
                            </div>
                        </section>  

								
								 
                    </div>
                
                
                
              </div> <!-- ./row -->
           
          </section>
      </section> 
      <!--main content end-->
