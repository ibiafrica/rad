<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Marge Prix Controller
*| --------------------------------------------------------------------------
*| Marge Prix site
*|
*/
class Marge_prix extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_marge_prix');
	}

	/**
	* show all Marge Prixs
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('marge_prix_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['marge_prixs'] = $this->model_marge_prix->get($filter, $field, $this->limit_page, $offset);
		$this->data['marge_prix_counts'] = $this->model_marge_prix->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/marge_prix/index/',
			'total_rows'   => $this->model_marge_prix->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Marge Prix List');
		$this->render('backend/standart/administrator/marge_prix/marge_prix_list', $this->data);
	}
	
	/**
	* Add new marge_prixs
	*
	*/
	public function add()
	{
		$this->is_allowed('marge_prix_add');

		$this->template->title('Marge Prix New');
		$this->render('backend/standart/administrator/marge_prix/marge_prix_add', $this->data);
	}

	/**
	* Add New Marge Prixs
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('marge_prix_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGNATION', 'DESIGNATION', 'trim|required');
		$this->form_validation->set_rules('MARGE', 'MARGE', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION' => $this->input->post('DESIGNATION'),
				'MARGE' => $this->input->post('MARGE'),
				'TYPE_MARGE' => $this->input->post('TYPE_MARGE'),
				'CREATED_BY' => get_user_data('id'),				
				'DATE_CREATION' => date('Y-m-d'),
			];

			
			$save_marge_prix = $this->model_marge_prix->store($save_data);

			if ($save_marge_prix) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_marge_prix;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/marge_prix/edit/' . $save_marge_prix, 'Edit Marge Prix'),
						anchor('administrator/marge_prix', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/marge_prix/edit/' . $save_marge_prix, 'Edit Marge Prix')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/marge_prix');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/marge_prix');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Marge Prixs
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('marge_prix_update');

		$this->data['marge_prix'] = $this->model_marge_prix->find($id);

		$this->template->title('Marge Prix Update');
		$this->render('backend/standart/administrator/marge_prix/marge_prix_update', $this->data);
	}

	/**
	* Update Marge Prixs
	*
	* @var $id String
	*/
	public function edit_save($id)
	{

		 
		if (!$this->is_allowed('marge_prix_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGNATION', 'DESIGNATION', 'trim|required');
		$this->form_validation->set_rules('MARGE', 'MARGE', 'trim|required');
		$marge = $this->input->post('MARGE');
		$type_marge = $this->input->post('TYPE_MARGE');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION' => $this->input->post('DESIGNATION'),
				'MARGE' => $this->input->post('MARGE'),
				'TYPE_MARGE' => $this->input->post('TYPE_MARGE'),
				'CREATED_BY' => get_user_data('id'),			
				'DATE_CREATION' => date('Y-m-d'),
			];

			 
			if ($type_marge==1) {
             
				$donnee =$this->db->get_where("pos_store_1_ibi_articles",array("TYPE_ARTICLE"=>1))->result();
				foreach ($donnee as $k) {
					$prix_vente= $k->PRIX_DACHAT_ARTICLE;
					$percent =$prix_vente + (($prix_vente * $marge) / 100);
					$this->db->query("UPDATE pos_store_1_ibi_articles SET PRIX_DE_VENTE_ARTICLE =".$percent." WHERE ID_ARTICLE=".$k->ID_ARTICLE);
			  }	
			  
			  	$save_marge_prix = $this->model_marge_prix->change($id, $save_data);
			
 			} else {
			    $save_marge_prix = $this->model_marge_prix->change($id, $save_data);
			}
			
			if ($save_marge_prix) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/marge_prix', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/marge_prix');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/marge_prix');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Marge Prixs
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('marge_prix_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id,$commentValue);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id,$commentValue);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'marge_prix'), 'success');
        } else {
            set_message(cclang('error_delete', 'marge_prix'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Marge Prixs
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('marge_prix_view');

		$this->data['marge_prix'] = $this->model_marge_prix->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Marge Prix Detail');
		$this->render('backend/standart/administrator/marge_prix/marge_prix_view', $this->data);
	}
	
	/**
	* delete Marge Prixs
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$marge_prix = $this->model_marge_prix->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("marge_prix",$delete_save,array("ID_MARGE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('marge_prix_export');

		$this->model_marge_prix->export('marge_prix', 'marge_prix');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('marge_prix_export');

		$this->model_marge_prix->pdf('marge_prix', 'marge_prix');
	}
}


/* End of file marge_prix.php */
/* Location: ./application/controllers/administrator/Marge Prix.php */