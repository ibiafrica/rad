
<?php
defined('BASEPATH') or exit('No direct script access allowed');
/**
 *| --------------------------------------------------------------------------
 *| Pos Ibi Ingredients Controller
 *| --------------------------------------------------------------------------
 *| Pos Ibi Ingredients site
 *|
 */
class pos_ibi_ingredients extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pos_ibi_ingredients');
	}

	/**
	 * show all Pos Ibi Ingredientss
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_ingredients_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$STORES = $this->uri->segment(2);

		$this->data['pos_ibi_ingredient'] = $this->model_pos_ibi_ingredients->get($filter, $field, $this->limit_page = 100, $offset);
		$this->data['pos_ibi_ingredients_counts'] = $this->model_pos_ibi_ingredients->count_all($filter, $field);
		$config = [
			'base_url'     => 'ingredients/' . $this->uri->segment(2) . '/index/',
			'total_rows'   => $this->model_pos_ibi_ingredients->count_all($filter, $field),
			'per_page'     => $this->limit_page =100,
			'uri_segment'  => 4,
		];
		$this->data['pagination'] = $this->pagination($config);
		$this->template->title('Ingredients List');
		$this->render('backend/standart/administrator/pos_ibi_ingredients/pos_ibi_ingredients_list', $this->data);
	}

	/**
	 * Add new pos_ibi_ingredientss
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_ibi_ingredients_add');

		$this->template->title('Ingredients New');
		$this->render('backend/standart/administrator/pos_ibi_ingredients/pos_ibi_ingredients_add', $this->data);
	}

	/**
	 * Add New Pos Ibi Ingredientss
	 *
	 * @return JSON
	 */
	public function add_save($uri)
	{
		if (!$this->is_allowed('pos_ibi_ingredients_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$NOMBRE_INGREDIENT = "";

		$TYPE_INGREDIENT = $this->input->post('TYPE_INGREDIENT');
		$NBRES_INGREDIENT = $this->input->post('NOMBRE_INGREDIENT');

		if (empty($NBRES_INGREDIENT)) {
			$NOMBRE_INGREDIENT = NULL;
		} else {
			$NOMBRE_INGREDIENT = $NBRES_INGREDIENT;
		}

		// var_dump($NOMBRE_INGREDIENT);exit;




		$get_last_id = $this->db->query('select MAX(ID_ARTICLE) as STORES from pos_store_' . $uri . '_ibi_articles WHERE
		STORE_ID_ARTICLE= "' . $uri . '" AND IS_INGREDIENT =1 ');

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


		$this->form_validation->set_rules('DESIGN_INGREDIENT', 'DESIGN INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('ETAT_INGREDIENT', 'ETAT INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('UNITE_INGREDIENT', 'UNITE INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('NOMBRE_UNITAIRE', 'NOMBRE_UNITAIRE', 'trim|required');
		$this->form_validation->set_rules('PRIX_ACHAT', 'PRIX_ACHAT', 'trim|required');
		$is_ingredient = 1;

		$NBRES_INGREDIENT = "";
		if (count($this->input->post('NOMBRE_INGREDIENT'))) {
			foreach ($this->input->post('NOMBRE_INGREDIENT') as $NOMBRE_INGREDIENT) {
				$NBRES_INGREDIENT .= $NOMBRE_INGREDIENT . ",";
			}
		}
		$NBRES_INGREDIENT = $NBRES_INGREDIENT . "/";
		$NBRES_INGREDIENTS = str_replace(",/", "", $NBRES_INGREDIENT);

		if ($this->form_validation->run()) {

			$save_data = [
				'DESIGN_ARTICLE' => $this->input->post('DESIGN_INGREDIENT'),
				'ETAT_INGREDIENT_ARTICLE' => $this->input->post('ETAT_INGREDIENT'),
				'UNITE_ARTICLE' => $this->input->post('UNITE_INGREDIENT'),
				'PRIX_DACHAT_ARTICLE' => $this->input->post('PRIX_ACHAT'),
				'NOMBRE_UNITAIRE' => $this->input->post('NOMBRE_UNITAIRE'),
				'TYPE_INGREDIENT' => $TYPE_INGREDIENT,
				'NOMBRE_INGREDIENT_TRANSFORMER' => $NBRES_INGREDIENTS,
				'STORE_ID_ARTICLE' => $uri,
				'CODEBAR_ARTICLE' => $code_bar,
				'CREATED_BY_ARTICLE' => get_user_data('id'),
				'DATE_CREATION_ARTICLE' => date('Y-m-d H:i:s'),
				'IS_INGREDIENT' => $is_ingredient
			];


			$save_pos_ibi_ingredients = $this->model_pos_ibi_ingredients->INSERTION_DB("pos_store_" . $uri . "_ibi_articles", $save_data);
			// print_r($save_pos_ibi_ingredients);exit;

			if ($save_pos_ibi_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_ingredients;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_ingredients/edit/' . $save_pos_ibi_ingredients, 'Edit Pos Ibi Ingredients'),
						anchor('administrator/pos_ibi_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/pos_ibi_ingredients/edit/' . $save_pos_ibi_ingredients, 'Edit Pos Ibi Ingredients')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_ingredients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * Update view Pos Ibi Ingredientss
	 *
	 * @var $id String
	 */
	public function edit($id = null)
	{


		$id = $this->uri->segment(4);
		$store = $this->uri->segment(2);
		$this->is_allowed('pos_ibi_ingredients_update');

		// $this->data['pos_ibi_ingredients'] = $this->model_pos_ibi_ingredients->find($id);
		$this->data['pos_ibi_ingredients'] = $this->model_pos_ibi_ingredients->one_off_article('pos_store_' . $store . '_ibi_articles', array('ID_ARTICLE' => $id));

		
        // var_dump($get_ingredient);exit();

		$this->template->title('Ingredients Update');
		$this->render('backend/standart/administrator/pos_ibi_ingredients/pos_ibi_ingredients_update', $this->data);
	}

	/**
	 * Update Pos Ibi Ingredientss
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_ingredients_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}

		$NOMBRE_INGREDIENT = "";

		$TYPE_INGREDIENT = $this->input->post('TYPE_INGREDIENT');
		$NBRES_INGREDIENT = $this->input->post('NOMBRE_INGREDIENT');

		if (empty($NBRES_INGREDIENT)) {
			$NOMBRE_INGREDIENT = NULL;
		} else {
			$NOMBRE_INGREDIENT = $NBRES_INGREDIENT;
		}



		// var_dump($NOMBRE_INGREDIENT);exit;


		$this->form_validation->set_rules('DESIGN_INGREDIENT', 'DESIGN INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('ETAT_INGREDIENT', 'ETAT INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('UNITE_INGREDIENT', 'UNITE INGREDIENT', 'trim|required');
	    $this->form_validation->set_rules('TYPE_INGREDIENT', 'TYPE INGREDIENT', 'trim|required');

		$uri = $this->input->post('URI');


		$NBRES_INGREDIENT = "";
		if (count($this->input->post('NOMBRE_INGREDIENT'))) {
			foreach ($this->input->post('NOMBRE_INGREDIENT') as $NOMBRE_INGREDIENT) {
				$NBRES_INGREDIENT .= $NOMBRE_INGREDIENT . ",";
			}
		}
		$NBRES_INGREDIENT = $NBRES_INGREDIENT . "/";
		$NBRES_INGREDIENTS = str_replace(",/", "", $NBRES_INGREDIENT);

		if ($this->form_validation->run()) {

			$save_data = [
				'DESIGN_ARTICLE' => $this->input->post('DESIGN_INGREDIENT'),
				'ETAT_INGREDIENT_ARTICLE' => $this->input->post('ETAT_INGREDIENT'),
				'UNITE_ARTICLE' => $this->input->post('UNITE_INGREDIENT'),
			    'TYPE_INGREDIENT' => $TYPE_INGREDIENT,
				'NOMBRE_INGREDIENT_TRANSFORMER' => $NBRES_INGREDIENTS

			];

           if($TYPE_INGREDIENT ==0){
				$this->db->where(array('ID_ARTICLE' => $id));
				$this->db->set(array('TYPE_INGREDIENT'=>$TYPE_INGREDIENT,'NOMBRE_INGREDIENT_TRANSFORMER' => NULL));
				$save_pos_ibi_ingredients = $this->db->update('pos_store_1_ibi_articles');
             }
             else{
             	$this->db->where(array('ID_ARTICLE' => $id));
				$this->db->set($save_data);
				$save_pos_ibi_ingredients = $this->db->update('pos_store_1_ibi_articles');
             }
           
			// $save_pos_ibi_ingredients = $this->model_pos_ibi_ingredients->up('pos_store_'.$uri.'_ibi_articles',$id, $save_data);

			if ($save_pos_ibi_ingredients) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_ingredients', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_ingredients');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_ingredients');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	/**
	 * delete Pos Ibi Ingredientss
	 *
	 * @var $id String
	 */
	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_ingredients_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;
		$store = $this->uri->segment(2);
		$ider = $this->uri->segment(4);
		$status_off = 1;

		$datas = array(
			'DELETE_COMMENT_ARTICLE' => $commentValue,
			'DELETE_BY_ARTICLE' => get_user_data('id'),
			'DELETE_STATUS_ARTICLE' => $status_off,
			'DELETE_DATE_ARTICLE' => date('Y-m-d H:i:')
		);



		if (!empty($ider)) {

			$this->db->where(array('ID_ARTICLE' => $ider));
			$this->db->set($datas);
			$remove = $this->db->update("pos_store_1_ibi_articles");

			// $remove = $this->_remove($id,$commentValue);
		} elseif (count($ider) > 0) {
			foreach ($ider as $id) {

				$this->db->where(array('ID_ARTICLE' => $id));
				$this->db->set($datas);
				$remove = $this->db->update("pos_store_1_ibi_articles");
				// $remove = $this->_remove($id,$commentValue);
			}
		}

		if ($remove) {
			set_message(cclang('has_been_deleted', 'pos_ibi_ingredients'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_ibi_ingredients'), 'error');
		}

		redirect_back();
	}

	/**
	 * View view Pos Ibi Ingredientss
	 *
	 * @var $id String
	 */
	public function view($id = false)
	{
		$id = $this->uri->segment(4);
		$STORES =  $this->uri->segment(2);

		$this->is_allowed('pos_ibi_ingredients_view');

		// $this->data['pos_ibi_ingredients'] = $this->model_pos_ibi_ingredients->join_avaiable()->filter_avaiable()->find($id);
		$this->data['pos_ibi_ingredients'] = $this->model_pos_ibi_ingredients->one_off_article('pos_store_' . $STORES . '_ibi_articles', array("ID_ARTICLE" => $id));


		// print_r($this->data['pos_ibi_ingredients']); exit;

		$this->template->title('Ingredients Detail');
		$this->render('backend/standart/administrator/pos_ibi_ingredients/pos_ibi_ingredients_view', $this->data);
	}

	/**
	 * delete Pos Ibi Ingredientss
	 *
	 * @var $id String
	 */
	private function _remove($id, $commentValue)
	{
		$pos_ibi_ingredients = $this->model_pos_ibi_ingredients->find($id);



		$delete_save = array(
			'DELETE_STATUS_INGREDIENT' => 1,
			'DELETE_DATE_INGREDIENT' => date('Y-m-d H:i:s'),
			'DELETE_BY_INGREDIENT' => get_user_data('id'),
			'DELETE_COMMENT_INGREDIENT' => $commentValue
		);

		$remove = $this->db->update("pos_ibi_ingredients", $delete_save, array("ID_INGREDIENT" => $id));
		return $remove;
	}



	public function transformation($id_ingrendient = 0)
	{
		$id_ingrendient = $this->uri->segment(4);
		$this->data['all_article'] = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE DELETE_STATUS_ARTICLE =0 AND ID_ARTICLE = " . $id_ingrendient . " ")->row_array();

		$this->data['all_articles'] = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE  DELETE_STATUS_ARTICLE =0 AND ID_ARTICLE = " . $id_ingrendient . " ")->result();
		
		// echo "<pre>";print_r($this->data['all_articles']);exit();

		$this->data['Transformer'] = $this->db->query("SELECT DESIGN_ARTICLE, ID_ARTICLE FROM pos_store_" . $this->uri->segment(2) . "_ibi_articles WHERE ID_ARTICLE in (" . $this->data['all_articles'][0]->NOMBRE_INGREDIENT_TRANSFORMER . ")")->result();

		$this->template->title('Article transformation');
		$this->render('backend/standart/administrator/pos_ibi_ingredients/pos_ibi_ingredients_transformation', $this->data);
	}





	public function transformer_add()
	{


        
        // QTE_ARTICLE_TRANS pour l article 1
        // ID_ARTICLE_TRANS art 1

        // DESIGN_ARTICLE_TRANS art 2
        // ARTICLE_NOMBRE_TRANS * QTE_ARTICLE_TRANS pour l article 2

		$this->form_validation->set_rules('QTE_ARTICLE_TRANS', 'QUANTITE INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('DESIGN_ARTICLE_TRANS', 'DESIGN INGREDIENT', 'trim|required');
		$this->form_validation->set_rules('ARTICLE_NOMBRE_TRANS', 'NOMBRE INGREDIENT', 'trim|required');


		$uri = $this->uri->segment(4);
		$id_article = $this->input->post("ID_ARTICLE_TRANS");
		$transformer_article = $this->input->post('DESIGN_ARTICLE_TRANS');
		$qte_transformer = $this->input->post('QTE_ARTICLE_TRANS');
		$nbre = $this->input->post('ARTICLE_NOMBRE_TRANS');

		/*$nbre_decoupage = $qte_transformer * $nbre;*/

		//print_r($nbre); exit();

		$nbre_decoupage = $nbre;




		$article_first = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(4) . "_ibi_articles WHERE ID_ARTICLE = " . $id_article . "  ")->row_array();

		$article_second = $this->db->query("SELECT * FROM pos_store_" . $this->uri->segment(4) . "_ibi_articles WHERE ID_ARTICLE = " . $transformer_article . "  ")->row_array();


		$quantite_update_first = $article_first['QUANTITY_ARTICLE'] - $qte_transformer;
		$quantite_decoupage_up_second = $article_second['QUANTITY_ARTICLE'] + $nbre_decoupage;


		// $quantite_decoupage_up = $article['QUANTITY_ARTICLE'] + $nbre_decoupage;


		if ($this->form_validation->run()) {
			$critere_data_decoup  = array('ID_ARTICLE' => $id_article);
			$critere_qte_up = array('ID_ARTICLE' => $transformer_article);

			$data_up = array('QUANTITY_ARTICLE' => $quantite_decoupage_up_second, 'TRANSFORMER_BY' => get_user_data('id'));
			$quantite_up = array('QUANTITY_ARTICLE' => $quantite_update_first);

          // print_r($data_up);exit();

         $this->db->where($critere_qte_up);
         $this->db->set($data_up);
         $save_pos_ibi_decoupage = $this->db->update("pos_store_" . $uri . "_ibi_articles");
			


		$save_pos_ibi_qte = $this->model_pos_ibi_ingredients->up("pos_store_" . $uri . "_ibi_articles", $critere_data_decoup, $quantite_up);

			if ($save_pos_ibi_decoupage) {






 $article_flow_in = $this->db->query("SELECT * FROM pos_store_" . $uri . "_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF = ( SELECT CODEBAR_ARTICLE FROM pos_store_" . $uri . "_ibi_articles WHERE ID_ARTICLE = " . $transformer_article . " )")->row_array();

    $transformation_out = "Transformation_out";
    $transformation_in = "Transformation_in";

    $data_out_stock = array('REF_ARTICLE_BARCODE_SF' => $article_first['CODEBAR_ARTICLE'], 'QUANTITE_SF' => $nbre_decoupage, 'TYPE_SF' => $transformation_out, 'DATE_CREATION_SF' => date("Y-m-d h:i:s"), 'CREATED_BY_SF' => get_user_data('id'));

    $data_in_stock = array('REF_ARTICLE_BARCODE_SF' => $article_second['CODEBAR_ARTICLE'], 'QUANTITE_SF' => $qte_transformer, 'TYPE_SF' => $transformation_in, 'DATE_CREATION_SF' => date("Y-m-d h:i:s"), 'CREATED_BY_SF' => get_user_data('id'));

    $article_flow_out = $this->db->query("SELECT * FROM pos_store_" . $uri . "_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF = (SELECT CODEBAR_ARTICLE FROM pos_store_" . $uri . "_ibi_articles WHERE ID_ARTICLE = " . $id_article . " )")->row_array();

    //       echo "<pre>";
    // var_dump($article_flow_in);exit();

    if (is_null($article_flow_in)) {
      $all_numbers_in = 0 + $qte_transformer;
    } else {
      $all_numbers_in = $article_flow_in['QUANTITE_SF'] + $qte_transformer;
    }

    $update_data_in = array('QUANTITE_SF' => $all_numbers_in, 'TYPE_SF' => $transformation_in);

    if (is_null($article_flow_out)) {
      $all_numbers_out = 0 + $nbre_decoupage;
    } else {
      $all_numbers_out = $article_flow_out['QUANTITE_SF'] + $nbre_decoupage;
    }

    $update_data_out = array('QUANTITE_SF' => $all_numbers_out, 'TYPE_SF' => $transformation_out);

    if (!is_null($article_flow_in)) {
      $critere_in = array('REF_ARTICLE_BARCODE_SF' => $article_flow_in['REF_ARTICLE_BARCODE_SF']);
    }

    if (!is_null($article_flow_out)) {
      $critere_out = array('REF_ARTICLE_BARCODE_SF' => $article_flow_out['REF_ARTICLE_BARCODE_SF']);
    }

    if (empty($article_flow_out)) {
      $insert_out_stock = $this->model_pos_ibi_ingredients->INSERTION_DB("pos_store_" . $uri . "_ibi_articles_stock_flow", $data_out_stock);
    } else {

      $this->db->where($critere_out);
      $this->db->set($update_data_out);
      $update_out_stock = $this->db->update("pos_store_" . $uri . "_ibi_articles_stock_flow");
    }

    if (empty($article_flow_in)) {
      $insert_in_stock = $this->model_pos_ibi_ingredients->INSERTION_DB("pos_store_" . $uri . "_ibi_articles_stock_flow", $data_in_stock);
    } else {

      $this->db->where($critere_in);
      $this->db->set($update_data_in);
      $update_in_stock = $this->db->update("pos_store_" . $uri . "_ibi_articles_stock_flow");
    }





				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_decoupage;
					$this->data['message'] = "transformation effectuer";
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('', 'Transformation reussie')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/articles');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = 'Transformer';
				} else {
					$this->data['success'] = false;
					$this->data['message'] = 'transformation echouer';
					$this->data['redirect'] = base_url('administrator/articles');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}





	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_ibi_ingredients_export');

		$this->model_pos_ibi_ingredients->export('pos_ibi_ingredients', 'pos_ibi_ingredients');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_ingredients_export');

		$this->model_pos_ibi_ingredients->pdf('pos_ibi_ingredients', 'pos_ibi_ingredients');
	}
}


/* End of file pos_ibi_ingredients.php */
/* Location: ./application/controllers/administrator/Pos Ibi Ingredients.php */
