<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Ibi Menu Du Jous Controller
*| --------------------------------------------------------------------------
*| Pos Ibi Menu Du Jous site
*|
*/
class pos_ibi_menu_du_jous extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_menu_du_jous');
	}

	/**
	* show all Pos Ibi Menu Du Jouss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_menu_du_jous_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$status 	= $this->input->get('statut');

		$this->data['pos_ibi_menu_du_jouss'] = $this->model_pos_ibi_menu_du_jous->get($status,$filter, $field, $this->limit_page, $offset);
		$this->data['pos_ibi_menu_du_jous_counts'] = $this->model_pos_ibi_menu_du_jous->count_all($status,$filter, $field);

		$config = [
			'base_url'     => 'administrator/pos_ibi_menu_du_jous/index/',
			'total_rows'   => $this->model_pos_ibi_menu_du_jous->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Menu Du Jours List');
		$this->render('backend/standart/administrator/pos_ibi_menu_du_jous/pos_ibi_menu_du_jous_list', $this->data);
	}
	
	/**
	* Add new pos_ibi_menu_du_jouss
	*
	*/
	public function add()
	{
		$this->is_allowed('pos_ibi_menu_du_jous_add');

		$this->template->title('Menu Du Jours New');
		$this->data['stores']=$this->db->get_where('pos_ibi_stores',array('ID_STORE'=>$this->uri->segment(2)))->result_array();
		$this->render('backend/standart/administrator/pos_ibi_menu_du_jous/pos_ibi_menu_du_jous_add', $this->data);
	}

	/**
	* Add New Pos Ibi Menu Du Jouss
	*
	* @return JSON
	*/
	public function add_save($uri)
	{
		if (!$this->is_allowed('pos_ibi_menu_du_jous_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('DESIGNATION_MENU', 'Designation', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION_MENU' => $this->input->post('DESIGNATION_MENU'),
				'DATE_CREATION_MENU' => date('Y-m-d H:i:s'),
				'CREATED_BY_MENU' => get_user_data('id'),			];

			
			$save_pos_ibi_menu_du_jous = $this->model_pos_ibi_menu_du_jous->store($save_data);
			$insertId = $this->db->insert_id();

			if ($save_pos_ibi_menu_du_jous) {

                    for ($count=0; $count < count($_POST['QUANTITY_INGREDIENT']); $count++) { 
						      $data_detail = [
										'MOM_ARTICLE_MENU_DETAIL' => $_POST['NOM_INGREDIENT'][$count],
										'QUANTITE_ARTICLE_MENU_DETAIL' => $_POST['QUANTITY_INGREDIENT'][$count],
										'MENU_ID' => $insertId,
										'ARTICLE_ID' => $_POST['ARTICLE_ID_MENU'][$count],
										'CODE_BAR_ARTICLE' => $_POST['CODE_BAR'][$count]
									];

                                  $ins = $this->db->insert('pos_ibi_menu_du_jous_details', $data_detail);
					}


				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_menu_du_jous;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_menu_du_jous/edit/' . $save_pos_ibi_menu_du_jous, 'Edit Pos Ibi Menu Du Jous'),
						anchor('administrator/pos_ibi_menu_du_jous', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pos_ibi_menu_du_jous/edit/' . $save_pos_ibi_menu_du_jous, 'Edit Pos Ibi Menu Du Jous')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('menu_du_jours/'.$uri.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('menu_du_jours/'.$uri.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function update_menu()
	{
		$id=$this->input->post('id_menu');
		$uri = $this->input->post('store');
		$update_status = $this->db->query("UPDATE pos_ibi_menu_du_jous SET STATUT_MENU=1 WHERE ID_MENU=".$id);
        if ($update_status) {
			echo json_encode([
				'success' => true,
				'message' =>set_message('Vous venais desactivez ce menu', 'success'),
				'redirect' => base_url('menu_du_jours/'.$uri.'/index'),
				]);
		}
		
	}

	public function active_menu()
	{
		$id=$this->input->post('id_menu');
		$uri = $this->input->post('store');
		$update_status = $this->db->query("UPDATE pos_ibi_menu_du_jous SET STATUT_MENU=0 WHERE ID_MENU=".$id);
        if ($update_status) {
			echo json_encode([
				'success' => true,
				'message' =>set_message('Vous venais activez ce menu', 'success'),
				'redirect' => base_url('menu_du_jours/'.$uri.'/index'),
				]);
		}
		
	}
	
		/**
	* Update view Pos Ibi Menu Du Jouss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_menu_du_jous_update');

		$this->data['pos_ibi_menu_du_jous'] = $this->model_pos_ibi_menu_du_jous->find($id);

		$this->template->title('Menu Du Jours Update');
		$this->render('backend/standart/administrator/pos_ibi_menu_du_jous/pos_ibi_menu_du_jous_update', $this->data);
	}

	/**
	* Update Pos Ibi Menu Du Jouss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_menu_du_jous_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('DESIGNATION_MENU', 'Designation', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'DESIGNATION_MENU' => $this->input->post('DESIGNATION_MENU'),
				'DATE_CREATION_MENU' => date('Y-m-d H:i:s'),
				'CREATED_BY_MENU' => get_user_data('id'),			];

			
			$save_pos_ibi_menu_du_jous = $this->model_pos_ibi_menu_du_jous->change($id, $save_data);

			if ($save_pos_ibi_menu_du_jous) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_menu_du_jous', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_menu_du_jous');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_menu_du_jous');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function get_plat($uri)
	{

        $data = $this->db->query('SELECT ID_ARTICLE AS ID,UNITE_ARTICLE AS UNITE,CODEBAR_ARTICLE AS CODEBAR,DESIGN_ARTICLE AS NOM_ART,  QUANTITY_ARTICLE AS QTE, IS_INGREDIENT AS TYPES,
		 PRIX_DACHAT_ARTICLE AS PRIX
        FROM pos_store_'.$uri .'_ibi_articles WHERE TYPE_ARTICLE=1 AND  DELETE_STATUS_ARTICLE = 0 AND STORE_ID_ARTICLE = "' . $uri . '"')->result();

        echo json_encode($data);
	}
	
	/**
	* delete Pos Ibi Menu Du Jouss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_menu_du_jous_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove =$this->db->query("UPDATE   pos_ibi_menu_du_jous SET DELETE_STATUS_MENU=1 WHERE ID_MENU=".$id);

		if ($remove) {
			$this->db->query("DELETE FROM pos_ibi_menu_du_jous_details WHERE MENU_ID=".$id);
            set_message(cclang('has_been_deleted', 'pos_ibi_menu_du_jous'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_ibi_menu_du_jous'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Ibi Menu Du Jouss
	*
	* @var $id String
	*/
	public function view()
	{
		$this->is_allowed('pos_ibi_menu_du_jous_view');
		$id = $this->uri->segment(4);
		$store = $this->uri->segment(2);

		$this->data['pos_ibi_menu_du_jous'] = $this->model_pos_ibi_menu_du_jous->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Menu Du Jours Detail');
		$this->render('backend/standart/administrator/pos_ibi_menu_du_jous/pos_ibi_menu_du_jous_view', $this->data);
	}
	
	/**
	* delete Pos Ibi Menu Du Jouss
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_ibi_menu_du_jous = $this->model_pos_ibi_menu_du_jous->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_ibi_menu_du_jous",$delete_save,array("ID_MENU"=>$id));
		return $remove;
	}
	
	public function update_plats_menu($id)
	{
		$ins=false;
		$uri = $this->input->post('uri');

               for ($count=0; $count < count($_POST['QUANTITY_INGREDIENT']); $count++) { 
				   	$produits = $this->db->get_where('pos_ibi_menu_du_jous_details',array('ARTICLE_ID'=>$_POST['ARTICLE_ID_MENU'][$count],'MENU_ID'=>$id));

                    if ($produits->num_rows() >0) {
					$check = $produits->row()->ARTICLE_ID;
                    
                     if ($check==$_POST['ARTICLE_ID_MENU'][$count]) {
		                  $this->db->query('UPDATE pos_ibi_menu_du_jous_details SET QUANTITE_ARTICLE_MENU_DETAIL="'.$_POST['QUANTITY_INGREDIENT'][$count].'" WHERE ARTICLE_ID='.$check);
					$ins =true;
					} else{
						 $data_detail = [
							'MOM_ARTICLE_MENU_DETAIL' => $_POST['NOM_INGREDIENT'][$count],
							'QUANTITE_ARTICLE_MENU_DETAIL' => $_POST['QUANTITY_INGREDIENT'][$count],
							'MENU_ID' => $id,
							'ARTICLE_ID' => $_POST['ARTICLE_ID_MENU'][$count],
							'CODE_BAR_ARTICLE' => $_POST['CODE_BAR'][$count]
						];
                      $ins = $this->db->insert('pos_ibi_menu_du_jous_details', $data_detail);
					}

         		}
				 else{
					    
                         $data_detail = [
							'MOM_ARTICLE_MENU_DETAIL' => $_POST['NOM_INGREDIENT'][$count],
							'QUANTITE_ARTICLE_MENU_DETAIL' => $_POST['QUANTITY_INGREDIENT'][$count],
							'MENU_ID' => $id,
							'ARTICLE_ID' => $_POST['ARTICLE_ID_MENU'][$count],
							'CODE_BAR_ARTICLE' => $_POST['CODE_BAR'][$count]
						];
                      $ins = $this->db->insert('pos_ibi_menu_du_jous_details', $data_detail);
					 
					
			        
		}
		

	}
	  
	
				if ($ins) {
					echo json_encode([
						'success' => true,
						'message' =>set_message('Vous venais desactivez ce menu', 'success'),
						'redirect' => base_url('menu_du_jours/'.$uri.'/view/'.$id),
						]);
		           }
	}

	public function delete_menu_plat()
	{
		# code...
		$id_menu = $this->input->post('id_menu');
		$store = $this->input->post('store');
	    $article = $this->input->post('article');

		$requete = $this->db->query('DELETE FROM pos_ibi_menu_du_jous_details WHERE MENU_ID='.$id_menu.' AND ARTICLE_ID='.$article);

		if ($requete) {
			echo json_encode([
				'success' => true,
				'message' =>set_message('Vous venais de retirer le plat a  ce menu', 'success'),
				'redirect' => base_url('menu_du_jours/'.$store.'/view/'.$id_menu),
			]);
		}

	}
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_ibi_menu_du_jous_export');
		$this->model_pos_ibi_menu_du_jous->export('pos_ibi_menu_du_jous', 'pos_ibi_menu_du_jous');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_menu_du_jous_export');
		$this->model_pos_ibi_menu_du_jous->pdf('pos_ibi_menu_du_jous', 'pos_ibi_menu_du_jous');
	}
}


/* End of file pos_ibi_menu_du_jous.php */
/* Location: ./application/controllers/administrator/Pos Ibi Menu Du Jous.php */