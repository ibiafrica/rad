<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Client Deposit Controller
 *| --------------------------------------------------------------------------
 *| Client Deposit site
 *|
 */
class Client_deposit extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_client_deposit');
	}

	/**
	 * show all Client Deposits
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('client_deposit_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['client_deposits'] = $this->model_client_deposit->get($filter, $field, $this->limit_page, $offset);
		$this->data['client_deposit_counts'] = $this->model_client_deposit->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/client_deposit/index/',
			'total_rows'   => $this->model_client_deposit->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Client Deposit List');
		$this->render('backend/standart/administrator/client_deposit/client_deposit_list', $this->data);
	}

	/**
	 * Add new client_deposits
	 *
	 */
	public function add()
	{
		$this->is_allowed('client_deposit_add');

		$this->template->title('Client Deposit New');
		$this->render('backend/standart/administrator/client_deposit/client_deposit_add', $this->data);
	}

	/**
	 * Add New Client Deposits
	 *
	 * @return JSON
	 */
	public function add_save()
	{

		if (!$this->is_allowed('client_deposit_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('PaidType', 'PAID TYPE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('amount', 'AMOUNT', 'trim|required');
		// $this->form_validation->set_rules('PAID_DATE', 'PAID DATE', 'trim|required');
		// $this->form_validation->set_rules('CREATED_BY', 'CREATED BY', 'trim|required|max_length[11]');
		// $this->form_validation->set_rules('BANK_NAME', 'BANK NAME', 'trim|required|max_length[255]');
		// $this->form_validation->set_rules('INVOICE_NUMBER', 'INVOICE NUMBER', 'trim|required|max_length[255]');


		if ($this->form_validation->run()) {
			$last = $this->db->query("SELECT INVOICE_NUMBER FROM client_deposit ORDER BY ID_DEPOSIT DESC LIMIT 1 ")->row_array()['INVOICE_NUMBER'];

			$res = 0;
			if (empty($last)) {
				$code = "CD000001";
			} else {
				$code = explode("CD", $last);
				$codee = intval($code[1]) + 1;
				$cod = "" . $codee . "";
				$code = "CD" . str_pad($codee, (strlen($last)) - strlen($cod), "0", STR_PAD_LEFT);
			}

			$save_data = [
				'PAID_TYPE' => $this->input->post('PaidType'),
				'AMOUNT' => $this->input->post('amount'),
				'PAID_DATE' => date("Y-m-d h:m:i"),
				'CREATED_BY' => get_user_data('id'),
				'BANK_NAME' => $this->input->post('banKName'),
				'INVOICE_NUMBER' => $code,
				'ID_CLIENT ' => $this->input->post("idClient"),
				'REF_DEPOSIT' => $this->input->post('Reference'),
				'description' => $this->input->post("describe")
			];


			$save_client_deposit = $this->model_client_deposit->store($save_data);

			if ($save_client_deposit) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_client_deposit;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/client_deposit/edit/' . $save_client_deposit, 'Edit Client Deposit'),
						anchor('administrator/client_deposit', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/client_deposit/edit/' . $save_client_deposit, 'Edit Client Deposit')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/client_deposit');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/client_deposit');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Client Deposits
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('client_deposit_update');

		$this->data['client_deposit'] = $this->model_client_deposit->find($id);

		$this->template->title('Client Deposit Update');
		$this->render('backend/standart/administrator/client_deposit/client_deposit_update', $this->data);
	}

	/**
	 * Update Client Deposits
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('client_deposit_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		// $this->form_validation->set_rules('PaidType', 'PAID TYPE', 'trim|required|max_length[11]');
		// $this->form_validation->set_rules('amount', 'AMOUNT', 'trim|required');
		// $this->form_validation->set_rules('PAID_DATE', 'PAID DATE', 'trim|required');
		// $this->form_validation->set_rules('CREATED_BY', 'CREATED BY', 'trim|required|max_length[11]');
		// $this->form_validation->set_rules('banKName', 'BANK NAME', 'trim|required|max_length[255]');
		// $this->form_validation->set_rules('invoiceName', 'INVOICE NUMBER', 'trim|required|max_length[255]');
		$save_data = [
				'AMOUNT' => $this->input->post('amount'),
				'PAID_DATE' => date("Y-m-d i:h:s"),
				'CREATED_BY' => get_user_data('id'),
				// 'INVOICE_NUMBER' => $this->input->post('invoiceName'),
				'PAID_TYPE' => $this->input->post('PaidType'),
				'BANK_NAME' => $this->input->post('banKName'),
				'REF_DEPOSIT' => $this->input->post('Reference'),
				'description' => $this->input->post("describe")
				];
				var_dump($save_data,$this->uri->segment(4));
				die;

		if ($this->form_validation->run()) {

			
			$save_client_deposit = $this->model_client_deposit->change($id, $save_data);

			if ($save_client_deposit) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/client_deposit', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/clients/view/' . $this->uri->segment(4));
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/client_deposit');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Client Deposits
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('client_deposit_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'client_deposit'), 'success');
		} else {
			set_message(cclang('error_delete', 'client_deposit'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Client Deposits
	 *
	 * @var $id String
	 */
	public function view($id)
	{

		$this->is_allowed('client_deposit_view');
		$this->data['client_deposit'] = $this->db->query("SELECT CP.*, AU.username from client_deposit CP join aauth_users AU on CP.CREATED_BY=AU.id where CP.ID_DEPOSIT=" . $id)->row_array();
		echo json_encode($this->data);
	}



	/**
	 * delete Client Deposits
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$client_deposit = $this->model_client_deposit->find($id);



		return $this->model_client_deposit->remove($id);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('client_deposit_export');

		$this->model_client_deposit->export('client_deposit', 'client_deposit');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('client_deposit_export');

		$this->model_client_deposit->pdf('client_deposit', 'client_deposit');
	}
}


/* End of file client_deposit.php */
/* Location: ./application/controllers/administrator/Client Deposit.php */