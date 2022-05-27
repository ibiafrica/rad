<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Pos_ibi_clients extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_pos_ibi_clients');
	}

	/**
	 * @api {get} /pos_ibi_clients/all Get all pos_ibi_clientss.
	 * @apiVersion 0.1.0
	 * @apiName AllPosibiclients 
	 * @apiGroup pos_ibi_clients
	 * @apiHeader {String} X-Api-Key Pos ibi clientss unique access-key.
	 * @apiHeader {String} X-Token Pos ibi clientss unique token.
	 * @apiPermission Pos ibi clients Cant be Accessed permission name : api_pos_ibi_clients_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Pos ibi clientss.
	 * @apiParam {String} [Field="All Field"] Optional field of Pos ibi clientss : ID_CLIENT, NOM_CLIENT, PRENOM_CLIENT, TEL_CLIENT, TEL_2_CLIENT, NUMBER_COMPTE_CLIENT, EMAIL_CLIENT, STATE_CLIENT, COUNTRY_CLIENT, CITY_CLIENT, QUARTIER_CLIENT, ADRESSE_CLIENT, BP_CLIENT, COMPANY_NAME_CLIENT, DATE_CREATION_CLIENT, DATE_MOD_CLIENT, REF_GROUP_CLIENT, FILES_CLIENT, DESCRIPTION_CLIENT.
	 * @apiParam {String} [Start=0] Optional start index of Pos ibi clientss.
	 * @apiParam {String} [Limit=10] Optional limit data of Pos ibi clientss.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of pos_ibi_clients.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataPos ibi clients Pos ibi clients data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_pos_ibi_clients_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['ID_CLIENT', 'NOM_CLIENT', 'PRENOM_CLIENT', 'TEL_CLIENT', 'TEL_2_CLIENT', 'NUMBER_COMPTE_CLIENT', 'EMAIL_CLIENT', 'STATE_CLIENT', 'COUNTRY_CLIENT', 'CITY_CLIENT', 'QUARTIER_CLIENT', 'ADRESSE_CLIENT', 'BP_CLIENT', 'COMPANY_NAME_CLIENT', 'DATE_CREATION_CLIENT', 'DATE_MOD_CLIENT', 'REF_GROUP_CLIENT', 'FILES_CLIENT', 'DESCRIPTION_CLIENT'];
		$pos_ibi_clientss = $this->model_api_pos_ibi_clients->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_pos_ibi_clients->count_all($filter, $field);

		$pos_ibi_clients_arr = [];

		foreach ($pos_ibi_clientss as $pos_ibi_clients) {
			$pos_ibi_clients->FILES_CLIENT  = BASE_URL.'uploads/pos_ibi_clients/'.$pos_ibi_clients->FILES_CLIENT;
			$pos_ibi_clients_arr[] = $pos_ibi_clients;
		}

		$data['pos_ibi_clients'] = $pos_ibi_clients_arr;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Pos ibi clients',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /pos_ibi_clients/detail Detail Pos ibi clients.
	 * @apiVersion 0.1.0
	 * @apiName DetailPos ibi clients
	 * @apiGroup pos_ibi_clients
	 * @apiHeader {String} X-Api-Key Pos ibi clientss unique access-key.
	 * @apiHeader {String} X-Token Pos ibi clientss unique token.
	 * @apiPermission Pos ibi clients Cant be Accessed permission name : api_pos_ibi_clients_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Pos ibi clientss.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of pos_ibi_clients.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError Pos ibi clientsNotFound Pos ibi clients data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_pos_ibi_clients_detail');

		$this->requiredInput(['ID_CLIENT']);

		$id = $this->get('ID_CLIENT');

		$select_field = ['ID_CLIENT', 'NOM_CLIENT', 'PRENOM_CLIENT', 'TEL_CLIENT', 'TEL_2_CLIENT', 'NUMBER_COMPTE_CLIENT', 'EMAIL_CLIENT', 'STATE_CLIENT', 'COUNTRY_CLIENT', 'CITY_CLIENT', 'QUARTIER_CLIENT', 'ADRESSE_CLIENT', 'BP_CLIENT', 'COMPANY_NAME_CLIENT', 'DATE_CREATION_CLIENT', 'DATE_MOD_CLIENT', 'REF_GROUP_CLIENT', 'FILES_CLIENT', 'DESCRIPTION_CLIENT'];
		$data['pos_ibi_clients'] = $this->model_api_pos_ibi_clients->find($id, $select_field);

		if ($data['pos_ibi_clients']) {
			$data['pos_ibi_clients']->FILES_CLIENT = BASE_URL.'uploads/pos_ibi_clients/'.$data['pos_ibi_clients']->FILES_CLIENT;
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Pos ibi clients',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Pos ibi clients not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /pos_ibi_clients/add Add Pos ibi clients.
	 * @apiVersion 0.1.0
	 * @apiName AddPos ibi clients
	 * @apiGroup pos_ibi_clients
	 * @apiHeader {String} X-Api-Key Pos ibi clientss unique access-key.
	 * @apiHeader {String} X-Token Pos ibi clientss unique token.
	 * @apiPermission Pos ibi clients Cant be Accessed permission name : api_pos_ibi_clients_add
	 *
 	 * @apiParam {String} NOM_CLIENT Mandatory NOM_CLIENT of Pos ibi clientss. Input NOM CLIENT Max Length : 100. 
	 * @apiParam {String} PRENOM_CLIENT Mandatory PRENOM_CLIENT of Pos ibi clientss. Input PRENOM CLIENT Max Length : 100. 
	 * @apiParam {String} [TEL_CLIENT] Optional TEL_CLIENT of Pos ibi clientss. Format TEL CLIENT must</b> Valid Number,  Input TEL CLIENT Max Length : 20. 
	 * @apiParam {String} [TEL_2_CLIENT] Optional TEL_2_CLIENT of Pos ibi clientss. Format TEL 2 CLIENT must</b> Valid Number,  Input TEL 2 CLIENT Max Length : 20. 
	 * @apiParam {String} [NUMBER_COMPTE_CLIENT] Optional NUMBER_COMPTE_CLIENT of Pos ibi clientss. Input NUMBER COMPTE CLIENT Max Length : 200. 
	 * @apiParam {String} [EMAIL_CLIENT] Optional EMAIL_CLIENT of Pos ibi clientss. Format EMAIL CLIENT must</b> Valid Email. 
	 * @apiParam {String} [STATE_CLIENT] Optional STATE_CLIENT of Pos ibi clientss. Input STATE CLIENT Max Length : 50. 
	 * @apiParam {String} [COUNTRY_CLIENT] Optional COUNTRY_CLIENT of Pos ibi clientss. Input COUNTRY CLIENT Max Length : 11. 
	 * @apiParam {String} [CITY_CLIENT] Optional CITY_CLIENT of Pos ibi clientss. Input CITY CLIENT Max Length : 11. 
	 * @apiParam {String} [QUARTIER_CLIENT] Optional QUARTIER_CLIENT of Pos ibi clientss. Input QUARTIER CLIENT Max Length : 11. 
	 * @apiParam {String} [ADRESSE_CLIENT] Optional ADRESSE_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [BP_CLIENT] Optional BP_CLIENT of Pos ibi clientss. Input BP CLIENT Max Length : 20. 
	 * @apiParam {String} [COMPANY_NAME_CLIENT] Optional COMPANY_NAME_CLIENT of Pos ibi clientss. Input COMPANY NAME CLIENT Max Length : 200. 
	 * @apiParam {String} [DATE_CREATION_CLIENT] Optional DATE_CREATION_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [DATE_MOD_CLIENT] Optional DATE_MOD_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [REF_GROUP_CLIENT] Optional REF_GROUP_CLIENT of Pos ibi clientss. Input REF GROUP CLIENT Max Length : 11. 
	 * @apiParam {File} [FILES_CLIENT] Optional FILES_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [DESCRIPTION_CLIENT] Optional DESCRIPTION_CLIENT of Pos ibi clientss.  
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_pos_ibi_clients_add');

		$this->form_validation->set_rules('NOM_CLIENT', 'NOM CLIENT', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('PRENOM_CLIENT', 'PRENOM CLIENT', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('TEL_CLIENT', 'TEL CLIENT', 'trim|max_length[20]|callback_valid_number');
		$this->form_validation->set_rules('TEL_2_CLIENT', 'TEL 2 CLIENT', 'trim|max_length[20]|callback_valid_number');
		$this->form_validation->set_rules('NUMBER_COMPTE_CLIENT', 'NUMBER COMPTE CLIENT', 'trim|max_length[200]');
		$this->form_validation->set_rules('EMAIL_CLIENT', 'EMAIL CLIENT', 'trim|valid_email');
		$this->form_validation->set_rules('STATE_CLIENT', 'STATE CLIENT', 'trim|max_length[50]');
		$this->form_validation->set_rules('COUNTRY_CLIENT', 'COUNTRY CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('CITY_CLIENT', 'CITY CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('QUARTIER_CLIENT', 'QUARTIER CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('BP_CLIENT', 'BP CLIENT', 'trim|max_length[20]');
		$this->form_validation->set_rules('COMPANY_NAME_CLIENT', 'COMPANY NAME CLIENT', 'trim|max_length[200]');
		$this->form_validation->set_rules('REF_GROUP_CLIENT', 'REF GROUP CLIENT', 'trim|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT'),
				'PRENOM_CLIENT' => $this->input->post('PRENOM_CLIENT'),
				'TEL_CLIENT' => $this->input->post('TEL_CLIENT'),
				'TEL_2_CLIENT' => $this->input->post('TEL_2_CLIENT'),
				'NUMBER_COMPTE_CLIENT' => $this->input->post('NUMBER_COMPTE_CLIENT'),
				'EMAIL_CLIENT' => $this->input->post('EMAIL_CLIENT'),
				'STATE_CLIENT' => $this->input->post('STATE_CLIENT'),
				'COUNTRY_CLIENT' => $this->input->post('COUNTRY_CLIENT'),
				'CITY_CLIENT' => $this->input->post('CITY_CLIENT'),
				'QUARTIER_CLIENT' => $this->input->post('QUARTIER_CLIENT'),
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT'),
				'BP_CLIENT' => $this->input->post('BP_CLIENT'),
				'COMPANY_NAME_CLIENT' => $this->input->post('COMPANY_NAME_CLIENT'),
				'DATE_CREATION_CLIENT' => $this->input->post('DATE_CREATION_CLIENT'),
				'DATE_MOD_CLIENT' => $this->input->post('DATE_MOD_CLIENT'),
				'REF_GROUP_CLIENT' => $this->input->post('REF_GROUP_CLIENT'),
				'DESCRIPTION_CLIENT' => $this->input->post('DESCRIPTION_CLIENT'),
			];
			
			$config = [
				'upload_path' 	=> './uploads/pos_ibi_clients/',
					'required' 		=> false
			];
			
			if ($upload = $this->upload_file('FILES_CLIENT', $config)){
				$upload_data = $this->upload->data();
				$save_data['FILES_CLIENT'] = $upload['file_name'];
			}

			$save_pos_ibi_clients = $this->model_api_pos_ibi_clients->store($save_data);

			if ($save_pos_ibi_clients) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /pos_ibi_clients/update Update Pos ibi clients.
	 * @apiVersion 0.1.0
	 * @apiName UpdatePos ibi clients
	 * @apiGroup pos_ibi_clients
	 * @apiHeader {String} X-Api-Key Pos ibi clientss unique access-key.
	 * @apiHeader {String} X-Token Pos ibi clientss unique token.
	 * @apiPermission Pos ibi clients Cant be Accessed permission name : api_pos_ibi_clients_update
	 *
	 * @apiParam {String} NOM_CLIENT Mandatory NOM_CLIENT of Pos ibi clientss. Input NOM CLIENT Max Length : 100. 
	 * @apiParam {String} PRENOM_CLIENT Mandatory PRENOM_CLIENT of Pos ibi clientss. Input PRENOM CLIENT Max Length : 100. 
	 * @apiParam {String} [TEL_CLIENT] Optional TEL_CLIENT of Pos ibi clientss. Format TEL CLIENT must</b> Valid Number,  Input TEL CLIENT Max Length : 20. 
	 * @apiParam {String} [TEL_2_CLIENT] Optional TEL_2_CLIENT of Pos ibi clientss. Format TEL 2 CLIENT must</b> Valid Number,  Input TEL 2 CLIENT Max Length : 20. 
	 * @apiParam {String} [NUMBER_COMPTE_CLIENT] Optional NUMBER_COMPTE_CLIENT of Pos ibi clientss. Input NUMBER COMPTE CLIENT Max Length : 200. 
	 * @apiParam {String} [EMAIL_CLIENT] Optional EMAIL_CLIENT of Pos ibi clientss. Format EMAIL CLIENT must</b> Valid Email. 
	 * @apiParam {String} [STATE_CLIENT] Optional STATE_CLIENT of Pos ibi clientss. Input STATE CLIENT Max Length : 50. 
	 * @apiParam {String} [COUNTRY_CLIENT] Optional COUNTRY_CLIENT of Pos ibi clientss. Input COUNTRY CLIENT Max Length : 11. 
	 * @apiParam {String} [CITY_CLIENT] Optional CITY_CLIENT of Pos ibi clientss. Input CITY CLIENT Max Length : 11. 
	 * @apiParam {String} [QUARTIER_CLIENT] Optional QUARTIER_CLIENT of Pos ibi clientss. Input QUARTIER CLIENT Max Length : 11. 
	 * @apiParam {String} [ADRESSE_CLIENT] Optional ADRESSE_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [BP_CLIENT] Optional BP_CLIENT of Pos ibi clientss. Input BP CLIENT Max Length : 20. 
	 * @apiParam {String} [COMPANY_NAME_CLIENT] Optional COMPANY_NAME_CLIENT of Pos ibi clientss. Input COMPANY NAME CLIENT Max Length : 200. 
	 * @apiParam {String} [DATE_CREATION_CLIENT] Optional DATE_CREATION_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [DATE_MOD_CLIENT] Optional DATE_MOD_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [REF_GROUP_CLIENT] Optional REF_GROUP_CLIENT of Pos ibi clientss. Input REF GROUP CLIENT Max Length : 11. 
	 * @apiParam {File} [FILES_CLIENT] Optional FILES_CLIENT of Pos ibi clientss.  
	 * @apiParam {String} [DESCRIPTION_CLIENT] Optional DESCRIPTION_CLIENT of Pos ibi clientss.  
	 * @apiParam {Integer} ID_CLIENT Mandatory ID_CLIENT of Pos Ibi Clients.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_pos_ibi_clients_update');

		
		$this->form_validation->set_rules('NOM_CLIENT', 'NOM CLIENT', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('PRENOM_CLIENT', 'PRENOM CLIENT', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('TEL_CLIENT', 'TEL CLIENT', 'trim|max_length[20]|callback_valid_number');
		$this->form_validation->set_rules('TEL_2_CLIENT', 'TEL 2 CLIENT', 'trim|max_length[20]|callback_valid_number');
		$this->form_validation->set_rules('NUMBER_COMPTE_CLIENT', 'NUMBER COMPTE CLIENT', 'trim|max_length[200]');
		$this->form_validation->set_rules('EMAIL_CLIENT', 'EMAIL CLIENT', 'trim|valid_email');
		$this->form_validation->set_rules('STATE_CLIENT', 'STATE CLIENT', 'trim|max_length[50]');
		$this->form_validation->set_rules('COUNTRY_CLIENT', 'COUNTRY CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('CITY_CLIENT', 'CITY CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('QUARTIER_CLIENT', 'QUARTIER CLIENT', 'trim|max_length[11]');
		$this->form_validation->set_rules('BP_CLIENT', 'BP CLIENT', 'trim|max_length[20]');
		$this->form_validation->set_rules('COMPANY_NAME_CLIENT', 'COMPANY NAME CLIENT', 'trim|max_length[200]');
		$this->form_validation->set_rules('REF_GROUP_CLIENT', 'REF GROUP CLIENT', 'trim|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT'),
				'PRENOM_CLIENT' => $this->input->post('PRENOM_CLIENT'),
				'TEL_CLIENT' => $this->input->post('TEL_CLIENT'),
				'TEL_2_CLIENT' => $this->input->post('TEL_2_CLIENT'),
				'NUMBER_COMPTE_CLIENT' => $this->input->post('NUMBER_COMPTE_CLIENT'),
				'EMAIL_CLIENT' => $this->input->post('EMAIL_CLIENT'),
				'STATE_CLIENT' => $this->input->post('STATE_CLIENT'),
				'COUNTRY_CLIENT' => $this->input->post('COUNTRY_CLIENT'),
				'CITY_CLIENT' => $this->input->post('CITY_CLIENT'),
				'QUARTIER_CLIENT' => $this->input->post('QUARTIER_CLIENT'),
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT'),
				'BP_CLIENT' => $this->input->post('BP_CLIENT'),
				'COMPANY_NAME_CLIENT' => $this->input->post('COMPANY_NAME_CLIENT'),
				'DATE_CREATION_CLIENT' => $this->input->post('DATE_CREATION_CLIENT'),
				'DATE_MOD_CLIENT' => $this->input->post('DATE_MOD_CLIENT'),
				'REF_GROUP_CLIENT' => $this->input->post('REF_GROUP_CLIENT'),
				'DESCRIPTION_CLIENT' => $this->input->post('DESCRIPTION_CLIENT'),
			];
			
			$config = [
				'upload_path' 	=> './uploads/pos_ibi_clients/',
					'required' 		=> false
			];
			
			if ($upload = $this->upload_file('FILES_CLIENT', $config)){
				$upload_data = $this->upload->data();
				$save_data['FILES_CLIENT'] = $upload['file_name'];
			}

			$save_pos_ibi_clients = $this->model_api_pos_ibi_clients->change($this->post('ID_CLIENT'), $save_data);

			if ($save_pos_ibi_clients) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /pos_ibi_clients/delete Delete Pos ibi clients. 
	 * @apiVersion 0.1.0
	 * @apiName DeletePos ibi clients
	 * @apiGroup pos_ibi_clients
	 * @apiHeader {String} X-Api-Key Pos ibi clientss unique access-key.
	 * @apiHeader {String} X-Token Pos ibi clientss unique token.
	 	 * @apiPermission Pos ibi clients Cant be Accessed permission name : api_pos_ibi_clients_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Pos ibi clientss .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_pos_ibi_clients_delete');

		$pos_ibi_clients = $this->model_api_pos_ibi_clients->find($this->post('ID_CLIENT'));

		if (!$pos_ibi_clients) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Pos ibi clients not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_pos_ibi_clients->remove($this->post('ID_CLIENT'));

			if (!empty($pos_ibi_clients->FILES_CLIENT)) {
				$path = FCPATH . '/uploads/pos_ibi_clients/' . $pos_ibi_clients->FILES_CLIENT;

				if (is_file($path)) {
					$delete_file = unlink($path);
				}
			}

		}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Pos ibi clients deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Pos ibi clients not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Pos ibi clients.php */
/* Location: ./application/controllers/api/Pos ibi clients.php */