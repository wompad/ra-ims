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
    <script src="../assets_0/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../assets_0/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../assets_0/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../assets_0/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="../assets_0/assets/js/scrollbar/simplebar.js"></script>
    <script src="../assets_0/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="../assets_0/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../assets_0/assets/js/sidebar-menu.js"></script>

    <script src="../assets_0/assets/js/chart/apex-chart/apex-chart.js"></script>
    <script src="../assets_0/assets/js/chart/apex-chart/stock-prices.js"></script>
    <script src="../assets_0/assets/js/prism/prism.min.js"></script>
    <script src="../assets_0/assets/js/clipboard/clipboard.min.js"></script>
    <script src="../assets_0/assets/js/counter/jquery.waypoints.min.js"></script>
    <script src="../assets_0/assets/js/counter/jquery.counterup.min.js"></script>
    <script src="../assets_0/assets/js/counter/counter-custom.js"></script>
    <script src="../assets_0/assets/js/custom-card/custom-card.js"></script>
    <script src="../assets_0/assets/js/owlcarousel/owl.carousel.js"></script>
    <script src="../assets_0/assets/js/dashboard/dashboard_2.js"></script>
    <script src="../assets_0/assets/js/tooltip-init.js"></script>
    <script src="../assets_0/assets/js/select2/select2.full.min.js"></script>
    <script src="../assets_0/assets/js/select2/select2-custom.js"></script>
    <script src="../assets_0/assets/js/toastify/toastify-js.js"></script>
    <script src="../assets_0/assets/js/default.js"></script>
    <script src="../assets_0/assets/jquery-confirm/js/jquery-confirm.js"></script>
    <script src="../assets_0/assets/js/notify/bootstrap-notify.min.js"></script>
    <script src="../assets_0/assets/js/notify/index.js"></script>
    <script src="../assets_0/assets/leaflet/leaflet.js"></script>
    <script src="../assets_0/assets/leaflet/leaflet.markercluster.js"></script>

    <!-- Highcharts -->
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <!-- <script src="../assets_0/assets/js/script.js"></script>
    <script src="../assets_0/assets/js/theme-customizer/customizer_fo.js"></script> -->

    <script src="../assets_0/key-cloak/node_modules/keycloak-js/dist/keycloak.js"></script>

    <script>

        var keycloak = new Keycloak();

        function initKeycloak(){
          keycloak.init({onLoad: 'login-required', 'checkLoginIframe' : false}).then(function(){
            var token = keycloak.idTokenParsed;
            getName(token.preferred_username);
            getTokenName(token.preferred_username);
          })
        }

        function getName(name){
          const fd = new FormData();
          fd.append('username', name);
          $.ajax({
            url: "../fopages/searchFOUser",
            type: 'POST',
            data: fd,
            async: false,
            success: function (data) {
              if(data == 0){
                window.location.assign("setup_account_fo");
              }
            },
            cache: false,
            contentType: false,
            processData: false
          });
        }

        // function logout(){

        //     $.ajax({
        //         url: "../fopages/logout",
        //         type: 'POST',
        //         async: false,
        //         success: function (data) {
        //             keycloak.logout({"redirectUri":"http:localhost/ra-ims"});
        //         },
        //         cache: false,
        //         contentType: false,
        //         processData: false
        //     });

        // }

        function getTokenName(name){
            return name;
        }

        var session = getTokenName();

    </script>

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../assets_0/assets/js/angular/angular.min.js"></script>
    <script src="../assets_0/assets/js/angular/Model/FOUser.js"></script>
    <script src="../assets_0/assets/js/angular/Model/Evacuation_Center.js"></script>
    <script src="../assets_0/assets/js/angular/Controller/fo_main_controller.js"></script>
        <!-- login js-->
    <!-- Plugin used-->

    <!--   -->

  </body>
</html>