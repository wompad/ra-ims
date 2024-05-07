
<?php

  // if (session_status() == PHP_SESSION_ACTIVE) {
  //   if(!isset($_SESSION['id'])){
  //     header('Location: index');
  //   }
  // }else{
  //   session_start();
  // }

?>

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
    <title>DSWD RA-IMS</title>
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
    <link rel="stylesheet" type="text/css" href="../assets_0/assets/css/vendors/select2.css">

    <link rel="stylesheet" type="text/css" href="../assets_0/assets/jquery-confirm/css/jquery-confirm.css">
  </head>
  <body ng-app="myApp" ng-controller="FOCtrl">
    <!-- login page start-->
    <div class="container-fluid p-0"> 
      <div class="row m-0">
        <div class="col-12 p-0">    
          <div class="login-card">
            <div class="col-xl-12">
              <div class="login-main" style="width: 600px"> 
                <form class="theme-form" name="userForm" novalidate>
                  <h4 class="txt-secondary">Setup your account details</h4>
                  <p>Kindly review your account details retrieved from DSWD Caraga Portal</p>
                  <div class="form-group" ng-hide="hideError || fouser.invalidUserinput().length < 1">
                    <label class="text-danger">
                      Kindly review your entries and fill-out the required fields
                    </label>
                    <ul class="text-danger">
                      <li ng-repeat="error in fouser.invalidUserinput()"><code class="text-danger">*</code> {{error}}</li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Your Name <code class="text-danger">*</code></label>
                    <div class="row g-2">
                      <div class="col-4">
                        <input class="form-control" type="text" required placeholder="First name" name="firstname" ng-model="fouser.first_name" ng-disabled="fouser.first_name">
                      </div>
                      <div class="col-4">
                        <input class="form-control" type="text" name="middlename" placeholder="Middle name" ng-model="fouser.middle_name" ng-disabled="fouser.middle_name">
                      </div>
                      <div class="col-4">
                        <input class="form-control" type="text" required name="lastname" placeholder="Last name" ng-model="fouser.last_name" ng-disabled="fouser.last_name">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Position/Designation<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Position/Designation" ng-model="fouser.position" ng-disabled="fouser.position">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Divison<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Division" ng-model="fouser.division" ng-disabled="fouser.division">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Section<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Section" ng-model="fouser.section" ng-disabled="fouser.section">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Area of Assignment<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Area of Assignment" ng-model="fouser.area_of_assignment" ng-disabled="fouser.area_of_assignment">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Contact Number<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" maxlength="11" placeholder="09XXXXXXXXX" ng-model="fouser.contact" ng-disabled="fouser.contact">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email Address<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Email Address" ng-model="fouser.email_address">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password<code class="text-danger">*</code></label>
                    <input class="form-control" type="password" required="" placeholder="Password" ng-model="fouser.password">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Confirm Password<code class="text-danger">*</code></label>
                    <input class="form-control" type="password" required="" placeholder="Confirm Password" ng-model="fouser.confirmpassword">
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100" ng-click="setupAccount();">Register Account Details</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- latest jquery-->
      <script src="../assets_0/assets/js/jquery-3.5.1.min.js"></script>
      <!-- Bootstrap js-->
      <script src="../assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
      <!-- feather icon js-->
      <script src="../assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
      <script src="../assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
      <script src="../assets_0/assets/js/select2/select2.full.min.js"></script>
      <script src="../assets_0/assets/js/select2/select2-custom.js"></script>
      <!-- scrollbar js-->
      <!-- Sidebar jquery-->
      <script src="../assets_0/assets/js/config.js"></script>

      <script src="../assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>

      <script>
        var session = '<?=$_SESSION["username"]?>';
      </script>

      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="../assets_0/assets/js/script.js"></script>
      <script src="../assets_0/assets/js/angular/angular.min.js"></script>
      <script src="../assets_0/assets/js/angular/Model/FOUser.js"></script>
      <script src="../assets_0/assets/js/angular/Controller/fo_controller.js"></script>
      <!-- login js-->
      <!-- Plugin used-->

    </div>
  </body>
</html>