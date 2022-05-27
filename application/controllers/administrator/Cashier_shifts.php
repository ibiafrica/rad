<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Cashier Shifts Controller
 *| --------------------------------------------------------------------------
 *| Cashier Shifts site
 *|
 */
class Cashier_shifts extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_cashier_shifts');
	}

	/**
	 * show all Cashier Shiftss
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('cashier_shifts_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$status = $this->input->post('status');

		$this->data['cashier_shiftss'] = $this->model_cashier_shifts->get($status, $filter, $field, $this->limit_page, $offset);
		$this->data['cashier_shifts_counts'] = $this->model_cashier_shifts->count_all($status, $filter, $field);

		$config = [
			'base_url'     => 'administrator/cashier_shifts/index/',
			'total_rows'   => $this->model_cashier_shifts->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		// var_dump($this->data['cashier_shiftss']);
		// //exit;

		$this->template->title('Cashier Shifts List');
		$this->render('backend/standart/administrator/cashier_shifts/cashier_shifts_list', $this->data);
	}

	/**
	 * Add new cashier_shiftss
	 *
	 */
	public function add()
	{
		$this->is_allowed('cashier_shifts_add');

		$this->template->title('Cashier Shifts New');
		$this->render('backend/standart/administrator/cashier_shifts/cashier_shifts_add', $this->data);
	}

	/**
	 * Add New Cashier Shiftss
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('cashier_shifts_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('start_date', 'Début Shift', 'trim|required');
		// $this->form_validation->set_rules('SHIFT_END', 'Fin Shift', 'trim|required');
		// $this->form_validation->set_rules('SHIFT_STATUS', 'Status', 'trim|required|max_length[11]');


		if ($this->form_validation->run()) {

			$save_data = [
				'SHIFT_STATUS' => $this->input->post('status'),
				'CREATED_BY_SHIFT' => $this->input->post('created_by'),
			];

			$this->db->set('SHIFT_STATUS', 1);
			$this->db->set('SHIFT_END', date('Y-m-s'));
			$this->db->where('SHIFT_STATUS', 0);
			$this->db->update('cashier_shifts');


			$save_cashier_shifts = $this->model_cashier_shifts->store($save_data);

			if ($save_cashier_shifts) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_cashier_shifts;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/cashier_shifts/edit/' . $save_cashier_shifts, 'Edit Cashier Shifts'),
						anchor('administrator/cashier_shifts', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/cashier_shifts/edit/' . $save_cashier_shifts, 'Edit Cashier Shifts')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cashier_shifts');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cashier_shifts');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}


	public function Update_shift()
	{
		# code...
		$id = $this->input->post('id');
		$save_data = [
			'SHIFT_END' => $this->input->post('end_date'),
			'SHIFT_STATUS' => $this->input->post('status'),
			//'CREATED_BY_SHIFT' => $this->input->post('created_by'),
		];

		$this->db->set($save_data);
		$this->db->where('ID_SHIFT', $id);
		$this->db->update('cashier_shifts');
	}

	/**
	 * Update view Cashier Shiftss
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('cashier_shifts_update');

		$this->data['cashier_shifts'] = $this->model_cashier_shifts->find($id);

		$this->template->title('Cashier Shifts Update');
		$this->render('backend/standart/administrator/cashier_shifts/cashier_shifts_update', $this->data);
	}

	/**
	 * Update Cashier Shiftss
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('cashier_shifts_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('SHIFT_START', 'Début Shift', 'trim|required');
		$this->form_validation->set_rules('SHIFT_END', 'Fin Shift', 'trim|required');
		$this->form_validation->set_rules('SHIFT_STATUS', 'Status', 'trim|required|max_length[11]');

		if ($this->form_validation->run()) {

			$save_data = [
				'SHIFT_START' => $this->input->post('SHIFT_START'),
				'SHIFT_END' => $this->input->post('SHIFT_END'),
				'SHIFT_STATUS' => $this->input->post('SHIFT_STATUS'),
				'CREATED_BY_SHIFT' => get_user_data('id'),
			];


			$save_cashier_shifts = $this->model_cashier_shifts->change($id, $save_data);

			if ($save_cashier_shifts) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/cashier_shifts', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/cashier_shifts');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/cashier_shifts');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Cashier Shiftss
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('cashier_shifts_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id, $commentValue);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id, $commentValue);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'cashier_shifts'), 'success');
		} else {
			set_message(cclang('error_delete', 'cashier_shifts'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Cashier Shiftss
	 *
	 * @var $id String
	 */
	public function view($id)
	{
		$this->is_allowed('cashier_shifts_view');

		$this->data['cashier_shifts'] = $this->model_cashier_shifts->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Cashier Shifts Detail');
		$this->render('backend/standart/administrator/cashier_shifts/cashier_shifts_view', $this->data);
	}

	/**
	 * delete Cashier Shiftss
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$cashier_shifts = $this->model_cashier_shifts->find($id);



		$delete_save = array(
			'DELETED_STATUS_' => 1,
			'DELETED_DATE_' => date('Y-m-d H:i:s'),
			'DELETED_USER_' => get_user_data('id'),
			'DELETED_COMMENT_' => $commentValue
		);

		$remove = $this->db->update("cashier_shifts", $delete_save, array("ID_SHIFT" => $id));
		return $remove;
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('cashier_shifts_export');

		$this->model_cashier_shifts->export('cashier_shifts', 'cashier_shifts');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('cashier_shifts_export');

		$this->model_cashier_shifts->pdf('cashier_shifts', 'cashier_shifts');
	}
}


/* End of file cashier_shifts.php */
/* Location: ./application/controllers/administrator/Cashier Shifts.php */