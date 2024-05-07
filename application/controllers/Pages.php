<?php

use webd\language\StringDistance;

defined('BASEPATH') OR exit('No direct script access allowed');

	class Pages extends CI_Controller{

		public function __construct() {
    
		    parent::__construct();

		    $this->load->helper('url');
		    $this->load->helper('download');
		}


		public function view($page = 'index'){

			 if(!file_exists(APPPATH.'views/pages/'.$page.'.php')){
			 	show_404();
			 }

			if($page == 'index' || $page == 'signup' || $page == 'lgu_login' || $page == 'setup_account' || $page == 'forgot_password'){
				// $this->load->view('modal/modals');
				$this->load->view('pages/'.$page);
			}else{
				$this->load->view('template/header_lgu');
				$this->load->view('template/modals');
				$this->load->view('pages/'.$page);
				$this->load->view('template/footer_lgu');
			}

		}

		function server_event_request(){
			header('Content-Type: text/event-stream');
			header('Cache-Control: no-cache');

			echo "data: {$this->raims->server_event_request()}\n\n";
			flush();
		}

		function get_provinces(){
			echo json_encode($data['result'][] = $this->raims->get_provinces());
		}

		function get_municipalities(){
			echo json_encode($data['result'][] = $this->raims->get_municipalities());
		}

		function get_mun_centroid(){
			echo json_encode($data['result'][] = $this->raims->get_mun_centroid());
		}

		function get_downloadables(){
			echo json_encode($data['result'][] = $this->raims->get_downloadables());
		}

		function get_all_request(){
			echo json_encode($data['result'][] = $this->raims->get_all_request());
		}

		function get_video_materials(){
			echo json_encode($data['result'][] = $this->raims->get_video_materials());
		}

		function dl_file($file){

			$file = 'downloadable_files/'.$file;

			header('Content-Description: File Transfer');
		    header('Content-Type: application/octet-stream');
		    header('Content-Disposition: attachment; filename="'.basename($file).'"');
		    header('Expires: 0');
		    header('Cache-Control: must-revalidate');
		    header('Pragma: public');
		    header('Content-Length: ' . filesize($file));
		    readfile($file);

		    exit;

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

		function get_offices(){
			echo json_encode($data['result'][] = $this->raims->get_offices());
		}

		function searchUser(){
			$email = $_GET['email'];
			echo json_encode($data['result'][] = $this->raims->searchUser($email));
		}

		function get_email_address(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			$id = $obj->id;
			echo json_encode($data['result'][] = $this->raims->get_email_address($id));
		}

		function get_eclists(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->raims->get_eclists());
		}

		function saveECDetails(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);
			echo json_encode($data['result'][] = $this->raims->saveECDetails($obj));
		}

		function get_user_details(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);

			$id = $obj->id;

			echo json_encode($data['result'][] = $this->raims->get_user_details($id));
		}

		function get_ec_libraries(){
			echo json_encode($data['result'][] = $this->raims->get_ec_libraries());
		}

		function savelguUser(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);

			echo json_encode($data['result'][] = $this->raims->savelguUser($obj));
		}

		function saveProfile(){

			$json = file_get_contents('php://input');
			$obj = json_decode($json);

			echo json_encode($data['result'][] = $this->raims->saveProfile($obj));
		}

		function saveAugmentationRequest(){

			$counter = 0;
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

				$items_list = [];

				for($i = 0 ; $i < count($_POST['items_requested']) ; $i++){

					$item = array(
						'item_requested' 		=> $_POST['items_requested'][$i],
						'quantity_requested'	=> $_POST['quantity_requested'][$i]
					);

					array_push($items_list,$item);

				}

				$request = array(
					'subject' 			=> $_POST['subject'],
					'incident_name' 	=> $_POST['incident_name'],
					'incident_date' 	=> $_POST['incident_date'],
					'estimated_family' 	=> $_POST['estimated_family'],
					'dromic_report' 	=> $_FILES['file']['name'][0],
					'request_letter' 	=> $_FILES['file']['name'][1],
					'items' 			=> $items_list
				);

				echo json_encode($data['result'][] = $this->raims->saveAugmentationRequest($request),JSON_NUMERIC_CHECK);

			}else{
				echo 0;
			}

		}

		function cancelRequest(){
			$json = file_get_contents('php://input');
			$obj = json_decode($json);

			echo json_encode($data['result'][] = $this->raims->cancelRequest($obj));
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

				    	echo json_encode($data['result'][] = $this->raims->uploadProfilePic($file),JSON_NUMERIC_CHECK);
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

				    	echo json_encode($data['result'][] = $this->raims->uploadProfilePic($file),JSON_NUMERIC_CHECK);
				    }else{
				    	return 0;
				    }
				}
			}else{
				trigger_error("File is not an image");
			}

		}

	}

?>