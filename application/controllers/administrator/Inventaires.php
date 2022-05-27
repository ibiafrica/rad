<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Store 1 Ibi Inventaires Controller
*| --------------------------------------------------------------------------
*| Pos Store 1 Ibi Inventaires site
*|
*/
class Inventaires extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

        $this->load->model('model_rm');
		$this->load->model('model_pos_ibi_inventaires');
	}

	/**
	* show all Pos Store 1 Ibi Inventairess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
        $offset = $this->uri->segment(4);
		$store = $this->uri->segment(2);
		$this->is_allowed('pos_ibi_inventaires_list');
if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pos_ibi_inventairess'] = $this->model_pos_ibi_inventaires->get($filter, $field, $this->limit_page=100, $offset);
		$this->data['pos_ibi_inventaires_counts'] = $this->model_pos_ibi_inventaires->count_all($filter, $field);

		$config = [
			'base_url'     => 'inventaires/'.$store.'/index',
			'total_rows'   => $this->model_pos_ibi_inventaires->count_all($filter, $field),
			'per_page'     => $this->limit_page=100,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);
		$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;
		$this->template->title('Inventaires List');
		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_list', $this->data);
	}
	
	/**
	* Add new pos_store_1_ibi_inventairess
	*
	*/
	public function approv($store,$id)
	{
       $up=$this->model_rm->update('pos_store_'.$store.'_ibi_inventaires',array('ID_INVENTAIRE'=>$id), array('STATUS_APPROV'=>1));
       if ($up) {
       	set_message("Inventaire cloture avec success", "success");
       }

       redirect_back();
	}


	public function add_articles()
	{
	    $store = $this->uri->segment(2);
	    $id=$this->uri->segment(4);

		$this->is_allowed('pos_ibi_inventaires_add');
       if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }

         $getStatus = $this->model_rm->getOne('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id))['STATUS_APPROV'];
         if ($getStatus==1) {
         	redirect_back();
         }


		$this->template->title('Inventaires New');

		 $this->data['getProduit']=$this->db->query('

		 SELECT *
		  FROM     pos_store_'.$store.'_ibi_articles A 
		  WHERE   A.CODEBAR_ARTICLE NOT IN
        (
        SELECT  BARCODE_IVI
        FROM    pos_store_'.$store.'_ibi_inventaires_items
        WHERE REF_IVI='.$id.' AND DELETE_STATUS_IVI=0
        ) AND DELETE_STATUS_ARTICLE=0')->result();

	  $boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

        $this->data['inventaires'] = $this->model_rm->getOne('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id));

		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_add_articles', $this->data);
	}


	public function update_prix_achat()

	{
		 $store = $this->uri->segment(4);
		$remove=$this->db->query('UPDATE pos_store_'.$store.'_ibi_inventaires_items fl join pos_store_'.$store.'_ibi_articles c set fl.PRIX_ACHAT_IVI = c.PRIX_DACHAT_ARTICLE WHERE c.CODEBAR_ARTICLE = fl.BARCODE_IVI');

		if ($remove) {
            set_message('success');
        } else {
            set_message('error');
        }

		redirect_back();
	}


	public function add()
	{
	    $store = $this->uri->segment(2);

		$this->is_allowed('pos_ibi_inventaires_add');
       if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
		$this->template->title('Inventaires New');
		 $this->data['getProduit']=$this->model_pos_ibi_inventaires->getList('pos_store_'.$store.'_ibi_articles', array('DELETE_STATUS_ARTICLE'=>0));
	$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;
		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_add', $this->data);
	}

	/**
	* Add New Pos Store 1 Ibi Inventairess
	*
	* @return JSON
	*/
	public function add_save($store)
	{
				//$store = $this->uri->segment(2);

		if (!$this->is_allowed('pos_store_1_ibi_inventaires_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

	   $this->form_validation->set_rules('titre_inventaire', '', 'trim|required', array('required'=>'Veuillez ajouter le titre d\'inventaire'));

        $this->form_validation->set_rules('codebar[]', '', 'trim|required', array('required'=>'Ajouter au moins un produit'));
      
  

		if ($this->form_validation->run()) {


			$data = array(
            'TITRE_INVENTAIRE' => $this->input->post('titre_inventaire'),
            'DESCRIPTION_INVENTAIRE' => $this->input->post('description'),
            //'TYPE_ARRIVAGE' => $this->input->post('type_approvisionnememt'),
            'DATE_CREATION_INVENTAIRE' => date("Y-m-d H:i:s"),
            'CREATED_BY_INVENTAIRE' => get_user_data('id')
           );

			$id_=$this->input->post('ID_INVENTAIRE');

			if (isset($id_) AND !empty($id_)) {
				$id_inventaire=$id_;
			}else{
				 $id_inventaire = $this->model_rm->insert_last_id('pos_store_'.$store.'_ibi_inventaires', $data);
			}
           


		     $id_fournisseur=$this->input->post('ID_FOURNISSEUR');
		     $quantite=$this->input->post('quantite');
             $prix_unitaire=$this->input->post('price');
             $prix_total=$this->input->post('prix_total');
             $codebare=$this->input->post('codebar');
             $prix_achat=$this->input->post('prix_achat');
             $expiration=$this->input->post('expiration');

			 $get_inventaire = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id_inventaire));
			           
			    
            $value_inventaire = 0;
            $items_inventaire = 0;
            for ($i = 0; $i < count($codebare); $i++) {
              
  
                $save_data_ivi = [

              'BARCODE_IVI' => $codebare[$i],
              'QUANTITY_THEORIQUE_IVI' => $prix_unitaire[$i],
              'REF_IVI' => $id_inventaire,
              'QUANTITY_PHYSIQUE_IVI ' => $quantite[$i],
              'DIFF ' => $prix_unitaire[$i]-$quantite[$i],
              'PRIX_ACHAT_IVI' => $prix_achat[$i],
              'DATE_CREATION_IVI' => date('Y-m-d H:i:s'),
              'CREATED_BY_IVI' => get_user_data('id')
          ];

		$check_items=$this->db->query('select *from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id_inventaire.' and BARCODE_IVI="'.$codebare[$i].'" and DELETE_STATUS_IVI=0 and STATUS_VALIDATION=0');

		if($check_items->num_rows() > 0){

		  $save_inventaires_items = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires_items',array('BARCODE_IVI'=>$codebare[$i], 'REF_IVI'=>$id_inventaire, 'DELETE_STATUS_IVI'=>0), $save_data_ivi);

               
	    }else{
                $save_inventaires_items = $this->model_pos_ibi_inventaires->insert('pos_store_'.$store.'_ibi_inventaires_items', $save_data_ivi); 
         }

           $value_inventaire += $prix_unitaire[$i];
           $items_inventaire += $quantite[$i];

          }

            

            
            if (is_numeric($get_inventaire['VALUE_INVENTAIRE'])) {
             	$get_val=$get_inventaire['VALUE_INVENTAIRE'];
             }else{
             	$get_val=0;
             }

             if (is_numeric($get_inventaire['ITEMS_INVENTAIRE'])) {
             	$get_itm=$get_inventaire['ITEMS_INVENTAIRE'];
             }else{
             	$get_itm=0;
             }
 
            $save_update = array(
 
              'VALUE_INVENTAIRE' => $get_val + $value_inventaire,
              'ITEMS_INVENTAIRE' => $get_itm + $items_inventaire,
              //'REF_PROVIDERS_INVENTAIRE' => $id_fournisseur,

            );
             
            $save_pos_ibi_inventaires = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id_inventaire), $save_update);

     
       

			

			if ($save_pos_ibi_inventaires) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_inventaires;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_store_1_ibi_inventaires/edit/'.$store.'/' . $save_pos_ibi_inventaires, 'Edit Pos  Ibi Inventaires'),
						anchor('inventaires/'.$store.'/index', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/inventaires/edit/'.$store.'/' . $save_pos_ibi_inventaires, 'Edit Pos Store 1 Ibi Inventaires')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('inventaires/'.$store.'/index');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('inventaires/'.$store.'/index');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pos Store 1 Ibi Inventairess
	*
	* @var $id String
	*/
	public function edit($id)
	{
				$store = $this->uri->segment(2);

		$this->is_allowed('pos_ibi_inventaires_update');
if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
		$this->data['pos_ibi_inventaires'] = $this->model_pos_ibi_inventaires->find($id);

		$this->template->title('Inventaires Update');
			$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;
		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_update', $this->data);
	}

	/**
	* Update Pos Store 1 Ibi Inventairess
	*
	* @var $id String
	*/
	public function edit_save()
	{
		   $store=$this->input->post('store');
		   $id=$this->input->post('id');
		   		if (!$this->is_allowed('pos_store_1_ibi_inventaires_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
	
        $QUANTITY_THEORIQUE_IVI = $this->input->post('QUANTITY_THEORIQUE_IVI');
        $QUANTITY_PHYSIQUE_IVI = $this->input->post('QUANTITY_PHYSIQUE_IVI');
        $CODEBAR = $this->input->post('CODEBAR');
        $ID_IVI = $this->input->post('ID_IVI');
        $DIFF = $this->input->post('DIFF');

$update_ivi = [

              'QUANTITY_THEORIQUE_IVI' => $QUANTITY_THEORIQUE_IVI,
              'QUANTITY_PHYSIQUE_IVI' => $QUANTITY_PHYSIQUE_IVI,
              'DIFF' => $QUANTITY_THEORIQUE_IVI-$QUANTITY_PHYSIQUE_IVI,
              'DATE_MOD_IVI' => date('Y-m-d H:i:s'),
              'MODIFIED_BY_IVI' => get_user_data('id')
          ];

          $get_inventaire = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id));
        
    
        
          $get_inventaire_items = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires_items', array('ID_IVI'=>$ID_IVI,'REF_IVI'=>$id));
        
        $theorique = $QUANTITY_THEORIQUE_IVI - $get_inventaire_items['QUANTITY_THEORIQUE_IVI'];
        $physique = $QUANTITY_PHYSIQUE_IVI - $get_inventaire_items['QUANTITY_PHYSIQUE_IVI'];

   


        $save_update = array(

              'VALUE_INVENTAIRE' => $get_inventaire['VALUE_INVENTAIRE'] + $theorique,
              'ITEMS_INVENTAIRE' => $get_inventaire['ITEMS_INVENTAIRE'] + $physique,

          );
             
        $save_inventaires = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id), $save_update);


        $update_items = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires_items', array('ID_IVI'=>$ID_IVI, 'REF_IVI'=>$id), $update_ivi);




     if ($update_items) {
            $data['inventaires_items'] = $this->db->query('select *from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id);
        }
		echo json_encode($data['inventaires_items']);
	}
	
	/**
	* delete Pos Store 1 Ibi Inventairess
	*
	* @var $id String
	*/
	public function delete($store,$id,$id_ivi)
	{
		$this->is_allowed('pos_ibi_inventaires_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$inputValue = $this->input->post('inputValue');
		$remove = false;
		 // $criteres['ID_IVI'] = $id_ivi;
   //       $table_items='pos_store_'.$store.'_ibi_inventaires_items';

		// if (!empty($id)) {
		// 	$remove = $this->_remove($id,$commentValue);
		// } elseif (count($arr_id) >0) {
		// 	foreach ($arr_id as $id) {
		// 		$remove = $this->_remove($id,$commentValue);
		// 	}
		// }
		
			  
        // $update_article = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires_items', array('CODEBAR_ARTICLE' => $stock_flow['REF_ARTICLE_BARCODE_SF']), array('QUANTITY_ARTICLE' => $article_quantite));

        // $delete_items = array(
        //           'DELETE_STATUS_IVI' => 1,
        //           'DELETE_DATE_IVI' => date('Y-m-d H:i:s'),
        //           'DELETE_BY_IVI' => get_user_data('id'),
        //           'DELETE_COMMENT_IVI' => $CommentValue
        //         );

        // $remove = $this->model_pos_ibi_inventaires->update($table_items, $criteres, $delete_items);

		$data=$this->db->query('update pos_store_'.$store.'_ibi_inventaires_items set DELETE_STATUS_IVI=1,DELETE_DATE_IVI="'.date('Y-m-d H:i:s').'",DELETE_BY_IVI='.get_user_data('id').',DELETE_COMMENT_IVI="'.$inputValue.'" where ID_IVI='.$id_ivi);
		// if ($remove) {
  //           set_message(cclang('has_been_deleted', 'inventaires'), 'success');
  //       } else {
  //           set_message(cclang('error_delete', 'inventaires'), 'error');
  //       }

		// redirect_back();
       
         $get_inventaire = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id));
        
        
         $get_inventaire_items = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires_items', array('ID_IVI'=>$id_ivi));
        
       
  
        $save_update = array(

   'VALUE_INVENTAIRE' => $get_inventaire['VALUE_INVENTAIRE'] - $get_inventaire_items['QUANTITY_THEORIQUE_IVI'],
   'ITEMS_INVENTAIRE' => $get_inventaire['ITEMS_INVENTAIRE'] - $get_inventaire_items['QUANTITY_PHYSIQUE_IVI'],

          );
             
        $save_inventaire = $this->model_pos_ibi_inventaires->update('pos_store_'.$store.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id), $save_update);




		 echo json_encode($data);
	}

		/**
	* View view Pos Store 1 Ibi Inventairess
	*
	* @var $id String
	*/
	public function view()
	{
		$store =$this->uri->segment(2);
		$id=$this->uri->segment(4);
		$this->is_allowed('pos_ibi_inventaires_view');
if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
		$this->data['pos_ibi_inventaires'] = $this->model_pos_ibi_inventaires->join_avaiable()->filter_avaiable()->find($id);
		$getProduit=$this->db->query('select *from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id.' and DELETE_STATUS_IVI=0');
		$this->data['inventaires_items']=$getProduit;
	$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;
		$this->template->title('Inventaires Detail');
		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_view', $this->data);
	}
	
	public function validation(){

         $store=$this->uri->segment(2);
         $id=$this->uri->segment(4);

		$items=$this->db->query('select *from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id.' and DELETE_STATUS_IVI=0 and STATUS_VALIDATION=0');
		foreach ($items->result() as $item) {
			$this->db->query('update pos_store_'.$store.'_ibi_articles set QUANTITY_ARTICLE='.$item->QUANTITY_PHYSIQUE_IVI.' where CODEBAR_ARTICLE="'.$item->BARCODE_IVI.'"');

			$this->db->query('insert into pos_store_'.$store.'_ibi_articles_stock_flow(`REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`,  `TYPE_SF`,  `DATE_CREATION_SF`,`CREATED_BY_SF`)values("'.$item->BARCODE_IVI.'","'.$item->QUANTITY_PHYSIQUE_IVI.'","'.$item->REF_IVI.'","inventory","'.date('Y-m-d H:i:s').'","'.get_user_data('id').'")');

			if($item->DIFF>0){
			$this->db->query('insert into pos_store_'.$store.'_ibi_articles_stock_flow(`REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`,  `TYPE_SF`,  `DATE_CREATION_SF`,`CREATED_BY_SF`)values("'.$item->BARCODE_IVI.'","'.$item->DIFF.'","'.$item->REF_IVI.'","inventory_perte","'.date('Y-m-d H:i:s').'","'.get_user_data('id').'")');
						}
		    if($item->DIFF<0){
		    	$positif_number=abs($item->DIFF);
		    $this->db->query('insert into pos_store_'.$store.'_ibi_articles_stock_flow(`REF_ARTICLE_BARCODE_SF`, `QUANTITE_SF`, `REF_COMMAND_CODE_SF`,  `TYPE_SF`,  `DATE_CREATION_SF`,`CREATED_BY_SF`)values("'.$item->BARCODE_IVI.'","'.$positif_number.'","'.$item->REF_IVI.'","inventory_excedent","'.date('Y-m-d H:i:s').'","'.get_user_data('id').'")');	
		    }


			
		}
		$this->db->query('update pos_store_'.$store.'_ibi_inventaires_items set STATUS_VALIDATION=1 where REF_IVI='.$id.' and DELETE_STATUS_IVI=0 and STATUS_VALIDATION=0');
		     set_message(cclang('La validation a ete effectuer avec success', 'inventaires'), 'success');

		header('Location: ' . $_SERVER['HTTP_REFERER']);
		

	}
	/**
	* delete Pos Store 1 Ibi Inventairess
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_store_1_ibi_inventaires = $this->model_pos_ibi_inventaires->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_store_1_ibi_inventaires",$delete_save,array("ID_INVENTAIRE"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export($store)
	{
		$this->is_allowed('pos_ibi_inventaires_export');

		$this->model_pos_ibi_inventaires->export('pos_store_1_ibi_inventaires', 'pos_store_1_ibi_inventaires');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf($store)
	{
		$this->is_allowed('pos_ibi_inventaires_export');

		$this->model_pos_ibi_inventaires->pdf('pos_store_1_ibi_inventaires', 'pos_store_1_ibi_inventaires');
	}


    public function add_type($prefix)
    {
        $this->is_allowed('pos_ibi_inventaires_add');
      
        $data = array(
            'TITRE_INVENTAIRE' => $this->input->post('titre_inventaire'),
            'DESCRIPTION_INVENTAIRE' => $this->input->post('description'),
            //'TYPE_ARRIVAGE' => $this->input->post('type_approvisionnememt'),
            'DATE_CREATION_INVENTAIRE' => date("Y-m-d H:i:s"),
            'CREATED_BY_INVENTAIRE' => get_user_data('id')
           );
        $save_type = $this->model_pos_ibi_inventaires->insert('pos_store_'.$prefix.'_ibi_inventaires', $data);
        if ($save_type) {
            // $inventaires = $this->model_pos_ibi_inventaires->getList('pos_store_'.$prefix.'_ibi_inventaires', array('DELETE_STATUS_INVENTAIRE'=>0));
$inventaires=$this->db->query('select *from pos_store_'.$prefix.'_ibi_inventaires where DELETE_STATUS_INVENTAIRE=0');
            $resultat = "<option>Choisir un titre</option>";
            foreach ($inventaires->result() as $inventaire) {
                $resultat .= "<option value='".$inventaire->ID_INVENTAIRE."' items='".$inventaire->TYPE_INVENTAIRE."'>".$inventaire->TITRE_INVENTAIRE."</option>";
            }
        }
         echo json_encode($resultat);
    }
      public function update_type_add($prefix)
    {
        $this->is_allowed('pos_ibi_inventaires_update');
        
       // $table = 'pos_store_'.$prefix.'_ibi_type_approvisionnement';
        $id_inventaire = $this->input->post('id_inventaire');

        $data = array(
             'TITRE_INVENTAIRE' => $this->input->post('titre_inventaire'),
            'DESCRIPTION_INVENTAIRE' => $this->input->post('description'),
            //'TYPE_ARRIVAGE' => $this->input->post('type_approvisionnememt'),
            'DATE_CREATION_INVENTAIRE' => date("Y-m-d H:i:s"),
            'CREATED_BY_INVENTAIRE' => get_user_data('id')
           );
        $update_type = $this->model_pos_ibi_inventaires->update('pos_store_'.$prefix.'_ibi_inventaires', array('ID_INVENTAIRE'=>$id_inventaire), $data);
        if ($update_type) {
            $inventaires = $this->model_pos_ibi_inventaires->getList('pos_store_'.$prefix.'_ibi_inventaires', array('DELETE_STATUS_INVENTAIRE'=>0));

            $resultat = "<option>Choisir un titre</option>";
             foreach ($inventaires as $inventaire) {
                if ($inventaire->ID_INVENTAIRE == $id_inventaire) {
                	
                    $resultat .= "<option selected value='".$inventaire->ID_INVENTAIRE
                    ."' items='".$inventaire->TYPE_INVENTAIRE."'>".$inventaire->TITRE_INVENTAIRE
                    ."</option>";
              } else { 
                    $resultat .= "<option value='".$inventaire->ID_INVENTAIRE."' items='".$inventaire->TYPE_INVENTAIRE."'>".$inventaire->TITRE_INVENTAIRE."</option>";
                }
             }
        }
        echo json_encode($resultat);
    }

  public function printing()
	{
		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		$this->is_allowed('pos_ibi_inventaires_print');
if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
             
        }
		$this->template->title('Inventaires print');
$getProduit=$this->db->query('select *from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id.' and DELETE_STATUS_IVI=0');

$getSomme=$this->db->query('select sum(QUANTITY_THEORIQUE_IVI) as QUANTITY_THEORIQUE_IVI,sum(QUANTITY_PHYSIQUE_IVI) as QUANTITY_PHYSIQUE_IVI,sum(DIFF) as DIFF from pos_store_'.$store.'_ibi_inventaires_items where REF_IVI='.$id.' and DELETE_STATUS_IVI=0 ');

$inventaires = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_inventaires',array('ID_INVENTAIRE'=>$id,));
       
         $author = $this->model_pos_ibi_inventaires->getOne('aauth_users',array('id'=> $inventaires['CREATED_BY_INVENTAIRE']));
        

		$this->data['inventaires_items']=$getProduit;
		$this->data['inventaires_sum']=$getSomme;
        $this->data['author'] = $author;
        	$boutique=$this->db->query('select *from pos_ibi_stores where ID_STORE='.$store)->row_array();
        $this->data['boutique']=$boutique;

		$this->render('backend/standart/administrator/pos_ibi_inventaires/pos_ibi_inventaires_print',$this->data);
	}
	 // public function prints($store = 0, $id_arrivage)
  //     {
  //       $this->is_allowed('approvisionnements_print');
  //        if($store == 0){

  //           set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
  //           redirect('administrator/stores');
               
  //         }
    
  //       $arrivages = $this->model_pos_ibi_inventaires->getOne('pos_store_'.$store.'_ibi_arrivages',array('ID_ARRIVAGE'=>$id_arrivage,));
       
  //       $author = $this->model_pos_ibi_inventaires->getOne('aauth_users',array('id'=> $arrivages['CREATED_BY_ARRIVAGE']));
  //       $this->data['author'] = $author;

  //       $stock_flow = $this->db->query('SELECT SUM(QUANTITE_SF) AS QUANTITE, SUM(UNIT_PRICE_SF) AS PRIX_UNITAIRE, SUM(TOTAL_PRICE_SF) AS PRIX_TOTAL FROM pos_store_'.$store.'_ibi_articles_stock_flow WHERE REF_SHIPPING_SF="'.$id_arrivage.'"')->row_array();
  //       $this->data['stock_flow'] = $stock_flow;
  //       $this->data['approvisionnements'] =$this->model_pos_ibi_approvisionnements->get_produit($store, $id_arrivage);

  //       $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_print', $this->data);
  //     }
}

//nturubika rothshild david
/* End of file pos_store_1_ibi_inventaires.php */
/* Location: ./application/controllers/administrator/Pos Store 1 Ibi Inventaires.php */