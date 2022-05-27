<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| InvoiceFiles Controller
*| --------------------------------------------------------------------------
*| user site
*|
*/
class Invoice_files extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_user');
	}

	/**
	* download file
	*
	* @var $file_path String
	* @var $file_name String
	*/
    public function index() {
		if(isset($_GET['date_debut']) && isset($_GET['date_fin'])) {
			$invoice_saved = $this->db->query("SELECT * FROM invoice_saved WHERE DATE(date_creation) >= '".$_GET['date_debut']."' AND DATE(date_creation) <= '".$_GET['date_fin']."'")->result();
		} else {
			$invoice_saved = $this->db->query('SELECT * FROM invoice_saved')->result();
		}
		$this->data['invoices'] = $invoice_saved;
        $this->template->title('Telecharger');
		$this->render('backend/standart/administrator/invoice_files/invoice_files_list', $this->data);
    }

	public function add_profile() {
		
	}

    public function apply_import_filter() {
		$user_id = get_user_data('id');
		$datapost = $_POST['dataPost'];
		$contribuable = $_POST['contribuable'];
		$invoices = [];
		// print_r(array_values($datapost));die;
		foreach(array_values($datapost) as $keys => $dataa) {
			$dat = json_decode($dataa);
			for($f = 0; $f < count($dat); $f++) {
				$element = $dat[$f];
				// for($t = 0; $t < count($element); $t++) {
				// 	$el = $element[$t];
				// 	if(!isset($invoices[$el])) {
				// 		$invoices[$el] = [];
				// 	}
					array_push($invoices[$element], $element);
				// }
			}
				// array_push($invoices, $dat);
			// for($f = 0; $f < count($dat); $f++) {
			// 	// if(!isset($dat))
			// }
		}
		print_r($invoices);die;



		echo json_encode($datapost);die;
	}

	// public function rangeData($arr) {

	// }

	public function login_request() {
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$data['success'] = false;
		$data['contribuable'] = null;
		$data['username'] = $username;

		if(!empty($username) && !empty($password)) {
			$verify = $this->db->query("SELECT tp_type, tp_name, tp_TIN, tp_trade_number, tp_postal_number,
			tp_phone_number, tp_address_province, tp_address_commune, tp_address_quartier, tp_address_avenue,
			tp_address_rue, tp_address_number, vat_taxpayer, ct_taxpayer, tl_taxpayer, tp_fiscal_center, 
			tp_activity_sector, tp_legal_form
			FROM contribuable ORDER BY id_contribuable desc LIMIT 0, 1")->row();
			if($verify) {
				$data['success'] = true;
				$data['contribuable'] = $verify;
			} else {
				$data['success'] = false;
			}
		}

		echo json_encode($data);die;
	}
	public function addInvoice() {
		$invoice_number = $this->input->post('data')['invoice_number'];
		$invoice_signature = $this->input->post('data')['invoice_signature'];
		
		$save_data = [
			'invoice_number' => $invoice_number,
			'invoice_signature' => $invoice_signature,
			'date_creation' => date('Y-m-d H:i:s')
		];
		$query = $this->db->insert('invoice_saved', $save_data);
	}
	public function addInvoiceCancelled() {
		$invoice_number = $this->input->post('data')['invoice_number'];
		$invoice_signature = $this->input->post('data')['invoice_signature'];
		
		$save_data = [
			'invoice_number' => $invoice_number,
			'invoice_signature' => $invoice_signature,
			'date_creation' => date('Y-m-d H:i:s')
		];
		$query = $this->db->insert('invoice_cancelled', $save_data);
	}
}