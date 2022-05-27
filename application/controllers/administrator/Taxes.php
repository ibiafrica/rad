<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Taxes Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Taxes site
*|
*/
class Taxes extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_taxes');
		$this->load->model('model_fournisseurs');
	}

	/**
	* show all Pos Ibi Taxess
	*
	* @var $offset String
	*/
	public function index($store = 0, $offset = 0)
	{
		$this->is_allowed('taxes_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['taxess'] = $this->model_taxes->get($filter, $field, $this->limit_page, $offset);
		$this->data['taxes_counts'] = $this->model_taxes->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/taxes/index/',
			'total_rows'   => $this->model_taxes->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste des taxes');
		$this->render('backend/standart/administrator/taxes/taxes_list', $this->data);
	}
	
	/**
	* Add new taxess
	*
	*/
	public function add($store = 0)
	{
		$this->is_allowed('taxes_add');

		$this->template->title('Nouvelle taxe');
		$this->render('backend/standart/administrator/taxes/taxes_add', $this->data);
	}

	/**
	* Add New Pos Ibi Taxess
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		if (!$this->is_allowed('taxes_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NAME_TAXE', 'Nom De La Taxe', 'trim|required');
		$this->form_validation->set_rules('RATE_TAXE', 'Taux Imposition', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_TAXE' => $this->input->post('NAME_TAXE'),
				'DESCRIPTION_TAXE' => $this->input->post('DESCRIPTION_TAXE'),
				'RATE_TAXE' => $this->input->post('RATE_TAXE'),
				'AUTHOR_TAXE' => get_user_data('id'),				'DATE_CREATION_TAXE' => date('Y-m-d H:i:s'),
			];

			
			$save_taxes = $this->model_taxes->store($save_data);

			if ($save_taxes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_taxes;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/taxes/edit/'.$store.'/' . $save_taxes, 'Edit Pos Ibi Taxes'),
						anchor('administrator/taxes/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/taxes/edit/'.$store.'/' . $save_taxes, 'Edit Pos Ibi Taxes')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/taxes/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/taxes/index/'.$store.'');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Taxess
	*
	* @var $id String
	*/
	public function edit($store = 0, $id)
	{
		$this->is_allowed('taxes_update');

		$this->data['taxes'] = $this->model_taxes->find($id);

		$this->template->title('Modifier taxe');
		$this->render('backend/standart/administrator/taxes/taxes_update', $this->data);
	}

	/**
	* Update Pos Ibi Taxess
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('taxes_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAME_TAXE', 'Nom De La Taxe', 'trim|required');
		$this->form_validation->set_rules('RATE_TAXE', 'Taux Imposition', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NAME_TAXE' => $this->input->post('NAME_TAXE'),
				'DESCRIPTION_TAXE' => $this->input->post('DESCRIPTION_TAXE'),
				'RATE_TAXE' => $this->input->post('RATE_TAXE'),
				'DATE_MOD_TAXE' => date('Y-m-d H:i:s'),
			];

			
			$save_taxes = $this->model_taxes->change($id, $save_data);

			if ($save_taxes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/taxes/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/taxes/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/taxes/index/'.$store.'');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Taxess
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('taxes_delete');

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
            set_message(cclang('has_been_deleted', 'taxes'), 'success');
        } else {
            set_message(cclang('error_delete', 'taxes'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Taxess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('taxes_view');

		$this->data['taxes'] = $this->model_taxes->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Taxes Detail');
		$this->render('backend/standart/administrator/taxes/taxes_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Taxess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$taxes = $this->model_taxes->find($id);

		
		
		return $this->model_taxes->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('taxes_export');

		$this->model_taxes->export('pos_ibi_taxes', 'taxes');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('taxes_export');

		$this->model_taxes->pdf('pos_ibi_taxes', 'taxes');
	}
}


/* End of file taxes.php */
/* Location: ./application/controllers/administrator/Pos Ibi Taxes.php */