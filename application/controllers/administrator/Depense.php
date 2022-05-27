<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Depense Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Depense site
*|
*/
class Depense extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_depense');
		$this->load->model('model_registers');
		$this->load->model('model_dashboard');
	}

	/**
	* show all Pos Ibi Depenses
	*
	* @var $offset String
	*/
	public function index($store = 0, $offset = 0)
	{
		$this->is_allowed('depense_list');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['depenses'] = $this->model_depense->get($filter, $field, $this->limit_page, $offset);
		$this->data['depense_counts'] = $this->model_depense->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/depense/index/'.$store.'/',
			'total_rows'   => $this->model_depense->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste de depense');
		$this->render('backend/standart/administrator/depense/depense_list', $this->data);
	}
	
	/**
	* Add new depenses
	*
	*/
	public function add($store = 0)
	{
		$this->is_allowed('depense_add');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

        $data = $this->model_registers->getList('acct_compte_comptable');
        $this->data['getComptes'] = $data;
		$this->template->title('Nouveau depense');
		$this->render('backend/standart/administrator/depense/depense_add', $this->data);
	}

	/**
	* Add New Pos Ibi Depenses
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		if (!$this->is_allowed('depense_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('ACQUIT_DEPENSE', 'Aquit', 'trim|required');
		$this->form_validation->set_rules('DESCRIPTION_DEPENSE', 'Raison', 'trim|required');
		$this->form_validation->set_rules('FOURNITURE_DEPENSE[]', 'Fourniture', 'trim|required');
		$this->form_validation->set_rules('MONTANT_DEPENSE[]', 'Montant', 'trim|required|callback_valid_number|is_natural_no_zero');
		$this->form_validation->set_rules('COMPTE_DEPENSE[]', 'Compte depense', 'trim|required');
		

		if ($this->form_validation->run()) {

			$compte = $this->input->post('COMPTE_DEPENSE');
			$montant = $this->input->post('MONTANT_DEPENSE');
			$random = $this->model_depense->shuffle_code_depense();

			for ($i=0; $i < count($compte); $i++) { 
				$save_data = [
					'COMPTE_DEPENSE' => $this->input->post('COMPTE_DEPENSE')[$i],
					'NUMERO_DEPENSE' => $random,
					'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE'),
					'FOURNITURE_DEPENSE' => $this->input->post('FOURNITURE_DEPENSE')[$i],
					'MONTANT_DEPENSE' => $this->input->post('MONTANT_DEPENSE')[$i],
					'DATE_CREATION_DEPENSE' => date('Y-m-d H:i:s'),
					'ACQUIT_DEPENSE' => $this->input->post('ACQUIT_DEPENSE'),
					'AUTHOR_DEPENSE' => get_user_data('id'),			
				];
				$save_depense = $this->model_depense->store($save_data);
			}
			// print_r($save_data);die();

			if ($save_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_depense;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/depense/edit/'.$store.'/' . $save_depense, 'Edit Depense'),
						anchor('administrator/depense/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/depense/edit/'.$store.'/' . $save_depense, 'Edit Depense')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Depenses
	*
	* @var $id String
	*/
	public function edit($store = 0,$id)
	{
		$this->is_allowed('depense_update');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		// $this->data['depense'] = $this->model_depense->find($id);
        $this->db->where('NUMERO_DEPENSE = '.$id.'');
		$this->data['depenses'] = $this->db->get('pos_ibi_depense')->result();

		$data = $this->model_registers->getList('acct_compte_comptable');
        $this->data['getComptes'] = $data;

		$this->template->title('Modifier depense');
		$this->render('backend/standart/administrator/depense/depense_update', $this->data);
	}

	/**
	* Update Pos Ibi Depenses
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('depense_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		$this->form_validation->set_rules('ACQUIT_DEPENSE', 'Aquit', 'trim|required');
		$this->form_validation->set_rules('DESCRIPTION_DEPENSE', 'Raison', 'trim|required');
		$this->form_validation->set_rules('FOURNITURE_DEPENSE[]', 'Fourniture', 'trim|required');
		$this->form_validation->set_rules('MONTANT_DEPENSE[]', 'Montant', 'trim|required|callback_valid_number|is_natural_no_zero');
		$this->form_validation->set_rules('COMPTE_DEPENSE[]', 'Compte depense', 'trim|required');
		
		if ($this->form_validation->run()) {

			$compte = $this->input->post('COMPTE_DEPENSE');
			$montant = $this->input->post('MONTANT_DEPENSE');
			$fourniture = $this->input->post('FOURNITURE_DEPENSE');

			for($i = 0; $i < count($compte); $i++) {
				$compte_count = $this->model_dashboard->countrows('pos_ibi_depense',array('COMPTE_DEPENSE'=>$compte[$i],'NUMERO_DEPENSE'=>$id));

				if($compte_count < 1) {
					$save_data = [
						'COMPTE_DEPENSE' => $compte[$i],
						'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE'),
						'FOURNITURE_DEPENSE' => $fourniture[$i],
						'NUMERO_DEPENSE' => $id,
						'MONTANT_DEPENSE' => $montant[$i],
						'DATE_CREATION_DEPENSE' => date('Y-m-d H:i:s'),
						'ACQUIT_DEPENSE' => $this->input->post('ACQUIT_DEPENSE'),
						'AUTHOR_DEPENSE' => get_user_data('id'),			
					];

					$save_depense = $this->model_depense->store($save_data);
				} else {
					$criteres['NUMERO_DEPENSE'] = $id;
					$criteres['COMPTE_DEPENSE'] = $compte[$i];
					$save_data = [
						'COMPTE_DEPENSE' => $compte[$i],
						'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE'),
						'FOURNITURE_DEPENSE' => $fourniture[$i],
						'MONTANT_DEPENSE' => $montant[$i],
						'DATE_MOD_DEPENSE' => date('Y-m-d H:i:s'),
						'ACQUIT_DEPENSE' => $this->input->post('ACQUIT_DEPENSE'),
						'AUTHOR_MOD_DEPENSE' => get_user_data('id'),			
					];

					$save_depense = $this->model_dashboard->update('pos_ibi_depense', $criteres, $save_data);
				}
			}

			if ($save_depense) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/depense/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Depenses
	*
	* @var $id String
	*/
	public function delete($store, $id = null)
	{
		$this->is_allowed('depense_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('depense_id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
			$remove_file = $this->model_registers->delete('pos_ibi_depense_file', array('REF_DEPENSE_FILE' => $id));
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
				$remove_file = $this->model_registers->delete('pos_ibi_depense_file', array('REF_DEPENSE_FILE' => $id));
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'depense'), 'success');
        } else {
            set_message(cclang('error_delete', 'depense'), 'error');
        }

		redirect_back();
	}

		public function delete_depense($store, $num_depense)
	{
		$depense_id = $this->input->post('depense_id');

		$criteres['ID_DEPENSE'] = $depense_id;

		$delete_cart = $this->model_dashboard->delete('pos_ibi_depense',$criteres);
		
		if ($delete_cart) {
			$this->data['message'] = 'success';
			$this->data['redirect'] = base_url('administrator/depense/edit/'.$store.'/'.$num_depense);
		}
		echo json_encode($this->data);

	}

		/**
	* View view Pos Ibi Depenses
	*
	* @var $id String
	*/
	public function view($store = 0,$id)
	{
		$this->is_allowed('depense_view');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $query = $this->db->query('SELECT * FROM `pos_ibi_depense_file` where REF_DEPENSE_FILE='.$id);
	    $file = $query->result();
        $this->data['depense_file'] = $file;
        $query = $this->db->get_where('pos_ibi_depense', array('NUMERO_DEPENSE' => $id))->row();
		// $this->data['depense'] = $this->model_depense->join_avaiable()->filter_avaiable()->find($id);
		$this->data['depense'] = $query;
        
		$this->template->title('Detail depense');
		$this->render('backend/standart/administrator/depense/depense_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Depenses
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		// $depense = $this->model_depense->find($id);

		return $this->model_dashboard->delete('pos_ibi_depense', array('NUMERO_DEPENSE'=>$id));
		
		// return $this->model_depense->remove($id);
	}
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('depense_export');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

        $date_depart1 = $this->input->get('date_depart');
        $date_fin1 = $this->input->get('date_fin');
        $date_depart = $date_depart1.' 00:00:00';
        $date_fin = $date_fin1.' 23:59:59';

		$this->data['depense'] = $this->model_depense->getListFilter($store,$date_depart,$date_fin);
		$this->data['depense_counts'] = $this->model_depense->getListFilter_count($store,$date_depart,$date_fin);
		$this->data['date_depart'] = $date_depart1;
        $this->data['date_fin'] = $date_fin1;
		$this->render('backend/standart/administrator/depense/depense_export', $this->data);

	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('depense_export');

		$this->model_depense->pdf('depense', 'depense');
	}

	public function add_file($store)
	{

		if (!$this->is_allowed('depense_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		} 
		$this->form_validation->set_rules('NAME_FILE', 'Nom fichier', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FILE', 'Numero fichier', 'trim|required');
		$this->form_validation->set_rules('REF_DEPENSE_FILE', 'depense', 'trim|required');
		$this->form_validation->set_rules('depense_file_PATH_FILE_name', 'Fichier', 'trim|required');
		if ($this->form_validation->run()) {

			$depense_file_PATH_FILE_uuid = $this->input->post('depense_file_PATH_FILE_uuid');
			$depense_file_PATH_FILE_name = $this->input->post('depense_file_PATH_FILE_name');
		
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
				'REF_DEPENSE_FILE' => $this->input->post('REF_DEPENSE_FILE'),
				'DATE_CREATION_FILE' => date('Y-m-d H:i:s'),
				'AUTHOR_FILE' => get_user_data('id'),
			];
   
			if (!is_dir(FCPATH . '/uploads/depense_file/')) {
				mkdir(FCPATH . '/uploads/depense_file/');
			}

			if (!empty($depense_file_PATH_FILE_name)) {
				$depense_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $depense_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $depense_file_PATH_FILE_uuid . '/' . $depense_file_PATH_FILE_name, 
						FCPATH . 'uploads/depense_file/' . $depense_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/depense_file/' . $depense_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

			$save_data['PATH_FILE'] = $depense_file_PATH_FILE_name_copy;

			}
		    
			$update = $this->model_registers->update('pos_ibi_depense', array('NUMERO_DEPENSE'=>$this->input->post('REF_DEPENSE_FILE')), array('STATUT_DEPENSE'=>1));
	
			$save_depense_file = $this->model_registers->insert('pos_ibi_depense_file',$save_data); 
	
			if ($save_depense_file) {
				 
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/depense/edit_file/'.$store.'/' . $save_depense_file, 'Edit Pos Ibi depense File')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				
			} 
			else {

            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/depense/index/'.$store.'');
				
			}

		} 
		else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}


		echo json_encode($this->data);
	}
	public function edit_file($store,$id)
	{

		if (!$this->is_allowed('depense_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		} 
		$this->form_validation->set_rules('NAME_FILE', 'Nom fichier', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FILE', 'Numero fichier', 'trim|required');
		$this->form_validation->set_rules('REF_DEPENSE_FILE', 'depense', 'trim|required');
		$this->form_validation->set_rules('depense_file_PATH_FILE_name', 'Fichier', 'trim|required');
		if ($this->form_validation->run()) {

			$depense_file_PATH_FILE_uuid = $this->input->post('depense_file_PATH_FILE_uuid');
			$depense_file_PATH_FILE_name = $this->input->post('depense_file_PATH_FILE_name');
		    $ID_FILE = $this->input->post('REF_DEPENSE_FILE');
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
				// 'REF_DEPENSE_FILE' => $this->input->post('REF_DEPENSE_FILE'),
				// 'DATE_CREATION_FILE' => date('Y-m-d H:i:s'),
				// 'AUTHOR_FILE' => get_user_data('id'),
			];
   
			if (!is_dir(FCPATH . '/uploads/depense_file/')) {
				mkdir(FCPATH . '/uploads/depense_file/');
			}

			if (!empty($depense_file_PATH_FILE_name)) {
				$depense_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $depense_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $depense_file_PATH_FILE_uuid . '/' . $depense_file_PATH_FILE_name, 
						FCPATH . 'uploads/depense_file/' . $depense_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/depense_file/' . $depense_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

			$save_data['PATH_FILE'] = $depense_file_PATH_FILE_name_copy;

			}
		
			$save_depense_file = $this->model_registers->update('pos_ibi_depense_file',array('ID_FILE'=>$ID_FILE), $save_data);
			
			if ($save_depense_file) {
				 
					set_message(
						cclang('success_save_data_redirect', [
					
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/depense/view/'.$store.'/'.$id);
				
			} 
			else {

            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/depense/view/'.$store.'/'.$id);
				
			}

		} 
		else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}


		echo json_encode($this->data);
	}
	public function delete_files($store,$id = null){

		$this->is_allowed('depense_file_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove_file($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove_file($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'depense file'), 'success');
        } else {
            set_message(cclang('error_delete', 'depense file'), 'error');
        }

		redirect_back();
	}
	private function _remove_file($id)
	{
		$depense_file = $this->model_registers->getOne('pos_ibi_depense_file',array('ID_FILE'=>$id));

		if (!empty($articles['PATH_FILE'])) {
			$path = FCPATH . '/uploads/depense_file/' . $depense_file['PATH_FILE'];

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		return $this->model_registers->delete('pos_ibi_depense_file',array('ID_FILE'=>$id));
	
	}
	public function upload_PATH_FILE_file()
	{
		if (!$this->is_allowed('depense_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'pos_ibi_depense_file',
		]);
	}
    public function delete_PATH_FILE_file($uuid)
	{
		if (!$this->is_allowed('depense_file_delete', false)) {
			echo json_encode([
				'success' => false,
				'error' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		echo $this->delete_file([
            'uuid'              => $uuid, 
            'delete_by'         => $this->input->get('by'), 
            'field_name'        => 'PATH_FILE', 
            'upload_path_tmp'   => './uploads/tmp/',
            'table_name'        => 'pos_ibi_depense_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/depense_file/'
        ]);
	}

    public function get_PATH_FILE_file($id)
	{
		if (!$this->is_allowed('depense_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => 'Image not loaded, you do not have permission to access'
				]);
			exit;
		}

		echo $this->get_file([
            'uuid'              => $id, 
            'delete_by'         => 'id', 
            'field_name'        => 'PATH_FILE', 
            'table_name'        => 'pos_ibi_depense_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/depense_file/',
            'delete_endpoint'   => 'administrator/depense/delete_PATH_FILE_file'
        ]);
	}
}


/* End of file depense.php */
/* Location: ./application/controllers/administrator/Pos Ibi Depense.php */