var app = angular.module('myApp', []);

app.controller('myUserCtrl', function($scope, $http) {

	$scope.user = new User();

	var serverip = "pages/";

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


	$scope.char = function(){
		console.log($scope.user.municipality);
	}


});