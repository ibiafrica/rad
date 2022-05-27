<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Articles Controller
 *| --------------------------------------------------------------------------
 *| Hospital Store 1 Ibi Articles site
 *|
 */
class Articles extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_articles');
		$this->load->model('model_r_proforma');
		$this->load->model('model_rm');
	}

	/**
	 * show all Hospital Store 1 Ibi Articless
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$offset = $this->uri->segment(4);
		$store = $this->uri->segment(2);
		// echo $store;
		$this->is_allowed('pos_ibi_articles_list');
		if ($store == 0) {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		// var_dump($type_articles);exit;

		$this->data['articless'] = $this->model_pos_ibi_articles->get($filter, $field, 200, $offset);
		$this->data['articles_counts'] = $this->model_pos_ibi_articles->count_all($filter, $field);

		$config = [
			'base_url'     => 'articles/' . $store . '/index/',
			'total_rows'   => $this->model_pos_ibi_articles->count_all($filter, $field),
			'per_page'     => 200,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
		$this->template->title('Articles List');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;
		$this->render('backend/standart/administrator/pos_ibi_articles/pos_ibi_articles_list', $this->data);
	}


	public function plat_view()
	{

		$req = $this->model_rm->getRequete("
        	SELECT A.PRIX_DE_VENTE_ARTICLE AS VENTE, A.*, D.*
        	FROM pos_store_2_ibi_articles A 
        	JOIN pos_ibi_articles_details D ON A.ID_ARTICLE=D.ARTICLE_ID
        
        	");
		$obj = [];
		foreach ($req as $key) {
			echo $key['PRIX_DE_VENTE_ARTICLE'];
			$info = $this->model_rm->getOne("pos_store_2_ibi_articles", array("CODEBAR_ARTICLE" => $key['CODEBAR_ARTICLE_INGREDIENT']));

			$obj[$key['DESIGN_ARTICLE']][] = array(
				"QUANTITY" => $key['INGREDIENT_QUANTITY'],
				"CODE" => $key['CODEBAR_ARTICLE_INGREDIENT'],
				"PRIX" => $key['PRIX_DACHAT_ARTICLE_DETAIL'],
				"DESIGNATION" => $info['DESIGN_ARTICLE'],
				"UNITE" => $info['UNITE_ARTICLE'],
				"TOTAL" => (int)$key['INGREDIENT_QUANTITY'] * $key['PRIX_DACHAT_ARTICLE_DETAIL'],
				"MARGE_ARTICLE" => $key['MARGE_ARTICLE'],
				"PRIX_VENTE" => $key['VENTE'],
				"ID_ARTICLE" => $key['ID_ARTICLE']

			);
		}

	
		$this->data['res'] = $obj;
		$this->render('backend/standart/administrator/pos_ibi_articles/plat_view', $this->data);
	}


	public function liste_plats($offset = 0)
	{
		$offset = $this->uri->segment(4);
		$store = $this->uri->segment(2);
	

		if ($store == 0) {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		
		$this->data['articles_counts'] = $this->model_pos_ibi_articles->count_all_plats($store, $filter, $field);





		$config = [
			'base_url'     => 'articles/' . $store . '/liste_plats',
			'total_rows'   => $this->model_pos_ibi_articles->count_all_plats($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$req = $this->model_pos_ibi_articles->get_plats($store, $filter, $field, $this->limit_page, $offset);


		$obj = [];
		$tot = 0;
		foreach ($req as $key) {

			$info = $this->model_rm->getOne("pos_store_2_ibi_articles", array("CODEBAR_ARTICLE" => $key['CODEBAR_ARTICLE_INGREDIENT']));

	

			$obj[$key['DESIGN_ARTICLE']][] = array(
				"QUANTITY" => $key['INGREDIENT_QUANTITY'],
				"CODE" => $key['CODEBAR_ARTICLE_INGREDIENT'],
				"PRIX" => $key['PRIX_DACHAT_ARTICLE_DETAIL'],
				"DESIGNATION" => $info['DESIGN_ARTICLE'],
				"UNITE" => $info['UNITE_ARTICLE'],
				"TOTAL" => (int)$key['INGREDIENT_QUANTITY'] * $key['PRIX_DACHAT_ARTICLE_DETAIL'],
				"MARGE_ARTICLE" => $key['MARGE_ARTICLE'],
				"PRIX_VENTE" => $key['PRIX_DE_VENTE_ARTICLE'],
				"ID_ARTICLE" => $key['ID_ARTICLE']

			);

			// pr($tot);
		}
		// exit;


		$this->data['res'] = $obj;




		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Articles List');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;
		$this->render('backend/standart/administrator/pos_ibi_articles/plat_list', $this->data);
	}

	public function depot_principal($offset = 0)
	{

		$offset = $this->uri->segment(4);
		$store = $this->uri->segment(2);
		// echo $store;
		$this->is_allowed('pos_ibi_articles_list');
		if ($store == 0) {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$type_articles = $this->input->get('type_articles');
		$type_bs = "";
		if (!is_null($type_articles)) {
			if ($type_articles == 1) {
				$type_bs = "Ingredients";
			} elseif ($type_articles == 0) {
				$type_bs = "Articles";
			} else {
				$type_bs = "";
			}
		}


		$this->data['articless'] = $this->model_pos_ibi_articles->get_depot($type_articles, $filter, $field, $this->limit_page = 100, $offset);
		$this->data['articles_counts'] = $this->model_pos_ibi_articles->count_all_depot($type_articles, $filter, $field);

		$config = [
			'base_url'     => 'articles/' . $store . '/depot_principal/',
			'total_rows'   => $this->model_pos_ibi_articles->count_all_depot($type_articles, $filter, $field),
			'per_page'     => $this->limit_page = 100,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
		$this->template->title('Articles Depot');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;
		$this->data['typ'] = $type_bs;
		$this->render('backend/standart/administrator/pos_ibi_articles/pos_ibi_articles_depots', $this->data);
	}

	public function add_plat()
	{
		$store = $this->uri->segment(2);
		$this->is_allowed('hospital_ibi_articles_add');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$this->data['articlesPlat'] =$this->db->get_where('pos_store_2_ibi_articles',['NATURE_ARTICLE'=>1,'STORE_ID_ARTICLE'=>$store])->result();

		// echo "<pre>";print_r($this->data['articlesPlat']);exit;

		$this->template->title('Articles New');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/add_plat', $this->data);
	}


	public function edit_plat()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->is_allowed('hospital_ibi_articles_update');

		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$this->data['articles'] = $this->model_pos_ibi_articles->find($id);
		$this->data['product_list'] = $this->model_pos_ibi_articles->trouver_article($store, $id);
		// var_dump($this->data['product_list']);
		// exit;

		$this->template->title('Articles Update');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;
		$this->render('backend/standart/administrator/pos_ibi_articles/update_plat', $this->data);
	}
	 
	public function add()
	{
		$store = $this->uri->segment(2);
		$this->is_allowed('pos_ibi_articles_add');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$this->template->title('Articles New');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/article_add', $this->data);
	}

	/**
	 * Add New Hospital Store 1 Ibi Articless
	 *
	 * @return JSON
	 */
	



	public function add_save()
	{


		$article_accompagner = $this->input->post('article_accompagner');
		$accompanger_status = $this->input->post('accompanger_status');
		$type_transformation = $this->input->post('type_transf');
		$type_article = $this->input->post('is_ingredient');

		$accompagnateur = '';
		if ($accompanger_status == 1) {
			foreach ($article_accompagner as $Articles) {
				$accompagnateur .= $Articles . ",";
			}
		}
		$accompagnateur .= '//';
		$accompagnateur = str_replace(',//', '', $accompagnateur);
		$accompagnateurs_conversion = NULL;

		if ($accompanger_status == 0) {
			$accompagnateur = NULL;
		} else {
			$accompagnateurs_conversion = $accompagnateur;
		}

		$NBRES_INGREDIENT = "";
		if ($type_transformation == 1) {
			if (count($this->input->post('NOMBRE_INGREDIENT[]'))) {
				foreach ($this->input->post('NOMBRE_INGREDIENT[]') as $NOMBRE_ART) {
					$NBRES_INGREDIENT .= $NOMBRE_ART . ",";
				}
			}
		}

		$NBRES_INGREDIENT = $NBRES_INGREDIENT . "/";
		$NBRES_INGREDIENTS = str_replace(",/", "", $NBRES_INGREDIENT);

		$store = $this->input->post('store');
		$designation = $this->input->post('designation');
		$quantite = $this->input->post('quantite');
        $poids = $this->input->post('poids');
		$categorie = $this->input->post('categorie');
		$marge_prix = $this->input->post('marge_prix');
		$prix_de_vente = $this->input->post('prix_de_vente');
		$prix_de_vente_vp = $this->input->post('prix_de_vente_vp');
		$tva = $this->input->post('tva');
		$nature = $this->input->post('nature');
		$unite = $this->input->post('unite');
		$customer = $this->input->post('article_id');
		$prix_de_achat = $this->input->post('prix_de_achat');
		$quantite_achat_ingredient = $this->input->post('quantite_achat_ingredient');

		if (true) {
			$type_article_conversion = $type_article;
		} else {
			$type_article_conversion = 1;
		}

		$familles = $this->input->post('famille');
		if ($type_article_conversion == 1) {
			$elmt_famille_ingredient = $familles;
		} else {
			$elmt_famille_ingredient = NULL;
		}

		if ($type_article_conversion != 1) {
			$qte = $quantite;
		} else {
			$qte = $quantite_achat_ingredient;
		}

		$is_ingredient_status = "";
		if ($type_article_conversion != 1) {
			$is_ingredient_status = 0;
		} else {
			$is_ingredient_status = 1;
		}

		$donnee = array(
			// 'ARTICLES_ACCOMPAGNATEUR'=>$accompagnateurs_conversion,
			// 'STATUS_ACCOMPAGNEMENT'=>$accompanger_status,
			'SEUIL_ARTICLE' => $this->input->post('SEUIL'),
			'DESIGN_ARTICLE' => $designation,
			'NATURE_ARTICLE' => $nature,
			'ETAT_TVA' => $tva,
			'PRIX_DACHAT_ARTICLE' => $prix_de_achat,
			/*'REF_ID_FAMILLE_ARTICLE' => $elmt_famille_ingredient,*/
			'QUANTITY_ARTICLE'  => $quantite,
			'POIDS_ARTICLE' => $poids,
			'STORE_ID_ARTICLE' => $store,
			'UNITE_ARTICLE' => $unite,
			'CREATED_BY_ARTICLE' => get_user_data('id'),
			'DATE_CREATION_ARTICLE' => date('y-m-d h:m:s'),
			'TYPE_INGREDIENT' => $type_transformation,
			'TYPE_ARTICLE' => $type_article_conversion,
			'CODEBAR_ARTICLE' => $this->generate_barcode_article($store),
			'NOMBRE_INGREDIENT_TRANSFORMER' => $NBRES_INGREDIENTS,
			'PRIX_DE_VENTE_ARTICLE' => $prix_de_vente,
			'IS_INGREDIENT' => $is_ingredient_status,
			'MARGE_ARTICLE' => 0,
			'REF_CATEGORIE_ARTICLE' => $categorie,
		);

	 

		if ($store == 1) {
			$requete = $this->model_rm->insert('pos_store_1_ibi_articles', $donnee);
		} else {
			$requete = $this->model_rm->insert('pos_store_' . $store . '_ibi_articles', $donnee);
			$requete = $this->model_rm->insert('pos_store_1_ibi_articles', $donnee);
		}

		echo json_encode($requete);
	}




	/**
	 * Update view Hospital Store 1 Ibi Articless
	 *
	 * @var $id String
	 */
	public function edit()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->is_allowed('pos_ibi_articles_update');

		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$this->data['articles'] = $this->model_pos_ibi_articles->find($id);
		$this->data['product_list'] = $this->model_pos_ibi_articles->trouver_article($store, $id);
		// var_dump($this->data['product_list']);

		$this->template->title('Articles Update');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/article_update', $this->data);
	}

	/**
	 * Update Hospital Store 1 Ibi Articless
	 *
	 * @var $id String
	 */
	public function edit_save()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		if (!$this->is_allowed('pos_ibi_articles_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$this->form_validation->set_rules('designation', 'DESIGN ARTICLE', 'trim|required');
		$this->form_validation->set_rules('categorie', 'REF CATEGORIE ARTICLE', 'trim|required');
		//$this->form_validation->set_rules('PRIX_DACHAT_ARTICLE', 'PRIX DACHAT ARTICLE', 'trim|required');
		$this->form_validation->set_rules('UNITE_ARTICLE', 'UNITE ARTICLE', 'trim|required');

		if ($this->form_validation->run()) {

			$save_data = [

			'SEUIL_ARTICLE' => $this->input->post('SEUIL'),
			'DESIGN_ARTICLE' => $this->input->post('designation'),
			'NATURE_ARTICLE' =>$this->input->post('nature_article'),
			'ETAT_TVA' => $this->input->post('tva'),
			'TYPE_INGREDIENT' => $this->input->post('type_transformation'),
			'PRIX_DACHAT_ARTICLE' => $this->input->post('prix_de_achat'),
			'REF_ID_FAMILLE_ARTICLE' =>$this->input->post('famille'),
			'REF_CATEGORIE_ARTICLE' => $this->input->post('categorie'),
			'UNITE_ARTICLE' => $this->input->post('UNITE_ARTICLE'),
			'NOMBRE_INGREDIENT_TRANSFORMER' => $this->input->post('NOMBRE_INGREDIENT'),
			'PRIX_DE_VENTE_ARTICLE' => $this->input->post('prix_de_vente'),
			'IS_INGREDIENT' => $this->input->post('is_ingredient_now'),
			'DATE_MOD_ARTICLE' => date('Y-m-d H:i:s'),
			'MODIFIED_BY_ARTICLE' => get_user_data('id'),
			];





			$save_articles = $this->model_pos_ibi_articles->change($id, $save_data);

			if ($save_articles) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('articles/' . $store . '/index', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('articles/' . $store . '/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('articles/' . $store . '/index');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Hospital Store 1 Ibi Articless
	 *
	 * @var $id String
	 */
	public function delete($store, $codebar = null)
	{
		$this->is_allowed('pos_ibi_articles_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;
		$inputValue = $this->input->post('inputValue');



		 $data =[
		 	'DELETE_STATUS_ARTICLE' => 1,
		 	'DELETE_COMMENT_ARTICLE' => $inputValue,
		 	'DELETE_DATE_ARTICLE' => date('Y-m-d H:i:s'),
		 	'DELETE_BY_ARTICLE' => get_user_data('id'),

		 ];
		/*$remove = $this->db->query('update pos_store_' . $store . '_ibi_articles set DELETE_STATUS_ARTICLE=1,DELETE_COMMENT_ARTICLE="' . $inputValue . '",DELETE_DATE_ARTICLE="' . date('Y-m-d H:i:s') . '",DELETE_BY_ARTICLE=' . get_user_data('id') . '  WHERE CODEBAR_ARTICLE=' . $codebar);*/

		if ($store == 1) {
			$remove = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_1_ibi_articles', $data);
		} else {
			$remove = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_' . $store . '_ibi_articles', $data);
			$remove = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_1_ibi_articles', $data);
		}

		if ($remove) {
			echo json_encode($remove);
		}

	}


	public function delete_plats()
	{

		$store =$this->input->post('store');
        $id =$this->input->post('id_plat');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;



		$remove = $this->db->query('update pos_store_' . $store . '_ibi_articles set DELETE_STATUS_ARTICLE=1,DELETE_DATE_ARTICLE="' . date('Y-m-d H:i:s') . '",DELETE_BY_ARTICLE=' . get_user_data('id') . '  WHERE ID_ARTICLE=' . $id);


		if ($remove) {
			$this->db->query('DELETE FROM pos_ibi_articles_details WHERE ARTICLE_ID="' . $id . '" ');

		} 

	}

	/**
	 * View view Hospital Store 1 Ibi Articless
	 *
	 * @var $id String
	 */
	public function view($store = 0, $id)
	{
		$this->is_allowed('pos_ibi_articles_view');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
		$this->data['articles'] = $this->model_pos_ibi_articles->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Articles Detail');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/pos_ibi_articles_view', $this->data);
	}


	public function Recuperer_tous_le_commande()
	{
		# code...
		$data = $this->db->get_where('pos_store_2_ibi_articles', array('IS_INGREDIENT' => 1, 'DELETE_STATUS_ARTICLE' => 0))->result();

		//print_r($data); exit;
		echo json_encode($data);
		exit();
	}



	public function Insertion_plat()
	{
 
		$id_article_transformer = $this->input->post('designation');
		$store = $this->input->post('store');
		$customer = $this->input->post('article_id');
		$marge_prix=$this->input->post('marge_prix');
		
		$platUpdate = array(
			"NATURE_ARTICLE"=>2,
			"TYPE_ARTICLE" => 2,
			"MARGE_ARTICLE" => $marge_prix,
		);

		$requete = $this->model_rm->update('pos_store_2_ibi_articles',['ID_ARTICLE'=>$id_article_transformer], $platUpdate);

		if ($requete) {
			for ($count = 0; $count < count($customer); $count++) {

				$get_code_bar = $this->db->get_where('pos_store_2_ibi_articles', array('ID_ARTICLE' => $_POST['article_id'][$count]))->row();
				$vente_produit = $this->db->query('INSERT INTO pos_ibi_articles_details(
                                     ARTICLE_ID,
                                     INGREDIENT_ID,
									 CODEBAR_ARTICLE_INGREDIENT,
                                     INGREDIENT_QUANTITY,
                                     PRIX_DACHAT_ARTICLE_DETAIL
                                      ) 
                                     VALUES(
                                      "' . $id_article_transformer . '",
                                      "' . $_POST['article_id'][$count] . '",
                                      "' . $get_code_bar->CODEBAR_ARTICLE . '",
                                      "' . $_POST['quantity'][$count] . '",
                                      "' . $_POST['total_price'][$count] . '"
									  )');
			}

		}
		
	}

	public function modification_de_plats()
	{
		$store = $this->input->post('store');
		$id_article_plat = $this->input->post('id_article');
		$article_ids = $this->input->post('article_id');
        $selectArticle = $this->db->get_where('pos_store_2_ibi_articles',['ID_ARTICLE'=>$id_article_plat])->row_array();

        $idPlat = $selectArticle['ID_ARTICLE'];
        $designationPlat=$selectArticle['DESIGN_ARTICLE'];
		
		
		$customer = $article_ids;

		$dataPlat = array(
			'DESIGN_ARTICLE' => $designationPlat,
			'CODEBAR_ARTICLE'=>$selectArticle['CODEBAR_ARTICLE'],
			'PRIX_DACHAT_ARTICLE'=>$selectArticle['PRIX_DACHAT_ARTICLE'],
			'PRIX_DE_VENTE_ARTICLE'=>$selectArticle['PRIX_DE_VENTE_ARTICLE'],
			'MARGE_ARTICLE'=>$selectArticle['MARGE_ARTICLE'],

		);

		$this->db->where('ID_ARTICLE', $id_article_plat);
		$this->db->set($dataPlat);
		$requete =$this->db->update('pos_store_2_ibi_articles');

		if ($requete) {

			$this->db->query("DELETE FROM  pos_ibi_articles_details WHERE ARTICLE_ID=" . $id_article_plat);
			for ($count = 0; $count < count($customer); $count++) {

				
		    $get_code_bar = $this->db->get_where('pos_store_2_ibi_articles', array('ID_ARTICLE' => $_POST['article_id'][$count]))->row();

			$data_ing = $this->db->query('INSERT INTO pos_ibi_articles_details(

                                     ARTICLE_ID,
                                     INGREDIENT_ID,
                                     INGREDIENT_QUANTITY,
									 CODEBAR_ARTICLE_INGREDIENT,
                                     PRIX_DACHAT_ARTICLE_DETAIL
                                      ) 
                                     VALUES(
                                      "' . $id_article_plat . '",
                                      "' . $_POST['article_id'][$count] . '",
                                      "' . $_POST['quantity'][$count] . '",
					                 "' . $get_code_bar->CODEBAR_ARTICLE . '",
                                      "' . $_POST['total_price'][$count] . '")
                              ');
			}
		}
	}




	public function generate_barcode($store)
	{

		$lastid = $this->db->query("SELECT lpad(max(ID_INGREDIENT)+1,6,0) as Maxcount FROM pos_ibi_ingredients");
		foreach ($lastid->result_array() as $key => $value) {
			if ($value['Maxcount'] == NULL) {
				$Countmax = "000001";
			} else {
				$Countmax = $value['Maxcount'];
			}
		}
		$store_slug_id = $store;
		$pos_store = $this->db->query("SELECT lpad(count(ID_STORE)+1,4,0) as Countstore FROM pos_ibi_stores WHERE ID_STORE<" . $store_slug_id . "")->result_array();
		$CountPosId = $pos_store[0]['Countstore'];



		$code = $CountPosId . "-" . $Countmax;

		return $code;
	}


	public function generate_barcode_article($store)
	{

		$lastid = $this->db->query("SELECT lpad(max(ID_ARTICLE)+1,6,0) as Maxcount FROM pos_store_" . $store . "_ibi_articles WHERE DELETE_STATUS_ARTICLE =0");
		foreach ($lastid->result_array() as $key => $value) {
			if ($value['Maxcount'] == NULL) {
				$Countmax = "000001";
			} else {
				$Countmax = $value['Maxcount'];
			}
		}
		$store_slug_id = $store;
		$pos_store = $this->db->query("SELECT lpad(count(ID_STORE)+1,4,0) as Countstore FROM pos_ibi_stores WHERE ID_STORE<" . $store_slug_id . "")->result_array();
		$CountPosId = $pos_store[0]['Countstore'];



		$code = $CountPosId . "-" . $Countmax;

		return $code;
	}


	/*public function generate_barcode_ingredient($store)
{
	$get_last_id = $this->db->query('select MAX(ID_ARTICLE) as STORES from pos_store_' . $store . '_ibi_articles WHERE
		STORE_ID_ARTICLE= "' . $store . '" AND IS_INGREDIENT =1 ');
		foreach ($get_last_id->result() as $key) {
			$idmax = $key->STORES;
		}
		$idmax++;
		if ($idmax > 0) {
			$nbr_caractere = strlen($idmax);
			if ($nbr_caractere == 1) {
				$code_bar = 'B200000' . $idmax;
			} else if ($nbr_caractere == 2) {
				$code_bar = 'B20000' . $idmax;
			} else if ($nbr_caractere == 3) {
				$code_bar = 'B2000' . $idmax;
			} else if ($nbr_caractere == 4) {
				$code_bar = 'B200' . $idmax;
			} else if ($nbr_caractere == 5) {
				$code_bar = 'B20' . $idmax;
			} else if ($nbr_caractere == 6) {
				$code_bar = 'B2' . $idmax;
			}
		} else {
			$code_bar = 'B2000000';
		}
		return $code_bar;
}*/





	public function Insertion()
	{

		$store = $this->input->post('store');

		$prix_vente = $this->input->post('prix_de_vente');
		$prix_achat = $this->input->post('prix_achat');
		$quantite = $this->input->post('quantite');
		$nature_article = $this->input->post('nature');
		$marge_prix = $this->input->post('marge_prix');

		$designation = $this->input->post('designation');
		$famille = $this->input->post('famille');
		$categorie = $this->input->post('categorie');

		$saves = array(
			"DESIGN_ARTICLE" => $designation,
			// "REF_CATEGORIE_ARTICLE" => $categorie,
			"NATURE_ARTICLE"=>2,
			"PRIX_DE_VENTE_ARTICLE" => $prix_vente,
			"PRIX_DACHAT_ARTICLE" => $prix_achat,
			"TYPE_ARTICLE" => 2,
			"MARGE_ARTICLE" => $marge_prix,
			"CODEBAR_ARTICLE" => $this->generate_barcode_article($store),
			"DATE_CREATION_ARTICLE" => date("Y-m-d H:i:s"),
			"CREATED_BY_ARTICLE" => get_user_data("id"),
		);



		$requete = $this->model_rm->insert_last_id('pos_store_2_ibi_articles', $saves);

		$customer = $this->input->post('article_id');

		if ($requete) {
			for ($count = 0; $count < count($customer); $count++) {

				$get_code_bar = $this->db->get_where('pos_store_2_ibi_articles', array('ID_ARTICLE' => $_POST['article_id'][$count]))->row();
				$vente_produit = $this->db->query('INSERT INTO pos_ibi_articles_details(
                                     ARTICLE_ID,
                                     INGREDIENT_ID,
									 CODEBAR_ARTICLE_INGREDIENT,
                                     INGREDIENT_QUANTITY,
                                     PRIX_DACHAT_ARTICLE_DETAIL
                                      ) 
                                     VALUES(
                                      "' . $requete . '",
                                      "' . $_POST['article_id'][$count] . '",
                                      "' . $get_code_bar->CODEBAR_ARTICLE . '",
                                      "' . $_POST['quantity'][$count] . '",
                                      "' . $_POST['total_price'][$count] . '"
									  )');
			}
		}
	}




	public function Modifier_article()
	{
		// var_dump($_POST);
		// exit;
		$store = $this->input->post('store');
		$designation = $this->input->post('designation');
		$marge_prix = $this->input->post('marge_prix');
		$seuil = $this->input->post('seuil');
		$famille = $this->input->post('famille');
		$type_article = 1;
		$customer = $this->input->post('article_id');
		$tva = $this->input->post('tva');
		$categorie = $this->input->post('categorie');
		$id_article = $this->input->post('id_article');
		$prix_vente = $this->input->post('prix_de_vente');
		$prix_achat = $this->input->post('prix_achat');
		$quantite = $this->input->post('quantite');
		$nature_article = $this->input->post('nature');
		$marge_prix = $this->input->post('marge_prix');




		/*$requete = $this->db->query("UPDATE pos_store_" . $store . "_ibi_articles 
			                 SET DESIGN_ARTICLE='" . $designation . "',
							 TYPE_ARTICLE='" . $type_article . "',
							 MARGE_ARTICLE='" . $marge_prix . "',
							 NATURE_ARTICLE='" . $nature_article . "',
							 ETAT_TVA='" . $tva . "',
							 QUANTITY_ARTICLE='" . empty($quantite) ? 0 : $quantite . "',
							 REF_CATEGORIE_ARTICLE='" . $categorie . "',
							 DATE_MOD_ARTICLE='".date('Y-m-d')."',
							 MODIFIED_BY_ARTICLE='".get_user_data('id')."',
							 SEUIL_ARTICLE='" . $seuil . "',
							 PRIX_DE_VENTE_ARTICLE='" . $prix_vente . "',
							 PRIX_DACHAT_ARTICLE='" . $prix_achat . "'
							 WHERE ID_ARTICLE=" . $id_article);*/

		$data = array(
			'DESIGN_ARTICLE' => $designation,
			'TYPE_ARTICLE'  => $type_article,
			'MARGE_ARTICLE'  => $marge_prix,
			'REF_ID_FAMILLE_ARTICLE' => $famille,
			'ETAT_TVA' => $tva,
			'DATE_MOD_ARTICLE' => date('Y-m-d'),
			'MODIFIED_BY_ARTICLE' => get_user_data('id'),
			'SEUIL_ARTICLE' => $seuil,
			'PRIX_DACHAT_ARTICLE' => $prix_achat,
			'PRIX_DE_VENTE_ARTICLE' => $prix_vente,
			'REF_CATEGORIE_ARTICLE' => $categorie,
			'NATURE_ARTICLE' => $nature_article,
			'QUANTITY_ARTICLE' => empty($quantite) ? 0 : $quantite,

		);

		$this->db->where('ID_ARTICLE', $id_article);
		$this->db->set($data);

		if ($store == 1) {

			$requete = $this->db->update('pos_store_1_ibi_articles');
		} else {
			// $requete = $this->db->update('pos_store_1_ibi_articles');
			$requete = $this->db->update('pos_store_' . $store . '_ibi_articles');
		}

		if ($requete) {

			$this->db->query("DELETE FROM  pos_ibi_articles_details WHERE ARTICLE_ID=" . $id_article);

			for ($count = 0; $count < count($customer); $count++) {

				// $get_code_bar = $this->db->get_where('pos_store_'.$store.'_ibi_articles',array('ID_ARTICLE'=>$_POST['article_id'][$count]))->row();
				//Le donnees vient du store 1
				$get_code_bar = $this->db->get_where('pos_store_1_ibi_articles', array('ID_ARTICLE' => $_POST['article_id'][$count]))->row();


				$data_ing = $this->db->query('INSERT INTO pos_ibi_articles_details(
                                     ARTICLE_ID,
                                     INGREDIENT_ID,
                                     INGREDIENT_QUANTITY,
									 CODEBAR_ARTICLE_INGREDIENT,
                                     PRIX_DACHAT_ARTICLE_DETAIL
                                      ) 
                                     VALUES(
                                      "' . $id_article . '",
                                      "' . $_POST['article_id'][$count] . '",
                                      "' . $_POST['quantity'][$count] . '",
					                 "' . $get_code_bar->CODEBAR_ARTICLE . '",
                                      "' . $_POST['total_price'][$count] . '"
                                      
									  )
                                       ');
			}
		}
	}


	public function Modifier_article_sans()
	{

	$UNITE_ARTICLE = $this->input->post('UNITE_ARTICLE');
		$article_accompagner = $this->input->post('article_accompagner');
		$accompanger_status = $this->input->post('accompanger_status');

		$type_transformation = $this->input->post('type_transformation');
		$type_article = $this->input->post('is_ingredient_now');
		$codebar = $this->input->post('codebar');

		//print_r($type_transformation); exit();


		/*$accompagnateur = '';
		if ($accompanger_status == 1) {
			foreach ($article_accompagner as $Articles) {
				$accompagnateur .= $Articles . ",";
			}
		}

		$accompagnateur .= '//';
		$accompagnateur = str_replace(',//', '', $accompagnateur);

		if ($accompanger_status == 0) {
			$accompagnateurs_conversion = NULL;
		} else {
			$accompagnateurs_conversion = $accompagnateur;
		}*/


		$NBRES_INGREDIENT = NULL;
		if ($type_transformation == 1) {
			if (count($this->input->post('NOMBRE_INGREDIENT[]'))) {
				foreach ($this->input->post('NOMBRE_INGREDIENT[]') as $NOMBRE_ART) {
					$NBRES_INGREDIENT .= $NOMBRE_ART . ",";
				}
			}
		}
		$NBRES_INGREDIENT = $NBRES_INGREDIENT . "/";
		$NBRES_INGREDIENTS = str_replace(",/", "", $NBRES_INGREDIENT);


		$articleTOtransformation = NULL;
		if ($type_transformation == 0) {
			$articleTOtransformation = NULL;
		} else {
			$articleTOtransformation = $NBRES_INGREDIENTS;
		}

		$store = $this->input->post('store');
		$designation = $this->input->post('designation');
		//$marge_prix = 45;
		$tva = $this->input->post('tva');
		$poids = $this->input->post('poids');
		$prix_de_vente = $this->input->post('prix_de_vente');
		$prix_de_achat = $this->input->post('prix_de_achat');
		$prix_de_vente_vp = $this->input->post('prix_de_vente_vip');
		$nature = $this->input->post('nature_article');
		$is_ingredient_now = $this->input->post('is_ingredient_now');
		$id_article = $this->input->post('id_article');
		$customer = $this->input->post('article_id');
		$quantites = $this->input->post('quantites');
		$categorie = $this->input->post('categorie');

		$true_categorie = NULL;
		if ($is_ingredient_now == 0) {
			$true_categorie = $categorie;
		} else {
			$true_categorie = NULL;
		}

		$data = array(
			'SEUIL_ARTICLE' => $this->input->post('SEUIL'),
			'DESIGN_ARTICLE' => $designation,
			'TYPE_ARTICLE'  => $type_article,
			'QUANTITY_ARTICLE'  => $quantites,
			'IS_INGREDIENT' => $is_ingredient_now,
			'POIDS_ARTICLE' => $poids,
			'ETAT_TVA' => $tva,
			'PRIX_DE_VENTE_ARTICLE' => $prix_de_vente,
			'PRIX_DACHAT_ARTICLE' => $prix_de_achat,
			'UNITE_ARTICLE' => $UNITE_ARTICLE,
			// 'STATUS_ACCOMPAGNEMENT'=>$accompanger_status,
			// 'ARTICLES_ACCOMPAGNATEUR'=>$accompagnateurs_conversion,
			'DATE_MOD_ARTICLE' => date('Y-m-d'),
			'MODIFIED_BY_ARTICLE' => get_user_data('id'),
			'REF_CATEGORIE_ARTICLE' => $true_categorie,
			'NATURE_ARTICLE' => $nature,
			'NOMBRE_INGREDIENT_TRANSFORMER' => $articleTOtransformation,
			'TYPE_INGREDIENT'  => $type_transformation,
			'PRIX_DE_VENTE_ARTICLE' => $prix_de_vente

		);

        //echo "<pre>";print_r($data);exit;

		/*if ($store == 2) {
			$update = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_2_ibi_articles', $data);
		} else {*/
			$update = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_' . $store . '_ibi_articles', $data);
			/*$update = $this->db->where('CODEBAR_ARTICLE', $codebar)->update('pos_store_2_ibi_articles', $data);
		}*/

	echo json_encode($update);
	}



	public function desactivate_article()
	{
		$ider = $this->input->post('ider');
		$store = $this->input->post('store');

		$this->db->where(array('ID_ARTICLE' => $ider));
		$this->db->set(array('STATUT_ARTICLE' => 1));
		$up = $this->db->update('pos_store_' . $store . '_ibi_articles');

		echo json_encode($up);
	}


	public function activate_article()
	{
		$ider = $this->input->post('ider');
		$store = $this->input->post('store');

		$this->db->where(array('ID_ARTICLE' => $ider));
		$this->db->set(array('STATUT_ARTICLE' => 0));
		$up = $this->db->update('pos_store_' . $store . '_ibi_articles');

		echo json_encode($up);
	}








	public function historique()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		$this->is_allowed('pos_ibi_articles_view');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}


		$date_depart1 = $this->input->get('date_depart');
		$date_fin1 = $this->input->get('date_fin');
		$date_depart = $date_depart1 . ' 00:00:00';
		$date_fin = $date_fin1 . ' 23:59:59';

		$this->data['articles'] = $this->model_pos_ibi_articles->getOneFilter($store, $date_depart, $date_fin, $id);
		$this->data['articles_counts'] = $this->model_pos_ibi_articles->getOneFilter_count($store, $date_depart, $date_fin, $id);
		$this->data['date_depart'] = $date_depart1;
		$this->data['date_fin'] = $date_fin1;

		$this->template->title('Articles Detail');
		$boutique = $this->db->query('select * from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/pos_ibi_articles_historique', $this->data);
	}


	public function approvisionnement()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);

		$this->is_allowed('pos_ibi_articles_approvisionnement');
		if ($store == 0) {

			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
		// else{
		//    $date_depart=$this->input->post('date_depart');
		//    $date_fin=$this->input->post('date_fin');
		// $this->data['rapport']=array();
		//    if (!empty($date_depart) && !empty($date_fin)) {

		//        	  $rapport=$this->model_r_proforma->getRequete('SELECT ar.DESIGN_ARTICLE as article FROM pos_store_1_ibi_articles_stock_flow as fl,pos_store_1_ibi_articles as ar WHERE fl.REF_ARTICLE_BARCODE_SF=ar.CODEBAR_ARTICLE AND DATE_CREATION_SF >="2020-09-08 14:23:33" AND DATE_CREATION_SF <="2020-09-08 14:23:53" '
		//        	);

		// 				$this->data['rapport']=$rapport;


		//       }
		//      }

		$date_depart1 = $this->input->get('date_depart');
		$date_fin1 = $this->input->get('date_fin');
		$date_depart = $date_depart1 . ' 00:00:00';
		$date_fin = $date_fin1 . ' 23:59:59';

		$this->data['articles'] = $this->model_pos_ibi_articles->getOneFilter_ap($store, $date_depart, $date_fin, $id);
		$this->data['articles_counts'] = $this->model_pos_ibi_articles->getOneFilter_count_ap($store, $date_depart, $date_fin, $id);
		$this->data['date_depart'] = $date_depart1;
		$this->data['date_fin'] = $date_fin1;

		$this->template->title('Articles Detail');
		$boutique = $this->db->query('select *from pos_ibi_stores where ID_STORE=' . $store)->row_array();
		$this->data['boutique'] = $boutique;

		$this->render('backend/standart/administrator/pos_ibi_articles/pos_ibi_articles_approvisionnement', $this->data);
	}





	public function verification_ingredient()
	{

		$product_ids = $this->input->post('product_id');
		$client_id = $this->input->post('client_id');
		$store = $this->uri->segment(4);
		$product_details = $this->model_pos_ibi_articles->get_total_product($product_ids);

		// var_dump($store);
		// exit;



		$html = "";
		$tr 	= " ";
		$order 	= " ";
		$bill 	= " ";

		if (!empty($product_details)) {

			$product_id = $this->aauth->generator(5);

			$tr .= "<tr id='" . $product_details['ID_ARTICLE'] . "' data-id='" . $product_id . "'>
			            <th nowrap id=\"product_name_" . $product_id . "\">" . $product_details['DESIGN_ARTICLE'] . "</th>
                            <input type=\"hidden\" name=\"sl\" class=\"sl\" value=" . $product_id . ">
			            	<input type=\"hidden\" class=\"product_id_" . $product_id . "\" name=\"article_id[]\" value=" . $product_details['ID_ARTICLE'] . ">
			           
                  <input type=\"hidden\" class=\"sl\" value=" . $product_id . ">
                    <input type=\"hidden\" class=\"product_id_ref_" . $product_id . "\" name=\"ref_id[]\" value=" . $product_details['ID_ARTICLE'] . ">
		              <th nowrap id=\"product_name_" . $product_id . "\">" . $product_details['UNITE_ARTICLE'] . "</th>
					
			           <td nowrap>
              <input style='border-radius:0px !important;width:70px' type=\"text\" name=\"quantity[]\" onkeyup=\"quantity_calculate('" . $product_id . "');\" onchange=\"quantity_calculate('" . $product_id . "');\" id=\"total_qntt_" . $product_id . "\" class=\"form-control text-right variant_ids_" . $product_details['ID_ARTICLE'] . "   available_quantity_" . $product_id . "\" value=\"1\" min=\"0\"  />
                    <input type=\"hidden\" class=\"sl\" value=" . $product_id . ">
                    <input type=\"hidden\" name=\"design[]\" value=" . $product_details['DESIGN_ARTICLE'] . ">
			            	<input type=\"hidden\" class=\"product_id_" . $product_id . "\" value=" . $product_details['ID_ARTICLE'] . ">
			            </td>
			            <td nowrap>
			            	<input data-backdrop=\"static\" data-keyboard=\"false\" data-toggle=\"modal\" data-target=\"#myModal\" style='border-radius:0px !important;width:70px;' type=\"text\" name=\"prix_produit[]\" value='" . $product_details['PRIX_DACHAT_ARTICLE'] . "' id=\"price_item_" . $product_id . "\" class=\"price_item" . $product_id . " form-control text-right\" min=\"0\"  style=\"width:60px;border-radius:0px;\" readonly=\"readonly\"/>
			            </td>
			             <td nowrap>
			            	<input style='border-radius:0px !important;width:70px;' class=\"total_price form-control text-right\" type=\"text\" name=\"total_price[]\" id=\"total_price_" . $product_id . "\" value='" . $product_details['PRIX_DACHAT_ARTICLE'] . "'  readonly=\"readonly\" style=\"width:70px\"/>
			            </td>
                     
                     <td nowrap width=\"\">
			                <a  style='border-radius:0px !important;width:60px' href=\"#\" class=\"btn btn-danger btn-sm\" data-toggle=\"tooltip\" data-placement=\"top\" title='Supprimer' onclick=\"deletePosRow('" . $product_details['ID_ARTICLE'] . "')\"><i class=\"fa fa-close\" aria-hidden=\"true\"></i></a></td>
			                  ";
			echo json_encode(array(
				'item' 	=> $tr,
				'order' => $order,
				'bill'	=> $bill,
				'product_id' => $product_id
			));
		}

		// else{

		// 	echo json_encode(array(

		//     	'item' 	=> 0

		//     ));

		// }

	}

	/**
	 * delete Hospital Store 1 Ibi Articless
	 *
	 * @var $id String
	 */
	private function _remove($id)
	{
		$pos_store_1_ibi_articles = $this->model_pos_ibi_articles->find($id);



		return $this->model_pos_ibi_articles->remove($id);
	}


	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export($store)
	{
		$this->is_allowed('pos_ibi_articles_export');

		$this->model_pos_ibi_articles->export('pos_store_' . $store . '_ibi_articles', 'pos_store_' . $store . '_ibi_articles');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf($store)
	{
		$this->is_allowed('pos_ibi_articles_export');

		$this->model_pos_ibi_articles->pdf('pos_store_' . $store . '_ibi_articles', 'pos_store_' . $store . '_ibi_articles');
	}
}

//nturubika rotshild david
/* End of file pos_store_1_ibi_articles.php */
/* Location: ./application/controllers/administrator/Hospital Store 1 Ibi Articles.php */