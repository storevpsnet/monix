<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>ورود به ناحیه کاربری | شرکت طراحی نوین شمال</title>

    <!-- Bootstrap core CSS -->
    <link href="/tk-panel/theme/css/bootstrap.min.css" rel="stylesheet">
    <link href="/tk-panel/theme/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/tk-panel/theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="/tk-panel/theme/css/style.css" rel="stylesheet">
    <link href="/tk-panel/theme/css/style-responsive.css" rel="stylesheet" />
	
    <script src="/tk-panel/theme/js/jquery-1.8.3.min.js"></script>
    <script src="/tk-panel/theme/js/sweetalert.min.js"></script>
    <script src="/tk-panel/theme/js/login.js"></script>
		 
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="/tk-panel/theme/js/html5shiv.js"></script>
    <script src="/tk-panel/theme/js/respond.min.js"></script>
    <![endif]-->
</head>

  <body class="login-body">
    <div class="container">

      <form class="form-signin" id="form-signin" method="POST" action="/auth/admin/">
	     <input type="hidden" name="_CSRF_TOKEN" value="<?=$token;?>" />
        <h2 class="form-signin-heading">ورود به پنل مدیریت V1</h2>
        <div class="login-wrap">
		     <div id="results"></div>
			 
            <input type="text" id="input_user" name="tkcr5kf(user$name$input)"  value="<?=filter($_POST['tkcr5kf(user$name$input)']);?>" class="form-control" placeholder="نام کاربری" autofocus>
            <input autocomplete="off"  id="input_pass" type="password" name="tkcr5kf(pass$word$input)"  class="form-control" placeholder="رمز عبور">
            <label class="checkbox">
                <input type="checkbox" value="remember-me"> مرا به خاطر بسپار
                <span class="pull-right"> <a href="#"></a></span>
            </label>
            <button class="btn btn-lg btn-login btn-block" onClick="login()" type="button">ورود</button>
            <span><i class="icon-unlock" aria-hidden="true"></i> ای پی شما جهت ورود امن ثبت شد : &nbsp;&nbsp;<?=getUserIP();?></span>
            <a href="#"> فراموشی رمز عبور </a>

        </div>

      </form>

    </div>

  </body>
</html>
