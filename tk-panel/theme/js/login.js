 function login(){
  var username_input = $('#input_user').val();
  var password_input = $('#input_pass').val(); 
  
  if(username_input !=="" && password_input !==""){
   $('.btn-login').text('کمی صبر کنید...');
   $('.btn-login').prop('disabled',true);
   var myform = document.getElementById('form-signin');
    var fd = new FormData(myform);
    $.ajax({
        url: '?ajax=login_admin',
        data: fd,
        cache: false,
        processData: false,
        contentType: false, 
        type: 'POST',
        success: function (data) {
		   $('.btn-login').text('ورود');
           $('.btn-login').prop('disabled',false);
		   var exports = $.parseJSON(data);	 
		   var results = $('#results');
           var alert_notvalidate = '<div class="alert alert-danger">نام  کاربري و يا کلمه عبور صحيح نميباشد</div>';
		   var alert_success = '<div class="alert alert-success">با موفقيت وارد شده ايد اکنون به پنل  خود هدايت ميشويد ...</div>';
		   var user_state = '<div class="alert alert-warning">نام کاربري شما از  پنل  مديريت غير فعال شده است لطفا با پشتيباني  تماس حاصل فرماييد</div>';
			 
			 if(exports.state_login == "0"){
				results.html(alert_notvalidate); 
			 }
			 if(exports.state_login == "1"){
				results.html(alert_success); 
				window.location = '/tk-panel/';
			 }		
			 if(exports.state_login == "2"){
				results.html(user_state); 
			 }				 
        }

    });

    return false;    //<---- Add this line
  }
 }