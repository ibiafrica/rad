<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Categorie Flux Caisse Controller
*| --------------------------------------------------------------------------
*| Pos Categorie Flux Caisse site
*|
*/
class pos_categorie_flux_caisse extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_categorie_flux_caisse');
	}

	/**
	* show all Pos Categorie Flux Caisses
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_categorie_flux_caisse_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_categorie_flux_caisses'] = $this->model_pos_categorie_flux_caisse->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_categorie_flux_caisse_counts'] = $this->model_pos_categorie_flux_caisse->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_categorie_flux_caisse/index/',
			'total_rows'   => $this->model_pos_categorie_flux_caisse->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Categorie Flux Caisse List');
		$this->render('backend/standart/administrator/pos_categorie_flux_caisse/pos_categorie_flux_caisse_list', $this->data);
	}
	
	/**
	* Add new pos_categorie_flux_caisses
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_categorie_flux_caisse_add');

		$this->template->title('Categorie Flux Caisse New');
		$this->render('backend/standart/administrator/pos_categorie_flux_caisse/pos_categorie_flux_caisse_add', $this->data);
	}

	/**
	* Add New Pos Categorie Flux Caisses
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pos_categorie_flux_caisse_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM_CATEGORIE', 'Categorie', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'CREATE_BY_CATEGORIE' => get_user_data('id'),				'DATE_CREATE_CATEGORIE' => date('Y-m-d H:i:s'),
			];

			
			$save_pos_categorie_flux_caisse = $this->model_pos_categorie_flux_caisse->store($save_data);

			if ($save_pos_categorie_flux_caisse) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_categorie_flux_caisse;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_categorie_flux_caisse/edit/' . $save_pos_categorie_flux_caisse, 'Edit Pos Categorie Flux Caisse'),
						anchor('administrator/pos_categorie_flux_caisse', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_categorie_flux_caisse/edit/' . $save_pos_categorie_flux_caisse, 'Edit Pos Categorie Flux Caisse')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_categorie_flux_caisse');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_categorie_flux_caisse');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Categorie Flux Caisses
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_categorie_flux_caisse_update');

		$this->data['pos_categorie_flux_caisse'] = $this->model_pos_categorie_flux_caisse->find($id);

		$this->template->title('Categorie Flux Caisse Update');
		$this->render('backend/standart/administrator/pos_categorie_flux_caisse/pos_categorie_flux_caisse_update', $this->data);
	}

	/**
	* Update Pos Categorie Flux Caisses
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_categorie_flux_caisse_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM_CATEGORIE', 'Categorie', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM_CATEGORIE' => $this->input->post('NOM_CATEGORIE'),
				'CREATE_BY_CATEGORIE' => get_user_data('id'),			];

			
			$save_pos_categorie_flux_caisse = $this->model_pos_categorie_flux_caisse->change($id, $save_data);

			if ($save_pos_categorie_flux_caisse) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_categorie_flux_caisse', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_categorie_flux_caisse');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_categorie_flux_caisse');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Categorie Flux Caisses
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_categorie_flux_caisse_delete');

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
            set_message(cclang('has_been_deleted', 'pos_categorie_flux_caisse'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_categorie_flux_caisse'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Categorie Flux Caisses
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pos_categorie_flux_caisse_view');

		$this->data['pos_categorie_flux_caisse'] = $this->model_pos_categorie_flux_caisse->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Categorie Flux Caisse Detail');
		$this->render('backend/standart/administrator/pos_categorie_flux_caisse/pos_categorie_flux_caisse_view', $this->data);
	}
	
	/**
	* delete Pos Categorie Flux Caisses
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_categorie_flux_caisse = $this->model_pos_categorie_flux_caisse->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_categorie_flux_caisse",$delete_save,array("ID_CATEGORIE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_categorie_flux_caisse_export');

		$this->model_pos_categorie_flux_caisse->export('pos_categorie_flux_caisse', 'pos_categorie_flux_caisse');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_categorie_flux_caisse_export');

		$this->model_pos_categorie_flux_caisse->pdf('pos_categorie_flux_caisse', 'pos_categorie_flux_caisse');
	}
}


/* End of file pos_categorie_flux_caisse.php */
/* Location: ./application/controllers/administrator/Pos Categorie Flux Caisse.php */