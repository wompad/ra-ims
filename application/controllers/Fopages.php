<?php

header('Access-Control-Allow-Origin: *');

use webd\language\StringDistance;

defined('BASEPATH') OR exit('No direct script access allowed');

	class Fopages extends CI_Controller{

		public function __construct() {
    
		    parent::__construct();

		    $this->load->helper('url');

		    $this->load->library('encryption');

		}


		public function view($page = 'index'){

			 if(!file_exists(APPPATH.'views/fopages/'.$page.'.php')){
			 	show_404();
			 }

			if($page == 'index' || $page == 'setup_account_fo' || $page == 'x' || $page == 'temp_login' || $page == 'forgot_password'){
				$this->load->view('fopages/'.$page);
			}else{
				$this->load->view('template/header_fo');
				$this->load->view('fopages/'.$page);
				$this->load->view('template/footer_fo');
			}

		}

		function get_ec_libraries(){
			echo json_encode($data['result'][] = $this->raims->get_ec_libraries());
		}

		function saveECDetails(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->raims->saveECDetails($obj));
		}

		function searchFOUser(){

			$username = $_POST["username"];
			echo json_encode($data['result'][] = $this->fo->searchfoUser($username));
		}

		function Temp_Login(){

			$username = $_POST["username"];
			$password = $_POST["password"];

			echo json_encode($data['result'][] = $this->fo->Temp_Login($username, $password));

		}

		function logout(){
			session_destroy();
			header('Location: ../index');
		}

		function get_fo_user_details(){

			$username = $_SESSION["username"];

			$url = "https://caraga-portal.dswd.gov.ph/api/employee/list/search/?format=json&q=".$username;
			$options = array('http' => array(
			    'method'  => 'GET',
			    'header' => 'Authorization: Token e80ae0809d85c62d858598144aace7e0b2d0125a'
			));
			$context  = stream_context_create($options);
			$response = file_get_contents($url, false, $context);

			$n = strpos($response, "[");
			$response = substr_replace($response,"",0,$n+1);
			$response = substr_replace($response, "" , -1,1);
			$obj = json_decode($response,true);

			echo json_encode($obj);

		}

		function get_fo_user_details_db(){
			echo json_encode($data['result'][] = $this->fo->get_fo_user_details_db());;
		}

		function updateProfile(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->updateProfile($obj));
		}

		function get_eclists(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_eclists(),JSON_NUMERIC_CHECK);
		}

		function get_ec(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_ec($obj->id),JSON_NUMERIC_CHECK);
		}

		function get_all_ECs(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_all_ECs($obj->offset),JSON_NUMERIC_CHECK);
		}

		function saveFOUser(){
			
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->saveFOUser($obj));
		}

		function uploadProfilePic(){

			if(getimagesize($_FILES['file']['tmp_name'][0])){	
				// get details of the uploaded file
			    $fileTmpPath = $_FILES['file']['tmp_name'][0];
			    $fileName = $_FILES['file']['name'][0];
			    $fileSize = $_FILES['file']['size'][0];
			    $fileType = $_FILES['file']['type'][0];
			    $fileNameCmps = explode(".", $fileName);
			    $fileExtension = strtolower(end($fileNameCmps));
			 
			    // sanitize file-name
			    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;

			    // check if file has one of the following extensions
			    $allowedfileExtensions = array('jpg', 'gif', 'png','jpeg');
			 
			    if (in_array($fileExtension, $allowedfileExtensions)){
				    // directory in which the uploaded file will be moved
				    $uploadFileDir = './uploads_profile/';
				    $dest_path = $uploadFileDir . $newFileName;
				 
				    if(move_uploaded_file($fileTmpPath, $dest_path)){

				    	$file = array(
				    		'user_profile_pic' => $newFileName
				    	);

				    	echo json_encode($data['result'][] = $this->fo->uploadProfilePic($file),JSON_NUMERIC_CHECK);
				    }else{
				    	echo 0;
				    }
				}
			}
		}

		function uploadProfileBanner(){

			if(getimagesize($_FILES['file']['tmp_name'][0])){

				// get details of the uploaded file
			    $fileTmpPath = $_FILES['file']['tmp_name'][0];
			    $fileName = $_FILES['file']['name'][0];
			    $fileSize = $_FILES['file']['size'][0];
			    $fileType = $_FILES['file']['type'][0];
			    $fileNameCmps = explode(".", $fileName);
			    $fileExtension = strtolower(end($fileNameCmps));
			 
			    // sanitize file-name
			    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
			    			 
			    // check if file has one of the following extensions
			    $allowedfileExtensions = array('jpg', 'gif', 'png','jpeg');
			 
			    if (in_array($fileExtension, $allowedfileExtensions)){
				    // directory in which the uploaded file will be moved
				    $uploadFileDir = './uploads_banner/';
				    $dest_path = $uploadFileDir . $newFileName;
				 
				    if(move_uploaded_file($fileTmpPath, $dest_path)){

				    	$file = array(
				    		'user_banner' => $newFileName
				    	);

				    	echo json_encode($data['result'][] = $this->fo->uploadProfilePic($file),JSON_NUMERIC_CHECK);
				    }else{
				    	return 0;
				    }
				}
			}
		}

		function SaveAndSendFile(){

			$counter = 0;
			$request_id = $_POST['request_id'];
			$requester_email = $_POST['requester_email'];
			$cc_emails = $_POST['cc_emails'];

			$files_length = count($_FILES['file']['name']);

			$request = [];

			for($i = 0 ; $i < count($_FILES['file']['name']) ; $i++){

				// get details of the uploaded file
			    $fileTmpPath = $_FILES['file']['tmp_name'][$i];
			    $fileName = $_FILES['file']['name'][$i];
			    $fileSize = $_FILES['file']['size'][$i];
			    $fileType = $_FILES['file']['type'][$i];
			    $fileNameCmps = explode(".", $fileName);
			    $fileExtension = strtolower(end($fileNameCmps));
			 
			    // sanitize file-name
			    $newFileName = $fileName;

			    // check if file has one of the following extensions
			    $allowedfileExtensions = array('jpg', 'png','jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
			 
			    if (in_array($fileExtension, $allowedfileExtensions)){
				    // directory in which the uploaded file will be moved
				    $uploadFileDir = './uploads_request/';
				    $dest_path = $uploadFileDir . $newFileName;
				 
				    if(move_uploaded_file($fileTmpPath, $dest_path)){
				    	$counter = $counter + 1;
				    }
				}
			}

			if($counter == $files_length){
				$request = array(
					'response_letter_file' 					=> $newFileName,
					'response_letter_file_date_uploaded'	=> date("Y-m-d H:i:s")
				);
				echo json_encode($data['result'][] = $this->fo->SaveAndSendFile($request_id,$requester_email,$cc_emails,$request),JSON_NUMERIC_CHECK);
			}else{
				echo 0;
			}

		}

		function SaveAndSendFileAssessment(){

			$counter = 0;
			$request_id = $_POST['request_id'];

			$files_length = count($_FILES['file']['name']);

			$assessment = [];

			for($i = 0 ; $i < count($_FILES['file']['name']) ; $i++){

				// get details of the uploaded file
			    $fileTmpPath = $_FILES['file']['tmp_name'][$i];
			    $fileName = $_FILES['file']['name'][$i];
			    $fileSize = $_FILES['file']['size'][$i];
			    $fileType = $_FILES['file']['type'][$i];
			    $fileNameCmps = explode(".", $fileName);
			    $fileExtension = strtolower(end($fileNameCmps));
			 
			    // sanitize file-name
			    $newFileName = $fileName;

			    // check if file has one of the following extensions
			    $allowedfileExtensions = array('jpg', 'png','jpeg', 'pdf', 'doc', 'docx', 'xls', 'xlsx');
			 
			    if (in_array($fileExtension, $allowedfileExtensions)){
				    // directory in which the uploaded file will be moved
				    $uploadFileDir = './uploads_request/';
				    $dest_path = $uploadFileDir . $newFileName;
				 
				    if(move_uploaded_file($fileTmpPath, $dest_path)){
				    	$counter = $counter + 1;
				    }
				}
			}

			if($counter == $files_length){
				$assessment = array(
					'assessment_report' 					=> $newFileName,
					'assessment_report_date_uploaded'		=> date("Y-m-d H:i:s")
				);
				echo json_encode($data['result'][] = $this->fo->SaveAndSendFileAssessment($request_id,$assessment),JSON_NUMERIC_CHECK);
			}else{
				echo 0;
			}

		}

		function get_mun_centroid(){
			echo json_encode($data['result'][] = $this->fo->get_mun_centroid());
		}

		function get_augmentation_list(){
			echo json_encode($data['result'][] = $this->fo->get_augmentation_list());
		}

		function get_approved_augmentation_list(){
			echo json_encode($data['result'][] = $this->fo->get_approved_augmentation_list());
		}

		function get_requested_items(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_requested_items($obj->id));
		}

		function get_approved_items(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_approved_items($obj->id));
		}

		function get_delivered_items(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_delivered_items($obj->id));
		}

		function save_delivered_items(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->save_delivered_items($obj));
		}

		function get_request_status(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->get_request_status($obj->id));
		}

		function saveApprovedRequest(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->saveApprovedRequest($obj));
		}

		function savePendingRequest(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->fo->savePendingRequest($obj));
		}

		function demo_sse(){
			header('Content-Type: text/event-stream');
			header('Cache-Control: no-cache');

			echo "data: {$this->fo->demo_sse()}\n\n";
			flush();
		}

		function get_password(){
			echo json_encode($data['result'][] = $this->fo->get_password());
		}

	}


?>