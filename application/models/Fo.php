<?php

use webd\language\StringDistance;


// echo "Jaro-Winkler : " . StringDistance::JaroWinkler("julietlompadjr", "julietolugoompadjr");

class Fo extends CI_Model{

	public function __construct(){
		$this->load->database();
		$this->load->library('session');
		$this->load->library('encryption');
	}

	function searchfoUser($username){

		$query = $this->db->query("SELECT * FROM tbl_fo_user where username = '$username'");

		$_SESSION['username'] = $username;

		if(count($query->result_array()) < 1){
			return 0;
		}else{
			return $username;
		}	
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

	function get_fo_user_details_db(){

		$username = $_SESSION['username'];

		$query = $this->db->query("SELECT
										t1.*,
										t2.user_bio,
										t2.user_description,
										t2.user_address,
										t2.user_profile_pic,
										t2.user_banner,
										t2.user_fb,
										t2.user_instagram,
										t2.user_twitter
									FROM
										tbl_fo_user t1
										left join tbl_fo_user_profile t2 on t1.id = t2.user_id
									WHERE
										t1.username = '$username'");

		return $query->result_array();
	}

	function updateProfile($obj){

		$username = $_SESSION['username'];
		$this->db->trans_start();

		try{
			$query = $this->db->query("SELECT * FROM tbl_fo_user where username = '$username'");
			$arr = $query->result_array();
			$id = $arr[0]['id'];

			$query = $this->db->where("user_id", $id);
			$query = $this->db->update("tbl_fo_user_profile",$obj);
			$this->db->trans_commit();

			$query = $this->db->query("SELECT
										t1.*,
										t2.user_bio,
										t2.user_description,
										t2.user_address,
										t2.user_profile_pic,
										t2.user_banner,
										t2.user_fb,
										t2.user_instagram,
										t2.user_twitter
									FROM
										tbl_fo_user t1
										left join tbl_fo_user_profile t2 on t1.id = t2.user_id
									WHERE
										t1.id = '$id'");

			$arr = $query->result_array();

			return $arr;
			
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		} 

	}

	function saveFOUser($obj){

		$this->db->trans_start();
		
		$password 		= $obj->password;
		$obj->password 	= $this->encryption->encrypt($password);

		try{

			$query_user= $this->db->insert("tbl_fo_user",$obj);
			$insert_id = $this->db->insert_id();

			$data = array(
				'user_id' => $insert_id
			);

			$query_user_profile = $this->db->insert("tbl_fo_user_profile",$data);

			$this->db->trans_commit();
			return $insert_id;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

	}

	function get_all_ECs($offset){

		$query_ec = $this->db->query("SELECT * FROM tbl_ecprofiles LIMIT 100 OFFSET $offset");
		$data['ec'] = $query_ec->result_array();

		$query_photo = $this->db->query("SELECT t1.* FROM tbl_ecphotos t1 LEFT JOIN ( SELECT * FROM tbl_ecprofiles LIMIT 100 OFFSET $offset ) t2 ON t1._parent_index = t2._index WHERE	t2._index IS NOT NULL");

		$data['photos'] = $query_photo->result_array();

		return $data;
	}

	function get_ec($id){

		$query_ec = $this->db->query("SELECT * FROM tbl_ecprofiles t1 WHERE t1._index='$id'");
		$data['ec'] = $query_ec->result_array();

		$query_photo = $this->db->query("SELECT t1.* FROM tbl_ecphotos t1 LEFT JOIN tbl_ecprofiles t2 ON t1._parent_index = t2._index WHERE	t2._index='$id'");
		$data['photos'] = $query_photo->result_array();

		return $data;
	}

	function get_eclists(){

		$query_count_ec = $this->db->query("SELECT count(*) all_records FROM tbl_ecprofiles");
		$data['count_ec'] = $query_count_ec->result_array();

		$floor = $data['count_ec'][0]['all_records'] > 100 ? (int) ($data['count_ec'][0]['all_records'] / 100) + 1 : (int) ($data['count_ec'][0]['all_records'] / 100);

		$data['page'] = (($data['count_ec'][0]['all_records']) % 100 > 0 ? $floor: $data['count_ec'][0]['all_records']);

		$query_muni = $this->db->query("SELECT city_municipality name, CAST(count(*) AS INT) y FROM tbl_ecprofiles GROUP BY city_municipality");
		$data['muni'] = $query_muni->result_array();

		$query_type_of_building = $this->db->query("SELECT type_of_building name, count(*) y FROM tbl_ecprofiles GROUP BY type_of_building");
		$data['type_of_building'] = $query_type_of_building->result_array();

		$query_building_status = $this->db->query("SELECT building_status name, count(*) y FROM tbl_ecprofiles GROUP BY building_status");
		$data['building_status'] = $query_building_status->result_array();

		$query_availability_status = $this->db->query("SELECT availability_status name, count(*) y FROM tbl_ecprofiles GROUP BY availability_status");
		$data['availability_status'] = $query_availability_status->result_array();

		$query_ffps_storage_availability = $this->db->query("SELECT ffps_storage_availability name, count(*) y FROM tbl_ecprofiles GROUP BY ffps_storage_availability");
		$data['ffps_storage_availability'] = $query_ffps_storage_availability->result_array();

		$query_compost_pit_latrine = $this->db->query("SELECT compost_pit_latrine name, count(*) y FROM tbl_ecprofiles GROUP BY compost_pit_latrine");
		$data['compost_pit_latrine'] = $query_compost_pit_latrine->result_array();

		$query_female_cr = $this->db->query("SELECT female_cr name, count(*) y FROM tbl_ecprofiles GROUP BY female_cr");
		$data['female_cr'] = $query_female_cr->result_array();

		$query_male_cr = $this->db->query("SELECT male_cr name, count(*) y FROM tbl_ecprofiles GROUP BY male_cr");
		$data['male_cr'] = $query_male_cr->result_array();

		$query_common_cr = $this->db->query("SELECT common_cr name, count(*) y FROM tbl_ecprofiles GROUP BY common_cr");
		$data['common_cr'] = $query_common_cr->result_array();

		$query_source_of_potable_water = $this->db->query("SELECT source_of_potable_water name, count(*) y FROM tbl_ecprofiles GROUP BY source_of_potable_water");
		$data['source_of_potable_water'] = $query_source_of_potable_water->result_array();

		$query_source_of_non_potable_water = $this->db->query("SELECT source_of_non_potable_water name, count(*) y FROM tbl_ecprofiles GROUP BY source_of_non_potable_water");
		$data['source_of_non_potable_water'] = $query_source_of_non_potable_water->result_array();

		$query = $this->db->query("SELECT count(*) y FROM tbl_ecprofiles");
		$data['ec_count'] = $query->result_array();

		return $data;
	}

	function uploadProfilePic($obj){

		$username = $_SESSION['username'];
		$this->db->trans_start();

		try{

			$query = $this->db->query("SELECT * FROM tbl_fo_user where username = '$username'");
			$arr = $query->result_array();
			$id = $arr[0]['id'];

			$query = $this->db->where("user_id", $id);
			$query = $this->db->update("tbl_fo_user_profile",$obj);

			$this->db->trans_commit();
			return 1;
		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		} 

	}

	function get_mun_centroid(){

		$query_ecs = $this->db->query("SELECT * FROM tbl_ecprofiles");
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

	function get_augmentation_list(){

		$query_request = $this->db->query("SELECT
												t1.*,
												t2.province_name,
												t3.municipality_name,
												t4.request_status
											FROM
												tbl_augmentation_request t1
												LEFT JOIN lib_province t2 ON t1.province_psgc = t2.psgc_code
												LEFT JOIN lib_municipality t3 ON t1.municipality_psgc = t3.psgc_code
												LEFT JOIN tbl_request_status t4 ON t4.request_id = t1.id 
											WHERE t4.request_status IS NULL or t4.request_status <> 'Approved'
											ORDER BY
												t1.date_requested DESC
										");
		$records = $query_request->result_array();

		return $records;

	}

	function get_approved_augmentation_list(){

		$query_request = $this->db->query("SELECT
												t1.*,
												t2.province_name,
												t3.municipality_name,
												t4.request_status,
												t4.response_letter_file,
												t4.response_letter_file_date_uploaded,
												t4.assessment_report,
												t4.assessment_report_date_uploaded,
												t4.approved_date
											FROM
												tbl_augmentation_request t1
												LEFT JOIN lib_province t2 ON t1.province_psgc = t2.psgc_code
												LEFT JOIN lib_municipality t3 ON t1.municipality_psgc = t3.psgc_code
												LEFT JOIN tbl_request_status t4 ON t4.request_id = t1.id 
											WHERE t4.request_status = 'Approved'
											ORDER BY
												t1.date_requested DESC
										");
		$records['approved_request'] = $query_request->result_array();

		return $records;

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

	function get_delivered_items($id){
		$query_items= $this->db->query("SELECT * FROM tbl_delivered_item WHERE request_id = '$id'");
		$items = $query_items->result_array();
		return $items;
	}

	function save_delivered_items($obj){

		date_default_timezone_set('Asia/Kuala_Lumpur');

		$this->db->trans_start();

		try{

			$query_user = $this->db->insert_batch("tbl_delivered_item",$obj);

			$this->db->trans_commit();
			return $query_user;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
	}

	function get_request_status($id){
		$query_items= $this->db->query("SELECT
												* FROM tbl_request_status WHERE request_id = '$id'
										");
		$items = $query_items->result_array();
		return $items;
	}

	function saveApprovedRequest($obj){

		date_default_timezone_set('Asia/Kuala_Lumpur');

		$email = $obj[1]->specifics->username_email;
		$request_id = $obj[1]->specifics->id;

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

		$this->db->trans_start();

		try{

			$query_user = $this->db->insert_batch("tbl_approved_items",$obj[0]->data);

			$query_insert = $this->db->query("SELECT * FROM tbl_request_status WHERE request_id = $request_id");
			$arr = $query_insert->result_array();

			if(count($arr) < 1){
				$data_insert = array(
					'request_id' => $request_id,
					'request_status' => 'Approved',
					'approved_date' => date("Y-m-d H:i:s")
				);
				$query_insert_status = $this->db->insert("tbl_request_status",$data_insert);
			}else{
				$data = array(
					'request_status' => 'Approved'
				);
				$query = $this->db->where("request_id", $request_id);
				$query = $this->db->update("tbl_request_status",$data);
			}

			$mail->isSMTP();
			$mail->Host     = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'drmd.focaraga@gmail.com';
			$mail->Password = 'gszbnneetpfwsdvj';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;
			
			$mail->addAddress($email);
			$mail->Subject = 'Request for Augmentation Assistance';
			$mail->isHTML(true);
			
			$mailContent = "<h3>Greetings from DSWD Caraga Disaster Response Management Division!</h3>
				<p>Please be informed that we have reviewed and assessed your request for augmentation assistance. <br>
				Our staff will facilitate your request for the immediate release of the food and non-food items requested. <br> We will be sending you the reply letter indicating the status of your request <br><br>Thank you. <br><br> <i>****** Please don't reply to this email ******</i></p> ";
			$mail->Body = $mailContent;
			
			if(!$mail->send()){
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}else{
				echo 'Message has been sent';
			}

			$this->db->trans_commit();
			return $query_user;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

	}

	function SaveAndSendFile($request_id,$requester_email,$cc_emails,$obj){

		date_default_timezone_set('Asia/Kuala_Lumpur');

		$email = $requester_email;
		$request_id = $request_id;
		$cc_emails = explode(",",$cc_emails);

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

		$this->db->trans_start();

		try{

			$query = $this->db->where("request_id", $request_id);
			$query = $this->db->update("tbl_request_status",$obj);

			$mail->isSMTP();
			$mail->Host     = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'drmd.focaraga@gmail.com';
			$mail->Password = 'gszbnneetpfwsdvj';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;
			
			$mail->addAddress($email);
			for($i = 0; $i < count($cc_emails) ; $i++){
				$mail->AddCC($cc_emails[$i]);
			}
			$mail->Subject = 'Request for Augmentation Assistance';
			$mail->isHTML(true);

			$mail->addAttachment("./uploads_request/".$obj['response_letter_file']);

			$mailContent = "<h3>Greetings from DSWD Caraga Disaster Response Management Division!</h3>
				<p>This is in relation to your request for augmentation assistance. Please be informed of the Field Office's response attached through this email.<br><br>Thank you. <br><br> <i>****** Please don't reply to this email ******</i></p> ";

			$mail->Body = $mailContent;
			
			if(!$mail->send()){
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}else{
				echo 'Message has been sent';
			}

			$this->db->trans_commit();
			return $query;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

	}

	function SaveAndSendFileAssessment($request_id,$obj){

		date_default_timezone_set('Asia/Kuala_Lumpur');

		$request_id = $request_id;
		$this->db->trans_start();

		try{

			$query = $this->db->where("request_id", $request_id);
			$query = $this->db->update("tbl_request_status",$obj);

			$this->db->trans_commit();
			return $query;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

	}

	function savePendingRequest($obj){
		date_default_timezone_set('Asia/Kuala_Lumpur');

		$email = $obj->specifics->username_email;
		$request_id = $obj->specifics->id;

        $this->load->library('phpmailer_lib');
        $mail = $this->phpmailer_lib->load();

		$this->db->trans_start();

		try{

			$query_insert = $this->db->query("SELECT * FROM tbl_request_status WHERE request_id = $request_id");
			$arr = $query_insert->result_array();

			if(count($arr) < 1){
				$data_insert = array(
					'request_id' => $request_id,
					'request_status' => $obj->request_status,
					'approved_date' => date("Y-m-d H:i:s")
				);
				$query_insert_status = $this->db->insert("tbl_request_status",$data_insert);
			}else{
				$data = array(
					'request_status' => $obj->request_status
				);
				$query = $this->db->where("request_id", $request_id);
				$query = $this->db->update("tbl_request_status",$data);
			}

			$mail->isSMTP();
			$mail->Host     = 'smtp.gmail.com';
			$mail->SMTPAuth = true;
			$mail->Username = 'drmd.focaraga@gmail.com';
			$mail->Password = 'gszbnneetpfwsdvj';
			$mail->SMTPSecure = 'ssl';
			$mail->Port     = 465;
			
			$mail->addAddress($email);
			$mail->Subject = 'Request for Augmentation Assistance';
			$mail->isHTML(true);
			
			if($obj->request_status == "Pending"){
				$mailContent = "<h3>Greetings from DSWD Caraga Disaster Response Management Division!</h3>";
				$mailContent = $mailContent. "<p style='font-size: 14px; text-align: justify'>Please be informed that we have reviewed your request. However upon assessment, you request is set as PENDING <br>";
				$mailContent = $mailContent. "Your request was pending due to the following remarks/reasons (". $obj->request_remarks . ").<br>";
				$mailContent = $mailContent. "Our social worker will contact you with regard to your request or you can send us an email thru: drmd.focrg@dswd.gov.ph";
				$mailContent = $mailContent. "<br><br>Thank you";
				$mailContent = $mailContent. "<br><br><i>*** Do not reply to this email. This is an automatic solution. ***</></p>";
			}else{
				$mailContent = "<h3>Greetings from DSWD Caraga Disaster Response Management Division!</h3>";
				$mailContent = $mailContent. "<p style='font-size: 14px; text-align: justify'>Please be informed that we have reviewed your request. However upon assessment, we regret to inform you that your request is DISAPPROVED<br>";
				$mailContent = $mailContent. "Your request was disapproved due to the following remarks/reasons (". $obj->request_remarks . ").<br>";
				$mailContent = $mailContent. "Our social worker will contact you with regard to your request or you can send us an email thru: drmd.focrg@dswd.gov.ph";
				$mailContent = $mailContent. "<br><br>Thank you";
				$mailContent = $mailContent. "<br><br><i>*** Do not reply to this email. This is an automatic solution. ***</></p>";
			}

			$mail->Body = $mailContent;
			
			if(!$mail->send()){
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			}else{
				echo 'Message has been sent';
			}

			$this->db->trans_commit();
			return $query_insert;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}
	}

	function demo_sse(){

		$rec = 0;

		$query_request = $this->db->query("SELECT count(*) as record_count FROM tbl_augmentation_request where is_notified = '0'");
		$record_count = $query_request->result_array();
		$rec = $record_count[0]['record_count'];

		$query_request = $this->db->query("UPDATE tbl_augmentation_request SET is_notified = '1'");

		return $rec;

	}

	function get_password(){

		$this->db->trans_start();

		$plain_text = '16-10859';
		$ciphertext = $this->encryption->encrypt($plain_text);

		$obj = array(
			'password' => $ciphertext
		);

		try{
			$query = $this->db->where("id_number", '16-10859');
			$query = $this->db->update("tbl_fo_user",$obj);

			$this->db->trans_commit();

			return $ciphertext;

		}catch(Exception $e){
			$this->db->trans_rollback();
			return 0;
		}

	}

	function Temp_Login($username, $password){

		$query_user = $this->db->query("SELECT * FROM tbl_fo_user WHERE username = '$username'");
		$record = $query_user->result_array();

		if(count($record) > 0){

			foreach($record as $rec){
				$ciphertext = $this->encryption->decrypt($rec['password']);
				if(($username == $rec['username']) && ($password == $ciphertext)){
					$_SESSION['username'] = $username;
					return 1;
				}else{
					return 0;
				}
			}

		}else{

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

			$_SESSION['username'] = $username;
			
			return $obj;
		}
	}

}