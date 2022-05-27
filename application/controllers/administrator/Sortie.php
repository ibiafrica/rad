<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 18 Ibi Sortie Controller
*| --------------------------------------------------------------------------
*| Pos Store 18 Ibi Sortie site
*|
*/
class Sortie extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_sortie');
		$this->load->model('model_rm');

	}

	/**
	* show all Pos Store 18 Ibi Sorties
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{

		$store=$this->uri->segment(2);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_18_ibi_sortie_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['sorties'] = $this->model_sortie->get($filter, $field, $this->limit_page, $offset);
		$this->data['sortie_counts'] = $this->model_sortie->count_all($filter, $field);

		$config = [
			'base_url'     => 'sortie/'.$store.'/index/',
			'total_rows'   => $this->model_sortie->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
		
		$this->template->title('Sortie List');
		$this->render('backend/standart/administrator/sortie/sortie_list', $this->data);
	}
	
	/**
	* Add new pos_store_18_ibi_sorties
	*
	*/
	public function add()
	{
        $store=$this->uri->segment(2);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_18_ibi_sortie_add'); 

		$this->data['stores'] = $this->model_rm->getRequete('SELECT *FROM pos_ibi_stores WHERE DELETE_STATUS_STORE=0 AND STATUS_STORE="opened"  AND ID_STORE!=' . $store . '');

		$this->data['type_sortie'] = $this->model_rm->getRequete('SELECT * FROM pos_ibi_type_ajustement WHERE DELETED_STATUS = 0');
		
		$this->data['articles']=$this->model_rm->getRequete('
		 SELECT CODEBAR_ARTICLE AS CODEBAR,
		DESIGN_ARTICLE AS NOM_ART, 
		QUANTITY_ARTICLE AS QTE,
		PRIX_DACHAT_ARTICLE AS PRIX,
		IS_INGREDIENT AS TYPES
		FROM pos_store_'.$this->uri->segment(2).'_ibi_articles WHERE TYPE_ARTICLE=0 AND DELETE_STATUS_ARTICLE=0');

		$this->template->title('Sortie New');
		$this->render('backend/standart/administrator/sortie/sortie_add', $this->data);
	}


	    public function getCode($store){
             
	         $lastid = $this->model_rm->getRequeteOne("SELECT ID_SORTIE,CODE_SORTIE FROM pos_store_".$store."_ibi_sortie ORDER BY ID_SORTIE DESC LIMIT 1 ");

	           $code=$lastid['CODE_SORTIE']; 
	          if (date('m')==substr($code,12,2)) {

	          	return 'SORTIE'.str_pad(substr($lastid['CODE_SORTIE'],6,5)+1, 5, "0", STR_PAD_LEFT).'/'.date('m/Y');
	             
	         }else{
	            return "SORTIE00001/".date('m/Y');
	         } 

	    }


	  


   
    public function add_sortie($store=0)
	{   
		
		print_r($_POST);
		exit();
		$titre=$this->input->post('titre_sortie');
		$description=$this->input->post('description');

        $data=array('CODE_SORTIE'=>$this->getCode($store),
                     'TITRE_SORTIE'=>$titre,
                     'DESCRIPTION_SORTIE'=>$description,
                     'DATE_CREATION_SORTIE'=>date('Y-m-d H:i:s'),
                     'CREATED_BY_SORTIE'=>get_user_data('id') 
       );
		$insert=$this->model_rm->insert('pos_store_'.$store.'_ibi_sortie',$data);
		if ($insert) {
	     $sortie=$this->model_rm->getList('pos_store_'.$store.'_ibi_sortie', array('DELETE_STATUS_SORTIE'=>0, 'STATUS_SORTIE'=>0));
	     $html="<select style='text-align:center' class='form-control chosen chosen-select-deselect' name='CODE_SORTIE' id='CODE_SORTIE'>
	     <option value=''>---Choisir un titre de la sortie---</option>";
         
         foreach ($sortie as $key) {
         	$html.='<option value='.$key['CODE_SORTIE'].'>'.$key['TITRE_SORTIE'].'</option>';
         }
         $html.='</select>';
         echo $html;
		} 

	}

	public function printSortie($store=0,$id=null){

		$this->data['sortie']=$this->model_rm->getOne('pos_store_'.$store.'_ibi_sortie', array('ID_SORTIE'=>$id));

		$this->data['produits']=$this->model_rm->getList('pos_store_'.$store.'_ibi_sortie_items', array('REF_CODE_SORTIE'=>$this->data['sortie']['CODE_SORTIE'], 'DELETED_STATUS_SORTIE_ITM'=>0));
     
        $this->load->view('backend/standart/administrator/print/print_sortie', $this->data);
	}

	public function modifyitem(){

		$id=$this->input->post('idproduit');
	    $qt=$this->input->post('qtproduit');
		$store=$this->input->post('store');
		$prix=$this->input->post('prix');
		$types=$this->input->post('types');
		

	    $get=$this->model_rm->getOne('pos_store_'.$store.'_ibi_sortie_items',array('ID_SORTIE_ITM'=>$id));

	
		$newqt=$qt-$get['QTE_SORTIE_ITM'];
		$newmount=$prix*($newqt);

		$upsortie=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_sortie SET QTE_ASORTIE=(QTE_ASORTIE+('.$newqt.') ), MONTANT_SORTIE=(MONTANT_SORTIE+('.$newmount.') ) WHERE CODE_SORTIE="'.$get['REF_CODE_SORTIE'].'" ');
		

          $upqt=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-('.$newqt.') ) WHERE CODEBAR_ARTICLE="'.$get['REF_CODE_BAR_SORTIE_ITM'].'"  ');
		

		    //insert stockflow 
	 		$data=[
	 		'REF_ARTICLE_BARCODE_SF'=>$get['REF_CODE_BAR_SORTIE_ITM'],
	 		'QUANTITE_SF'=>$qt,
	 		'UNIT_PRICE_SF'=>$prix,
	 		'TOTAL_PRICE_SF'=>$prix*$qt,
	 		'REF_COMMAND_CODE_SF'=>$get['REF_CODE_SORTIE'],
	 		'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
	 		'CREATED_BY_SF'=>get_user_data('id'),
	 		'TYPE_SF'=>'stock_out_modify'

	 	    ];

            $ins=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', $data);
        
		
		
	    $this->model_rm->update('pos_store_'.$store.'_ibi_sortie_items',array('ID_SORTIE_ITM'=>$id), array('QTE_SORTIE_ITM'=>$qt, 'PRIX_TOTAL_SORTIE_ITM'=>$qt*$prix,'DATE_MOD_SORTIE_ITM'=>date('Y-m-d H:i:s')));

	}
	/**
	* Add New Pos Store 18 Ibi Sorties
	*
	* @return JSON
	*/
	public function add_save($store=0)
	{
        
        

		if ($store == 0) {
           echo json_encode([
				'success' => false,
				'message' => 'vous devez selectionner une boutique avant d\'effectuer cet operation'
				]);
			exit;;
        }

		if (!$this->is_allowed('pos_store_18_ibi_sortie_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('CODE_ARTICLE[]', 'Article', 'trim|required');
		$this->form_validation->set_rules('titre_sortie[]', 'Titre sortie', 'trim|required');
		$this->form_validation->set_rules('BOUTIQUE', 'Boutique', 'trim|required');	

		if ($this->form_validation->run()) {
	

		 $idsortie=$this->input->post('CODE_SORTIE');
		 $code=$this->input->post('CODE_ARTICLE');
		 $nom=$this->input->post('NOM_ARTICLE');
		 $qt=$this->input->post('Q_ARTICLE');
		 $prix=$this->input->post('PRIX_ARTICLE');
		 $total=$this->input->post('TOTAL_ARTICLE');
		 $types=$this->input->post('TYPES');
		

		$data=array('CODE_SORTIE'=>$this->getCode($store),
	                     'TITRE_SORTIE'=>$this->input->post('titre_sortie'),
	                     'DESTINATION_SORTIE'=>$this->input->post('BOUTIQUE'),
	                     'QTE_ASORTIE'=>0,
	                     'MONTANT_SORTIE'=>0,
	                     'DESCRIPTION_SORTIE'=>$this->input->post('description'),
	                     'DATE_CREATION_SORTIE'=>date('Y-m-d H:i:s'),
	                     'CREATED_BY_SORTIE'=>get_user_data('id') 
		       );
	$insertsortie=$this->model_rm->insert('pos_store_'.$store.'_ibi_sortie',$data);

	$lastid = $this->db->insert_id();

	$request = $this->db->query('SELECT AJ.AJUSTEMENT_NAME,S.CODE_SORTIE FROM  pos_store_'.$store.'_ibi_sortie S LEFT JOIN pos_ibi_type_ajustement AJ ON AJ.AJUSTEMENT_ID=S.TITRE_SORTIE WHERE ID_SORTIE='.$lastid)->row();
		
		$type_fs = $request->AJUSTEMENT_NAME;
		$CODE_SORTIE = $request->CODE_SORTIE;
		 
         $montant_s=0;
         $quantite_s=0;
		 for ($i=0; $i < count($code) ; $i++) { 
          
		 		$montant_s+=$total[$i];
		 	    $quantite_s+=$qt[$i];
           
                  $insproduct=$this->model_rm->insert('pos_store_'.$store.'_ibi_sortie_items', array(
			             	'REF_CODE_SORTIE'=>$CODE_SORTIE,
			             	'PRODUCT_NAME_SORTIE_ITM'=>$nom[$i],
			             	'QTE_SORTIE_ITM'=>$qt[$i],
			             	'PRIX_SORTIE_ITM'=>$prix[$i],
			             	'PRIX_TOTAL_SORTIE_ITM'=>$total[$i],
			             	'REF_CODE_BAR_SORTIE_ITM'=>$code[$i],
			             	'CREATED_BY_SORTIE_ITM'=>get_user_data('id'),
							'DATE_CREATION_SORTIE_ITM'=>date('Y-m-d H:i:s'),
						    'TYPES'=>$types[$i]
							 
					   ));
					   
					   
                   $upqt=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-'.$qt[$i].') WHERE CODEBAR_ARTICLE="'.$code[$i].'"  ');
			   
				
               $datas=[
	 		'REF_ARTICLE_BARCODE_SF'=>$code[$i],
	 		'QUANTITE_SF'=>$qt[$i],
	 		'UNIT_PRICE_SF'=>$prix[$i],
	 		'TOTAL_PRICE_SF'=>$prix[$i]*$qt[$i],
	 		'REF_COMMAND_CODE_SF'=>$CODE_SORTIE,
	 		'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
	 		'CREATED_BY_SF'=>get_user_data('id'),
	 		'TYPE_SF'=>$type_fs,

	 	    ];

            $ins=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', $datas);
	
		 	
		 }

		 $this->db->query('UPDATE pos_store_'.$store.'_ibi_sortie SET QTE_ASORTIE="'.$quantite_s.'",
	                     MONTANT_SORTIE="'.$montant_s.'" WHERE ID_SORTIE='.$lastid);


			if ($insertsortie) {
				if ($this->input->post('save_type') == 'stay') {
					
				} else {
					set_message('la sortie a ete bien enregistree', 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('sortie/'.$store.'/index/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('sortie/'.$store.'/index/');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 18 Ibi Sorties
	*
	* @var $id String
	*/
	public function edit()
	{
        
        $store=$this->uri->segment(2);
        $id=$this->uri->segment(4);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_18_ibi_sortie_update');

		$this->data['pos_store_18_ibi_sortie'] = $this->model_sortie->find($id);

		$this->template->title('Sortie Update');
		$this->render('backend/standart/administrator/sortie/sortie_update', $this->data);
	}

	/**
	* Update Pos Store 18 Ibi Sorties
	*
	* @var $id String
	*/
	public function edit_save($store=0,$id)
	{

		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		if (!$this->is_allowed('pos_store_18_ibi_sortie_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('CODE_SORTIE', 'CODE SORTIE', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('TITRE_SORTIE', 'TITRE SORTIE', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'CODE_SORTIE' => $this->input->post('CODE_SORTIE'),
				'TITRE_SORTIE' => $this->input->post('TITRE_SORTIE'),
			];

			
			$save_pos_store_18_ibi_sortie = $this->model_sortie->change($id, $save_data);

			if ($save_pos_store_18_ibi_sortie) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/sortie/index/'.$store, ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('sortie/'.$store.'/index/');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('sortie/'.$store.'/index/');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pos Store 18 Ibi Sorties
	*
	* @var $id String
	*/
	public function deleteItem($store=0,$id = null){
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $comment= $this->input->get('inputValue');


    

        $remove2=$this->model_rm->update('pos_store_'.$store.'_ibi_sortie_items', array('ID_SORTIE_ITM'=>$id), array('DELETED_STATUS_SORTIE_ITM'=>1, 'DELETED_DATE_SORTIE_ITM'=>date('Y-m-d H:i:s'), 'DELETED_BY_SORTIE_ITM'=>get_user_data('id'), 'DELETED_COMMENT_SORTIE_ITM'=>$comment));

        if ($remove2) {

        	$get=$this->model_rm->getOne('pos_store_'.$store.'_ibi_sortie_items', array('ID_SORTIE_ITM'=>$id));
			
			/*if($get['TYPES']=='article'){*/
				
				$upArtcl=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+'.$get['QTE_SORTIE_ITM'].') WHERE CODEBAR_ARTICLE="'.$get['REF_CODE_BAR_SORTIE_ITM'].'" ');
			/*}else{
				
				 $upArtcl=$this->model_rm->getUpdate('UPDATE pos_ibi_ingredients SET QUANTITY_INGREDIENT=(QUANTITY_INGREDIENT+'.$get['QTE_SORTIE_ITM'].' ) WHERE CODEBAR_INGREDIENT="'.$get['REF_CODE_BAR_SORTIE_ITM'].'"  ');
			}*/
			
        	$upSortie=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_sortie SET QTE_ASORTIE=(QTE_ASORTIE-'.$get['QTE_SORTIE_ITM'].'), MONTANT_SORTIE=(MONTANT_SORTIE-'.$get['PRIX_TOTAL_SORTIE_ITM'].') WHERE CODE_SORTIE="'.$get['REF_CODE_SORTIE'].'" ');
           


            set_message('l\'article a ete retire avec success','success');
        } else {
            set_message('une erreur est survennue lors de la suppression', 'error');
        }

		redirect_back();
	}


	public function delete($store=0,$id = null)
	{

		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_18_ibi_sortie_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$commentValue = $this->input->get('inputValue');
		$remove = false;
		$getData=$this->model_rm->getOne('pos_store_'.$store.'_ibi_sortie', array('ID_SORTIE'=>$id));

		 $up=$this->model_rm->update('pos_store_'.$store.'_ibi_sortie', array('ID_SORTIE'=>$id), array('DELETE_STATUS_SORTIE'=>1, 'DELETED_BY_SORTIE'=>get_user_data('id'), 'DELETE_COMMENT_SORTIE'=>$commentValue, 'DETEDE_DATE_SORTIE'=>date('Y-m-d H:i:s')));

			if ($up) {
             $getArticle=$this->model_rm->getList('pos_store_'.$store.'_ibi_sortie_items', array('REF_CODE_SORTIE'=>$getData['CODE_SORTIE']));
              

                 $supproduct=$this->model_rm->update('pos_store_'.$store.'_ibi_sortie_items', array('REF_CODE_SORTIE'=>$getData['CODE_SORTIE']), array('	DELETED_STATUS_SORTIE_ITM'=>1, 'DELETED_DATE_SORTIE_ITM'=>date('Y-m-d H:i:s'), 'DELETED_BY_SORTIE_ITM'=>get_user_data('id'), 'DELETED_COMMENT_SORTIE_ITM'=>$commentValue));


	            foreach ($getArticle as $key ) {
	            	
	               /*if($key['TYPES']=='0'){*/
                      $upArtcl=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+'.$key['QTE_SORTIE_ITM'].') WHERE CODEBAR_ARTICLE="'.$key['REF_CODE_BAR_SORTIE_ITM'].'" ');
				   /*}else{
					  $upqt=$this->model_rm->getUpdate('UPDATE pos_ibi_ingredients SET QUANTITY_INGREDIENT=(QUANTITY_INGREDIENT+'.$key['QTE_SORTIE_ITM'].' ) WHERE CODEBAR_INGREDIENT="'.$key['REF_CODE_BAR_SORTIE_ITM'].'"  '); 
				   }*/

	            }

					
					
			}

		if ($up) {
            set_message('suppression reussie avec success', 'success');
        } else {
            set_message('une erreur est survennue', 'error');
        }

		redirect_back();
	}

		/**
	* View view Pos Store 18 Ibi Sorties
	*
	* @var $id String
	*/
	public function view()
	{
        $store=$this->uri->segment(2);
        $id=$this->uri->segment(4);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('pos_store_18_ibi_sortie_view');

		$this->data['sortie'] = $this->model_sortie->join_avaiable()->filter_avaiable()->find($id);

		$this->template->title('Sortie Detail');
		$this->render('backend/standart/administrator/sortie/sortie_view', $this->data);
	}
	
	/**
	* delete Pos Store 18 Ibi Sorties
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_store_18_ibi_sortie = $this->model_sortie->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_store_18_ibi_sortie",$delete_save,array("ID_SORTIE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pos_store_18_ibi_sortie_export');

		$this->model_sortie->export('pos_store_18_ibi_sortie', 'pos_store_18_ibi_sortie');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pos_store_18_ibi_sortie_export');

		$this->model_sortie->pdf('pos_store_18_ibi_sortie', 'pos_store_18_ibi_sortie');
	}



	public function aprov($store, $id){
   
      $up=$this->model_rm->update('pos_store_'.$store.'_ibi_sortie', array('ID_SORTIE'=>$id), array('STATUS_SORTIE'=>1));

       if ($up) {
            set_message('approbation reussie', 'success');
        } else {
            set_message('une erreur est survennue', 'error');
        }

		redirect_back();
	}
}


/* End of file pos_store_18_ibi_sortie.php */
/* Location: ./application/controllers/administrator/Pos Store 18 Ibi Sortie.php */