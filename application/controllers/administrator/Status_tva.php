<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Resto status tva bs Controller
 *| --------------------------------------------------------------------------
 *| Resto Store status tva ibi apk
 *|
 */
class Status_tva extends Admin
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}



	public function index(){

		$this->data['stat'] = $this->db->get_where('status_tva',['id_status'=>1])->row_array();
		$this->template->title('Tva Management');
        $this->render('backend/standart/administrator/status_tva/status_tva_list', $this->data);	
	}


	public function changer_status(){
     $change=$this->model_rm->update('status_tva', array('id_status'=>1), ['status'=>$this->input->post('statut')]);
     if ($change) {
      	echo json_encode(array('status'=>'Status Tva changer avec success', 'statut'=>'ok'));
      }else{
      	 echo json_encode(array('status'=>'Aucun changement effectuer!!', 'statut'=>'false'));

      }
	

	}




}