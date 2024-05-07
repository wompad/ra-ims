<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="assets_0/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assets_0/assets/images/favicon.png" type="image/x-icon">
    <title>DSWD RA-IMS Login</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/style.css">
    <link id="color" rel="stylesheet" href="assets_0/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="assets_0/assets/jquery-confirm/css/jquery-confirm.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="assets_0/assets/images/login/2.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <!-- <div><a class="logo text-start" href="index.html"><img class="img-fluid for-light" src="assets_0/assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="assets_0/assets/images/logo/logo_dark.png" alt="looginpage"></a></div> -->
              <div class="login-main"> 
                <div class="theme-form">
                  <h4>Sign in As</h4>
                  <div class="form-group">
                    <select class="form-control" id="user_type">
                    	<option value="0" selected>Please select user type</option>
                    	<option value="1">Local Government Unit</option>
                    	<option value="2">DSWD Caraga Personnel</option>
                    </select>
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100" id="continue">Continue</button>
                  </div>
                  <p class="mt-4 mb-0 text-center">Don't have account?<a class="ms-2" href="signup">Create Account</a></p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <script src="assets_0/assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <script src="assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
      <script src="assets_0/assets/js/config.js"></script>
      <script src="assets_0/assets/js/script.js"></script>
      <script src="assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>

      <script>
      	$('#continue').click(function(){

      		var user_type = $('#user_type').val();

      		if(user_type == "1"){
      			window.location.assign("lgu_login");
      		}else{
            window.location.assign("fo/x");
          }

      	})
      </script>

    </div>
  </body>
</html>