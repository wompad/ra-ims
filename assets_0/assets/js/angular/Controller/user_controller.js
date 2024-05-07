var app = angular.module('myApp', []);

app.controller('myUserCtrl', function($scope, $http) {

	$scope.user = new User();

	$scope.hideError = 1;

	var serverip = "pages/";

	var datas = {
		id : id
	}

	setTimeout(function(){
		$http.post(serverip+"get_email_address",datas).then(function(response){
			$scope.user.email_address = response.data[0].email_address;
		});
	},300)

	$http.get(serverip+"get_provinces").then(function(response){
		$scope.provinces = response.data;

		$scope.provinces.unshift({
			psgc_code : 0,
			province_name : "Select Province"
		});

		$scope.user.province = $scope.provinces[0];

		$http.get(serverip+"get_municipalities").then(function(response){
			$scope.municipalities = response.data;

			$scope.municipalities.unshift(
				{
					psgc_code 			: 0,
					province_psgc 		: $scope.user.province.psgc_code,
					municipality_name 	: 'Select Municipality',
					district 			: 0,
					iscity 				: 'f'
				}
			);
			$scope.user.municipality = $scope.municipalities[0];
		})
	})

	$http.get(serverip+"get_offices").then(function(response){
		$scope.offices = response.data;

		$scope.offices.unshift({
			id 					: 0,
			office_name 		: "Select Office",
			office_coverage 	: "None",
		});

		$scope.user.office = $scope.offices[0];

	})


	$scope.insertSelectMunicipality = function (){

		angular.forEach($scope.municipalities, function (municipality) {
			if(municipality.psgc_code == 0){
				$scope.municipalities.shift();
			}
	    });

		$scope.municipalities.unshift(
			{
				psgc_code 			: 0,
				province_psgc 		: $scope.user.province.psgc_code,
				municipality_name 	: 'Select Municipality',
				district 			: 0,
				iscity 				: 'f'
			}
		);

		$scope.user.municipality = $scope.municipalities[0];

	}

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

    $scope.alertBox2 = function(title, msg, type, btn, btntext){
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
                	window.location.assign("lgu_login");
                }
            }
        }
      });
    }

	$scope.setupAccount = function(){

		if($scope.user.invalidUserinput().length > 0){
			$scope.hideError = 0;
		}else{
			$http.post(serverip+"savelguUser",$scope.user.toJSON()).then(function(response){
				if(response.data == 0){
					$scope.alertBox2('Error','User account already exist. Please click the button to login','red','btn-danger', 'Continue to Login');
				}else{
					$scope.alertBox('Success','User account details successfully updated. Please click the button to continue!','green','btn-success', 'Continue', response.data);
				}
			}).catch(function(error) {
	           console.log(error);
	        });
		}
	}

});

