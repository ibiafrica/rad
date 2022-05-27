<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Clients Controller
 *| --------------------------------------------------------------------------
 *| Pos Clients site
 *|
 */
class pos_clients extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_clients');
		$this->load->model('model_rm');
	}

	/**
	 * show all Pos Clientss
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_clients_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_clientss'] = $this->model_pos_clients->get($filter, $field, $this->limit_page, $offset);
		$this->data['pos_clients_counts'] = $this->model_pos_clients->count_all($filter, $field);

      

		$config = [
			'base_url'     => 'administrator/pos_clients/index/',
			'total_rows'   => $this->model_pos_clients->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Clients List');
		$this->render('backend/standart/administrator/pos_clients/pos_clients_list', $this->data);
	}




	public function imageUploader($file){

		    $target_dir = "uploads/";
			$target_file = $target_dir . basename($file["name"]);
			$uploadOk = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

			// Check if image file is a actual image or fake image
			if(isset($_POST["submit"])) {
			  $check = getimagesize($file["tmp_name"]);
			  if($check !== false) {
			    echo "File is an image - " . $check["mime"] . ".";
			    $uploadOk = 1;
			  } else {
			    echo "File is not an image.";
			    $uploadOk = 0;
			  }
			}

			// Check if file already exists
			if (file_exists($target_file)) {
			  echo "Sorry, file already exists.";
			  $uploadOk = 0;
			}

			// Allow certain file formats
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
			&& $imageFileType != "gif" ) {
			  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			  $uploadOk = 0;
			}

			// Check if $uploadOk is set to 0 by an error
			if ($uploadOk == 0) {
			  echo "Sorry, your file was not uploaded.";
			// if everything is ok, try to upload file
			} else {
			  if (move_uploaded_file($file["tmp_name"], $target_file)) {
			    echo "The file ". htmlspecialchars( basename( $file["name"])). " has been uploaded.";
			  } else {
			    echo "Sorry, there was an error uploading your file.";
			  }
			}
	}



		public function upload_image($file){
		  
		  
		  $extension = explode('.', $file['fileToUpload']['name']);
		  $new_name = date('Y-m-d H:i:s'). '.' . $extension[1];
		  // $name= basename($_FILES["fileToUpload"]["name"]);
		  $destination = FCPATH .'uploads/user_image/'; 
		  

	       if (!is_dir($destination)) {
	            mkdir($destination, 0777, true);
	        }

	        // if($image_name != ''){
         //     unlink($destination.$image_name);
         //   }
	        
		  move_uploaded_file($file['fileToUpload']['tmp_name'], $destination.$new_name);
		  return $new_name;

	}



	public function upload_image_up($file){
		  
		  
		  $extension = explode('.', $file['fileToUpload_up']['name']);
		  $new_name = date('Y-m-d H:i:s'). '.' . $extension[1];
		  // $name= basename($_FILES["fileToUpload"]["name"]);
		  $destination = FCPATH .'uploads/user_image/'; 
		  

	       if (!is_dir($destination)) {
	            mkdir($destination, 0777, true);
	        }

	        // if($image_name != ''){
         //     unlink($destination.$image_name);
         //   }
	        
		  move_uploaded_file($file['fileToUpload_up']['tmp_name'], $destination.$new_name);
		  return $new_name;

	}

	/**
	 * Add new pos_clientss
	 *
	 */

	public function close_facture($facture_id)
	{
		$res = $this->db->query("UPDATE client_file set CLIENT_FILE_STATUS = 1 WHERE CLIENT_FILE_ID = $facture_id");
		if ($res) {
			redirect_back();
		}
	}

	public function open_facture($client_id)
	{
		// bad code
		$client_latest_file = $this->db->select("*")->from("client_file")->where("CLIENT_ID", $client_id)->get()->result()[0];
		// Copied code
		$this->db->select('*');
		$this->db->from('client_file');
		$this->db->order_by('CLIENT_FILE_ID', 'DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		if ($query->num_rows() > 0)  //Ensure that there is at least one result 
		{
			foreach ($query->result() as $row)  //Iterate through results
			{
				$client_file_id = $row->CLIENT_FILE_ID;
				$client_file_id_next = $client_file_id + 1;
			}
		} else {
			$client_file_id_next = 1;
		}

		$client_file_code = $client_file_id_next . "CL1" . date("m") . "" . date("Y");


		// preparation de donnees
		$client_file = array(
			'CLIENT_FILE_CODE' => $client_file_code,
			'CLIENT_ID' => $client_id,
			'CLIENT_FILE_STATUS' => 0,
			'CREATED_BY_CLIENT_FILE' => get_user_data('id'),
			'DATE_CREATION_CLIENT_FILE' => date('Y-m-d H:i:s'),
			'DISCOUNT_BOISSON' => $client_latest_file->DISCOUNT_BOISSON,
			'DISCOUNT_FOOD' => $client_latest_file->DISCOUNT_FOOD,
			'DISCOUNT_FACTURE' => $client_latest_file->DISCOUNT_FACTURE,
		);

		$this->db->insert('client_file', $client_file);
		redirect_back();
	}
	public function add()
	{
		$this->is_allowed('pos_clients_add');

		$this->template->title('Pos Clients New');
		$this->render('backend/standart/administrator/pos_clients/pos_clients_add', $this->data);
	}

	/**
	 * Add New Pos Clientss
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		
		$null = 0;
		$TVA = "";
		$AVEC_TVA = $this->input->post('AVEC_TVA');
		if (is_null($AVEC_TVA)) {
			$TVA = $null;
		} else {
			$TVA = $AVEC_TVA;
		}


		$type_client = $this->input->post('TYPE_CLIENT');


        // var_dump($PI);exit();


		// $type_discount = $this->input->post('TYPE_DISCOUNT');
		if (!$this->is_allowed('pos_clients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}
		if ($type_client != 2) {
			//$this->form_validation->set_rules('NUM_IDENTITE', 'Numero dIdentite', 'trim|required');
			$this->form_validation->set_rules('TYPE_CLIENT', 'Type de client', 'trim|required');
			//$this->form_validation->set_rules('TYPE_CLIENT_ID', 'Type d Identite', 'trim|required');
			$this->form_validation->set_rules('NOM_CLIENT', 'Nom', 'trim|required');
			//$this->form_validation->set_rules('SEXE_CLIENT', 'Sexe', 'trim|required');
			//$this->form_validation->set_rules('PRENOM', 'Prenom', 'trim|required');
		} else {
			$this->form_validation->set_rules('TYPE_CLIENT', 'Type de client', 'trim|required');
			$this->form_validation->set_rules('NOM_CLIENT', 'Nom', 'trim|required');
			//$this->form_validation->set_rules('SEXE_CLIENT', 'Sexe', 'trim|required');
			//$this->form_validation->set_rules('PRENOM', 'Prenom', 'trim|required');

		}




		if ($this->form_validation->run()) {

			$save_data = [
				'TYPE_IDENTITE' => $this->input->post('TYPE_CLIENT_ID'),
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT'),
				'PRENOM' => $this->input->post('PRENOM'),
				'SEXE' => $this->input->post('SEXE_CLIENT'),
				'NIF_CLIENT' =>$this->input->post('NIF_CLIENT'),
                'SOCIETE_CLIENT' =>$this->input->post('SOCIETE_CLIENT'),
                'DESCRIPTION_CLIENT' =>$this->input->post('DESCRIPTION_CLIENT'),
				'TYPE_CLIENT_ID' => $this->input->post('TYPE_CLIENT'),
				'AVEC_TVA' => $TVA,
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT'),
				'NUM_IDENTITE' => $this->input->post('NUM_IDENTITE'),
				'TEL_CLIENTS' => $this->input->post('TEL_CLIENTS'),
				'DATE_CREATION_CLIENT' => date('Y-m-d H:i:s'),
				'CREATED_BY_CLIENT' => get_user_data('id'),

			];

	

			 if ($_FILES['fileToUpload']['name']!='') {

		    	$image=$this->upload_image($_FILES);

		    	$save_data['DOCUMENT_FILE_IDENTITE']=$image;
				
		    }

			$save_pos_clients = $this->model_pos_clients->store($save_data);
			$client_id = $this->db->insert_id();

			//////////////////////////////


			$this->db->select('*');
			$this->db->from('client_file');
			$this->db->order_by('CLIENT_FILE_ID', 'DESC');
			$this->db->limit('1');
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$client_file_id = $row->CLIENT_FILE_ID;
					$client_file_id_next = $client_file_id + 1;
				}
			} else {
				$client_file_id_next = 1;
			}

			$client_file_code = $client_file_id_next . "CL" . $type_client . "" . date("m") . "" . date("Y");




			if ($save_pos_clients) {

				// preparation de donnees dans client__file
				if ($type_client == 2) {
					$client_file = array(
						'CLIENT_FILE_CODE' => $client_file_code,
						'CLIENT_ID' => $client_id,
						'ACCESS_CODE' => rand(1000, 9999),
						'CLIENT_FILE_STATUS' => 0,
						'CREATED_BY_CLIENT_FILE' => get_user_data('id'),
						'DATE_CREATION_CLIENT_FILE' => date('Y-m-d H:i:s'),
						'DISCOUNT_BOISSON' => 0,
						'DISCOUNT_FOOD' => 0
					);

					$this->db->insert('client_file', $client_file);
				}

				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_clients;
					$this->data['message'] = "AJOUT";
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/pos_clients/edit/' . $save_pos_clients, 'Edit Pos Clients')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_clients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_clients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Pos Clientss
	 *
	 * @var $id String
	 */

	public function history($client_id)
	{
		$this->is_allowed('pos_clients_update');
		$date_from = date("Y-m-d")." 00:00:00";
		$date_end = date("Y-m-d")." 23:59:59";
		// $$this->render('backend/standart/administrator/pos_clients/pos_clients_history', $this->data);
		$date_f = $this->input->get('date_from');
		$date_e = $this->input->get('date_end');
		$combined_raw = [];

		// ! must add date peremption to all the stores for this to work
		if (isset($date_from) && isset($date_end)) {
			$date_from = $date_f . " 00:00:00";
			$date_end = $date_e . " 23:59:59";
		}
		if (empty($date_f) and empty($data_e)) {
			$date_from = date("Y-m-d") . " 00:00:00";
			$date_end = date("Y-m-d") . " 23:59:59";
		}

		$cl = $this->db->select("*")
			->from("pos_clients")
			->where("ID_CLIENT", $client_id)
			->get()->result()[0];

		$commandes_and_prods = $this->db->query("SELECT 
		COMMANDE_STATUS, CODE, DATE_CREATION_pos_IBI_COMMANDES, u.full_name as CREATED_BY,
		REF_PRODUCT_CODEBAR, QUANTITE, PRIX, cp.NAME as PROD_NAME
		 FROM pos_ibi_commandes as c JOIN pos_ibi_commandes_produits as cp ON cp.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES
		 JOIN aauth_users u ON u.id = c.CREATED_BY_pos_IBI_COMMANDES WHERE c.CLIENT_ID_COMMANDE = $client_id 
		 AND c.DELETED_STATUS_pos_IBI_COMMANDES = 0 AND c.DATE_CREATION_pos_IBI_COMMANDES BETWEEN '$date_from'  AND '$date_end' ORDER BY c.ID_pos_IBI_COMMANDES DESC")
			->result();

		$client_data = [];
		$tots = 0;
		if (sizeof($commandes_and_prods) > 0) {

			for ($c = 0; $c < sizeof($commandes_and_prods); $c++) {
				$current_cmd = $commandes_and_prods[$c];
				$date_refined = explode(" ", $current_cmd->DATE_CREATION_pos_IBI_COMMANDES)[0];
				if (!isset($client_data[$date_refined])) {
					$client_data[$date_refined] = [];
					$client_data[$date_refined]['TOTAL'] = 0;
					$client_data[$date_refined]['CMDS'] = [];
				}

				if (!isset($client_data[$date_refined]['CMDS'][$current_cmd->CODE])) {
					$client_data[$date_refined]['CMDS'][$current_cmd->CODE] = [];
					// array_push($client_data[$date_refined], $current_cmd);
				}
				$tots += intval($current_cmd->QUANTITE) * intval($current_cmd->PRIX);
				$client_data[$date_refined]['TOTAL'] += intval($current_cmd->QUANTITE) * intval($current_cmd->PRIX);
				array_push($client_data[$date_refined]['CMDS'][$current_cmd->CODE], $current_cmd);
			}
		}

		$real_data = array_values($client_data);
		for ($r = 0; $r < sizeof($real_data); $r++) {
			$real_data[$r]['CMDS'] = array_values($real_data[$r]['CMDS']);
		}
		$this->data['date_from'] = $date_from;
		$this->data['date_end'] = $date_end;
		$this->data['client'] = $cl;
		$this->data['details'] = $real_data;
		$this->data['TOTALY'] = $tots;


		$this->data['params'] = $this->model_rm->getOne("parametrage");
		// echo json_encode($this->data['TOTALY']);
		// die;
		$this->render('backend/standart/administrator/pos_clients/pos_clients_details', $this->data);
	}
	public function edit($id)
	{
		$this->is_allowed('pos_clients_update');
		$ider = $this->uri->segment(4);
		$this->data['pos_clients'] = $this->model_pos_clients->update_client($ider);

		// var_dump($this->data['pos_clients']);exit();

		$this->template->title('Pos Clients Update');
		$this->render('backend/standart/administrator/pos_clients/pos_clients_update', $this->data);
	}

	/**
	 * Update Pos Clientss
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{

		// var_dump($_FILES);exit();


		if (!$this->is_allowed('pos_clients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}


		$type_client_up = $this->input->post('TYPE_CLIENT_UP');



		// $Discount_b = $this->input->post('DISCOUNT_B');
		// $Discount_f = $this->input->post('DISCOUNT_F');
		// $Discount_fact = $this->input->post('DISCOUNT_FACTURE');

		$TVA = null;
		$AVEC_TVA = $this->input->post('AVEC_TVA_UP');
		if (is_null($AVEC_TVA)) {
			$TVA = $AVEC_TVA;
		} else {
			$TVA = $AVEC_TVA;
		}

		if ($type_client_up == 2) {
			$this->form_validation->set_rules('NOM_CLIENT_UP', 'Nom', 'trim|required');
			// $this->form_validation->set_rules('SEXE_CLIENT_UP', 'Sexe', 'trim|required');
			// $this->form_validation->set_rules('PRENOM_UP', 'Prenom', 'trim|required');
			$this->form_validation->set_rules('TYPE_CLIENT_UP', 'Type de client', 'trim|required');
		} else {
			$this->form_validation->set_rules('NOM_CLIENT_UP', 'Nom', 'trim|required');
			// $this->form_validation->set_rules('SEXE_CLIENT_UP', 'Sexe', 'trim|required');
			// $this->form_validation->set_rules('PRENOM_UP', 'Prenom', 'trim|required');
			$this->form_validation->set_rules('TYPE_CLIENT_UP', 'Type de client', 'trim|required');
			// $this->form_validation->set_rules('NUM_IDENTITE_UP', 'Numero dIdentite', 'trim|required');
			// $this->form_validation->set_rules('TYPE_CLIENT_ID_UP', 'Type d Identite', 'trim|required');
		}


		if ($this->form_validation->run()) {

			$save_data = [
				'TYPE_IDENTITE' => $this->input->post('TYPE_CLIENT_ID_UP'),
				'NOM_CLIENT' => $this->input->post('NOM_CLIENT_UP'),
				'PRENOM' => $this->input->post('PRENOM_UP'),
				'TEL_CLIENTS' => $this->input->post('TEL_CLIENTS_UP'),
				'AVEC_TVA' => $TVA,
				'SEXE'=>$this->input->post('SEXE_CLIENT_UP'),
				'TYPE_CLIENT_ID' => $this->input->post('TYPE_CLIENT_UP'),
				'DESCRIPTION_CLIENT' =>$this->input->post('DESCRIPTION_CLIENT_UP'),
				'NUM_IDENTITE' => $this->input->post('NUM_IDENTITE_UP'),
				'ADRESSE_CLIENT' => $this->input->post('ADRESSE_CLIENT_UP')

			];

		   if ($_FILES['fileToUpload_up']['name']!='') {

		    	$image=$this->upload_image_up($_FILES);
		    	$save_data['DOCUMENT_FILE_IDENTITE']=$image;
				
		    }

			$save_pos_clients = $this->model_pos_clients->change($id, $save_data);

			if ($save_pos_clients) {



				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_clients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_clients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_clients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Pos Clientss
	 *
	 * @var $id String
	 */
	public function delete($id)
	{
		$this->is_allowed('pos_clients_delete');

		$this->load->helper('file');

		//	$id = $this->input->get('id');
		//   var_dump($id);
		$commentValue = $this->input->get('inputValue');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->db->query("UPDATE pos_clients SET DELETE_STATUS_CLIENT=1  WHERE ID_CLIENT=" . $id);
		}
		// } elseif (count($arr_id) >0) {
		// 	foreach ($arr_id as $id) {
		// 		$remove = $this->_remove($id,$commentValue);
		// 	}
		// }

		if ($remove) {
			$this->db->query("UPDATE client_file SET DELETED_STATUS_CLIENT_FILE=1 WHERE CLIENT_ID=" . $id);
			set_message(cclang('has_been_deleted', 'pos_clients'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_clients'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Pos Clientss
	 *
	 * @var $id String
	 */

	public function view($id)
	{
			$this->is_allowed('pos_clients_view');

		$this->data['pos_clients'] = $this->model_pos_clients->join_avaiable()->filter_avaiable()->find($id);

		$user_id = $this->uri->segment(4);

		$this->data['paiement_client']=$this->db->query('SELECT * FROM pos_ibi_commandes cmd  WHERE cmd.CLIENT_ID_COMMANDE = '.$user_id.'  ')->result();

	   $prod_btk_Pos = $this->db->query("
			SELECT DISTINCT(p.NAME),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=8 AND c.CLIENT_ID_COMMANDE = ".$user_id." GROUP BY p.NAME ORDER BY COUNT(*) DESC LIMIT 10")->result();


			$all_divers = "";
			foreach ($prod_btk_Pos as $value) {
				$nbre_product = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID  WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=8 AND p.NAME = '" . $value->NAME . "' AND c.CLIENT_ID_COMMANDE = '" . $user_id . "'  ")->num_rows();

				$all_divers .= " {name: '" . $value->NAME . "',y: " . number_format($nbre_product) . ",drilldown: '" . $value->NAME . "'
                },";
			}

			$prod_btk_bar = $this->db->query("
				SELECT DISTINCT(p.NAME),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=4 AND c.CLIENT_ID_COMMANDE = ".$user_id." GROUP BY p.NAME ORDER BY COUNT(*) DESC LIMIT 10")->result();

			$all_bar = '';
			foreach ($prod_btk_bar as  $value) {
				$nbre_bar = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p  INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=4 AND p.NAME = '" . $value->NAME . "' AND c.CLIENT_ID_COMMANDE = '" . $user_id . "'  ")->num_rows();

				$all_bar .= " {name: '" . $value->NAME . "',y: " . number_format($nbre_bar) . ",drilldown: '" .$value->NAME. "'
                },";
			}

			$prod_btk_kichen = $this->db->query("
				SELECT DISTINCT(p.NAME),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=2 AND c.CLIENT_ID_COMMANDE = ".$user_id." GROUP BY p.NAME ORDER BY COUNT(*) DESC LIMIT 10")->result();

			$all = '';
			foreach ($prod_btk_kichen as  $value) {
				$nbre_kichen = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p  INNER JOIN pos_ibi_commandes c ON c.ID_pos_IBI_COMMANDES = p.pos_IBI_COMMANDES_ID WHERE p.STORE_ID_pos_IBI_COMMANDES_PRODUITS=2 AND p.NAME = '" . $value->NAME . "' AND c.CLIENT_ID_COMMANDE = '" . $user_id . "'  ")->num_rows();


				$all .= " {name: '" . $value->NAME. "',y: " . number_format($nbre_kichen) . ",drilldown: '".$value->NAME. "'
                },";
			}

			$this->data['top_ten_Pos'] = $all; //cuisine
			$this->data['top_ten_bar'] = $all_bar; // bar
			$this->data['top_ten_divers'] = $all_divers; //Pos
			$this->data['situation_client']=$this->get_situation_client($id);


			$this->template->title('Pos Clients Detail');
			$this->render('backend/standart/administrator/pos_clients/pos_clients_view', $this->data);
		
	}
	/*public function view($id)
	{
			$this->is_allowed('pos_clients_view');

		$this->data['pos_clients'] = $this->model_pos_clients->join_avaiable()->filter_avaiable()->find($id);

		$user_id = $this->uri->segment(4);

		$this->data['paiement_client'] = $this->db->query("SELECT * FROM client_file file WHERE CLIENT_ID = " . $user_id . "  ")->result();


		$prod_divers = $this->db->query("SELECT DISTINCT(p.NAME),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p  INNER JOIN client_file file ON file.CLIENT_FILE_ID = p.CLIENT_FILE_ID_COMMANDES_PRODUITS  WHERE p.REF_ID_SERVICE_COMMANDE  = 4 AND file.CLIENT_ID = " . $user_id . " GROUP BY p.NAME ORDER BY COUNT(*) DESC LIMIT 10")->result();

			$all_divers = "";
			foreach ($prod_divers as $value) {
				$get_divers = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p INNER JOIN client_file file ON file.CLIENT_FILE_ID = p.CLIENT_FILE_ID_COMMANDES_PRODUITS  WHERE p.NAME = '" . $value->NAME . "' AND file.CLIENT_ID = '" . $user_id . "' AND p.REF_ID_SERVICE_COMMANDE = 4 ")->num_rows();

				$all_divers .= " {name: '" . $value->NAME . "',y: " . number_format($get_divers) . ",drilldown: '" . $value->NAME . "'
                },";
			}

			$prod_bar = $this->db->query("SELECT DISTINCT(p.REF_PRODUCT_CODEBAR),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p INNER JOIN client_file file ON file.CLIENT_FILE_ID = p.CLIENT_FILE_ID_COMMANDES_PRODUITS WHERE file.CLIENT_ID  = '" . $user_id . "' AND p.REF_ID_SERVICE_COMMANDE = 3 GROUP BY p.REF_PRODUCT_CODEBAR ORDER BY  COUNT(*) DESC LIMIT 10")->result();

			$all_bar = '';
			foreach ($prod_bar as  $value) {
				$get_cmd = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p INNER JOIN client_file file  WHERE p.REF_PRODUCT_CODEBAR = '" . $value->REF_PRODUCT_CODEBAR . "' AND file.CLIENT_ID = '" . $user_id . "'  AND p.REF_ID_SERVICE_COMMANDE  = 3 ")->num_rows();

				$produit = $this->db->query("SELECT * FROM pos_store_1_ibi_articles WHERE CODEBAR_ARTICLE = '" . $value->REF_PRODUCT_CODEBAR . "' ")->row_array();

				$all_bar .= " {name: '" . $produit['DESIGN_ARTICLE'] . "',y: " . number_format($get_cmd) . ",drilldown: '" . $produit['DESIGN_ARTICLE'] . "'
                },";
			}

			$prod_cmd = $this->db->query("SELECT DISTINCT(p.REF_PRODUCT_CODEBAR),p.pos_IBI_COMMANDES_ID, COUNT(*) FROM pos_ibi_commandes_produits p INNER JOIN client_file file ON file.CLIENT_FILE_ID = p.CLIENT_FILE_ID_COMMANDES_PRODUITS WHERE file.CLIENT_ID  = '" . $user_id . "'  AND p.REF_ID_SERVICE_COMMANDE  = 2 GROUP BY p.REF_PRODUCT_CODEBAR ORDER BY  COUNT(*) DESC LIMIT 10")->result();


			$all = '';
			foreach ($prod_cmd as  $value) {
				$get_cmd = $this->db->query("SELECT * FROM pos_ibi_commandes_produits p INNER JOIN client_file file ON file.CLIENT_FILE_ID = p.CLIENT_FILE_ID_COMMANDES_PRODUITS WHERE p.REF_PRODUCT_CODEBAR = '" . $value->REF_PRODUCT_CODEBAR . "' AND file.CLIENT_ID  = " . $user_id . " AND p.REF_ID_SERVICE_COMMANDE  = 2 ")->num_rows();

				$produit = $this->db->query("SELECT * FROM pos_store_1_ibi_articles WHERE CODEBAR_ARTICLE = '" . $value->REF_PRODUCT_CODEBAR . "' ")->row_array();

				$all .= " {name: '" . $produit['DESIGN_ARTICLE'] . "',y: " . number_format($get_cmd) . ",drilldown: '" . $produit['DESIGN_ARTICLE'] . "'
                },";
			}

			$this->data['top_ten_Pos'] = $all;
			$this->data['top_ten_bar'] = $all_bar;
			$this->data['top_ten_divers'] = $all_divers;
			$this->data['situation_client']=$this->get_situation_client($id);

			$this->template->title('Pos Clients Detail');
			$this->render('backend/standart/administrator/pos_clients/pos_clients_view', $this->data);
		
	}*/


    public function get_situation_client($id)
	{

		$du = $this->input->get('du');
		$au = $this->input->get('au');
		$type = $this->input->get('type');
		$req = '';

		// $date_from = "2021-03-05 00:00:00";
		// $date_end = "2021-03-07 23:59:59";

		$client_situation_raw = $this->db->query("SELECT
			PRIX,
			QUANTITE,
			NOM_CLIENT,
			PRENOM,
			ID_CLIENT,
			cp.DISCOUNT_PERCENT,
			 cp.ID_pos_IBI_COMMANDES_PRODUITS,
			MONTANT_PAIEMENT,
			TYPE_FACTURE,
			DESIGNATION_PAIEMENT_MODE,
			 ID_PAIEMENT,
			u.full_name AS RECU_PAR,
			DATE_CREATION_PAIEMENT
		FROM
			pos_ibi_commandes c
		JOIN pos_ibi_commandes_produits cp ON
			cp.pos_IBI_COMMANDES_ID = c.ID_pos_IBI_COMMANDES
		LEFT JOIN pos_clients cl ON
			cl.ID_CLIENT = c.CLIENT_ID_COMMANDE
		LEFT JOIN pos_paiements rp ON
			rp.CLIENT_ID_PAIEMENT = c.CLIENT_ID_COMMANDE
		LEFT JOIN aauth_users u ON
			u.id = rp.CREATED_BY_PAIEMENT
		LEFT JOIN mode_paiement mp ON
			mp.ID_MODE_PAIEMENT = rp.MODE_PAIEMENT
		WHERE
			c.DELETED_STATUS_pos_IBI_COMMANDES = 0
		AND c.CLIENT_ID_COMMANDE=".$id."
			
		ORDER BY rp.DATE_CREATION_PAIEMENT DESC
		")->result();

		// echo "<pre>"; print_r($client_situation_raw);
		// die;


		$client_situation_refined = [];
		$du_array = [];


		for ($b = 0; $b < sizeof($client_situation_raw); $b++) {
			$current = $client_situation_raw[$b];
			if (!isset($client_situation_refined[$current->ID_CLIENT])) {
				$du_array[$current->ID_CLIENT] = [];

				$client_situation_refined[$current->ID_CLIENT] = array(
					"ID" => $current->ID_CLIENT,
					"PAYMENTS" => [],
					"NOM_CLIENT" => $current->NOM_CLIENT . " " . $current->PRENOM,
					"MONTANT_DU" => 0, "MONTANT_PAID" => 0,
					"HISTORY" => []
				);
			}

			if (!in_array($current->ID_PAIEMENT, $client_situation_refined[$current->ID_CLIENT]["PAYMENTS"])) {
				array_push($client_situation_refined[$current->ID_CLIENT]["PAYMENTS"], $current->ID_PAIEMENT);

				if (!empty($current->MONTANT_PAIEMENT)) {
					array_push(
						$client_situation_refined[$current->ID_CLIENT]['HISTORY'],
						array(
							"DATE" => $current->DATE_CREATION_PAIEMENT,
							"METHODE" => $current->DESIGNATION_PAIEMENT_MODE,
							"AMOUNT" => $current->MONTANT_PAIEMENT, "RECU_PAR" => $current->RECU_PAR
						)
					);
					$client_situation_refined[$current->ID_CLIENT]['MONTANT_PAID'] += $current->MONTANT_PAIEMENT;
				}
			}

			if (!isset($du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS])) {
				$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS] = [];
				$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL'] = [];
				array_push(
					$du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL'],
					((intval($current->PRIX) * intval($current->QUANTITE)) - ((intval($current->PRIX) * intval($current->QUANTITE)) * intval($current->DISCOUNT_PERCENT) / 100))
				);
				$client_situation_refined[$current->ID_CLIENT]['MONTANT_DU'] += array_sum($du_array[$current->ID_CLIENT][$current->ID_pos_IBI_COMMANDES_PRODUITS]['TOTAL']);
			}
	

			
		}
		// echo json_encode(array_values($client_situation_refined));
		// die;
		 $array[0]=[];
		 $array[0]['HISTORY']=[];
		 $array[0]['MONTANT_DU']=0;
		 $array[0]['MONTANT_PAID']=0;
		 return count(array_values($client_situation_refined)) > 0 ? array_values($client_situation_refined) : $array ;

	}
 
 

	/**
	 * delete Pos Clientss
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$pos_clients = $this->model_pos_clients->find($id);



		$delete_save = array(
			'DELETE_STATUS_CLIENT' => 1,
			'DELETE_BY_CLIENT' => get_user_data('id'),
			'DELETE_COMMENT_CLIENT' => $commentValue
		);
		$data = array(
			'DELETED_STATUS_CLIENT_FILE' => 1
		);
		$this->db->update("client_file", $data, array("CLIENT_ID" => $id));
		$remove = $this->db->update("pos_clients", $delete_save, array("ID_CLIENT" => $id));
		return $remove;
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_clients_export');

		$this->model_pos_clients->export('pos_clients', 'pos_clients');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_clients_export');

		$this->model_pos_clients->pdf('pos_clients', 'pos_clients');
	}


	public function detail_commande_client($id)
	{
		$status 	= $this->input->get('status');
		$commandes = $this->model_pos_clients->Cient_commande($id, $status);
		//  var_dump($data);
		//  exit;

		for ($c = 0; $c < sizeof($commandes); $c++) {
			$current_c = $commandes[$c];
			$prods = $this->db->select("*")
				->from("pos_ibi_commandes_produits")
				->where("pos_IBI_COMMANDES_ID", $current_c->ID_pos_IBI_COMMANDES)
				->get()->result();
			$current_c->PRODUCTS = $prods;
		}

		$this->data['liste_commande'] = $commandes;



		$this->render('backend/standart/administrator/pos_clients/pos_clients_detail_facture', $this->data);
	}

	public function detail_commande_paiement($commande_id)
	{
		$data['shift'] = $this->db->query('SELECT SHIFT_STATUS FROM `cashier_shifts` WHERE SHIFT_STATUS=0');
		
		$data['status'] = $this->model_pos_clients->Commande_status($commande_id);
		$data['liste_paiement'] = $this->model_pos_clients->Commande_paiement($commande_id);
		$data['restant'] = $this->model_pos_clients->Commande_paiement_count_montant($commande_id);
		$data['total'] = $this->model_pos_clients->Commande_paiement_count_montant_total($commande_id);
		$data['total_res'] = $this->model_pos_clients->Commande_paiement_count_montant_total_res($commande_id);
		// echo "<pre>";
		// print_r($data['total_res']);exit();


		$this->render('backend/standart/administrator/pos_clients/pos_facture_detail_paiement', $data);
	}

	public function detail_commande_produit()
	{
		# code...
		$id = $this->input->post('commande_id');

		$data = $this->model_pos_clients->get_commande_produits($id);

		echo json_encode($data);
	}





	public function get_client()
	{

		$id = $this->input->post('id');
		$get_client = $this->db->query("SELECT * FROM pos_clients WHERE ID_CLIENT ='" . $id . "' ")->row_array();


		echo json_encode($get_client);
	}
}


/* End of file pos_clients.php */
/* Location: ./application/controllers/administrator/Pos Clients.php */