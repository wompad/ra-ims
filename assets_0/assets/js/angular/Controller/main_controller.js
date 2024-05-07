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

app.directive('xcustomOnChange', function () {
	return {
		restrict: 'A',
		link: function (scope, element, attrs) {
		var onChangeHandler = scope.$eval(attrs.customOnChange);
			element.bind('change', onChangeHandler);
		}
	};
});

app.controller('myItemCtrl', function($scope, $http) {

	$scope.name = "John Doe";
	$scope.cart = new Shopping_Cart();
	$scope.user = new User();
	$scope.evacuation_center = new Evacuation_Center();

	$scope.hideError = true;

	$scope.hideList = false;
	$scope.hideDetails = true;
	$scope.hideEditDetails = true;

	$scope.hideitemError = true;

	$scope.ecDetail = "";

	$scope.searchFileID = '';

	var serverip = "pages/";

	var datas = {
		id : session
	};

	setTimeout(function(){
		$http.post(serverip+"get_user_details",datas).then(function(response){
			$scope.getUser(response.data.user[0], response.data.user_profile[0]);
		});
	},300);

	$http.get(serverip+"get_provinces").then(function(response){
		$scope.provinces = response.data;
	});

	$http.get(serverip+"get_municipalities").then(function(response){
		$scope.municipalities = response.data;
	});

	$http.get(serverip+"get_offices").then(function(response){
		$scope.offices = response.data;
		$scope.offices.unshift({
			id 					: 0,
			office_name 		: "Select Office",
			office_coverage 	: "None",
		});
		$scope.user.office = $scope.offices[0];
	});

	$scope.viewFile = (file) => {
	   $scope.requestfile = "uploads_request/"+file;
	   window.open($scope.requestfile,"MsgWindow", "width=900,height=900");
	 }

	$scope.showButton = (file) =>{
	    if(file){
	      return 1;
	    }
	    return 0;
	  }

	$scope.parseDate = (date) => {
	    const d = new Date(date);
	    return d.toDateString();
	  }

	let lgu_track_request = $('#lgu_track_request');

	$scope.viewLGURequestDetail = (request) =>{

		console.log(request);
		$scope.reqdetails = request;

		let data = {
	    	id : request.id
	    }

		$http.post(serverip+"get_requested_items",data).then(function(response){
	    	$scope.requested_items = response.data;
	    });

      	$http.post(serverip+"get_approved_items",data).then(function(response){
        	$scope.approved_items = response.data;
      	});

		$('#requestDetailsModal').modal('show');

	}

	$scope.get_request_list = () =>{
		$http.get(serverip+"get_all_request").then(function(response){
			$scope.all_request = response.data.request;
		});	
	}

	if(lgu_track_request.length){

		//const source = new EventSource(serverip+"server_event_request");
		//source.onmessage = function(event) {
		  $scope.get_request_list();
		//};

	}

	var downloadables = $('#downloadables');

	if(downloadables.length){
		$http.get(serverip+"get_downloadables").then(function(response){
			$scope.downloadablefiles = response.data;
		});
	}

	$scope.playVideo = (video, index) => {

		let element = document.getElementById($scope.video_id);
		element.classList.remove('active');

		$scope.video_id = 'video'+index;

		element = document.getElementById($scope.video_id);
		element.classList.add('active');

		$scope.video_file = "downloadable_files/video-materials/"+video.filename
		$('#video_container').empty().append("<video id='playVid' style='width: 100%' controls preload='auto'><source src='"+$scope.video_file+"' type='video/mp4'>Your browser does not support the video tag.</video>")
		$scope.file_description = video.file_description;

		document.getElementById("playVid").play();
	}

	var video_materials = $('#video_materials');

	if(video_materials.length){
		$http.get(serverip+"get_video_materials").then(function(response){
			$scope.video_materials = response.data;
			$scope.video_file = "downloadable_files/video-materials/"+response.data[0]['filename'];
			$('#video_container').empty().append("<video id='playVid' style='width: 100%' controls preload='auto'><source src='"+$scope.video_file+"' type='video/mp4'>Your browser does not support the video tag.</video>")
			$scope.file_description = $scope.video_materials[0].file_description;

			document.getElementById("playVid").play();

		});
		$scope.video_id = 'video0'
	}

	var ec_list = $('#ec_list');
	var mapdiv = $('#map');

	if(ec_list.length || mapdiv.length){

		$http.get(serverip+"get_ec_libraries").then(function(response){
			

			$scope.availability_status = response.data['availability_status'];
			$scope.availability_status.unshift({
				id 				: 0,
				lib_name 		: "Select Availability Status",
			});
			$scope.evacuation_center.availability_status = $scope.availability_status[0];

			$scope.building_status = response.data['building_status'];
			$scope.building_status.unshift({
				id 				: 0,
				lib_name 		: "Select Building Status",
			});
			$scope.evacuation_center.building_status = $scope.building_status[0];

			$scope.source_of_water = response.data['source_of_water'];
			$scope.source_of_water.unshift({
				id 				: 0,
				lib_name 		: "Select Water Source",
			});
			$scope.evacuation_center.source_of_water = $scope.source_of_water[0];

			$scope.type_of_building = response.data['type_of_building'];
			$scope.type_of_building.unshift({
				id 				: 0,
				lib_name 		: "Select Building Type",
			});

			$scope.evacuation_center.type_of_building = $scope.type_of_building[0];
		});

		$scope.get_eclists = function(){

			$http.get(serverip+"get_eclists").then(function(response){

				$scope.ec_lists = response.data.ec;
				$scope.photos = response.data.photos

				var arr_barangay = $scope.ec_lists.map(item => item.barangay).filter((value, index, self) => self.indexOf(value) === index);

				var arr_type_of_building = $scope.ec_lists.map(item => item.type_of_building).filter((value, index, self) => self.indexOf(value) === index);

				var arr_building_status = $scope.ec_lists.map(item => item.building_status).filter((value, index, self) => self.indexOf(value) === index);

				var arr_availability_status = $scope.ec_lists.map(item => item.availability_status).filter((value, index, self) => self.indexOf(value) === index);

				var arr_ffps_storage_availability = $scope.ec_lists.map(item => item.ffps_storage_availability).filter((value, index, self) => self.indexOf(value) === index);

				var arr_compost_pit_latrine = $scope.ec_lists.map(item => item.compost_pit_latrine).filter((value, index, self) => self.indexOf(value) === index);

				var arr_female_cr = $scope.ec_lists.map(item => item.female_cr).filter((value, index, self) => self.indexOf(value) === index);

				var arr_male_cr = $scope.ec_lists.map(item => item.male_cr).filter((value, index, self) => self.indexOf(value) === index);

				var arr_common_cr = $scope.ec_lists.map(item => item.common_cr).filter((value, index, self) => self.indexOf(value) === index);

				var arr_source_of_potable_water = $scope.ec_lists.map(item => item.source_of_potable_water).filter((value, index, self) => self.indexOf(value) === index);

				var arr_source_of_non_potable_water = $scope.ec_lists.map(item => item.source_of_non_potable_water).filter((value, index, self) => self.indexOf(value) === index);

				$scope.data_brgy = [];

				angular.forEach(arr_barangay, function (brgy) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(brgy == ex.barangay){
							i += 1;
						}
					});
					$scope.data_brgy.push({
						name: brgy,
						y: i
					})
				});

				$scope.viewChart('container_brgy','Number of Profiled ECs per Barangay','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Barangays',$scope.data_brgy);

				$scope.data_type_of_building = []

				angular.forEach(arr_type_of_building, function (type_of_building) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(type_of_building == ex.type_of_building){
							i += 1;
						}
					});

					if(typeof type_of_building !== "undefined"){
						$scope.data_type_of_building.push({
							name: type_of_building,
							y: i
						})
					}
				});

				$scope.viewChart('container_type_of_buildings','Number of Profiled ECs per Type of Building','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Type of Building',$scope.data_type_of_building);

				$scope.data_building_status = []

				angular.forEach(arr_building_status, function (building_status) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(building_status == ex.building_status){
							i += 1;
						}
					});

					if(typeof building_status !== "undefined"){
						$scope.data_building_status.push({
							name: building_status,
							y: i
						})
					}
				});

				$scope.viewChart('container_building_status','Number of Profiled ECs per Building Status','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Building Status',$scope.data_building_status);

				$scope.data_availability_status = []

				angular.forEach(arr_availability_status, function (availability_status) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(availability_status == ex.availability_status){
							i += 1;
						}
					});

					if(typeof availability_status !== "undefined"){
						$scope.data_availability_status.push({
							name: availability_status,
							y: i
						})
					}
				});

				$scope.viewChart('container_availability_status','Number of Profiled ECs per Availability Status','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Availability Status',$scope.data_availability_status);

				$scope.data_ffps_storage_availability = []

				angular.forEach(arr_ffps_storage_availability, function (ffps_storage_availability) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(ffps_storage_availability == ex.ffps_storage_availability){
							i += 1;
						}
					});

					if(typeof ffps_storage_availability !== "undefined"){
						$scope.data_ffps_storage_availability.push({
							name: ffps_storage_availability,
							y: i
						})
					}
				});

				$scope.viewChart('container_ffp_storage_availability','Number of Profiled ECs per per FFP Storage Facility','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Storage Facility',$scope.data_ffps_storage_availability);

				$scope.data_compost_pit_latrine = []

				angular.forEach(arr_compost_pit_latrine, function (compost_pit_latrine) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(compost_pit_latrine == ex.compost_pit_latrine){
							i += 1;
						}
					});

					if(typeof compost_pit_latrine !== "undefined"){
						$scope.data_compost_pit_latrine.push({
							name: compost_pit_latrine,
							y: i
						})
					}
				});

				$scope.viewChart('container_compost_pit_latrine','Number of Profiled ECs per Number of Compost Pit Latrine','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Compost Pit Latrine',$scope.data_compost_pit_latrine);

				$scope.data_female_cr = []

				angular.forEach(arr_female_cr, function (female_cr) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(female_cr == ex.female_cr){
							i += 1;
						}
					});

					if(typeof female_cr !== "undefined"){
						$scope.data_female_cr.push({
							name: female_cr,
							y: i
						})
					}
				});

				$scope.viewChart('container_female_cr','Number of Profiled ECs per Number of Female Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Female Comfort Rooms',$scope.data_female_cr);

				$scope.data_male_cr = []

				angular.forEach(arr_male_cr, function (male_cr) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(male_cr == ex.male_cr){
							i += 1;
						}
					});

					if(typeof male_cr !== "undefined"){
						$scope.data_male_cr.push({
							name: male_cr,
							y: i
						})
					}
				});

				$scope.viewChart('container_male_cr','Number of Profiled ECs per Number of Male Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Male Comfort Rooms',$scope.data_male_cr);

				$scope.data_common_cr = []

				angular.forEach(arr_common_cr, function (common_cr) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(common_cr == ex.common_cr){
							i += 1;
						}
					});

					if(typeof common_cr !== "undefined"){
						$scope.data_common_cr.push({
							name: common_cr,
							y: i
						})
					}
				});

				$scope.viewChart('container_common_cr','Number of Profiled ECs per Number of Common Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Common Comfort Rooms',$scope.data_common_cr);

				$scope.data_source_of_potable_water = []

				angular.forEach(arr_source_of_potable_water, function (source_of_potable_water) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(source_of_potable_water == ex.source_of_potable_water){
							i += 1;
						}
					});

					if(typeof source_of_potable_water !== "undefined"){
						$scope.data_source_of_potable_water.push({
							name: source_of_potable_water,
							y: i
						})
					}
				});

				$scope.viewChart('container_source_of_potable_water','Number of Profiled ECs per Source of Potable Water','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Source of Potable Water',$scope.data_source_of_potable_water);

				$scope.data_source_of_non_potable_water = []

				angular.forEach(arr_source_of_non_potable_water, function (source_of_non_potable_water) {
					var i = 0;
					angular.forEach($scope.ec_lists, function (ex) {
						if(source_of_non_potable_water == ex.source_of_non_potable_water){
							i += 1;
						}
					});

					if(typeof source_of_non_potable_water !== "undefined"){
						$scope.data_source_of_non_potable_water.push({
							name: source_of_non_potable_water,
							y: i
						})
					}
				});

				$scope.viewChart('container_source_of_non_potable_water','Number of Profiled ECs per Source of Non Potable Water','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Source of Non Potable Water',$scope.data_source_of_non_potable_water);

			});

		}

		$scope.get_eclists();

		$scope.viewChart = function(container,text_title,text_subtitle,text_yaxis, name, data){
			Highcharts.chart(container, {
			    chart: {
			        type: 'column'
			    },
			    title: {
			        align: 'left',
			        text: text_title
			    },
			    subtitle: {
			        align: 'left',
			        text: text_subtitle
			    },
			    accessibility: {
			        announceNewData: {
			            enabled: true
			        }
			    },
			    xAxis: {
			        type: 'category'
			    },
			    yAxis: {
			        title: {
			            text: text_yaxis
			        }

			    },
			    legend: {
			        enabled: false
			    },
			    plotOptions: {
			        series: {
			            borderWidth: 0,
			            dataLabels: {
			                enabled: true,
			                format: '{point.y}'
			            }
			        }
			    },

			    tooltip: {
			        headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
			        pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y}</b> of total<br/>'
			    },

			    series: [
			        {
			            name: name,
			            colorByPoint: true,
			            data: data
			        }
			    ],
			});
		}


	}

	$scope.viewECDetails = function(ec){

		$scope.ecDetail = ec;
		$scope.spec_photos = [];

		angular.forEach($scope.photos, function (photo) {
            if(ec._index == photo._parent_index){
            	$scope.spec_photos.push(photo);
            }
        });

		$scope.hideList = true;
		$scope.hideDetails = false;
		$scope.hideEditDetails = true;

	}

	$scope.viewEC = function(){
		$('#exampleModalCenter').modal("show");
		console.log($scope.spec_photos);
	}

	$scope.uploadECPhoto = function(event){
		var reader = new FileReader();
		reader.onload = function(){
			var output = document.getElementById('preview_ec_photo');
			output.src = reader.result;
		};
		reader.readAsDataURL(event.target.files[0]);
	}


	$scope.selectECPhoto = function(){

		$("#ec_photo").trigger('click');	

	}

	$scope.saveECDetails = function(){

		$data = {
			id : $scope.evacuation_center.id,
			ec : $scope.evacuation_center.toJSON(),
		};

		$.confirm({
			title: '<i class="fa fa-question-circle txt-warning"></i> <span class="txt-warning">Confirm</span>',
			content: '<span class="txt-dark">Are you sure you want to continue saving changes to evacuation center details.</span>',
			type: 'orange',
			typeAnimated: true,
			buttons: {
				Ok: {
					text: 'Confirm',
					btnClass: 'btn-warning',
					action: function(){

						$http.post(serverip+"saveECDetails",$data).then(function(response){

							var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Changes saved...</strong>', {
								type: 'theme',
								allow_dismiss: true,
								delay: 2000,
								showProgressbar: true,
								timer: 300,
								background: "#D44950",
								animate:{
									enter:'animated fadeInDown',
									exit:'animated fadeOutUp'
								}
							});

							$scope.get_eclists();

							$scope.hideList = false;
							$scope.hideDetails = true;
							$scope.hideEditDetails = true;

						}).catch(function(error) {
							console.log(error);
						});
					}
				},
				cancel: {
					text: 'Cancel',
					action: function(){
						console.log("action cancelled");
					}
				},
			}
		});

	}

	$scope.editECDetails = function(ec){

		$scope.ecDetail = ec;
		$scope.spec_photos = [];

		angular.forEach($scope.photos, function (photo) {
            if(ec._index == photo._parent_index){
            	$scope.spec_photos.push(photo);
            }
        });


		$scope.evacuation_center.id 								= ec._id;
		$scope.evacuation_center.name_of_evacuation_center          = ec.name_of_evacuation_center;

		$scope.evacuation_center._gps_coordinates_latitude          = ec._gps_coordinates_latitude;
		$scope.evacuation_center._gps_coordinates_longitude         = ec._gps_coordinates_longitude;
		$scope.evacuation_center._gps_coordinates_altitude          = ec._gps_coordinates_altitude;
		$scope.evacuation_center._gps_coordinates_precision         = ec._gps_coordinates_precision;

		if(typeof ec.type_of_building === 'undefined' || ec.type_of_building == null || ec.type_of_building == ""){
			ec.type_of_building = "Select Building Type";
		}
		angular.forEach($scope.type_of_building, function(type){
			if(type.lib_name == ec.type_of_building){
				$scope.evacuation_center.type_of_building = type;
			}
		})
		
		if(typeof ec.availability_status === 'undefined' || ec.availability_status == null || ec.availability_status == ""){
			ec.availability_status = "Select Availability Status";
		}
		angular.forEach($scope.availability_status, function(type){
			if(type.lib_name == ec.availability_status){
				$scope.evacuation_center.availability_status = type;
			}
		})

		if(typeof ec.building_status === 'undefined' || ec.building_status == null || ec.building_status == ""){
			ec.building_status = "Select Building Status";
		}
		angular.forEach($scope.building_status, function(type){
			if(type.lib_name == ec.building_status){
				$scope.evacuation_center.building_status = type;
			}
		})
		$scope.evacuation_center.floor_area                         = ec.floor_area;
		$scope.evacuation_center.capacity_family                    = ec.capacity_family;
		$scope.evacuation_center.capacity_individuals               = ec.capacity_individuals;
		$scope.evacuation_center.no_of_rooms                        = ec.no_of_rooms;
		$scope.evacuation_center.ffps_storage_availability          = ec.ffps_storage_availability;
		$scope.evacuation_center.material_recycling_facility        = ec.material_recycling_facility;
		$scope.evacuation_center.compost_pit_latrine                = ec.compost_pit_latrine;
		$scope.evacuation_center.sealed_latrines                    = ec.sealed_latrines;
		$scope.evacuation_center.female_cr                          = ec.female_cr;
		$scope.evacuation_center.male_cr                            = ec.male_cr;
		$scope.evacuation_center.common_cr                          = ec.common_cr;
		$scope.evacuation_center.name_of_designated_camp_manager    = ec.name_of_designated_camp_manager;

		if(typeof ec.source_of_potable_water === 'undefined' || ec.source_of_potable_water == null || ec.source_of_potable_water == ""){
			ec.source_of_potable_water = "Select Water Source";
		}
		angular.forEach($scope.source_of_water, function(type){
			if(type.lib_name == ec.source_of_potable_water){
				$scope.evacuation_center.source_of_potable_water = type;
			}
		})

		if(typeof ec.source_of_non_potable_water === 'undefined' || ec.source_of_non_potable_water == null || ec.source_of_non_potable_water == ""){
			ec.source_of_non_potable_water = "Select Water Source";
		}
		angular.forEach($scope.source_of_water, function(type){
			if(type.lib_name == ec.source_of_non_potable_water){
				$scope.evacuation_center.source_of_non_potable_water = type;
			}
		})

		$scope.evacuation_center.child_friendly_spaces              = ec.child_friendly_spaces;
		$scope.evacuation_center.women_friendly_spaces              = ec.women_friendly_spaces;
		$scope.evacuation_center.couples_room                       = ec.couples_room;
		$scope.evacuation_center.prayer_room                        = ec.prayer_room;
		$scope.evacuation_center.community_kitchen                  = ec.community_kitchen;
		$scope.evacuation_center.availability_of_wash_facilities    = ec.availability_of_wash_facilities;
		$scope.evacuation_center.ramp_for_pwds                      = ec.ramp_for_pwds;
		$scope.evacuation_center.help_desk                          = ec.help_desk;
		$scope.evacuation_center.info_boards                        = ec.info_boards;
		$scope.evacuation_center.has_cccm_committee                 = ec.has_cccm_committee;
		$scope.evacuation_center.number_trained_cccm                = ec.number_trained_cccm;
		$scope.evacuation_center.number_trained_cfs                 = ec.number_trained_cfs;
		$scope.evacuation_center.number_trained_wfs                 = ec.number_trained_wfs;
		$scope.evacuation_center.date_last_updated                  = ec.date_last_updated;


		$scope.hideList = true;
		$scope.hideDetails = true;
		$scope.hideEditDetails = false;

	}

	$scope.getItemTotal = function(items){
		var i = 0;
		angular.forEach(items, function (item) {
            i += item.y;
        });
        return i;
	}

	$scope.getfileClass = function(filename){
		var ext = filename.split(".").pop();

		if(ext == 'docx' || ext == 'doc'){
			return 'fa fa-file-word-o txt-primary';
		}else if(ext == 'xlsx' || ext == 'xls'){
			return 'fa fa-file-excel-o txt-success';
		}else if(ext == 'pdf'){
			return 'fa fa-file-pdf-o txt-danger';
		}else if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'bmp'){
			return 'fa fa-file-image-o txt-warning';
		}else if(ext == 'ppt' || ext == 'pptx'){
			return 'fa fa-file-powerpoint-o txt-warning';
		}
	}

	$scope.sliceFile = (filename) => {
	    const count = 29;
	    if(filename){
	    	if(filename.length < 29){
	    		for(i = 1 ; i < (29-filename.length) ; i++){
	    			filename += " ";
	    		}
	    		return filename;
	    	}else{
	      		return filename.slice(0, count) + (filename.length > count ? "..." : "");
	      	}
	    }
	}

	$scope.insertSelectMunicipality = function (){
		var j = 0;
		for(i = 0 ; i < $scope.municipalities.length ; i ++){
			if($scope.municipalities[i].province_psgc == $scope.user.province.psgc_code){
				j = i;
				break;
			}
		}
		$scope.user.municipality = $scope.municipalities[j];
	};

	$scope.getUser = function(user, user_profile){

		$scope.tmpfirstname = user.firstname;
		$scope.tmplastname = user.lastname;

		$scope.user.firstname = user.firstname;
		$scope.user.middlename = user.middlename;
		$scope.user.lastname = user.lastname;
		$scope.user.email_address = user.email_address;
		$scope.user.contact_number = user.contact_number;
		$scope.user.position = user.position;
		$scope.user.contact_number = user.contact_number;
		$scope.province_name = user.province_name;
		$scope.municipality_name = user.municipality_name;
		$scope.office_name = user.office_name;

		angular.forEach($scope.provinces, function (province) {
            if(province.psgc_code == user.province_psgc){
            	$scope.user.province = province;
            }
        });

        angular.forEach($scope.municipalities, function (municipality) {
            if(municipality.psgc_code == user.municipality_psgc){
            	$scope.user.municipality = municipality;
            }
        });

        if(typeof user_profile !== 'undefined'){

	        $scope.user.bio 				= 	user_profile.user_bio;
			$scope.user.description 		= 	user_profile.user_description;
			$scope.user.address 			= 	user_profile.user_address;
			$scope.user.fb					= 	user_profile.user_fb;
			$scope.user.instagram 			= 	user_profile.user_instagram;
			$scope.user.twitter 			= 	user_profile.user_twitter;

			$scope.tmp_profile 				= 	user_profile.user_profile_pic;
			$scope.tmp_banner 				= 	user_profile.user_banner
			$scope.tmp_bio 					= 	user_profile.user_bio;

		}

	};

	$scope.confirmBox = function(){

		$.confirm({
        title: '<i class="fa fa-question-circle txt-warning"></i> <span class="txt-warning">Confirm</span>',
        content: '<span class="txt-dark">Are you sure you want to continue saving changes to your profile.</span>',
        type: 'orange',
        typeAnimated: true,
        buttons: {
            Ok: {
                text: 'Confirm',
                btnClass: 'btn-warning',
                action: function(){

                	$http.post(serverip+"saveProfile",$scope.user.toJSONv2()).then(function(response){
						location.reload();
					}).catch(function(error) {
			           console.log(error);
			        });
                }
            },
            cancel: {
                text: 'Cancel',
                action: function(){
                	console.log(1);
                }
            },
        }
      });

	};


	$scope.confirmChanges = function(){
		if($scope.user.invalidUserinputv2().length > 0){
			$scope.hideError = 0;
		}else{
			$scope.confirmBox();
		}
	};

	$scope.addnewItem = function(){
		$scope.cart.addItems();
	    $scope.selectAllItems = false;
	    angular.forEach($scope.cart.items_list, function (item) {
	        item.check = $scope.selectAllItems;
	    });

	};

	$scope.removeItem = function(index){
    	$scope.cart.removeItem(index);
    };

    $scope.deletemarkItems = function(){
	    $scope.cart.deletemarkItems();
	    $scope.selectAllItems = false;

    };

    $scope.checkAllItems = function(){
    	if ($scope.selectAllItems) {
	    	$scope.selectAllItems = true;
	    }else{
	    	$scope.selectAllItems = false;
	    }
	    angular.forEach($scope.cart.items_list, function (item) {
            item.check = $scope.selectAllItems;
        });
    };


    $scope.checkRequested = function(){
    	if($scope.cart.invalidInputs().length > 0){
    		$scope.hideitemError = false;
    	}else{

    		$scope.hideitemError = true;

    		const fd = new FormData();

			fd.append('subject', $scope.cart.subject);
			fd.append('incident_name', $scope.cart.incident_name);
			fd.append('incident_date', new Date($scope.cart.incident_date).toISOString());
			fd.append('estimated_family', $scope.cart.estimated_family);

			angular.forEach($scope.cart.items_list,function(item){
	    		fd.append('items_requested[]',item.item_requested);
	    		fd.append('quantity_requested[]',item.quantity_requested);
		 	});

	    	angular.forEach($scope.cart.dromic_file,function(file){
	    		fd.append('file[]',file);
		 	});

		 	angular.forEach($scope.cart.request_file,function(file){
	    		fd.append('file[]',file);
		 	});

			$.ajax({
		        url: serverip + "saveAugmentationRequest",
		        type: 'POST',
		        data: fd,
		        async: false,
		        success: function (data) {

		        	var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Request Sent Successfully...</strong>', {
					    type: 'theme',
					    allow_dismiss: true,
					    delay: 2000,
					    showProgressbar: true,
					    timer: 300,
					    background: "#D44950",
					    animate:{
					        enter:'animated fadeInDown',
					        exit:'animated fadeOutUp'
					    }
					});

					$scope.cart.subject 			= "";
					$scope.cart.incident_name 		= "";
					$scope.cart.incident_date 		= "";
					$scope.cart.estimated_family 	= "";
					$scope.cart.items_list 			= [];
					$dromic_file 					= "";
					$request_file 					= "";
					$('#dromic_file').val('');
					$('#request_file').val('');
		        },
		        cache: false,
		        contentType: false,
		        processData: false
		    });

    	}
    };

    $scope.showEditAttachmentModal = () =>{
    	$('#editAttachmentsModal').modal("show");
    }

    $scope.cancelRequest = function(request){

    	let data = {
    		request_id : request.id
    	}

    	$http.post(serverip+"cancelRequest",data).then(function(response){

    		var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Request cancelled...</strong>', {
			    type: 'theme',
			    allow_dismiss: true,
			    delay: 2000,
			    showProgressbar: true,
			    timer: 300,
			    background: "#D44950",
			    animate:{
			        enter:'animated fadeInDown',
			        exit:'animated fadeOutUp'
			    }
			});

			$scope.get_request_list();

		}).catch(function(error) {
           console.log(error);
        });

    };

    $scope.selectProfile = function(){
    	$("#file_profile").trigger('click');
    };

    $scope.selectProfileBanner = function(){
    	$("#file_banner").trigger('click');
    };

    $scope.uploadFile = function(){

    	const fd = new FormData();

    	angular.forEach($scope.user.profile_pic,function(file){
    		fd.append('file[]',file);
	 	});

		$.ajax({
	        url: serverip + "uploadProfilePic",
	        type: 'POST',
	        data: fd,
	        async: false,
	        error: function (request, error) {
		        alert("File not uploaded: " + error);
		    },
		    success: function (data) {

	        	var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Upload saved...</strong>', {
				    type: 'theme',
				    allow_dismiss: true,
				    delay: 2000,
				    showProgressbar: true,
				    timer: 300,
				    background: "#D44950",
				    animate:{
				        enter:'animated fadeInDown',
				        exit:'animated fadeOutUp'
				    }
				});
	        	$http.post(serverip+"get_user_details",datas).then(function(response){
					$scope.getUser(response.data.user[0], response.data.user_profile[0]);
				});
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });

    };

    $scope.uploadFileBanner = function(){

    	const fd = new FormData();

    	angular.forEach($scope.user.profile_banner,function(file){
    		fd.append('file[]',file);
	 	});

		$.ajax({
	        url: serverip + "uploadProfileBanner",
	        type: 'POST',
	        data: fd,
	        async: false,
	        error: function (request, error) {
		        alert("File not uploaded: " + error);
		    },
	        success: function (data) {

	        	var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Upload saved...</strong>', {
				    type: 'theme',
				    allow_dismiss: true,
				    delay: 2000,
				    showProgressbar: true,
				    timer: 300,
				    background: "#D44950",
				    animate:{
				        enter:'animated fadeInDown',
				        exit:'animated fadeOutUp'
				    }
				});

	        	$http.post(serverip+"get_user_details",datas).then(function(response){
					$scope.getUser(response.data.user[0], response.data.user_profile[0]);
				});
	        },
	        cache: false,
	        contentType: false,
	        processData: false
	    });

    };

	if(mapdiv.length){

		$http.get("pages/get_mun_centroid").then(function(response){

			var centroid = response.data.centroid;

			var latlng = [Number(centroid[0].latitude), Number(centroid[0].longitude)];

			map = new L.map('map').setView(latlng, 12.5);

			L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
			    attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
			    maxZoom: 18
			}).addTo(map);

			json = JSON.parse(response.data.geojson);

			var markers = L.markerClusterGroup();

			var ecs = L.geoJSON([json], {

				style: function (feature) {
					return feature.properties && feature.properties.style;
				},

				onEachFeature: onEachFeature,

				pointToLayer: function (feature, latlng) {
					return L.circleMarker(latlng, {
						radius: 8,
						fillColor: '#DC143C',
						color: '#FFF',
						weight: 1,
						opacity: 1,
						fillOpacity: 0.9
					});
				}

			});

			function onEachFeature(feature, layer) {
			    layer.on({
			        click: onMapClick,
			        mouseover: onMouseOver,
			        mouseout: function(){
			        	this.closePopup();
			        }
			    });
			}

			function onMouseOver(e){
				console.log(e);
				var p = L.point([e.originalEvent.clientX,e.originalEvent.clientY])
		        var latlng = map.containerPointToLatLng(p);
		        this.bindPopup(e.target.feature.properties.evacuation_name+"<br><br><label>Click to open details</label>").openPopup();
			}

			function onMapClick(e) {
				$scope.$apply(function() {
				    $scope.ec = e.target.feature.id;
				    for(i = 0 ; i < $scope.ec_lists.length ; i++){
						if($scope.ec_lists[i]._index == $scope.ec){
							$scope.viewECDetails($scope.ec_lists[i]);
						}
					}
				});
			}

			markers.addLayer(ecs);

      		map.addLayer(markers);
			
		});

	}

});
