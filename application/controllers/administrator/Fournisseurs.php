<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Fournisseurs Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Fournisseurs site
*|
*/
class Fournisseurs extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_fournisseurs');
		$this->load->model('model_registers');
	}
	// jjhs

	/**
	* show all Pos Ibi Fournisseurss
	*
	* @var $offset String
	*/
	public function index($store = 0, $offset = 0)
	{
		$this->is_allowed('fournisseurs_list');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['fournisseurss'] = $this->model_fournisseurs->get($filter, $field, $this->limit_page, $offset);
		$this->data['fournisseurs_counts'] = $this->model_fournisseurs->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/fournisseurs/index/'.$store.'/',
			'total_rows'   => $this->model_fournisseurs->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste des fournisseurs');
		$this->render('backend/standart/administrator/fournisseurs/fournisseurs_list', $this->data);
	}
	/**
	* Add new fournisseurss
	*
	*/
	public function add($store = 0)
	{
		$this->is_allowed('fournisseurs_add');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }

		$this->template->title('Nouveau fournisseur');
		$this->render('backend/standart/administrator/fournisseurs/fournisseurs_add', $this->data);
	}

	/**
	* Add New Pos Ibi Fournisseurss
	*
	* @return JSON
	*/
	public function add_save($store)
	{
		if (!$this->is_allowed('fournisseurs_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('NOM', 'Nom fournisseur', 'trim|required');
		$this->form_validation->set_rules('NUMBER_COMPTE', 'Numero compte', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM' => $this->input->post('NOM'),
				'BP' => $this->input->post('BP'),
				'NUMBER_COMPTE' => $this->input->post('NUMBER_COMPTE'),
				'TEL' => $this->input->post('TEL'),
				'EMAIL' => $this->input->post('EMAIL'),
				'DATE_CREATION' => date('Y-m-d H:i:s'),
				'AUTHOR' => get_user_data('id'),				
				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
			];

			
			$save_fournisseurs = $this->model_fournisseurs->store($save_data);

			if ($save_fournisseurs) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_fournisseurs;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/fournisseurs/edit/'.$store.'/' . $save_fournisseurs, 'Edit Fournisseurs'),
						anchor('administrator/fournisseurs/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/fournisseurs/edit/'.$store.'/' . $save_fournisseurs, 'Edit Fournisseurs')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Ibi Fournisseurss
	*
	* @var $id String
	*/
	public function edit($store = 0, $id)
	{
		$this->is_allowed('fournisseurs_update');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
		$this->data['fournisseurs'] = $this->model_fournisseurs->find($id);

		$this->template->title('Modifier fournisseur');
		$this->render('backend/standart/administrator/fournisseurs/fournisseurs_update', $this->data);
	}

	/**
	* Update Pos Ibi Fournisseurss
	*
	* @var $id String
	*/
	public function edit_save($store,$id)
	{
		if (!$this->is_allowed('fournisseurs_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NOM', 'Nom fournisseur', 'trim|required');
		$this->form_validation->set_rules('NUMBER_COMPTE', 'Numero compte', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'NOM' => $this->input->post('NOM'),
				'BP' => $this->input->post('BP'),
				'NUMBER_COMPTE' => $this->input->post('NUMBER_COMPTE'),
				'TEL' => $this->input->post('TEL'),
				'EMAIL' => $this->input->post('EMAIL'),
				'DATE_MOD' => date('Y-m-d H:i:s'),
				'DESCRIPTION' => $this->input->post('DESCRIPTION'),
			];

			
			$save_fournisseurs = $this->model_fournisseurs->change($id, $save_data);

			if ($save_fournisseurs) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/fournisseurs/index/'.$store.'', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Ibi Fournisseurss
	*
	* @var $id String
	*/
	public function delete($store,$id = null)
	{
		$this->is_allowed('fournisseurs_delete');

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
            set_message(cclang('has_been_deleted', 'fournisseurs'), 'success');
        } else {
            set_message(cclang('error_delete', 'fournisseurs'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Fournisseurss
	*
	* @var $id String
	*/
	
	public function view($store = 0, $id_fournisseur)
	{
		$this->is_allowed('fournisseurs_view');

		if($store == 0){

	        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
				redirect('administrator/store');
	             
	        }
	   $query = $this->db->query('SELECT ID_FILE, NAME_FILE,NUMERO_FILE,REF_FOURNISSEUR_FILE,PATH_FILE,NOM,AUTHOR_FILE,DATE_CREATION_FILE  FROM pos_ibi_fournisseurs_file, pos_ibi_fournisseurs WHERE pos_ibi_fournisseurs_file.REF_FOURNISSEUR_FILE=pos_ibi_fournisseurs.ID AND REF_FOURNISSEUR_FILE='.$id_fournisseur);
	    $INFORMATION_FOURNISSEUR_FILE = $query->result();

	    $stock_flow = $this->db->query('SELECT * FROM pos_store_'.$store.'_ibi_approvisionnement as ap,pos_store_'.$store.'_ibi_type_approvisionnement as tap,pos_ibi_fournisseurs as f where ap.ID_TYPE_APPROVISIONNEMENT=tap.ID_TYPE_APPROVISIONNEMENT and ap.ID_FOURNISSEUR_APPROVISIONNEMENT=f.ID and ap.ID_FOURNISSEUR_APPROVISIONNEMENT='.$id_fournisseur);
	    $approv = $stock_flow->result();

        $this->data['approvisionnement'] = $approv;
     
		$this->data['fournisseurs_files'] = $INFORMATION_FOURNISSEUR_FILE;
		$this->data['fournisseurs'] = $this->model_fournisseurs->join_avaiable()->filter_avaiable()->find($id_fournisseur);

		$this->template->title('Fournisseurs Detail');
		$this->render('backend/standart/administrator/fournisseurs/fournisseurs_view', $this->data);
	}
	public function delete_files($store,$id = null){

		$this->is_allowed('fournisseurs_file_delete');

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
            set_message(cclang('has_been_deleted', 'fournisseurs file'), 'success');
        } else {
            set_message(cclang('error_delete', 'fournisseurs file'), 'error');
        }

		redirect_back();
	}
	
	/**
	* delete Pos Ibi Fournisseurss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$fournisseurs = $this->model_fournisseurs->find($id);

		return $this->model_fournisseurs->remove($id);
	}
	private function _remove_file($id)
	{
		$fournisseur_file = $this->model_registers->getOne('pos_ibi_fournisseurs_file',array('ID_FILE'=>$id));

		if (!empty($fournisseur_file['PATH_FILE'])) {
			$path = FCPATH . '/uploads/fournisseurs_file/' . $fournisseur_file['PATH_FILE'];

			if (is_file($path)) {
				$delete_file = unlink($path);
			}
		}

		return $this->model_registers->delete('pos_ibi_fournisseurs_file',array('ID_FILE'=>$id));
	
	}

	public function add_file($store)
	{

		if (!$this->is_allowed('fournisseurs_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		} 
		$this->form_validation->set_rules('NAME_FILE', 'Nom fichier', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FILE', 'Numero fichier', 'trim|required');
		$this->form_validation->set_rules('REF_FOURNISSEUR_FILE', 'Client', 'trim|required');
		$this->form_validation->set_rules('fournisseurs_file_PATH_FILE_name', 'Fichier', 'trim|required');
		if ($this->form_validation->run()) {

			$fournisseurs_file_PATH_FILE_uuid = $this->input->post('fournisseurs_file_PATH_FILE_uuid');
			$fournisseurs_file_PATH_FILE_name = $this->input->post('fournisseurs_file_PATH_FILE_name');
		
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
				'REF_FOURNISSEUR_FILE' => $this->input->post('REF_FOURNISSEUR_FILE'),
				'DATE_CREATION_FILE' => date('Y-m-d H:i:s'),
				'AUTHOR_FILE' => get_user_data('id'),
			];
   
			if (!is_dir(FCPATH . '/uploads/fournisseurs_file/')) {
				mkdir(FCPATH . '/uploads/fournisseurs_file/');
			}

			if (!empty($fournisseurs_file_PATH_FILE_name)) {
				$fournisseurs_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $fournisseurs_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $fournisseurs_file_PATH_FILE_uuid . '/' . $fournisseurs_file_PATH_FILE_name, 
						FCPATH . 'uploads/fournisseurs_file/' . $fournisseurs_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/fournisseurs_file/' . $fournisseurs_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

			$save_data['PATH_FILE'] = $fournisseurs_file_PATH_FILE_name_copy;

			}
		
			
			$save_fournisseurs_file = $this->model_registers->insert('pos_ibi_fournisseurs_file',$save_data); 
	
			if ($save_fournisseurs_file) {
				 
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/fournisseurs/edit_file/'.$store.'/' . $save_fournisseurs_file, 'Edit Pos Ibi Fournisseur File')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				
			} 
			else {

            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/fournisseurs/index/'.$store.'');
				
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
		if (!$this->is_allowed('fournisseurs_file_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('NAME_FILE', 'Nom fichier', 'trim|required');
		$this->form_validation->set_rules('NUMERO_FILE', 'Numero fichier', 'trim|required');
		$this->form_validation->set_rules('REF_ID_FILE', 'Client', 'trim|required');
		$this->form_validation->set_rules('fournisseurs_file_PATH_FILE_name', 'Fichier', 'trim|required');
		
		if ($this->form_validation->run()) {
			$fournisseurs_file_PATH_FILE_uuid = $this->input->post('fournisseurs_file_PATH_FILE_uuid');
			$fournisseurs_file_PATH_FILE_name = $this->input->post('fournisseurs_file_PATH_FILE_name');
		    $ID_FILE = $this->input->post('REF_ID_FILE');
			$save_data = [
				'NAME_FILE' => $this->input->post('NAME_FILE'),
				'NUMERO_FILE' => $this->input->post('NUMERO_FILE'),
			];

			if (!is_dir(FCPATH . '/uploads/fournisseurs_file/')) {
				mkdir(FCPATH . '/uploads/fournisseurs_file/');
			}

			if (!empty($fournisseurs_file_PATH_FILE_uuid)) {
				$fournisseurs_file_PATH_FILE_name_copy = date('YmdHis') . '-' . $fournisseurs_file_PATH_FILE_name;

				rename(FCPATH . 'uploads/tmp/' . $fournisseurs_file_PATH_FILE_uuid . '/' . $fournisseurs_file_PATH_FILE_name, 
						FCPATH . 'uploads/fournisseurs_file/' . $fournisseurs_file_PATH_FILE_name_copy);

				if (!is_file(FCPATH . '/uploads/fournisseurs_file/' . $fournisseurs_file_PATH_FILE_name_copy)) {
					echo json_encode([
						'success' => false,
						'message' => 'Error uploading file'
						]);
					exit;
				}

				$save_data['PATH_FILE'] = $fournisseurs_file_PATH_FILE_name_copy;
			}
		
			$save_fournisseurs_file = $this->model_registers->update('pos_ibi_fournisseurs_file',array('ID_FILE'=>$ID_FILE), $save_data);

			if ($save_fournisseurs_file) {
				 
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/fournisseurs/view/'.$store.'/'.$id);
				
			} else {
				
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/fournisseurs/view/'.$store.'/'.$id);
				
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	public function upload_PATH_FILE_file()
	{
		if (!$this->is_allowed('fournisseurs_file_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$uuid = $this->input->post('qquuid');

		echo $this->upload_file([
			'uuid' 		 	=> $uuid,
			'table_name' 	=> 'pos_ibi_fournisseurs_file',
		]);
	}

	public function delete_PATH_FILE_file($uuid)
	{
		if (!$this->is_allowed('fournisseurs_file_delete', false)) {
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
            'table_name'        => 'pos_ibi_fournisseurs_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/fournisseurs_file/'
        ]);
	}

	public function get_PATH_FILE_file($id)
	{
		if (!$this->is_allowed('fournisseurs_file_update', false)) {
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
            'table_name'        => 'pos_ibi_fournisseurs_file',
            'primary_key'       => 'ID_FILE',
            'upload_path'       => 'uploads/fournisseurs_file/',
            'delete_endpoint'   => 'administrator/fournisseurs/delete_PATH_FILE_file'
        ]);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('fournisseurs_export');

		$this->model_fournisseurs->export('pos_ibi_fournisseurs', 'fournisseurs');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('fournisseurs_export');

		$this->model_fournisseurs->pdf('pos_ibi_fournisseurs', 'fournisseurs');

	}
	
 
}


/* End of file fournisseurs.php */
/* Location: ./application/controllers/administrator/Pos Ibi Fournisseurs.php */