<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 3 Ibi Transfert Items Controller
*| --------------------------------------------------------------------------
*| Pos Store 3 Ibi Transfert Items site
*|
*/
class Transfert_items extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_transfert_items');
		$this->load->model('model_dashboard');
		$this->load->model('model_articles');
		$this->load->model('model_registers');

	}

	/**
	* show all Pos Store 3 Ibi Transfert Itemss
	*
	* @var $offset String
	*/
	public function index($store =0,$offset = 0)
	{
		if($store == 0){

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
		$this->is_allowed('transfert_items_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['transfert_itemss'] = $this->model_transfert_items->get($filter, $field, $this->limit_page, $offset);
		$this->data['transfert_items_counts'] = $this->model_transfert_items->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/transfert_items/index/'.$store,
			'total_rows'   => $this->model_transfert_items->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 5,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Liste de transfert');
		$this->render('backend/standart/administrator/transfert_items/transfert_items_list', $this->data);
	}

	public function add($store = 0)
	{
		$this->is_allowed('transfert_items_add');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $this->data['getProduit']=$this->model_dashboard->getList('pos_store_'.$store.'_ibi_articles');

		$this->template->title('Nouveau transfert');
		$this->render('backend/standart/administrator/transfert_items/transfert_items_add', $this->data);
	}

	public function select_famille($store){

        $store_id = $this->input->post('store_id');
      
        $resultat = "<option value=''>Selectionner la famille</option>";
        
        $famille = $this->model_registers->getList('pos_store_'.$store_id.'_famille');

    	foreach ($famille as $key) {
    		$resultat.="<option value='".$key['ID_FAMILLE']."'>".$key['NOM_FAMILLE']."</option>";
            }
    	echo json_encode($resultat);
    }

    public function select_categorie($store){

        $famille = $this->input->post('famille');
      
        $resultat = "<option value=''>Selectionner la categorie</option>";
        
        $categorie = $this->model_registers->getList('pos_store_'.$store.'_ibi_categories',array('PARENT_REF_ID_CATEGORIE'=>$famille));

    	foreach ($categorie as $key) {
    		$resultat.="<option value='".$key['ID_CATEGORIE']."'>".$key['NOM_CATEGORIE']."</option>";
            }
    	echo json_encode($resultat);
    }

	public function add_save($store)
    {
 
      if (!$this->is_allowed('transfert_items_add',false)) {
            echo json_encode([
              'success' => false,
              'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }
    	$this->form_validation->set_rules('store_id','','trim|required',array('required'=>'<font>Selectionner une boutique</font>'));
    	$this->form_validation->set_rules('famille','','trim|required',array('required'=>'<font>Selectionner une famille</font>'));
  		$this->form_validation->set_rules('article[]','','trim|required',array('required'=>'<font>Veuillez ajouter un produit dans la liste</font>'));

  		if ($this->form_validation->run()) {
           
     		$store_transfert = $this->input->post('store_id');
     		$famille = $this->input->post('famille');
     		$categorie = $this->input->post('categorie');
     		$article = $this->input->post('article');
     		$design = $this->input->post('design');
     		$quantite = $this->input->post('search');
     		$price = $this->input->post('price');

     	for ($i = 0; $i < count($article); $i++) { 

     		$save_data = [

				'DESIGN' => $design[$i],
				'QUANTITY' => $quantite[$i],
				'UNIT_PRICE' => $price[$i],
				'TOTAL_PRICE' => $price[$i] * $quantite[$i],
				'REF_ITEM' => $categorie,
				'FAMILLE' => $famille,
				'DATE_CREATION' => date('Y-m-d H:i:s'),
				'REF_TRANSFER' => $store,
				'BARCODE' => $article[$i],
				'USER_ID'=> get_user_data('id'),
				'TRANSFART_STATUS' => 1,
			];

			$save_transfert = $this->model_registers->insert_last_id('pos_store_'.$store_transfert.'_ibi_transfert_items',$save_data);

			$save_data_sf = [

					'REF_ARTICLE_BARCODE_SF' => $article[$i],
					'QUANTITE_SF' => $quantite[$i],
					'UNIT_PRICE_SF' => $price[$i],
                    'TOTAL_PRICE_SF' => $price[$i] * $quantite[$i],
					'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
					'AUTHOR_SF' => get_user_data('id'),
					'REF_COMMAND_CODE_SF' => $save_transfert,
					'TYPE_SF' => 'transfert_in',
					'ACTION_STORE_SF' => $store_transfert,
					'DESCRIPTION_SF' => $design[$i]
				];

			$save_stock_flow = $this->db->insert('pos_store_'.$store_transfert.'_ibi_articles_stock_flow',$save_data_sf);
		}
		if ($save_stock_flow) {

			set_message(
            cclang('success_save_data_redirect'),
            'success'
          );
          $this->data['success'] = true;
          $this->data['redirect'] = base_url('administrator/transfert_items/index/'.$this->uri->segment(4));
		} else {
		  $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
          $this->data['redirect'] = base_url('administrator/transfert_items/index/'.$this->uri->segment(4));
		}

  		} else {
	      $this->data['success'] = false;
	      $this->data['message'] = validation_errors();
	    }

        echo json_encode($this->data);
    }

	
	/**
	* delete Pos Store 3 Ibi Transfert Itemss
	*
	* @var $id String
	*/
	public function delete($store, $id)
	{
		$this->is_allowed('transfert_items_delete');

		$transfert_items = $this->model_registers->getOne('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id));

		if($transfert_items['TRANSFART_STATUS'] == 2 ){
			set_message("Impossible de supprimer un transfert approuver", 'error');
			redirect_back();
		}

		if($transfert_items['TRANSFART_STATUS'] == 1 ){
			set_message("Impossible de supprimer un transfert en attente", 'error');
			redirect_back();
		}

	    $remove = $this->model_registers->delete('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id));

		if ($remove) {
            set_message('Suppression réussie', 'success');
        } else {
            set_message('Echec de Suppression', 'error');
        }

		redirect_back();
	}

	public function transfert_refused_one($store, $id)
	{

	  $this->is_allowed('transfert_items_delete');

	  $transfert_items = $this->model_registers->getOne('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id));

		if($transfert_items['TRANSFART_STATUS'] == 2 ){
			set_message("Impossible de refuser un transfert approuver", 'error');
			redirect_back();
		}

		if($transfert_items['TRANSFART_STATUS'] == 0 ){
			set_message("Ce transfert a été réfusé", 'error');
			redirect_back();
		}

	    $remove = $this->model_registers->update('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id),array('TRANSFART_STATUS'=>0));

		if ($remove) {
            set_message('Transfert réfusé', 'success');
        } else {
            set_message('Echec', 'error');
        }

		redirect_back();
	}

	public function transfert_refused($store, $id)
	{

	  $this->is_allowed('transfert_items_delete');

		$update = false;
		$article_update = false;

	    $transfert_items = $this->model_registers->getOne('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id));

	    if($transfert_items['TRANSFART_STATUS'] == 1 ){
			set_message("Ce transfert a été desapprouver", 'error');
			redirect_back();
		}

		if($transfert_items['TRANSFART_STATUS'] == 0 ){
			set_message("Impossible de desapprouver un transfert annuler", 'error');
			redirect_back();
		}

	    $designation = $transfert_items['DESIGN'];
        $quantite = $transfert_items['QUANTITY'];

		$article = $this->model_dashboard->getRequeteOne('SELECT QUANTITE_RESTANTE_ARTICLE FROM pos_store_'.$store.'_ibi_articles WHERE DESIGN_ARTICLE="'.$designation.'"');

	    $update = $this->model_registers->update('pos_store_'.$store.'_ibi_transfert_items',array('ID'=>$id), array('TRANSFART_STATUS'=>1));

	    $quantite_restante = $article['QUANTITE_RESTANTE_ARTICLE'] - $quantite;
	    if($quantite_restante < 0){
	    	$quantite_restante = 0;
	    }
        
		$data_update = [
				    'QUANTITE_RESTANTE_ARTICLE' => $quantite_restante 
				];

	    $article_update = $this->model_registers->update('pos_store_'.$store.'_ibi_articles',array('DESIGN_ARTICLE'=>$designation), $data_update);

		if ($update and $article_update) {
            set_message('Desaprobation réussie', 'success');
        } else {
            set_message('Echec desaprobation', 'error');
        }

		redirect_back();
	}

    public function transfert_approuved($store, $id)
	{
		$this->is_allowed('transfert_items_approuve');

	    $save_article = false;
	    $update_transfert = false;

	    $transfert_items = $this->model_registers->getOne('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id));

	    if($transfert_items['TRANSFART_STATUS'] == 2 ){
			set_message("Ce transfert a été approuvé", 'error');
			redirect_back();
		}

		if($transfert_items['TRANSFART_STATUS'] == 0 ){
			set_message("Impossible d\'approuver un transfert annuler", 'error');
			redirect_back();
		}
          
		  $designation = $transfert_items['DESIGN'];
          $quantite = $transfert_items['QUANTITY'];
          $cout_achat = $transfert_items['COUT'];
		  $prix_unitaire = $transfert_items['UNIT_PRICE'];
		  $prix_total = $transfert_items['TOTAL_PRICE'];
		  $categorie = $transfert_items['REF_ITEM'];
		  $famille = $transfert_items['FAMILLE'];
		  $stores = $transfert_items['REF_TRANSFER'];

			if ($store == 2) {
				$position_article = 0;
			}else{
				$position_article = 1;
			}
       
          $this->db->select('QUANTITE_RESTANTE_ARTICLE');
          $this->db->where('DESIGN_ARTICLE',$designation);
	      $this->db->from('pos_store_'.$store.'_ibi_articles');		
		  $article = $this->db->get();
            
			if($article->num_rows() > 0 )
			{
	           foreach($article->result() as $articles)
		        {
                   $quantite_res = $articles->QUANTITE_RESTANTE_ARTICLE;
		        }
		       $quantite_restante = $quantite_res + $quantite;
		       if($quantite_restante < 0){
		       		$quantite_restante = $quantite;
		       }
                
			   $update_data = [ 
			   	    'REF_CATEGORIE_ARTICLE' => $famille ,
					'REF_SOUS_CATEGORIE_ARTICLE' => $categorie,
			   		'QUANTITE_RESTANTE_ARTICLE' => $quantite_restante,
			   		'PRIX_DACHAT_ARTICLE' => $cout_achat,
					'PRIX_DE_VENTE_ARTICLE' => $prix_unitaire,
					'PRIX_DE_VENTE_TTC_ARTICLE' => 0,
			   		'POSITION_ARTICLE' => $position_article,
			   		'DATE_MOD_ARTICLE' => date('Y-m-d H:i:s'),
					'AUTHOR_ARTICLE' => get_user_data('id'),
					'TYPE_ARTICLE' => 1,
					'STATUS_ARTICLE' => 1,
					'STOCK_ENABLED_ARTICLE' => 1,
					'MINIMUM_QUANTITY_ARTICLE' => 1,
					'STORE_ARTICLE'	=> $store, 
				];
         
               $save_article = $this->model_registers->update('pos_store_'.$store.'_ibi_articles', array('DESIGN_ARTICLE'=>$designation),$update_data);
            }else{

		      $data_insert = [
						'DESIGN_ARTICLE' => $designation,
						'REF_CATEGORIE_ARTICLE' => $famille ,
						'REF_SOUS_CATEGORIE_ARTICLE' => $categorie,
						'QUANTITY_ARTICLE' => $quantite,
						'QUANTITE_RESTANTE_ARTICLE' => $quantite,
						'PRIX_DACHAT_ARTICLE' => $cout_achat,
						'PRIX_DE_VENTE_ARTICLE' => $prix_unitaire,
						'PRIX_DE_VENTE_TTC_ARTICLE' => 0,
		                'CODEBAR_ARTICLE' =>  $this->model_articles->generate_barcode($store,$categorie),
						'DATE_CREATION_ARTICLE' => date('Y-m-d H:i:s'),
						'AUTHOR_ARTICLE' => get_user_data('id'),
						'TYPE_ARTICLE' => 1,
						'STATUS_ARTICLE' => 1,
						'STOCK_ENABLED_ARTICLE' => 1,
						'MINIMUM_QUANTITY_ARTICLE' => 1,
						'POSITION_ARTICLE' => 0,
						'STORE_ARTICLE'	=> $store,

					];
                
                $save_article = $this->db->insert('pos_store_'.$store.'_ibi_articles', $data_insert);

                }
            $data_upd = [ 
            		'TRANSFART_STATUS' => 2,
            		'AUTHOR_APPR_TRANSF' => get_user_data('id'),
            		'DATE_APPR_TRANSF' => date('Y-m-d H:i:s') 
            	];
            $update_transfert = $this->model_registers->update('pos_store_'.$store.'_ibi_transfert_items', array('ID'=>$id),$data_upd);
            $articles_origin = $this->model_registers->getOne('pos_store_'.$stores.'_ibi_articles', array('DESIGN_ARTICLE'=> $designation));
            $quantite_remove = 0;
            if($quantite > $articles_origin['QUANTITE_RESTANTE_ARTICLE']) {
            	$quantite_remove = 0;
            }else {
            	$quantite_remove = $articles_origin['QUANTITE_RESTANTE_ARTICLE'] - $quantite;
            }
            $data_remove = [
            	'QUANTITE_RESTANTE_ARTICLE' => $quantite_remove
            ];
            $update_articles = $this->model_registers->update('pos_store_'.$stores.'_ibi_articles', array('DESIGN_ARTICLE'=>$designation),$data_remove);
        if($save_article and $update_transfert and $update_articles)
        {
            set_message('Approbation réussie', 'success');
       
        } else {
            set_message('Echec approbation', 'error');
        }

		redirect_back();
	}



}


/* End of file pos_store_3_ibi_transfert_items.php */
/* Location: ./application/controllers/administrator/Pos Store 3 Ibi Transfert Items.php */