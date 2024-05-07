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
                  <h4>Forgot Password?</h4>
                  <p>Please enter your email and we'll send you a link to recover your account.</p>
                  <div class="form-group">
                    <label class="col-form-label">Email Address</label>
                    <input class="form-control" type="email" required="" placeholder="Test@gmail.com" id="email">
                  </div>
                  <div class="form-group mb-0">
                    <div class="text-end mt-3">
                      <button class="btn btn-primary btn-block w-100" id="reset_password">Reset Password</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="https://www.gstatic.com/firebasejs/8.0.1/firebase.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-app.js"></script>
      <script src="https://www.gstatic.com/firebasejs/8.0.1/firebase-auth.js"></script>

      <script>
        const firebaseConfig = {
          apiKey: "AIzaSyCcTC_JTHCtZzL-NXuy0XkIORsfWkWB-Uo",
          authDomain: "ra-ims.firebaseapp.com",
          projectId: "ra-ims",
          storageBucket: "ra-ims.appspot.com",
          messagingSenderId: "978281283884",
          appId: "1:978281283884:web:03bcc9ec56bdce61646c89",
          measurementId: "G-G8BQZ2TRGZ"
        };
        firebase.initializeApp(firebaseConfig);
      </script>
      <script src="assets_0/assets/js/jquery-3.5.1.min.js"></script>
      <script src="assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <script src="assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
      <script src="assets_0/assets/js/config.js"></script>
      <script src="assets_0/assets/js/script.js"></script>
      <script src="assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>
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

        function alertBox2(title, msg, type, btn){
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
                      window.location.assign("lgu_login");
                    }
                }
            }
          });
        }

        $('#login').click(function(){
          email = $('#email').val();
          password = $('#password').val();
          if(email == "" || password == ""){
            alertBox("Error","Email address and password are required", "red", "btn-danger");
          }else{
            loginUser();
          }
        })

        async function loginUser(){
          await firebase.auth().signInWithEmailAndPassword(email, password).then(function(){
            getCurrentUser();
          }).catch(function(error) {
            alertBox("Error",error.message, "red", "btn-danger");
          });
        }

        function getCurrentUser(){
          var user = firebase.auth().currentUser;
          if(!user.emailVerified){
            alertBox("Error","Kindly verify your email through the link that we have sent during your account registration", "red", "btn-danger");
          }else{
            email = $('#email').val();
            var datas = {
              email : email
            };
            $.getJSON("pages/searchUser",datas,function(a){
              if(a.new_user == 0){
                window.location.assign("dashboard"); 
              }else{
                window.location.assign("setup_account"); 
              }
            });
          }
        }

        $('#reset_password').click(function(){

          var auth  = firebase.auth();
          var email = $('#email').val();

          if(email == ""){
            alertBox("Error","Email address is required!", "red", "btn-danger");
          }else{
            auth.sendPasswordResetEmail(email).then(function(){
              alertBox2("Success","Email has been sent to you, Please check and verify!", "green", "btn-success");
            }).catch(function(error){
              alertBox("Error","Message: "+ error.message, "red", "btn-danger");
            })
          }

        })

      </script>

    </div>
  </body>
</html>