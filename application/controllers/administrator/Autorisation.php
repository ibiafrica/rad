<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
*| --------------------------------------------------------------------------
*| Auth Controller
*| --------------------------------------------------------------------------
*| For authentication
*|
*/
class Autorisation extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}

	public function index(){
        
		$this->template->title('Autorisation');
		$this->render('backend/standart/autorisation_view');
	}


	public function set_status()
	{
		
		$status = $this->input->post('status');
		

		$update_status = $this->model_rm->update('autorisation', array('ID_AUTORISATION'=>1),
		 [
			'STATUS' => $status == 'inactive' ? 1 : 0
		]);
		
		if ($update_status) {
			$this->response = [
				'success' => true,
				'message' => 'autorisation status updated',
			];
		} else {
			$this->response = [
				'success' => false,
				'message' => cclang('data_not_change')
			];
		}

		return $this->response($this->response);
	}

}