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

  $scope.hideList = false;
  $scope.hideDetails = true;
  $scope.hideEditDetails = true;

  $scope.requestList = false;
  $scope.requestDetail = true;
  $scope.requestApproveDetails = true;

  $scope.evacuation_center = new Evacuation_Center();

  $scope.fully_delivered = true;

  $scope.showloader = 0;

  var datas = {
    username : session
  };

  $scope.approvedItems = [];

  // Libraries 
  $scope.statuses = [
		{
			value 		  : "Pending",
			description	: "Pending/Lacking Documents"
		},
		{
			value 		  : "Approved",
			description	: "Approved for Assessment"
		},
		{
			value 		  : "Disapproved",
			description	: "Disapproved"
		},
    {
      value       : "Cancelled",
      description : "Cancelled"
    }
	];

  $scope.request_status = $scope.statuses[0];

  $scope.update_deliveries = [];

  // End Libraries

  var serverip = "../fopages/"

  $scope.Msgbox = (text) =>{

		$.confirm({
        title: '<i class="fa fa-question-circle txt-danger"></i> <span class="txt-danger">Error</span>',
        content: '<span class="txt-dark">'+text+'</span>',
        type: 'red',
        typeAnimated: true,
        buttons: {
            Ok: {
                text: 'Okay',
                btnClass: 'btn-danger',
                action: function(){
                  console.log(1);
                }
            }
        }
      });

	};

  setTimeout(function(){
    $http.post(serverip+"get_fo_user_details_db",datas).then(function(response){
      $scope.getuserDetail(response.data[0]);
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
    $scope.fouser.email_address         = user.email_address;

    $scope.fouser.bio                   = user.user_bio;
    $scope.fouser.description           = user.user_description;
    $scope.fouser.address               = user.user_address;
    $scope.fouser.fb                    = user.user_fb;
    $scope.fouser.instagram             = user.user_instagram;
    $scope.fouser.twitter               = user.user_twitter;
    $scope.fouser.profile_pic           = user.user_profile_pic;
    $scope.fouser.banner                = user.user_banner;

    $scope.tmpfirstname                 = user.first_name;
    $scope.tmplastname                  = user.last_name;

    $scope.tmp_profile                  = ($scope.fouser.profile_pic != null || $scope.fouser.profile_pic == "") ? "../uploads_profile/"+$scope.fouser.profile_pic : $scope.fouser.image_path;
    $scope.tmp_banner                   = user.user_banner;

    $scope.tmp_bio                      = user.user_bio;

  };

  const manage_request = $('#manage_request');

  $scope.get_augmentation_list = function(){

    $scope.augmentation_list = [];
    $scope.unread_augmentation = 0;  

    $http.get(serverip+"get_augmentation_list").then(function(response){
      $scope.augmentation_list = response.data;

      angular.forEach($scope.augmentation_list, function (request) {
        if(request.is_read == 0){
          $scope.unread_augmentation += 1;
        }
      });

    });

  }

  const track_approved_request = $('#track_approved_request');

  $scope.get_approved_augmentation_list = function(){

    $scope.augmentation_list = [];
    $scope.unread_augmentation = 0;  

    $http.get(serverip+"get_approved_augmentation_list").then(function(response){
      $scope.augmentation_list = response.data.approved_request;

      angular.forEach($scope.augmentation_list, function (request) {
        if(request.is_read == 0){
          $scope.unread_augmentation += 1;
        }
      });

    });

  }

  const page_request_summary = $('#page_request_summary');

  $scope.get_request_summary = function(){

    $scope.augmentation_list = [];

    $http.get(serverip+"get_approved_augmentation_list").then(function(response){
      $scope.augmentation_list = response.data.approved_request;
    });

  }

  $scope.refresh_approved_augmentation_list = function(request_id){

    $scope.augmentation_list = [];
    $scope.unread_augmentation = 0;  

    $http.get(serverip+"get_approved_augmentation_list").then(function(response){
      $scope.augmentation_list = response.data.approved_request;
      angular.forEach($scope.augmentation_list, function (request) {
        if(request.is_read == 0){
          $scope.unread_augmentation += 1;
        }
        if(request_id == request.id){
          $scope.response_letter_file = request.response_letter_file;
          $scope.assessment_report = request.assessment_report;
          $scope.assessment_report_file = request.assessment_report;
        }
      });
    });

  }

  $scope.UpdateDeliveries = (request) =>{
    $('#UpdateDeliveriesModal').modal('show');

    let data = {
      id : request.id
    }

    $scope.items_to_be_delivered = [];

    $http.post(serverip+"get_approved_items",data).then(function(response){
      $scope.approved_items = response.data;
      angular.forEach(response.data, function (item) {
        $scope.items_to_be_delivered.push({
          'item_id'                           : item.id,
          'request_id'                        : item.request_id,
          'approved_item'                     : item.approved_item,
          'approved_quantity'                 : Number(item.approved_quantity),
          'delivered_quantity'                : '',
          'delivery_date'                     : '',
          'already_delivered_quantity'        : Number(item.delivered)
        })
      });
    })
  }

  $scope.SaveDeliveries = () =>{

    $scope.deliveries = [];
    let d = 0;

    if($scope.fully_delivered === true){
      $scope.deliveries = [];
      angular.forEach($scope.items_to_be_delivered, function (item) {
        if((item.already_delivered_quantity <= item.approved_quantity) && ((item.approved_quantity - item.already_delivered_quantity) > 0)){
            $scope.deliveries.push({
              'item_id'             : item.item_id,
              'request_id'          : item.request_id,
              'quantity_delivered'  : (item.approved_quantity - item.already_delivered_quantity),
              'date_delivered'      : $scope.delivery_full_date
            })
          }
        });
      if($scope.deliveries.length > 0){
        if(typeof $scope.delivery_full_date === "undefined" || $scope.delivery_full_date == null || $scope.delivery_full_date == ""){
          $scope.Msgbox("Delivery date must not be blank");
        }else{
          $http.post(serverip+"save_delivered_items",$scope.deliveries).then(function(response){
            $('#UpdateDeliveriesModal').modal('hide');
            var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Data successfully saved...</strong>', {
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
            $scope.fully_delivered = true;
          })
        }
      }else{
        $scope.Msgbox("Cannot update deliveries, all items are fully delivered!");
      }
    }else{
      if($scope.fully_delivered == false){
        $scope.deliveries = [];
        let strError = "";
        let items = $scope.items_to_be_delivered;
        for(i = 0 ; i < items.length ; i++){
          if(Number(items[i].delivered_quantity) != 0){
            if(Number(items[i].delivered_quantity) > Number(items[i].approved_quantity)){
              strError += "Item # "+(i+1)+" to be delivered quantity must not be greater than the approved quantity<br/>";
            }else{
              if(Number(items[i].delivered_quantity) > 0){
                if(typeof items[i].delivery_date === "undefined" || items[i].delivery_date == null || items[i].delivery_date == ""){
                  strError += "Item # "+(i+1)+" to be delivery date must not be blank<br/>";
                }
              }
            }
          }
        }
        if(strError.length > 1){
          $scope.Msgbox(strError);
        }else{
          angular.forEach($scope.items_to_be_delivered, function (item) {
            if(Number(item.delivered_quantity) > 0){
              $scope.deliveries.push({
                'item_id'             : item.item_id,
                'request_id'          : item.request_id,
                'quantity_delivered'  : item.delivered_quantity,
                'date_delivered'      : item.delivery_date
              })
            }
          });
          if($scope.deliveries.length > 0){
            $http.post(serverip+"save_delivered_items",$scope.deliveries).then(function(response){
              $('#UpdateDeliveriesModal').modal('hide');
              var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Data successfully saved...</strong>', {
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
            })
          }
        }
      }
    }
  }

  $scope.saveApprovedRequest = () =>{
    let str = "";
    let invalid_inputs = [];
    if($scope.approvedItems.length === 0){
      $scope.Msgbox('Kindly specify items to be augmented!');
    }else{
      for(var i = 0 ; i < $scope.approvedItems.length ; i ++){
        if(typeof $scope.approvedItems[i].approvedItem === "undefined" || $scope.approvedItems[i].approvedItem == "" || $scope.approvedItems[i].approvedItem == null){
          str += "[Item] ";
        }
        if(typeof $scope.approvedItems[i].approvedQuantity === "undefined" || $scope.approvedItems[i].approvedQuantity == "" || $scope.approvedItems[i].approvedQuantity == null || $scope.approvedItems[i].quantity_requested == 0){
          str += "[Quantity] ";
        }
        if(str != ""){
          invalid_inputs.push("Item # "+(i+1)+"'s Approved "+str+" are requred!");
        }
        str = "";
      }
      if(invalid_inputs.length > 0){
        str = "";
        for(i in invalid_inputs){
          str += invalid_inputs[i] + "<br>";
        }
        $scope.Msgbox(str);
      }else{

        $scope.request_specifics = [];
        $scope.data = [];
        
        angular.forEach($scope.approvedItems, function (item) {
          $scope.data.push({
            request_id        : $scope.reqDetails.id,
            approved_item     : item.approvedItem,
            approved_quantity : item.approvedQuantity
          })
        });

        $scope.request_specifics.push({data: $scope.data});
        $scope.request_specifics.push({specifics: $scope.reqDetails});

        $http.post(serverip+"saveApprovedRequest",$scope.request_specifics).then(function(response){

          var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Data successfully saved...</strong>', {
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

          $scope.get_augmentation_list();
          $scope.backtorequestList(1);

        });

      }
    }
  }

  $scope.savePendingRequest = () =>{

    if($scope.request_remarks === "" || $scope.request_remarks === null || typeof $scope.request_remarks === "undefined"){
      $scope.Msgbox('Please provide some remarks.');
    }else{

      let data = {
        request_status  : $scope.request_status.value,
        request_remarks : $scope.request_remarks,
        specifics       : $scope.reqDetails
      }

      $http.post(serverip+"savePendingRequest",data).then(function(response){

        var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Data successfully saved...</strong>', {
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

        $('#requestDetailsModal').modal('hide');

        $scope.get_augmentation_list();
        $scope.backtorequestList(1);

      });
    }
  }

  $scope.showButton = function(file){
    if(file){
      return 1;
    }
    return 0;
  }

  $scope.requestDetails = function(event, request){
    if(event.target.nodeName == "TD"){
      $scope.reqDetails = request;

      let data = {
        id : request.id
      }

      $http.post(serverip+"get_requested_items",data).then(function(response){
        $scope.requested_items = response.data;
      });

      $http.post(serverip+"get_approved_items",data).then(function(response){
        $scope.approved_items = response.data;
      });

      $http.post(serverip+"get_request_status",data).then(function(response){
        $scope.request_status_file = response.data;
        $scope.response_letter_file = $scope.request_status_file[0].response_letter_file;
        $scope.assessment_report = $scope.request_status_file[0].assessment_report;
        $scope.assessment_report_file = $scope.request_status_file[0].assessment_report;
      });

      angular.forEach($scope.statuses, function(status){
        if(request.request_status == status.value){
          $scope.request_status = status;
        }
      })

      $scope.requestList = true;
      $scope.requestDetail = false;
    }
  }

  $scope.attachReplyLetter = function(){
    $('#attachReplyLetterModal').modal('show');
  }

  $scope.attachAssessmentReport = function(){
    $('#attachAssessmentReportModal').modal('show');
  }

  $scope.validateEmail = function(email){
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());

  }

  $scope.save_and_send_response_file = function(){

    $scope.showloader = 1;

    setTimeout(function(){
      if($scope.response_letter == null || $scope.response_letter == "" || $scope.response_letter.length < 1){
        $scope.Msgbox('Please select a file first...');
      }else{

        if($scope.email_recipient == null || $scope.email_recipient == ""){

          const fd = new FormData();

          fd.append('request_id',$scope.reqDetails.id);
          fd.append('requester_email',$scope.reqDetails.username_email);
          fd.append('cc_emails',"");

          angular.forEach($scope.response_letter,function(file){
            fd.append('file[]',file);
          });

          $.ajax({
            url: serverip + "SaveAndSendFile",
            type: 'POST',
            data: fd,
            async: false,
            success: function (data) {

              var notify = $.notify('<i class="fa fa-bell-o"></i><strong> File successfully saved and sent to requesting LGU...</strong>', {
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

              $('#response_letter').val('');
              $('#attachReplyLetterModal').modal('hide');
              $scope.refresh_approved_augmentation_list($scope.reqDetails.id);
              $scope.showloader = 0;
            },
            cache: false,
            contentType: false,
            processData: false
          });

        }else{
          let emails = $scope.email_recipient.replace(/\s/g, "");
          let i = 0;
          emails = emails.split(",");
          angular.forEach(emails, function(email){
            if($scope.validateEmail(email)){
              i += 1;
            }
          })
          if(i == emails.length){

            const fd = new FormData();

            fd.append('request_id',$scope.reqDetails.id);
            fd.append('requester_email',$scope.reqDetails.username_email);

            angular.forEach($scope.response_letter,function(file){
              fd.append('file[]',file);
            });

            fd.append('cc_emails',$scope.email_recipient.replace(/\s/g, ""));

            $.ajax({
              url: serverip + "SaveAndSendFile",
              type: 'POST',
              data: fd,
              async: false,
              success: function (data) {
                var notify = $.notify('<i class="fa fa-bell-o"></i><strong> File successfully saved and sent to requesting LGU...</strong>', {
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
                $('#response_letter').val('');
                $('#attachReplyLetterModal').modal('hide');
                $scope.refresh_approved_augmentation_list($scope.reqDetails.id);
                $scope.showloader = 0;
              },
              cache: false,
              contentType: false,
              processData: false
            });
          }else{
            $scope.Msgbox('Please provide valid email addresses...');
          }
        }
        
      }
    },2000)

  }

  $scope.save_assessment_report = function(){

    if($scope.assessment_report == null || $scope.assessment_report == "" || $scope.assessment_report.length < 1){
      $scope.Msgbox('Please select a file first...');
    }else{

      const fd = new FormData();

      fd.append('request_id',$scope.reqDetails.id);

      angular.forEach($scope.assessment_report,function(file){
        fd.append('file[]',file);
      });

      $.ajax({
        url: serverip + "SaveAndSendFileAssessment",
        type: 'POST',
        data: fd,
        async: false,
        success: function (data) {
          var notify = $.notify('<i class="fa fa-bell-o"></i><strong> File successfully saved...</strong>', {
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
          $('#assessment_report').val('');
          $('#attachAssessmentReportModal').modal('hide');
          $scope.refresh_approved_augmentation_list($scope.reqDetails.id);
        },
        cache: false,
        contentType: false,
        processData: false
      });
      
    }

  }

  $scope.backtorequestList = function(bool){
    if(bool == 1){
      $scope.requestList = !bool;
      $scope.requestDetail = bool;
      $scope.requestApproveDetails = bool;
    }else{
      $scope.requestList = !bool;
      $scope.requestDetail = bool;
      $scope.requestApproveDetails = !bool;
    }
    
  }

  $scope.viewFile = function(file){
    $scope.requestfile = "../uploads_request/"+file;
    //$('#modalFileViewer').modal("show");
    window.open($scope.requestfile,"MsgWindow", "width=900,height=900");
  }

  $scope.parseDate = function(date){
    const d = new Date(date);
    return d.toDateString();
  }

  $scope.isreadRequest = function(status){
    return status == "0" ? 'notread' : 'isread';
  }

  $scope.getfileClass = function(filename){
		var ext = filename.split(".").pop();

    ext = ext.toLowerCase();

		if(ext == 'docx' || ext == 'doc'){
			return 'W';
		}else if(ext == 'xlsx' || ext == 'xls'){
			return 'X';
		}else if(ext == 'pdf'){
			return 'PDF';
		}else if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'bmp'){
			return 'IMG';
		}

	}

  $scope.getfileClass2 = function(filename){
		var ext = filename.split(".").pop();

    ext = ext.toLowerCase();

		if(ext == 'docx' || ext == 'doc'){
			return 'badge badge-primary';
		}else if(ext == 'xlsx' || ext == 'xls'){
			return 'badge badge-success';
		}else if(ext == 'pdf'){
			return 'badge badge-danger';
		}else if(ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif' || ext == 'bmp'){
			return 'badge badge-warning';
		}

	}

  $scope.saveRequestStatus = function(){

    if($scope.request_status.value === "Pending" || $scope.request_status.value === "Disapproved" || $scope.request_status.value === "Cancelled"){
      $('#requestDetailsModal').modal('show');
    }else{
      $scope.requestApproveDetails = false;
      $scope.requestDetail = true;
    }

  }

  $scope.sliceFile = function(filename){
    let ext = filename.split(".");

    const count = 30;
    if(filename){
      return filename.slice(0, count) + (filename.length > count ? ("..."+ ext[ext.length-1]) : "");
    }
  }

  if(manage_request.length){

    $scope.get_augmentation_list();

    const source = new EventSource(serverip+"demo_sse");
    source.onmessage = function(event) {
      if(event.data != "0"){
        $scope.get_augmentation_list();
      }
    };
  }

  if(track_approved_request.length){
    $scope.get_approved_augmentation_list();
  }

  if(page_request_summary.length){
    $scope.get_request_summary();
  }

  $scope.calculateDiff = (date1, date2) =>{
    let request_date = new Date(date1);
    let approved_date = new Date(date2);
    let days = Math.floor((approved_date.getTime() - request_date.getTime()) / 1000 / 60 / 60 / 24);
    return days;
  }

  $scope.calculateAverage = (lists) =>{
    let sum_days = 0;
    angular.forEach(lists, function (list) {
      let request_date = new Date(list.date_requested);
      let approved_date = new Date(list.approved_date);
      sum_days += Math.floor((approved_date.getTime() - request_date.getTime()) / 1000 / 60 / 60 / 24);
    });
    return (sum_days/lists.length);
  }

  $scope.removeItem = (x) =>{
    $scope.approvedItems.splice(x, 1);
  }

  $scope.deletemarkItems = () =>{
    var oldList = $scope.approvedItems;
    $scope.approvedItems = [];

    for(var i in oldList){
      if(!oldList[i].check) $scope.approvedItems.push(oldList[i]);
    }
  }

  $scope.addApprovedItems = () =>{
    var id = $scope.approvedItems.length + 1;

		$scope.approvedItems.push({
			id 						        : id,
			approvedItem 			  : "",
			approvedQuantity		: 0,
			check 					      : false
		})
  }

  var ec_list = $('#ec_list');
  var mapdiv = $('#map');

  if(ec_list.length || mapdiv.length){

    $http.get(serverip+"get_ec_libraries").then(function(response){
      

      $scope.availability_status = response.data['availability_status'];
      $scope.availability_status.unshift({
        id        : 0,
        lib_name    : "Select Availability Status",
      });
      $scope.evacuation_center.availability_status = $scope.availability_status[0];

      $scope.building_status = response.data['building_status'];
      $scope.building_status.unshift({
        id        : 0,
        lib_name    : "Select Building Status",
      });
      $scope.evacuation_center.building_status = $scope.building_status[0];

      $scope.source_of_water = response.data['source_of_water'];
      $scope.source_of_water.unshift({
        id        : 0,
        lib_name    : "Select Water Source",
      });
      $scope.evacuation_center.source_of_water = $scope.source_of_water[0];

      $scope.type_of_building = response.data['type_of_building'];
      $scope.type_of_building.unshift({
        id        : 0,
        lib_name    : "Select Building Type",
      });

      $scope.evacuation_center.type_of_building = $scope.type_of_building[0];

    });

    $scope.calculateAve = (item) => {
      return ((Number(item)/Number($scope.ec_length[0].y)) * 100);
    }

    $scope.getItemTotal = (arr) =>{
      let sum = 0;
      angular.forEach(arr, function (item) {
        sum += Number(item.y);
      });
      return sum;
    }

    $scope.char = (data) =>{
      console.log(data);
    }


    $scope.get_ECs = (page_number = 1) =>{

      let data = {
        'offset' :  page_number == 1 ? 0 : ((100*page_number) - 100)
      };

      $http.post(serverip+"get_all_ECs",data).then(function(response){
        $scope.ec_lists = response.data.ec;
        $scope.photos = response.data.photos
      })
    }

    $scope.get_ECs(1);

    $http.get(serverip+"get_eclists",).then(function(response){

      $scope.pagenumber = [];

      for(i = 1; i <= response.data.page ; i++){
        $scope.pagenumber.push({
          num : i
        });
      }

      $scope.offset_pagenumber = $scope.pagenumber[0];

      $scope.ec_length = response.data.ec_count;
      $scope.data_muni = response.data.muni
      $scope.data_type_of_building = response.data.type_of_building
      $scope.data_building_status = response.data.building_status
      $scope.data_availability_status = response.data.availability_status
      $scope.data_ffps_storage_availability = response.data.ffps_storage_availability
      $scope.data_compost_pit_latrine = response.data.compost_pit_latrine
      $scope.data_female_cr = response.data.female_cr
      $scope.data_male_cr = response.data.male_cr
      $scope.data_common_cr = response.data.common_cr
      $scope.data_source_of_potable_water = response.data.source_of_potable_water
      $scope.data_source_of_non_potable_water = response.data.source_of_non_potable_water

      $scope.viewChart('container_brgy','Number of Profiled ECs per City/Municipality','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','City/Municipality',response.data.muni);
      $scope.viewChart('container_type_of_buildings','Number of Profiled ECs per Type of Building','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Type of Building',response.data.type_of_building);
      $scope.viewChart('container_building_status','Number of Profiled ECs per Building Status','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Building Status',response.data.building_status);
      $scope.viewChart('container_availability_status','Number of Profiled ECs per Availability Status','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Availability Status',response.data.availability_status);
      $scope.viewChart('container_ffp_storage_availability','Number of Profiled ECs per per FFP Storage Facility','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Storage Facility',response.data.ffps_storage_availability);
      $scope.viewChart('container_compost_pit_latrine','Number of Profiled ECs per Number of Compost Pit Latrine','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Compost Pit Latrine',response.data.compost_pit_latrine);
      $scope.viewChart('container_female_cr','Number of Profiled ECs per Number of Female Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Female Comfort Rooms',response.data.female_cr);
      $scope.viewChart('container_male_cr','Number of Profiled ECs per Number of Male Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Male Comfort Rooms',response.data.male_cr);
      $scope.viewChart('container_common_cr','Number of Profiled ECs per Number of Common Comfort Rooms','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Common Comfort Rooms',response.data.common_cr);
      $scope.viewChart('container_source_of_potable_water','Number of Profiled ECs per Source of Potable Water','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Source of Potable Water',response.data.source_of_potable_water);
      $scope.viewChart('container_source_of_non_potable_water','Number of Profiled ECs per Source of Non Potable Water','Source: Enumerated Data Base on the Evacuation Center Profiling Tool','Number of Profiled ECs','Source of Non Potable Water',response.data.source_of_non_potable_water);

    });

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

  // $scope.viewECDetails = function(ec){

  //   $scope.ecDetail = ec;
  //   $scope.spec_photos = [];

  //   angular.forEach($scope.photos, function (photo) {
  //       if(ec._index == photo._parent_index){
  //         $scope.spec_photos.push(photo.Photo);
  //       }
  //   });

  //   $scope.hideList = true;
  //   $scope.hideDetails = false;
  //   $scope.hideEditDetails = true;
  // }

  $scope.editECDetails = function(ec){

    $scope.hideList = true;
    $scope.hideDetails = true;
    $scope.hideEditDetails = false;

    $scope.ecDetail = ec;
    $scope.spec_photos = [];

    angular.forEach($scope.photos, function (photo) {
            if(ec._index == photo._parent_index){
              $scope.spec_photos.push(photo);
            }
        });

    $scope.evacuation_center.id                                 = ec._id;
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

  $scope.confirmChanges = function(){

    $http.post(serverip+"updateProfile",$scope.fouser.toJSONv2()).then(function(response){

      var notify = $.notify('<i class="fa fa-bell-o"></i><strong> Profile updated..</strong>', {
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

      $scope.getuserDetail(response.data[0]);
    });

  }

  $scope.selectProfile = function(){
    $("#file_profile").trigger('click');
  };

  $scope.selectProfileBanner = function(){
    $("#file_banner").trigger('click');
  };

  $scope.uploadFile = function(){

    const fd = new FormData();

    angular.forEach($scope.fouser.profile_pic,function(file){
      fd.append('file[]',file);
    });

    $.ajax({
        url: serverip + "uploadProfilePic",
        type: 'POST',
        data: fd,
        async: false,
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

          $http.post(serverip+"get_fo_user_details_db").then(function(response){
            $scope.getuserDetail(response.data[0]);
          });

        },
        cache: false,
        contentType: false,
        processData: false
    });

  };

  $scope.uploadFileBanner = function(){

    const fd = new FormData();

    angular.forEach($scope.fouser.profile_banner,function(file){
      fd.append('file[]',file);
    });

    $.ajax({
      url: serverip + "uploadProfileBanner",
      type: 'POST',
      data: fd,
      async: false,
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

        $http.post(serverip+"get_fo_user_details_db").then(function(response){
          $scope.getuserDetail(response.data[0]);
        });
      },
      cache: false,
      contentType: false,
      processData: false
    });

  };

  // $scope.showRow = (request) =>{
  //   return request.request_status !== 'Cancelled';
  // }
  

  $scope.viewECDetails = function(ec){

    $scope.ecDetail = ec;
    $scope.spec_photos = [];

    angular.forEach($scope.photos, function (photo) {
            if(ec._index == photo._parent_index){
              $scope.spec_photos.push(photo.Photo);
            }
        });

    $scope.hideList = true;
    $scope.hideDetails = false;
    $scope.hideEditDetails = true;

  }

  $scope.viewECDetails2 = function(ec, photos){

    console.log(ec);

    $scope.ecDetail = ec;
    $scope.spec_photos = [];

    angular.forEach(photos, function (photo) {
      $scope.spec_photos.push(photo.Photo);
    });

    $scope.hideList = true;
    $scope.hideDetails = false;
    $scope.hideEditDetails = true;

  }

  if(mapdiv.length){

		$http.get(serverip+"get_mun_centroid").then(function(response){

			var latlng = [9.222684960264164, 125.68711947081457];

			map = new L.map('map').setView(latlng, 8.5);

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
						fillColor: '#D64DCF',
						color: '#9528AE',
						weight: 1,
						opacity: 1,
						fillOpacity: 0.7
					});
				}

			})

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
				var p = L.point([e.originalEvent.clientX,e.originalEvent.clientY])
		        var latlng = map.containerPointToLatLng(p);
		        this.bindPopup(e.target.feature.properties.evacuation_name+"<br><br><label>Click to open details</label>").openPopup();
			}

			function onMapClick(e) {

				$scope.$apply(function() {

            const data = {
              id : e.target.feature.id
            }

            $http.post(serverip+"get_ec",data).then(function(response){
                $scope.viewECDetails2(response.data.ec[0], response.data.photos);
            });

				  //   for(i = 0 ; i < $scope.ec_lists.length ; i++){
  				// 		if($scope.ec_lists[i]._index == $scope.ec){
  				// 			
  				// 		}
					 // }
				});
			}
      
      markers.addLayer(ecs);
      map.addLayer(markers);
			
		});

	}

});