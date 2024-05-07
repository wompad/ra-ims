<?php

use webd\language\StringDistance;

// echo "Jaro-Winkler : " . StringDistance::JaroWinkler("julietlompadjr", "julietolugoompadjr");

class Raims extends CI_Model{

		public function __construct(){
			$this->load->database();
			$this->load->library('session');
		}

		function get_provinces(){
			$query = $this->db->query("SELECT * FROM lib_province");
			return $query->result_array();
		}

		function get_municipalities(){
			$query = $this->db->query("SELECT * FROM lib_municipality");
			return $query->result_array();
		}

		function get_ec_libraries(){

			$data = Array();

			$query_availability_status = $this->db->query("SELECT * FROM lib_availability_status");
			$data['availability_status'] = $query_availability_status->result_array();

			$query_building_status = $this->db->query("SELECT * FROM lib_building_status");
			$data['building_status'] = $query_building_status->result_array();

			$query_source_of_water = $this->db->query("SELECT * FROM lib_source_of_water");
			$data['source_of_water'] = $query_source_of_water->result_array();

			$query_type_of_building = $this->db->query("SELECT * FROM lib_type_of_building");
			$data['type_of_building'] = $query_type_of_building->result_array();

			return $data;

		}

		function get_mun_centroid(){
			$id = $_SESSION['id'];

			$query_user = $this->db->query("SELECT * FROM tbl_lgu_user where id = $id");
			$arr = $query_user->result_array();

			$municipality = $arr[0]['municipality_psgc'];

			$query = $this->db->query("SELECT * FROM lib_municipality where psgc_code = '$municipality'");
			$data['centroid'] = $query->result_array();

			$query_ecs = $this->db->query("SELECT * FROM tbl_ecprofiles where municipality_psgc = '$municipality'");
			$ecs = $query_ecs->result_array();

			$geojson ='{"type": "FeatureCollection",';
			$geojson = $geojson .'"features":[';

			for($i = 0 ; $i < count($ecs) ; $i++){

				$ecname = preg_replace('/[[:cntrl:]]/','',$ecs[$i]['name_of_evacuation_center']);

				if($i == (count($ecs) - 1)){
					$geojson = $geojson .'{';
					$geojson = $geojson .'"geometry": {';
					$geojson = $geojson .'"type": "Point",';
					$geojson = $geojson .'"coordinates": [';
					$geojson = $geojson . $ecs[$i]["_gps_coordinates_longitude"].",";
					$geojson = $geojson . $ecs[$i]["_gps_coordinates_latitude"]."]";
					$geojson = $geojson .'},';
					$geojson = $geojson .'"type": "Feature",';
					$geojson = $geojson .'"properties": {';
					$geojson = $geojson .'"evacuation_name":"'.$ecname.'"';
					$geojson = $geojson .'},';
					$geojson = $geojson .'"id":'.$ecs[$i]["_index"].'}';
				}else{
					$geojson = $geojson .'{';
					$geojson = $geojson .'"geometry": {';
					$geojson = $geojson .'"type": "Point",';
					$geojson = $geojson .'"coordinates":[';
					$geojson = $geojson . $ecs[$i]["_gps_coordinates_longitude"].",";
					$geojson = $geojson . $ecs[$i]["_gps_coordinates_latitude"]."]";
					$geojson = $geojson .'},';
					$geojson = $geojson .'"type": "Feature",';
					$geojson = $geojson .'"properties": {';
					$geojson = $geojson .'"evacuation_name":"'.$ecname.'"';
					$geojson = $geojson .'},';
					$geojson = $geojson .'"id":'.$ecs[$i]["_index"].'},';
				}
			}

			$geojson = $geojson . "]}";

			$data['geojson'] = $geojson;

			return $data;
		}

		function get_downloadables(){
			$query = $this->db->query("SELECT * FROM tbl_downloadables ORDER BY document_type_id ASC");
			return $query->result_array();
		}

		function get_video_materials(){
			$query = $this->db->query("SELECT * FROM tbl_video_materials");
			return $query->result_array();
		}

		function get_offices(){
			$query = $this->db->query("SELECT * FROM tbl_offices LIMIT 4");
			return $query->result_array();
		}

		function get_requested_items($id){

			$query_items= $this->db->query("SELECT
													* FROM tbl_requested_items WHERE request_id = '$id'
											");
			$items = $query_items->result_array();

			return $items;

		}

		function get_approved_items($id){
			$query_items= $this->db->query("SELECT
												t1.*,
												t2.item_id,
												SUM(t2.quantity_delivered) delivered
											FROM
												tbl_approved_items t1
												LEFT JOIN tbl_delivered_item t2 ON t1.id = t2.item_id
											WHERE
												t1.request_id = '$id' 
												AND item_status = 'Approved'
												GROUP BY t1.id, t2.item_id
											");
			$items = $query_items->result_array();
			return $items;
		}

		function searchUser($email){

			$query = $this->db->query("SELECT * FROM tbl_temp_lgu_user where lower(email_address) = lower('$email')");

			if(count($query->result_array()) < 1){
				$data = array(
					'email_address' => $email,
					'user_type' 	=> 1
				);
				$this->db->insert('tbl_temp_lgu_user', $data);
	   			$insert_id = $this->db->insert_id();
	   			
	   			$_SESSION['email_address'] = $email;
	   			$_SESSION['id'] = $insert_id;

	   			return $insert_id;

			}else{

				$query_1 = $this->db->query("SELECT * FROM tbl_lgu_user where lower(email_address) = lower('$email')");
				$arr_1 = $query_1->result_array();

				if(count($query_1->result_array()) < 1){
					$query = $this->db->query("SELECT * FROM tbl_temp_lgu_user where lower(email_address) = lower('$email')");
					$arr = $query->result_array();

					$_SESSION['email_address'] = $email;
					$user = array(
						'new_user' 	=> 1,
						'id' 		=> $arr[0]['id']
					);
					$_SESSION['id'] = $arr[0]['id'];

				}else{

					$_SESSION['email_address'] = $email;
					$user = array(
						'new_user' 	=> 0,
						'id' 		=> $arr_1[0]['id']
					);
					$_SESSION['id'] = $arr_1[0]['id'];

					$data_login = array(
						'username_email' 	=> strtolower($email)
					);

					$query_user= $this->db->insert("tbl_userlogin",$data_login);

				}

				return $user;
			}

		}

		function get_email_address($id){
			$query = $this->db->query("SELECT * FROM tbl_temp_lgu_user where id = $id");
			return $query->result_array();
		}

		function server_event_request(){

			return 1;

		}

		function get_all_request(){

			$id = $_SESSION['id'];

			$query_user = $this->db->query("SELECT * FROM tbl_lgu_user where id = $id");
			$arr = $query_user->result_array();

			$municipality = $arr[0]['municipality_psgc'];

			$query = $this->db->query("SELECT
											t1.*,
											t2.request_status,
											t2.approved_date,
											t2.response_letter_file 
										FROM
											tbl_augmentation_request t1
											LEFT JOIN tbl_request_status t2 ON t1.id = t2.request_id 
										WHERE
											t1.municipality_psgc = '$municipality'
										ORDER BY t1.date_requested DESC");
			$data['request'] = $query->result_array();
			
			return $data;
		}

		function get_eclists(){

			$id = $_SESSION['id'];

			$query_user = $this->db->query("SELECT * FROM tbl_lgu_user where id = $id");
			$arr = $query_user->result_array();

			$municipality = $arr[0]['municipality_psgc'];

			$query = $this->db->query("SELECT * FROM tbl_ecprofiles where municipality_psgc = '$municipality'");
			$data['ec'] = $query->result_array();

			$query = $this->db->query("SELECT
										t1.* 
									FROM
										tbl_ecphotos t1
										LEFT JOIN tbl_ecprofiles t2 on t1._parent_index = t2._index
									WHERE t2.municipality_psgc = '$municipality'");

			$data['photos'] = $query->result_array();

			return $data;
		}

		function saveECDetails($obj){

			$id = $obj->id;
			$ec = $obj->ec;

			$this->db->trans_start();

			try{
				$query = $this->db->where("_id", $id);
				$query = $this->db->update("tbl_ecprofiles",$ec);
				$this->db->trans_commit();
			}catch(Exception $e){
				$this->db->trans_rollback();
			}

		}

		function get_user_details($id){



			$query = $this->db->query("SELECT
										t1.*,
										t2.municipality_name,
										t3.province_name,
										t4.office_name
									FROM
										tbl_lgu_user t1
										LEFT JOIN lib_municipality t2 ON t1.municipality_psgc = t2.psgc_code
										LEFT JOIN lib_province t3 ON t1.province_psgc = t3.psgc_code 
										left join tbl_offices t4 on t1.office_id = t4.id
									WHERE
										t1.id = $id");

			$data['user'] = $query->result_array();

			$query_profile = $this->db->query("SELECT
										*
									FROM
										tbl_lgu_user_profile
									WHERE
										user_id = $id");

			$data['user_profile'] = $query_profile->result_array();

			return $data;
		}

		function savelguUser($obj){

			$email = $obj->email_address;

			$query = $this->db->query("SELECT * FROM tbl_lgu_user where email_address = '$email'");

			if(count($query->result_array()) < 1){

				$user = array(
					'firstname' 		=> strtoupper($obj->firstname),
					'middlename' 		=> strtoupper($obj->middlename),
					'lastname'		 	=> strtoupper($obj->lastname),
					'province_psgc' 	=> $obj->province,
					'municipality_psgc' => $obj->municipality,
					'email_address' 	=> $obj->email_address,
					'contact_number'	=> $obj->contact_number,
					'office_id' 		=> $obj->office,
					'position' 			=> strtoupper($obj->position),
					'isverified' 		=> 1
				);

				$this->db->trans_start();
				
				try{

					$query_user= $this->db->insert("tbl_lgu_user",$user);
					$insert_id = $this->db->insert_id();

					$query_user_profile = $this->db->query("SELECT * FROM tbl_lgu_user_profile WHERE user_id = $insert_id");

					if($query_user_profile->num_rows < 1){

						$data = array(
							'user_bio' 				=> '',
							'user_description' 		=> '',
							'user_address' 			=> '',
							'user_profile_pic' 		=> '',
							'user_banner' 			=> '',
							'user_fb' 				=> '',
							'user_instagram' 		=> '',
							'user_twitter' 			=> '',
							'user_id' 				=> $insert_id

						);

						$query_user_profile = $this->db->insert("tbl_lgu_user_profile",$data);

					}

					$this->db->trans_commit();
					$_SESSION['id'] = $insert_id;

					return $insert_id;

				}catch(Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}else{
				return 0;
			}

		}

		function saveProfile($obj){

			$id = $_SESSION['id'];

			$user = array(
				'firstname' 		=> strtoupper($obj->firstname),
				'middlename' 		=> strtoupper($obj->middlename),
				'lastname'		 	=> strtoupper($obj->lastname),
				'province_psgc' 	=> $obj->province,
				'municipality_psgc' => $obj->municipality,
				'contact_number'	=> $obj->contact_number,
				'position' 			=> strtoupper($obj->position),
			);

			$user_profile = array(
				'user_bio' 			=> $obj->bio,
				'user_description' 	=> $obj->description,
				'user_address'		=> $obj->address,
				'user_fb' 			=> $obj->fb,
				'user_instagram' 	=> $obj->instagram,
				'user_twitter' 		=> $obj->twitter,
				'user_id' 			=> $id
			);

			$this->db->trans_start();

			try{
				$query = $this->db->where("id", $id);
				$query = $this->db->update("tbl_lgu_user",$user);
				$this->db->trans_commit();
			}catch(Exception $e){
				$this->db->trans_rollback();
			}

			$query = $this->db->query("SELECT * FROM tbl_lgu_user_profile where user_id = '$id'");
			if(count($query->result_array()) < 1){
				
				$this->db->trans_start();
				try{
					$query_user= $this->db->insert("tbl_lgu_user_profile",$user_profile);
					$insert_id = $this->db->insert_id();
					$this->db->trans_commit();
				}catch(Exception $e){
					$this->db->trans_rollback();
				}
			}else{
				$this->db->trans_start();
				try{
					$query = $this->db->where("user_id", $id);
					$query = $this->db->update("tbl_lgu_user_profile",$user_profile);
					$this->db->trans_commit();
				}catch(Exception $e){
					$this->db->trans_rollback();
				}
			}

		}

		function uploadProfilePic($obj){

			$id = $_SESSION['id'];

			$this->db->trans_start();

			try{
				$query = $this->db->where("user_id", $id);
				$query = $this->db->update("tbl_lgu_user_profile",$obj);
				$this->db->trans_commit();
				return 1;
			}catch(Exception $e){
				$this->db->trans_rollback();
				return 0;
			} 

		}

		function saveAugmentationRequest($obj){

			date_default_timezone_set('Asia/Kuala_Lumpur');

			$time = strtotime($obj['incident_date']);
			$email = $_SESSION['email_address'];

			$query = $this->db->query("SELECT * FROM tbl_lgu_user where email_address = '$email'");
			$arr = $query->result_array();

			$province_psgc = $arr[0]['province_psgc'];
			$municipality_psgc = $arr[0]['municipality_psgc'];

			$data = array(
				'province_psgc' 			=> $province_psgc,
				'municipality_psgc'			=> $municipality_psgc,
				'username_email' 			=> $email,
				'request_subject' 			=> $obj['subject'],
				'request_incident_name' 	=> $obj['incident_name'],
				'request_incident_date' 	=> date('Y-m-d',$time),
				'request_estimated_family' 	=> $obj['estimated_family'],
				'dromic_report_file' 		=> $obj['dromic_report'],
				'request_letter_file' 		=> $obj['request_letter']
			);


			$this->db->trans_start();
				
			try{

				$query_request = $this->db->insert("tbl_augmentation_request",$data);
				$insert_id = $this->db->insert_id();

				for($i = 0 ; $i < count($obj['items']) ; $i++){
					$items_list = array(
						'request_id' 		=> $insert_id,
						'item_requested' 	=> $obj['items'][$i]['item_requested'],
						'item_quantity' 	=> $obj['items'][$i]['quantity_requested']
					);

					$query_items_list = $this->db->insert("tbl_requested_items",$items_list);

				}

				$this->db->trans_commit();

				return 1;

			}catch(Exception $e){
				$this->db->trans_rollback();
				return 0;
			}

		}

		function cancelRequest($obj){

			date_default_timezone_set('Asia/Kuala_Lumpur');

			$query = $this->db->query("SELECT * FROM tbl_request_status WHERE request_id = '$obj->request_id'");
			$arr = $query->result_array();

			if(count($arr) > 0){

				$data = array(
					'request_status' 	=> 'Cancelled',
					'status_date' 		=> date("Y-m-d H:i:s")
				);

				$this->db->trans_start();

				try{
					$query = $this->db->where("request_id", $obj->request_id);
					$query = $this->db->update("tbl_request_status",$data);
					$this->db->trans_commit();
					return 1;
				}catch(Exception $e){
					$this->db->trans_rollback();
					return 0;
				}

			}else{

				$this->db->trans_start();

				$data = array(
					'request_id' 		=> $obj->request_id,
					'request_status' 	=> 'Cancelled',
					'status_date' 		=> date("Y-m-d H:i:s")
				);

				try{

					$query_request = $this->db->insert("tbl_request_status",$data);
					$insert_id = $this->db->insert_id();
					$this->db->trans_commit();
					return 1;

				}catch(Exception $e){
					$this->db->trans_rollback();
					return 0;
				}
			}

		}

}


?>