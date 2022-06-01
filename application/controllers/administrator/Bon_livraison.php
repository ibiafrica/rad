<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Bon Livraison Controller
*| --------------------------------------------------------------------------
*| Bon Livraison site
*|
*/
class Bon_livraison extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_bon_livraison');
		$this->load->model('model_bon_livraison_details');
        $this->load->model('model_rm');
        $this->load->model('model_registers');

	}

	/**
	* show all Bon Livraisons
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('bon_livraison_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$this->data['bon_livraisons'] = $this->model_bon_livraison->get($filter, $field, $this->limit_page, $offset);
		$this->data['bon_livraison_counts'] = $this->model_bon_livraison->count_all($filter, $field);

		$config = [
				'base_url'     => 'administrator/bon_livraison/index/',
				'total_rows'   => $this->model_bon_livraison->count_all($filter, $field),
				'per_page'     => $this->limit_page,
				'uri_segment'  => 4,
			];
			
			$this->data['pagination'] = $this->pagination($config);
			$this->template->title('Bon Livraison List');
			// dump($this->data);


			// $this->render('backend/standart/administrator/pos_flux_caisse/pos_flux_caisse_list', $this->data);
		$this->render('backend/standart/administrator/bon_livraison/bon_livraison_list', $this->data);
	}
	
	/**
	* Add new bon_livraisons
	*
	*/
	public function add()
	{
		$this->is_allowed('bon_livraison_add');

		$this->template->title('Bon Livraison New');
		$this->render('backend/standart/administrator/bon_livraison/bon_livraison_add', $this->data);
	}

	/**
	* Add New Bon Livraisons
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('bon_livraison_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}		

		$this->form_validation->set_rules('CLIENT', 'REF CLIENT BL', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('code_bar[]', 'ARTICLE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('quantite[]', 'QUANTITE', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {

			$id_client = $this->input->post('CLIENT');

			$code_art = $this->input->post('code_bar');
			$nom_art = $this->input->post('name');
			$prix_unit = $this->input->post('prix_unit');
			$quantite = $this->input->post('quantite');
			$total = null;

			$code_bl = $this->model_bon_livraison->random_code();	
		
			$bon_livraison = [
				'CODE_BL' => $code_bl,
				'REF_CLIENT_BL' => $id_client,
				'CREATE_BY_BL' => get_user_data('id'),
				'DATE_CREATION_BL' => date('Y-m-d H:m:s')
			];
			
			$save_bon_livraison = $this->model_rm->insert_last_id('bon_livraison', $bon_livraison);
            
			// dump($save_bon_livraison); die;

			for($i=0; $i<count($code_art); $i++){

				$produit = $this->model_registers->getOne('pos_store_1_ibi_articles', array('DELETE_STATUS_ARTICLE'=> 0, 'CODEBAR_ARTICLE' => $code_art[$i]));
				$quantite_produit = $produit->QUANTITY_ARTICLE;

				$quantite__ = $quantite[$i];

				if($quantite_produit <= 0 || $quantite__ > $quantite_produit)
				{
					$quantite_ = 0;
				}else{
					$quantite_ = $quantite[$i];
					$produit = $this->model_registers->getOne('pos_store_1_ibi_articles', array('DELETE_STATUS_ARTICLE'=> 0, 'CODEBAR_ARTICLE' => $code_art[$i]));
					$quantite_produit = $produit->QUANTITY_ARTICLE - $quantite_;
					$new_quant = $this->model_rm->update('pos_store_1_ibi_articles', array('CODEBAR_ARTICLE' => $code_art[$i]), array('QUANTITY_ARTICLE' => $quantite_produit));
				}

				$bon_livraison_detail[] = [
					'REF_ID_BL' => $save_bon_livraison,
					'REF_BON_LIVRAISON' => $code_bl,
					'CODE_PRODUIT_BLD' => $code_art[$i],
					'NOM_PRODUIT_BLD' => $nom_art[$i],
					'PRIX_UNITAIRE_BLD' => $prix_unit[$i],
					'QUANTITE_BLD' => $quantite[$i],
					'PRIX_TOTAL_BLD' => (int)($prix_unit[$i]) * $quantite_
				];

			}

			// dump($bon_livraison_detail);
			// die;
			
			$save_details = $this->model_rm->insertArray('bon_livraison_details', $bon_livraison_detail);

			$save_bon_livraison = true;
			
			if ($save_bon_livraison) {
				
				set_message(
					cclang('success_save_data_redirect', [
					anchor('administrator/bon_livraison/edit/' . $save_bon_livraison, 'Edit Bon Livraison')
				]), 'success');

				$this->data['success'] = true;
				$this->data['redirect'] = base_url('administrator/bon_livraison');
			} else {
				
				$this->data['success'] = false;
				$this->data['message'] = cclang('data_not_change');
				$this->data['redirect'] = base_url('administrator/bon_livraison');
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function getDetail($id_bl)
	{
		$this->data['bon_livraison'] = $this->model_bon_livraison->join_avaiable()->filter_avaiable()->find($id_bl);

		$where = [
			'REF_ID_BL' => $id_bl,
			'STATUS_DELETE_BLD' => 0
		];

		$this->data['bon_livraison_details'] = $this->model_rm->getList('bon_livraison_details', $where);

		echo json_encode($this->data);

	}

	// public function update_stock($code_art, $quantite)
	// {
	// 	$produit = $this->model_rm->getRequeteResult(`SELECT QUANTITY_ARTICLE FROM pos_store_1_ibi_articles WHERE DELETE_STATUS_ARTICLE=0 AND CODEBAR_ARTICLE = $code_art`);
	// 	$quantite_produit = $produit->QUANTITY_ARTICLE - $quantite;

	// 	$new_quant = $this->model->rm->update('pos_store_1_ibi_articles', array('CODEBAR_ARTICLE' => $code_art), array('QUANTITY_ARTICLE' => $quantite_produit));

	// 	return $new_quant;
	// }
	
		/**
	* Update view Bon Livraisons
	*
	* @var $id String
	*/
	public function edit($id, $code)
	{
		$this->is_allowed('bon_livraison_update');

		$this->data['bon_livraison'] = $this->model_bon_livraison->find($id);

		$where = [
			'REF_BON_LIVRAISON' => $code,
			'STATUS_DELETE_BLD' => 0
		];

		$this->data['bon_livraison_details'] = $this->model_rm->getList('bon_livraison_details', $where);
		// dump($this->data['bon_livraison_details']);
		// die;

		$this->template->title('Bon Livraison Update');
		$this->render('backend/standart/administrator/bon_livraison/bon_livraison_update', $this->data);
	}

	/**
	* Update Bon Livraisons
	*
	* @var $id String
	*/
	public function edit_save()
	{
		if (!$this->is_allowed('bon_livraison_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('CLIENT', 'REF CLIENT BL', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('code_bar[]', 'ARTICLE', 'trim|required|max_length[11]');
		$this->form_validation->set_rules('quantite[]', 'QUANTITE', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$id_bl = $this->input->post('ID_BL');
			$code_bl = $this->input->post('CODE_BL');
			$id_client = $this->input->post('CLIENT');

			$code_art = $this->input->post('code_bar');
			$nom_art = $this->input->post('name');
			$prix_unit = $this->input->post('prix_unit');
			$quantite = $this->input->post('quantite');
			$total = null;

			$bon_livraison = ['REF_CLIENT_BL' => $id_client,];
			$ref_bl = ['REF_BON_LIVRAISON' => $code_bl];
			$where_id = ['ID_BL' => $id_bl];

			$save_bon_livraison = $this->model_rm->update('bon_livraison',$id_bl, $bon_livraison);

			for($i=0; $i<count($code_art); $i++){

				$bl_count = $this->model_registers->record_countsome('bon_livraison_details', array('CODE_PRODUIT_BLD' => $code_art[$i],'NOM_PRODUIT_BLD'=>$nom_art[$i], 'PRIX_UNITAIRE_BLD' => $prix_unit[$i]));

				$produit = $this->model_registers->getOne('pos_store_1_ibi_articles', array('DELETE_STATUS_ARTICLE'=> 0, 'CODEBAR_ARTICLE' => $code_art[$i]));
				$quantite_produit = $produit->QUANTITY_ARTICLE;

				$quantite__ = $quantite[$i];

				if($quantite_produit <= 0 || $quantite__ > $quantite_produit)
				{
					$quantite_ = 0;
				}else{
					$quantite_ = $quantite[$i];
					$produit = $this->model_registers->getOne('pos_store_1_ibi_articles', array('DELETE_STATUS_ARTICLE'=> 0, 'CODEBAR_ARTICLE' => $code_art[$i]));
					$quantite_produit = $produit->QUANTITY_ARTICLE - $quantite_;
					$new_quant = $this->model_rm->update('pos_store_1_ibi_articles', array('CODEBAR_ARTICLE' => $code_art[$i]), array('QUANTITY_ARTICLE' => $quantite_produit));
				}

				if($bl_count < 1)
				{
					$bon_livraison_detail = [
						'REF_BON_LIVRAISON' => $code_bl,
						'CODE_PRODUIT_BLD' => $code_art[$i],
						'NOM_PRODUIT_BLD' => $nom_art[$i],
						'PRIX_UNITAIRE_BLD' => $prix_unit[$i],
						'QUANTITE_BLD' => $quantite[$i],
						'PRIX_TOTAL_BLD' => (int)($prix_unit[$i]) * $quantite_
					];

					$save_detail = $this->model_rm->insert('bon_livraison_details', $bon_livraison_detail);

				}else{
					$bon_livraison_detail = [
						'QUANTITE_BLD' => $quantite[$i],
						'PRIX_TOTAL_BLD' => (int)($prix_unit[$i]) * $quantite_
					];
					
					$update_bl_detail = $this->model_rm->update('bon_livraison_details', array('CODE_PRODUIT_BLD' => $code_art[$i], 'REF_BON_LIVRAISON' => $code_bl), $bon_livraison_detail);
				}
			
			}
	
			if ($save_bon_livraison) {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/bon_livraison');
				
			} else {
			
				$this->data['success'] = false;
				$this->data['message'] = cclang('data_not_change');
				$this->data['redirect'] = base_url('administrator/bon_livraison');
				
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Bon Livraisons
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('bon_livraison_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		// dump($id);
		// die;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'bon_livraison'), 'success');
        } else {
            set_message(cclang('error_delete', 'bon_livraison'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Bon Livraisons
	*
	* @var $id String
	*/
	public function view($id,$code)
	{
		$this->is_allowed('bon_livraison_view');

		$this->data['bon_livraison'] = $this->model_bon_livraison->join_avaiable()->filter_avaiable()->find($id);

		$where = [
			'REF_BON_LIVRAISON' => $code,
			'STATUS_DELETE_BLD' => 0
		];

		$this->data['bon_livraison_details'] = $this->model_rm->getList('bon_livraison_details', $where);

		// dump($this->data['bon_livraison_details']);
		// die;

		$this->template->title('Bon Livraison Detail');
		$this->render('backend/standart/administrator/bon_livraison/bon_livraison_view', $this->data);
	}
	
	/**
	* delete Bon Livraisons
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		// $bon_livraison = $this->model_bon_livraison->find($id);
        
		 $delete_save = array(
								'STATUS_DELETE_BL' => 1,
								'DATE_MODIFICATION_BL' => date('Y-m-d H:i:s')
							);

		$remove = $this->model_rm->update("bon_livraison",array("ID_BL"=>$id),$delete_save);
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('bon_livraison_export');

		$this->model_bon_livraison->export('bon_livraison', 'bon_livraison');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('bon_livraison_export');

		$this->model_bon_livraison->pdf('bon_livraison', 'bon_livraison');
	}

	public function search_produits(){

		$id_bl = $this->uri->segment(4);
		$code_bld = $this->uri->segment(5);
		$datasearch = $this->input->post('datasearch');

		// $this->data['getProduits'] = $this->model_rm->getRequeteResult('SELECT * FROM pos_store_1_ibi_articles WHERE DELETE_STATUS_ARTICLE=0 AND DESIGN_ARTICLE LIKE "%'.$datasearch.'%"');
		// $this->data['getProduits'] = $this->model_rm->getRequete("SELECT ID_ARTICLE, CODEBAR_ARTICLE, DESIGN_ARTICLE, PRIX_DACHAT_ARTICLE
		// FROM pos_store_1_ibi_articles  WHERE TYPE_ARTICLE=0 AND DELETE_STATUS_ARTICLE = 0 AND STORE_ID_ARTICLE= 1 
		// AND CODEBAR_ARTICLE NOT IN (SELECT CODE_PRODUIT_BLD FROM bon_livraison_details WHERE REF_ID_BL = $id_bl)
		// ");

		$this->data['getProduits'] = $this->model_rm->getRequeteResult("SELECT * FROM pos_store_1_ibi_articles WHERE CODEBAR_ARTICLE NOT IN (SELECT CODE_PRODUIT_BLD FROM bon_livraison_details WHERE REF_ID_BL = $id_bl) AND DELETE_STATUS_ARTICLE=0 AND DESIGN_ARTICLE LIKE '%$datasearch%'");
		

		// dump($code_bld); die;
		
		echo json_encode($this->data['getProduits']);
	  }

	  public function search_produits_add(){

		$id_bl = $this->uri->segment(4);
		$code_bld = $this->uri->segment(5);
		$datasearch = $this->input->post('datasearch');

		$this->data['getProduits'] = $this->model_rm->getRequeteResult('SELECT * FROM pos_store_1_ibi_articles WHERE DELETE_STATUS_ARTICLE=0 AND DESIGN_ARTICLE LIKE "%'.$datasearch.'%"');
		
		echo json_encode($this->data['getProduits']);
	  }
}


/* End of file bon_livraison.php */
/* Location: ./application/controllers/administrator/Bon Livraison.php */