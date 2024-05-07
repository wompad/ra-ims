var app = angular.module('myApp', []);

app.directive('ngFile', ['$parse', function ($parse) {
 return {
  restrict: 'A',
  link: function(scope, element, attrs) {
   element.bind('change', function(){

    $parse(attrs.ngFile).assign(scope,element[0].files)
    scope.$apply();
   });
  }
 };
}]);

app.directive('customOnChange', function() {
  return {
    restrict: 'A',
    link: function (scope, element, attrs) {
      var onChangeHandler = scope.$eval(attrs.customOnChange);
      element.on('change', onChangeHandler);
      element.on('$destroy', function() {
        element.off();
      });

    }
  };
});

app.controller('FOCtrl', function($scope, $http) {

  $scope.fouser = new FOUser();

  var datas = {
    username : session
  };

  $scope.hideError = 1;

  var serverip = "../fopages/"

  setTimeout(function(){
    $http.post(serverip+"get_fo_user_details",datas).then(function(response){
      $scope.getuserDetail(response.data);
    });
  },300)

  $scope.getuserDetail = function(user){

    $scope.fouser.account_number        = user.account_number;
    $scope.fouser.area_of_assignment    = user.area_of_assignment.toUpperCase();
    $scope.fouser.birthdate             = user.birthdate;
    $scope.fouser.contact               = user.contact;
    $scope.fouser.division              = user.division.toUpperCase();
    $scope.fouser.employee_id           = user.employee_id;
    $scope.fouser.first_name            = user.first_name.toUpperCase();
    $scope.fouser.gender                = user.gender;
    $scope.fouser.id_number             = user.id_number;
    $scope.fouser.image_path            = user.image_path;
    $scope.fouser.last_name             = user.last_name.toUpperCase();
    $scope.fouser.middle_name           = user.middle_name.toUpperCase();
    $scope.fouser.position              = user.position.toUpperCase();
    $scope.fouser.section               = user.section.toUpperCase();
    $scope.fouser.status                = user.status;
    $scope.fouser.username              = user.username;

    $scope.tmpfirstname                 = user.first_name;

  };

  $scope.alertBox = function(title, msg, type, btn, btntext, param){
    $.confirm({
      title: title,
      content: msg,
      type: type,
      typeAnimated: true,
      buttons: {
          tryAgain: {
              text: btntext,
              btnClass: btn,
              action: function(){
                window.location.assign("dashboard");
              }
          }
      }
    });
  }

  $scope.setupAccount = function(){
    
    if($scope.fouser.invalidUserinput().length > 0){
      $scope.hideError = 0;
    }else{

      $http.post(serverip+"saveFOUser",$scope.fouser.toJSON()).then(function(response){
        $scope.alertBox('Success','User account details successfully registered. Please click the button to continue!','green','btn-success', 'Continue', response.data);
      }).catch(function(error) {
          console.log(error);
      });

    }
  }


});