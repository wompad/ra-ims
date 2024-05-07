<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Cuba admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Cuba admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="../assets_0/assets/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="../assets_0/assets/images/favicon.png" type="image/x-icon">
    <title>DSWD RA-IMS Login</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/style.css">
    <link id="color" rel="stylesheet" href="../assets_0/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/jquery-confirm/css/jquery-confirm.css">
  </head>
  <body>
    <!-- login page start-->
    <div class="container-fluid">
      <div class="row">
        <div class="col-xl-7"><img class="bg-img-cover bg-center" src="../assets_0/assets/images/login/2.jpg" alt="looginpage"></div>
        <div class="col-xl-5 p-0">
          <div class="login-card">
            <div>
              <!-- <div><a class="logo text-start" href="../index.html"><img class="img-fluid for-light" src="../assets_0/assets/images/logo/login.png" alt="looginpage"><img class="img-fluid for-dark" src="../assets_0/assets/images/logo/logo_dark.png" alt="looginpage"></a></div> -->
              <div class="login-main"> 
                <div class="theme-form">
                  <h4 class="text-primary"><strong>Sign in to Account</strong></h4>
                  <label>Kindly login using your DSWD Portal account credentials to begin your transaction</label>
                  <div class="form-group">
                    <label class="col-form-label">Username</label>
                    <input class="form-control" type="email" required="" placeholder="Username" id="username">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <div class="form-input position-relative">
                      <input class="form-control" type="password" name="password" required="" placeholder="*********" id="password">
                    </div>
                  </div>
                  <div class="form-group">
                    <script src="https://www.google.com/recaptcha/api.js"></script>
                    <div class="g-recaptcha" data-sitekey="6Lf9QJUoAAAAAHT3hqgFWV0TW6nq1XFvHvW-MI5o"></div>
                    <div class="form-group login-pf-settings">
                        <div id="kc-form-options"></div>
                        <div class=""></div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <div class="checkbox p-0">
                      <input id="checkbox1" type="checkbox">
                      <label class="text-muted" for="checkbox1" style="visibility: hidden">Remember password</label>
                    </div><a class="link" href="forgot_password">Forgot password?</a>
                  </div>
                  <div class="form-group mb-0">
                    <div class="text-end">
                      <button class="btn btn-primary btn-block w-100" id="login">Sign in</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="../assets_0/assets/js/jquery-3.5.1.min.js"></script>
      <script src="../assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <script src="../assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="../assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
      <script src="../assets_0/assets/js/config.js"></script>
      <script src="../assets_0/assets/js/script.js"></script>
      <script src="../assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>
      <script>

        function alertBox(title, msg, type, btn){
          $.confirm({
            title: title,
            content: msg,
            type: type,
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Ok',
                    btnClass: btn,
                    action: function(){
                    }
                }
            }
          });
        }

        function setupAccount(){
          $.confirm({
            title: 'Setup Account',
            content: 'Account retrived from DSWD Portal, setup your account to continue',
            type: 'green',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Ok',
                    btnClass: 'btn-success',
                    action: function(){
                      window.location.assign("setup_account_fo");
                    }
                }
            }
          });
        }

        function UserNotFound(){
          $.confirm({
            title: 'Error',
            content: 'User account does not exist',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Ok',
                    btnClass: 'btn-danger',
                    action: function(){
                    }
                }
            }
          });
        }

        $('#login').click(function(){
          username = $('#username').val();
          password = $('#password').val();
          if(username == "" || password == ""){
            alertBox("Error","Username and password are required", "red", "btn-danger");
          }else{
            if(grecaptcha && grecaptcha.getResponse().length > 0){
              loginUser();
            }
          }
        })

        async function loginUser(){

          const fd = new FormData();
          fd.append('username', $('#username').val());
          fd.append('password', $('#password').val());
          $.ajax({
            url: "../fopages/Temp_Login",
            type: 'POST',
            data: fd,
            async: false,
            success: function (data) {

              if(data == 1){
                window.location.assign("dashboard");
              }else{
                let obj = JSON.parse(data);
                if(typeof obj === 'object' && obj !== null){
                  setupAccount();
                }else{
                  UserNotFound();
                }
              }
            },
            cache: false,
            contentType: false,
            processData: false
          });

        }

      </script>

    </div>
  </body>
</html>