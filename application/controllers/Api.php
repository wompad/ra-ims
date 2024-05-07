<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH . '/libraries/REST_Controller.php';
 

class Api extends REST_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->model('tbl_persons_model', 'persons');
		$this->load->model('tbl_users_model', 'users');
	}
	public function index_get(){
  		$this->response(null, REST_Controller::HTTP_UNAUTHORIZED);
   }


   public function access_token_post(){

   }
   
    
   public function person_post(){
	$records =  file_get_contents('php://input') ;
	$records = json_decode($records);
 
		
	$retval = $saved_ids = [];
	$has_errors = false;
	foreach ($records as $record) {
			$data['first_name'] = $record->first_name;
			$data['last_name'] = $record->last_name;
			$data['middle_name'] = $record->middle_name;
			$data['bday'] = $record->bday;
			$data['id'] = $record->id;
			$data['updated_at'] = date('Y-m-d h:i:s');
			$has_error = $this->db->replace('tbl_persons', $data);
			array_push($saved_ids,$record->id);
	 

	}
 	$retval['has_errors'] = $has_errors;
 	$retval['saved_ids'] = $saved_ids;
 	$retval['message'] = "Saved ". ( $has_errors? " with errors.": "with no error.");
	$this->response( $retval, $retval? REST_Controller::HTTP_OK: REST_Controller::HTTP_NO_CONTENT);
  
   }
   
   private function _exists($id = false){
		if(!$id) return false;
		$this->db->from('tbl_persons')->where('id',$id);
		return (bool)$this->db->count_all_results();
	   
   }
   
	   public function person_delete($id){
		$this->db->delete('tbl_persons', array('id' => $id));  
		$this->response([
			'returned from delete:' => $id,
		]);
	}
   
}
