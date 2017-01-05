<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title><?php if(empty($page_title)){echo "خوش آمدید  به پنل کاربری |";}else{echo $page_title;}?> </title>

    <!-- Bootstrap core CSS -->
    <link href="/tk-panel/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tk-panel/theme/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/tk-panel/theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="/tk-panel/theme/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="/tk-panel/theme/css/owl.carousel.css" type="text/css">
    <!-- Custom styles for this template -->
    <link href="/tk-panel/theme/css/style.css" rel="stylesheet">
    <link href="/tk-panel/theme/css/style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="/tk-panel/theme/js/html5shiv.js"></script>
      <script src="/tk-panel/theme/js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" class="">
      <!--header start-->
      <header class="header white-bg">
            <div class="sidebar-toggle-box">
                <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
            </div>
            <!--logo start-->
            <a href="#" class="logo"><span> مونیکس </span></a>
            <!--logo end-->
            <div class="nav notify-row" id="top_menu">
                <!--  notification start -->
                <ul class="nav top-menu">
                   
                    <!-- notification dropdown start-->
                    <li id="header_notification_bar" class="dropdown">
                        <a  class="dropdown-toggle" href="?route=manage_tiket&tiket_state=1">
     
                            <i class="icon-bell-alt"></i>
                            <span class="badge bg-warning"><?=number_format($total_open_tiket);?></span>
                        </a>
                       
                    </li>
                    <!-- notification dropdown end -->
                </ul>
                <!--  notification end -->
            </div>
            <div class="top-nav "> 
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">
                    <li>
                        <input type="text" class="form-control search" placeholder="کد ، عنوان درخواست">
                    </li>
                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                           
                            <span class="username"><?=$user['am_fname']." ".$user['am_lname'];?></span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>  		  
                            <li><a href="?logout"><i class="icon-key"></i> خروج</a></li>
                        </ul>
                    </li>
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
               <ul class="sidebar-menu">
                  <li class="<?php if(empty($page_num)){echo "active";}?>">
                      <a class="" href="/tk-panel/">
                          <i class="icon-dashboard"></i>
                          <span>پیشخوان</span>
                       </a>
                     </li>
				     <li class="sub-menu <?php if($page_num =="3" or $page_num =="14" or $page_num =="13"){echo "active open";}?>">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i> 
                          <span>مدیریت تیکت ها</span>
                          <span class="arrow"></span>
                      </a>    
                      <ul class="sub">
                         <li><a class="<?php if($page_num =="3"){echo "active";}?>" href="?route=manage_tiket">همه درخواست ها</a></li>
						 <li><a class="<?php if($page_num =="14"){echo "active";}?>" href="?route=manage_tiket&state=1">درخواست های باز</a></li>
						 <li><a class="<?php if($page_num =="13"){echo "active";}?>" href="?route=create_tiket">ایجاد درخواست جدید</a></li>						
                     </ul> 
   				    </li>  
                    <?php if(show_tikets() == '0'){ ?>
				     <li class="sub-menu <?php if($page_num =="10" or $page_num =="66"){echo "active open";}?>">
                      <a href="javascript:;" class="">
                          <i class="icon-book"></i>
                          <span>مدیریت سیستم</span>
                          <span class="arrow"></span>
                      </a>    
                      <ul class="sub">  
                         <li><a class="<?php if($page_num =="10"){echo "active";}?>" href="?route=Manage_Department">مدیریپت دپارتمان ها</a></li>
						 <li><a class="<?php if($page_num =="66"){echo "active";}?>" href="?route=setting_system">تنظیمات کلی سیستم</a></li>				
                     </ul> 
   				    </li>  
                    <?php }?>
                    <?php if(show_tikets() == '0'){ ?>  
                  <li class="<?php if($page_num =="4"){echo "active open";}?>">  
                      <a class="<?php if($page_num =="4"){echo "active";}?>" href="?route=manage_user">
                          <i class="icon-user"></i>
                          <span>مدیریت کابران</span> 
                      </a>
                  </li> 
 				     
                  <li class="<?php if($page_num =="15"){echo "active open";}?>">
                      <a class="<?php if($page_num =="15"){echo "active";}?>" href="?route=manage_Operator"> 
                          <i class="icon-user"></i>
                          <span>مدیریت اپراتور ها</span>
                      </a>   
                  </li> 
                    <?php }?>  
                  <li>  
                      <a class="" href="?logout">
                          <i class="icon-user"></i>
                          <span>خروج</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end--> 