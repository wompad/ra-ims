
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
    <title>DSWD RA-IMS</title>
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
    <link rel="stylesheet" type="text/css" href="assets_0/assets/css/vendors/select2.css">

    <link rel="stylesheet" type="text/css" href="assets_0/assets/jquery-confirm/css/jquery-confirm.css">
  </head>
  <body ng-app="myApp" ng-controller="myUserCtrl">
    <!-- login page start-->
    <div class="container-fluid p-0"> 
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div class="col-xl-12">
              <div class="login-main" style="width: 540px"> 
                <div class="theme-form">
                  <h4>Create your account</h4>
                  <p>This registration is powered by Firebase<span>&#174;</span>. Enter your personal details to create account</p>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Enter Email Address <code class="text-danger">*</code></label>
                    <div class="row g-2">
                      <div class="col-12">
                        <input class="form-control" type="email" required placeholder="test@gmail.com" id="email">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Password <code class="text-danger">*</code></label>
                    <div class="row g-2">
                      <div class="col-12">
                        <input class="form-control" type="password" placeholder="*************" required id="password">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Confirm Password <code class="text-danger">*</code></label>
                    <div class="row g-2">
                      <div class="col-12">
                        <input class="form-control" type="password" required placeholder="*************" id="confirmpassword">
                      </div>
                    </div>
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-outline-primary btn-block w-100 btn-lg" id='signup'>Register</button>
                    <a class="btn btn-outline-secondary btn-block w-100 btn-lg mt-2" href="index">Back to Login</a>
                  </div>
                  <br>
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

      <!-- latest jquery-->
      <script src="assets_0/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
      <script src="assets_0/assets/js/select2/select2.full.min.js"></script>
      <script src="assets_0/assets/js/select2/select2-custom.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="assets_0/assets/js/config.js"></script>

      <script src="assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="assets_0/assets/js/script.js"></script>

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

        $('#signup').click(function(){

          var email = $('#email').val();
          var password = $('#password').val();
          var confirmpassword = $('#confirmpassword').val();

          if(email == "" || password == "" || confirmpassword == ""){
            alertBox("Error","Email, Password and Confirm Password must not be blank.", "red", "btn-danger");
          }else{
            if(password != confirmpassword){
              alertBox("Error","Password and Confirm Password is not matched!", "red", "btn-danger");
            }else{
              signupUser(email, password);
            }
          }

        })

        async function signupUser(email, password){
          try{
            const userCred = await firebase.auth().createUserWithEmailAndPassword(email, password).catch(function(error){
              alertBox("Error",error.message, "red", "btn-danger");
            })
            await userCred.user.sendEmailVerification({
              url : 'http://localhost/ra-ims'
            }).then(function(){
              alertBox("Success","Email verification sent. Please verify your account to continue login.", "green", "btn-success");
              $('#email').val('');
              $('#password').val('');
              $('#confirmpassword').val('');
            })
          }catch(e){
            console.log(e);
          }
        } 

      </script>

    </div>
  </body>
</html>