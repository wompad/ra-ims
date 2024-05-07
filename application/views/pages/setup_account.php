
<?php

  if (session_status() == PHP_SESSION_ACTIVE) {
    if(!isset($_SESSION['id'])){
      header('Location: index');
    }
  }else{
    session_start();
  }

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
              <div class="login-main" style="width: 600px"> 
                <form class="theme-form" name="userForm" novalidate>
                  <h4 class="txt-secondary">Setup your account details</h4>
                  <p>Enter your personal details to create account</p>
                  <div class="form-group" ng-hide="hideError">
                    <label class="text-danger">
                      Kindly review your entries and fill-out the required fields
                    </label>
                    <ul class="text-danger">
                      <li ng-repeat="error in user.invalidUserinput()"><code class="text-danger">*</code> {{error}}</li>
                    </ul>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Email Address<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" name="email" ng-model="user.email_address" required ng-disabled="1" placeholder="Test@gmail.com">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Your Name <code class="text-danger">*</code></label>
                    <div class="row g-2">
                      <div class="col-4">
                        <input class="form-control" type="text" required placeholder="First name" name="firstname" ng-model="user.firstname">
                      </div>
                      <div class="col-4">
                        <input class="form-control" type="text" name="middlename" placeholder="Middle name" ng-model="user.middlename">
                      </div>
                      <div class="col-4">
                        <input class="form-control" type="text" required name="lastname" placeholder="Last name" ng-model="user.lastname">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">Address <code class="text-danger">*</code> </label>
                    <div class="row g-2">
                      <div class="mb-2 col-sm-6">
                        <select class="js-example-basic-single" required="" name="province" ng-options="x as x.province_name for x in provinces track by x.psgc_code" ng-model="user.province" ng-change="insertSelectMunicipality();">
                        </select>
                      </div>
                      <div class="mb-2 col-sm-6">
                        <select class="js-example-basic-single" name="municipality" ng-options="x as x.municipality_name for x in municipalities | filter: {province_psgc : user.province.psgc_code }: true track by x.psgc_code" ng-model="user.municipality" ng-disabled="user.province.psgc_code == 0">
                        </select>
                        <span ng-show="user.municipality.psgc_code == 0 && userForm.municipality.$touched" class="text-danger">City/Municipality is required</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label pt-0">LGU Office <code class="text-danger">*</code> </label>
                    <div class="row g-2">
                      <div class="mb-2 col-sm-12">
                        <select class="js-example-basic-single" required="" name="office" ng-options="x as x.office_name for x in offices track by x.id" ng-model="user.office">
                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Position/Designation<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" placeholder="Position/Designation" ng-model="user.position">
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Contact Number<code class="text-danger">*</code></label>
                    <input class="form-control" type="text" required="" maxlength="11" placeholder="09XXXXXXXXX" ng-model="user.contact_number">
                  </div>
                  <div class="form-group mb-0">
                    <button class="btn btn-primary btn-block w-100" type="submit" ng-click="setupAccount();">Save Account Details</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>

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

      <script>

        var id = "<?= $_SESSION['id'] ?>";

      </script>
      <!-- Plugins JS start-->
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="assets_0/assets/js/script.js"></script>
      <script src="assets_0/assets/js/angular/angular.min.js"></script>
      <script src="assets_0/assets/js/angular/Model/User.js"></script>
      <script src="assets_0/assets/js/angular/Controller/user_controller.js"></script>
      <!-- login js-->
      <!-- Plugin used-->

    </div>
  </body>
</html>