<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Contribuable Controller
*| --------------------------------------------------------------------------
*| Contribuable site
*|
*/
class Contribuable extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_contribuable');
	}

	/**
	* show all Contribuables
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('contribuable_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$contribuables = $this->model_contribuable->get($filter, $field, 100000, $offset);

		$last = end($contribuables) == null ? null : end($contribuables);

		$this->data['contribuable'] = $last;

		$this->data['contribuable_counts'] = $this->model_contribuable->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/contribuable/index/',
			'total_rows'   => $this->model_contribuable->count_all($filter, $field),
			'per_page'     => 1000000,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		if($last == null) {
			$this->template->title('Ajouter Contribuable');
			$this->render('backend/standart/administrator/contribuable/contribuable_add', $this->data);
		} else {
			$this->template->title('Detail Contribuable');
			$this->render('backend/standart/administrator/contribuable/contribuable_view', $this->data);
		}

	}
	
	/**
	* Add new contribuables
	*
	*/
	public function add()
	{
		$this->is_allowed('contribuable_add');

		$this->template->title('Contribuable New');
		$this->render('backend/standart/administrator/contribuable/contribuable_add', $this->data);
	}

	/**
	* Add New Contribuables
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('contribuable_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('tp_type', 'Type', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('tp_name', 'Nom', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tp_TIN', 'NIF', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tp_trade_number', 'Numero Du Registre', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_postal_number', 'Code Postal', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_phone_number', 'Telephone', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_address_province', 'Province', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_commune', 'Commune', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_quartier', 'Quartier', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_avenue', 'Avenue', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_rue', 'Rue', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_number', 'Numero', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('vat_taxpayer', 'Assujetti A La TVA', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('ct_taxpayer', 'Assujetti A La Taxe Consommation', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('tl_taxpayer', 'Assujetti Au PF', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('tp_fiscal_center', 'Centre Fiscal', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_activity_sector', 'Secteur D\'Activite', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('tp_legal_form', 'Forme Juridique', 'trim|required|max_length[20]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'tp_type' => $this->input->post('tp_type'),
				'tp_name' => $this->input->post('tp_name'),
				'tp_TIN' => $this->input->post('tp_TIN'),
				'tp_trade_number' => $this->input->post('tp_trade_number'),
				'tp_postal_number' => $this->input->post('tp_postal_number'),
				'tp_phone_number' => $this->input->post('tp_phone_number'),
				'tp_address_province' => $this->input->post('tp_address_province'),
				'tp_address_commune' => $this->input->post('tp_address_commune'),
				'tp_address_quartier' => $this->input->post('tp_address_quartier'),
				'tp_address_avenue' => $this->input->post('tp_address_avenue'),
				'tp_address_rue' => $this->input->post('tp_address_rue'),
				'tp_address_number' => $this->input->post('tp_address_number'),
				'vat_taxpayer' => $this->input->post('vat_taxpayer'),
				'ct_taxpayer' => $this->input->post('ct_taxpayer'),
				'tl_taxpayer' => $this->input->post('tl_taxpayer'),
				'tp_fiscal_center' => $this->input->post('tp_fiscal_center'),
				'tp_activity_sector' => $this->input->post('tp_activity_sector'),
				'tp_legal_form' => $this->input->post('tp_legal_form'),
			];

			
			$save_contribuable = $this->model_contribuable->store($save_data);

			if ($save_contribuable) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_contribuable;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/contribuable/edit/' . $save_contribuable, 'Edit Contribuable'),
						anchor('administrator/contribuable', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/contribuable/edit/' . $save_contribuable, 'Edit Contribuable')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/contribuable');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/contribuable');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Contribuables
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('contribuable_update');

		$this->data['contribuable'] = $this->model_contribuable->find($id);

		$this->template->title('Contribuable Update');
		$this->render('backend/standart/administrator/contribuable/contribuable_update', $this->data);
	}

	/**
	* Update Contribuables
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('contribuable_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('tp_type', 'Type', 'trim|required|max_length[5]');
		$this->form_validation->set_rules('tp_name', 'Nom', 'trim|required|max_length[100]');
		$this->form_validation->set_rules('tp_TIN', 'NIF', 'trim|required|max_length[30]');
		$this->form_validation->set_rules('tp_trade_number', 'Numero Du Registre', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_postal_number', 'Code Postal', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_phone_number', 'Telephone', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_address_province', 'Province', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_commune', 'Commune', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_quartier', 'Quartier', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_avenue', 'Avenue', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_rue', 'Rue', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('tp_address_number', 'Numero', 'trim|required|max_length[10]');
		$this->form_validation->set_rules('vat_taxpayer', 'Assujetti A La TVA', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('ct_taxpayer', 'Assujetti A La Taxe Consommation', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('tl_taxpayer', 'Assujetti Au PF', 'trim|required|max_length[3]');
		$this->form_validation->set_rules('tp_fiscal_center', 'Centre Fiscal', 'trim|required|max_length[20]');
		$this->form_validation->set_rules('tp_activity_sector', 'Secteur D\'Activite', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('tp_legal_form', 'Forme Juridique', 'trim|required|max_length[20]');
		
		if ($this->form_validation->run()) {

			$contribuable_tp_logo_uuid = $this->input->post('contribuable_tp_logo_uuid');
			$contribuable_tp_logo_name = $this->input->post('contribuable_tp_logo_name');
		
			$save_data = [
				'tp_type' => $this->input->post('tp_type'),
				'tp_name' => $this->input->post('tp_name'),
				'tp_TIN' => $this->input->post('tp_TIN'),
				'tp_trade_number' => $this->input->post('tp_trade_number'),
				'tp_postal_number' => $this->input->post('tp_postal_number'),
				'tp_phone_number' => $this->input->post('tp_phone_number'),
				'tp_address_province' => $this->input->post('tp_address_province'),
				'tp_address_commune' => $this->input->post('tp_address_commune'),
				'tp_address_quartier' => $this->input->post('tp_address_quartier'),
				'tp_address_avenue' => $this->input->post('tp_address_avenue'),
				'tp_address_rue' => $this->input->post('tp_address_rue'),
				'tp_address_number' => $this->input->post('tp_address_number'),
				'vat_taxpayer' => $this->input->post('vat_taxpayer'),
				'ct_taxpayer' => $this->input->post('ct_taxpayer'),
				'tl_taxpayer' => $this->input->post('tl_taxpayer'),
				'tp_fiscal_center' => $this->input->post('tp_fiscal_center'),
				'tp_activity_sector' => $this->input->post('tp_activity_sector'),
				'tp_legal_form' => $this->input->post('tp_legal_form'),
				'tp_email' => $this->input->post('email'),
				'status_tva' => $this->input->post('status_tva'),
			];

			if (!is_dir(FCPATH . '/uploads/contribuable/')) {
				mkdir(FCPATH . '/uploads/contribuable/');
			}

			if (!empty($contribuable_tp_logo_uuid)) {
				$contribuable_tp_logo_name_copy = date('YmdHis') . '-' . $contribuable_tp_logo_name;

				rename(FCPATH . 'uploads/tmp/' . $contribuable_tp_logo_uuid . '/' . $contribuable_tp_logo_name, 
						FCPATH . 'uploads/contribuable/' . $contribuable_tp_logo_name_copy);

				if (!is_file(FCPATH . '/uploads/contribuable/' . $contribuable_tp_logo_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['tp_logo'] = $contribuable_tp_logo_name_copy;
			}

			
			$save_contribuable = $this->model_contribuable->change($id, $save_data);

			if ($save_contribuable) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/contribuable', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/contribuable');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/contribuable');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Contribuables
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('contribuable_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'contribuable'), 'success');
        } else {
            set_message(cclang('error_delete', 'contribuable'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Contribuables
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('contribuable_view');

		$this->data['contribuable'] = $this->model_contribuable->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Contribuable Detail');
		$this->render('backend/standart/administrator/contribuable/contribuable_view', $this->data);
	}
	
	/**
	* delete Contribuables
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$contribuable = $this->model_contribuable->find($id);

		
		
		return $this->model_contribuable->remove($id);
	}


	public function upload_tp_logo_file()
	{
		if (!$this->is_allowed('contribuable_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'contribuable',
		]);
	}

	/**
	* Delete Image Settings App	* 
	* @return JSON
	*/
	public function delete_tp_logo_file($uuid)
	{
		//print_r($uuid);die;
		if (!$this->is_allowed('contribuable_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'tp_logo', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'contribuable',
            'primary_key'       => 'id_contribuable',
            'upload_path'       => 'uploads/contribuable/'
        ]);
	}

	/**
	* Get Image Settings App	* 
	* @return JSON
	*/
	public function get_tp_logo_file($id)
	{
		if (!$this->is_allowed('contribuable_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		$contribuable = $this->model_contribuable->find($id);

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'tp_logo', 
            'table_name'        => 'contribuable',
            'primary_key'       => 'id_contribuable',
            'upload_path'       => 'uploads/contribuable/',
            'delete_endpoint'   => 'administrator/contribuable/delete_tp_logo_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('contribuable_export');

		$this->model_contribuable->export('contribuable', 'contribuable');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('contribuable_export');

		$this->model_contribuable->pdf('contribuable', 'contribuable');
	}
}


/* End of file contribuable.php */
/* Location: ./application/controllers/administrator/Contribuable.php */