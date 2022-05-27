<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Accompagnement Controller
 *| --------------------------------------------------------------------------
 *| Accompagnement bas
 *|
 */

class Accompagnement extends Admin
{

	public function __construct()
	{
		parent::__construct();


		$this->load->model('model_accompagnement');
		$this->load->model('model_rm');
	}




	public function index($offset = 0){

	    $this->is_allowed('accompagnement_list');

	   $store = $this->uri->segment(2);

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['accompagnements_bs'] = $this->model_accompagnement->get($store,$filter, $field, $this->limit_page, $offset);

		$this->data['accompagnements_bs_counts'] = $this->model_accompagnement->count_all($store,$filter, $field);

		$config = [
			'base_url'     => 'accompagnement/'.$store.'/index/',
			'total_rows'   => $this->model_accompagnement->count_all($store,$filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);


		$this->template->title('Accompagnement sunStone');
		$this->render('backend/standart/administrator/accompagnement/accompagnement_list', $this->data);
	}



	public function add_save()
	{
		$this->form_validation->set_rules('DESIGNATION_ACCOMPAGNEMENT', 'Designation', 'trim|required');
		if ($this->form_validation->run()) {

			$data_accompagnement=[
				'DESIGNATION_ACCOMPAGNEMENT' => $this->input->post('DESIGNATION_ACCOMPAGNEMENT'),
				'CREATE_BY_ACCOMPAGNEMENT' =>get_user_data('id'),
				'ID_STORE'=>$this->input->post('ID_STORE')
			];
			$saveItems = $this->model_rm->register('pos_accompagnement',$data_accompagnement);
			if ($saveItems) {
			   $this->data = true;
			} else {
			   $this->data= false;
			}

	}else{
	      $this->data= false;
	}

		echo json_encode($this->data);
}

public function get_accompagnement(){
			$ider = $this->input->post('id');
		    $getAccompagnement = $this->db->query('SELECT * FROM pos_accompagnement WHERE ID_ACCOMPAGNEMENT =' . $ider . ' ')->row_array();
		echo json_encode($getAccompagnement);
}


public function edit_save($id){


		$this->form_validation->set_rules('DESIGNATION_ACCOMPAGNEMENT_UP', 'Designation', 'trim|required');
		if ($this->form_validation->run()) {
		
			$data_accompagnement=[
				'DESIGNATION_ACCOMPAGNEMENT' => $this->input->post('DESIGNATION_ACCOMPAGNEMENT_UP')
			];
			$saveItems = $this->model_rm->update('pos_accompagnement',["ID_ACCOMPAGNEMENT"=>$id],$data_accompagnement);
			if ($saveItems) {
			   $this->data = true;
			} else {
			   $this->data= false;
			}

	}else{
	      $this->data= false;
	}

		echo json_encode($this->data);

}


public function delete_accompagnement(){
	$id_deleted = $this->input->post('id_deleted');
	$data_accompagnement=['ACCOMPAGNEMENT_STATUS' =>1,'DELETED_BY'=>get_user_data('id'),'DATE_DELETED'=>date('Y-m-d h:i:s')];

	$saveItems = $this->model_rm->update('pos_accompagnement',["ID_ACCOMPAGNEMENT"=>$id_deleted],$data_accompagnement);
			if ($saveItems) { $this->data = true;} else { $this->data= false; }
	

		echo json_encode($this->data);
}






}
