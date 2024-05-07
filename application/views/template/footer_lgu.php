<!-- footer start-->
        <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-12 footer-copyright text-center">
                <p class="mb-0">Copyright 2021 © Cuba theme by pixelstrap  </p>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    <!-- latest jquery-->
    <script src="assets_0/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="assets_0/assets/js/scrollbar/simplebar.js"></script>
    <script src="assets_0/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="assets_0/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assets_0/assets/js/sidebar-menu.js"></script>
    <!-- <script src="assets_0/assets/js/chart/chartist/chartist.js"></script>
    <script src="assets_0/assets/js/chart/chartist/chartist-plugin-tooltip.js"></script> -->
    <script src="assets_0/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="assets_0/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="assets_0/assets/js/prism/prism.min.js"></script>
    <script src="assets_0/assets/js/clipboard/clipboard.min.js"></script>
    <script src="assets_0/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="assets_0/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="assets_0/assets/js/counter/counter-custom.js"></script>
    <script src="assets_0/assets/js/custom-card/custom-card.js"></script>
    <script src="assets_0/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="assets_0/assets/js/dashboard/dashboard_2.js"></script>
    <script src="assets_0/assets/js/tooltip-init.js"></script>
    <script src="assets_0/assets/js/select2/select2.full.min.js"></script>
    <script src="assets_0/assets/js/select2/select2-custom.js"></script>
    <script src="assets_0/assets/js/toastify/toastify-js.js"></script>
    <script src="assets_0/assets/js/default.js"></script>
    <script src="assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>
    <script src="assets_0/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="assets_0/assets/js/notify/index.js"></script>
    <script src="assets_0/assets/leaflet/leaflet.js"></script>
    <script src="assets_0/assets/leaflet/leaflet.markercluster.js"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>


    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script>
      var session = '<?=$_SESSION["id"]?>';
    </script>

    <!-- <script src="assets_0/assets/js/script.js"></script>
    <script src="assets_0/assets/js/theme-customizer/customizer.js"></script> -->
    <script src="assets_0/assets/js/angular/angular.min.js"></script>
    <script src="assets_0/assets/js/angular/Model/Shopping_Cart.js"></script>
    <script src="assets_0/assets/js/angular/Model/User.js"></script>
    <script src="assets_0/assets/js/angular/Model/Evacuation_Center.js"></script>
    <script src="assets_0/assets/js/angular/Controller/main_controller.js"></script>
    <!-- login js-->
    <!-- Plugin used-->

    <!--   -->

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
                    window.location.assign('logout');
                  }
              }
          }
        });
      }

      $('#save_changes_password').click(function(){

        email = $('#email_address').val();
        password = $('#password').val();
        newPassword = $('#newPassword').val();
        confirmPassword = $('#confirmPassword').val();

        if(email == "" || password == "" || newPassword == "" || confirmPassword == ""){
          alertBox("Error","Please fill all fields to continue!", "purple", "btn-danger");
        }else{
          if(newPassword != confirmPassword){
            alertBox("Warning","New Password and Confirm Password does not match!", "orange", "btn-warning");
          }else{
            loginUser(email, password);
          }
        }
      })

      async function loginUser(email, password){
        await firebase.auth().signInWithEmailAndPassword(email, password).then(function(){
          getCurrentUser();
        }).catch(function(error) {
          alertBox("Error",error.message, "red", "btn-danger");
        });
      }

      function getCurrentUser(){

        newPassword = $('#newPassword').val();

        var user = firebase.auth().currentUser;
        if(!user.emailVerified){
          alertBox("Error","Kindly verify your email through the link that we have sent during your account registration", "red", "btn-danger");
        }else{

          user.updatePassword(newPassword).then(function() {
            alertBox2("Success","Password successfully changed. After clicking the button you will be automatically logged-out.","green", "btn-success");
          }).catch(function(error) {
            alertBox("Error!","Message: "+error.message, "red", "btn-danger");
          });

        }
      }
    </script>

  </body>
</html>