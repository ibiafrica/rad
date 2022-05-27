<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Hospital Ibi Requisition Controller
*| --------------------------------------------------------------------------
*| Hospital Ibi Requisition site
*|
*/
class Requisition_recu extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_requisition_recu');
		$this->load->model('model_rm');
	}

	/**
	* show all Hospital Ibi Requisitions
	*
	* @var $offset String
	*/
	public function index()
	{   
		$offset = $this->uri->segment(4);
		$store=$this->uri->segment(2);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$this->is_allowed('hospital_ibi_requisition_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['requisition'] = $this->model_requisition_recu->get($filter, $field, $this->limit_page, $offset);
		$this->data['req_counts'] = $this->model_requisition_recu->count_all($filter, $field);

		$config = [
			'base_url'     => 'requisition/'.$store.'/index/',
			'total_rows'   => $this->model_requisition_recu->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Hospital Ibi Requisition List');
		$this->render('backend/standart/administrator/requisition/hospital_ibi_requisition_recu', $this->data);
	}
	
	/**
	* Add new hospital_ibi_requisitions
	*
	*/
	public function add()
	{
        $store=$this->uri->segment(2);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }
        
		$this->is_allowed('hospital_ibi_requisition_add');
       $data['boutiques'] = $this->model_rm->getList('pos_ibi_stores');
		$this->template->title('Hospital Ibi Requisition New');
		$this->render('backend/standart/administrator/requisition/hospital_ibi_requisition_add', $this->data);
	}

	/**
	* Add New Hospital Ibi Requisitions
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('hospital_ibi_requisition_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		

		$this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
		$this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');

		if ($this->form_validation->run()) {
		
			$save_data = [
				'ID_BOUTIQUE_REQ'=>$this->input->post('BOUTIQUE'),
				'TITLE_REQ'=>$this->input->post('TITRE'),
				'DATE_CREATION_REQ'=>date('Y-m-d H:i:s'),
				'CREATED_BY_REQ'=>get_user_data('id'),
				'AUTHOR_REQ'=>get_user_data('id')

			];

			
			$save_id = $this->model_requisition_recu->store($save_data);
			
				for ($i=0; $i < count($_POST['NOM_ARTICLE']) ; $i++) { 
					$data=[
					'NOM_ARTICLE_REQ'=>$_POST['NOM_ARTICLE'][$i],
					'QT_ARTICLE_REQ'=>$_POST['Q_ARTICLE'][$i],
					'PRIX_ARTICLE_REQ'=>$_POST['PRIX_ARTICLE'][$i],
					'TOTAL_ARTICLE_REQ'=>$_POST['TOTAL_ARTICLE'][$i],
					'CODEBAR_ARTICLE_REQ'=>$_POST['CODE'][$i],
					'ID_REQ'=>$save_id
				];

				$ins=$this->model_rm->insert('hospital_ibi_article_requisition',$data);

				}
				
			

			if ($save_id) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_id;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/hospital_ibi_requisition/edit/' . $save_id, 'Edit Hospital Ibi Requisition'),
						anchor('administrator/hospital_ibi_requisition', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/hospital_ibi_requisition/edit/' . $save_id, 'Edit Hospital Ibi Requisition')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/requisition');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/requisition');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Hospital Ibi Requisitions
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('hospital_ibi_requisition_update');

		$this->data['requisition'] = $this->model_requisition_recu->find($id);
        $this->data['articles']=$this->model_rm->getList('hospital_ibi_article_requisition', array('ID_REQ'=>$id));
		$this->template->title('Hospital Ibi Requisition Update');
		$this->render('backend/standart/administrator/requisition/hospital_ibi_requisition_update', $this->data);
	}

	/**
	* Update Hospital Ibi Requisitions
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('hospital_ibi_requisition_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		
		$this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
		$this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');

		if ($this->form_validation->run()) {
		
			$save_data = [
				'ID_BOUTIQUE_REQ'=>$this->input->post('BOUTIQUE'),
				'TITLE_REQ'=>$this->input->post('TITRE'),
				'DATE_MOD_REQ'=>date('Y-m-d H:i:s'),
				'MODIFIED_BY_REQ'=>get_user_data('id'),

			];

			
			$save_id = $this->model_requisition_recu->change($id, $save_data);
			$del=$this->model_rm->delete('hospital_ibi_article_requisition', array('ID_REQ'=>$id));
			
				for ($i=0; $i < count($_POST['NOM_ARTICLE']) ; $i++) { 
					$data=[
					'NOM_ARTICLE_REQ'=>$_POST['NOM_ARTICLE'][$i],
					'QT_ARTICLE_REQ'=>$_POST['Q_ARTICLE'][$i],
					'PRIX_ARTICLE_REQ'=>$_POST['PRIX_ARTICLE'][$i],
					'TOTAL_ARTICLE_REQ'=>$_POST['TOTAL_ARTICLE'][$i],
					'CODEBAR_ARTICLE_REQ'=>$_POST['CODE'][$i],
					'ID_REQ'=>$id
				];

				$ins=$this->model_rm->insert('hospital_ibi_article_requisition',$data);

				}
				
			if ($save_id) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/requisition', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/requisition');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/requisition');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Hospital Ibi Requisitions
	*
	* @var $id String
	*/
	public function delete($id = null, $msg=null)
	{

		$this->is_allowed('hospital_ibi_requisition_delete');

		$this->load->helper('file');
        
        // echo htmlspecialchars($msg); exit();
		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->model_rm->update('hospital_ibi_requisition',array('ID_REQ'=>$id), array('DELETE_STATUS_REQ'=>1,
			          'DELETE_DATE_REQ'=>date('Y-m-d H:i:s'),
			          'DELETED_COMMENTS_REQ'=>$msg,
			          'DELETED_BY_REQ'=>get_user_data('id')
		));
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->model_rm->update('hospital_ibi_requisition',array('ID_REQ'=>$id), array('DELETE_STATUS_REQ'=>1,
			          'DELETE_DATE_REQ'=>date('Y-m-d H:i:s'),
			          'DELETED_COMMENTS_REQ'=>$msg,
			          'DELETED_BY_REQ'=>get_user_data('id')
		));
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'hospital_ibi_requisition'), 'success');
        } else {
            set_message(cclang('error_delete', 'hospital_ibi_requisition'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Hospital Ibi Requisitions
	*
	* @var $id String
	*/
	
	/**
	* delete Hospital Ibi Requisitions
	*
	* @var $id String
	*/
	

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('hospital_ibi_requisition_export');

		$this->model_requisition_recu->pdf('hospital_ibi_requisition', 'hospital_ibi_requisition');
	}

	public function getArticles(){
		$id=$this->input->post('id');
		$data=$this->model_rm->getList('pos_store_'.$id.'_ibi_articles', array('DELETE_STATUS_ARTICLE'=>0));
		echo json_encode($data);
	}

	public function getNotify(){
	 $status=$this->input->post('status');
	 $store=$this->input->post('store');
	 $data['recu']=$this->model_rm->getRequete('
	 	SELECT NAME_STORE, ID_REQ FROM hospital_ibi_requisition AS R
        LEFT JOIN pos_ibi_stores AS S
        ON R.FROM_STORE=S.ID_STORE
	 	WHERE DESTINATION_STORE_REQ='.$store.' AND STATUS_REQ=0 AND STATUS_NOTIFY_REQ=0 AND DELETE_STATUS_REQ=0');

	 $data['feed']=$this->model_rm->getRequete('SELECT A.ID_REQ, NOM_ARTICLE_REQ, QT_ARTICLE_REQ,NAME_STORE,A.STATUS_PROD_REQ
		FROM hospital_ibi_requisition AS R 
		LEFT JOIN hospital_ibi_article_requisition AS A
		ON R.ID_REQ=A.ID_REQ
		LEFT JOIN pos_ibi_stores AS S
		ON R.DESTINATION_STORE_REQ=S.ID_STORE
		WHERE R.FROM_STORE='.$store.' AND A.STATUS_PROD_REQ!=0 AND A.STATUS_NOTIFY_ARTICLE=0');

	 $data['feedTrans']=$this->model_rm->getRequete('SELECT TITLE_ST, ID_ST, NAME_STORE, APPROUVED_ST FROM pos_store_1_ibi_stock_transfert AS T 
	 LEFT JOIN pos_ibi_stores AS S ON T.DESTINATION_STORE_ST=S.ID_STORE 
	  WHERE FROM_STORE_ST='.$store.' AND APPROUVED_ST!=0 AND STATUS_NOTIFY_TS=0');

	 $data['trans']=$this->model_rm->getRequete('SELECT ID_ST, NAME_STORE, APPROUVED_ST FROM pos_store_1_ibi_stock_transfert AS T
	 LEFT JOIN pos_ibi_stores AS S ON T.FROM_STORE_ST=S.ID_STORE
	  WHERE T.DESTINATION_STORE_ST='.$store.' AND T.APPROUVED_ST=0 AND DELETE_STATUS_ST=0 AND STATUS_NOTIFY_TS=0');


	 echo json_encode($data);
	}
  

    public function updateNotify(){
     $store=$this->input->post('store');
     $up=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('FROM_STORE_ST'=>$store), array('STATUS_NOTIFY_TS'=>1));
      
     $upreq=$this->model_rm->getUpdate('
     	UPDATE hospital_ibi_article_requisition A,
     	       hospital_ibi_requisition R 
     	SET A.STATUS_NOTIFY_ARTICLE=1
     	
		WHERE R.ID_REQ=A.ID_REQ AND R.FROM_STORE='.$store.' AND A.STATUS_PROD_REQ!=0 ');
    }


	public function approbation(){
		$store=$this->uri->segment(2);
		$id=$this->uri->segment(4);
        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $check=$this->model_rm->getOne('hospital_ibi_requisition', array('ID_REQ'=>$id))['DESTINATION_STORE_REQ'];
       
        if ($check==$store OR $check==0) {
            
        

        $this->model_rm->update('hospital_ibi_requisition',array('ID_REQ'=>$id), array('STATUS_NOTIFY_REQ'=>1));

		$this->is_allowed('hospital_ibi_requisition_view');

		$this->data['requisition'] = $this->model_requisition_recu->join_avaiable()->filter_avaiable()->find($id);
        $this->data['produits']=$this->model_rm->getList('hospital_ibi_article_requisition', array('ID_REQ'=>$id));

		$this->template->title('Hospital Ibi Requisition Detail');
		$this->render('backend/standart/administrator/requisition/hospital_ibi_requisition_approbation', $this->data);

		}else{
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
	            redirect('administrator/stores');
		}

	}

	public function getProduct(){
		
        $idreq=$this->input->post('id');
        $code=$this->input->post('code');
        $action=$this->input->post('action');
        $store=$this->input->post('store');
        $qt=$this->input->post('qt');
        $unit_prix=$this->input->post('unit_prix');
        $nom=$this->input->post('nom');

        $data=array();
        


        $reqInfo=$this->model_rm->getOne('hospital_ibi_requisition', array('ID_REQ'=>$idreq));


        if ($reqInfo['DELETE_STATUS_REQ']==1) {
	     	$data['req']=[];
	        $data['msg']='error_stat';
	        echo json_encode($data);
	        exit();

       }

        
        if (isset($action) AND !empty($action)) {

 	
        	
        		if ($action!='rejetter') {
                    
	                 $checkQt=$this->model_rm->getOne('pos_store_'.$store.'_ibi_articles', array('CODEBAR_ARTICLE'=>$code))['QUANTITY_ARTICLE'];

	                 if ($qt>$checkQt) {
	                 	$data['req']=$this->getAllData($store,$idreq);
		                $data['msg']='error';
		                echo json_encode($data);
		                exit();

	                 }

	                 

        			$boutique1=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-'.$qt.') WHERE CODEBAR_ARTICLE="'.$code.'"  ');

        			$insertflow=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', array(
        				'REF_COMMAND_CODE_SF'=>$reqInfo['CODE_REQ'],
        				'REF_ARTICLE_BARCODE_SF'=>$code,
        				'QUANTITE_SF'=>$qt,
        				'TYPE_SF'=>'transfert_out',
        				'UNIT_PRICE_SF'=>$unit_prix,
        				'TOTAL_PRICE_SF'=>$unit_prix*$qt,
        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
        				'CREATED_BY_SF'=>get_user_data('id')
        			));

                    //verifie si le type de la requisition c'est pour une boutique ou pour un patient
        			if (empty($reqInfo['PATIENT']) OR $reqInfo['PATIENT']==0) {


        			$idBoutiq=$this->model_rm->getOne('hospital_ibi_requisition', array('ID_REQ'=>$idreq))['FROM_STORE'];
        			//check if article exist, if it exists quantity will be updated and if not , article will be created

        			 $chek=$this->model_rm->getOne('pos_store_'.$idBoutiq.'_ibi_articles', array('CODEBAR_ARTICLE'=>$code));
        			 if ($chek) {
        			 	$upqt=$this->model_rm->getUpdate('UPDATE pos_store_'.$idBoutiq.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+'.$qt.') WHERE CODEBAR_ARTICLE="'.$code.'"  ');

        			 	$flow=$this->model_rm->insert('pos_store_'.$idBoutiq.'_ibi_articles_stock_flow', array(
        				'REF_COMMAND_CODE_SF'=>$reqInfo['CODE_REQ'],
        				'REF_ARTICLE_BARCODE_SF'=>$code,
        				'QUANTITE_SF'=>$qt,
        				'TYPE_SF'=>'transfert_in',
        				'UNIT_PRICE_SF'=>$unit_prix,
        				'TOTAL_PRICE_SF'=>$unit_prix*$qt,
        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
        				'CREATED_BY_SF'=>get_user_data('id')
        			));
        			 }else{
        			 	$insert=$this->model_rm->insert('pos_store_'.$idBoutiq.'_ibi_articles',
        			 		array(
        			 			'DESIGN_ARTICLE'=>$nom,
        			 			'CODEBAR_ARTICLE'=>$code,
        			 			'PRIX_DE_VENTE_ARTICLE'=>$unit_prix,
        			 			'QUANTITY_ARTICLE'=>$qt,
        			 			'DATE_CREATION_ARTICLE'=>date('Y-m-d H:i:s'),
        			 			'CREATED_BY_ARTICLE'=>get_user_data('id') 
        			 		));

        			 	$flow2=$this->model_rm->insert('pos_store_'.$idBoutiq.'_ibi_articles_stock_flow', array(
        				'REF_COMMAND_CODE_SF'=>$reqInfo['CODE_REQ'],
        				'REF_ARTICLE_BARCODE_SF'=>$code,
        				'QUANTITE_SF'=>$qt,
        				'TYPE_SF'=>'transfert_in',
        				'UNIT_PRICE_SF'=>$unit_prix,
        				'TOTAL_PRICE_SF'=>$unit_prix*$qt,
        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
        				'CREATED_BY_SF'=>get_user_data('id')
        			));
        			 }
        			
        			}//endif type requisition
        			else{

                      $comand=$this->model_rm->getOne('pos_store_'.$store.'_ibi_commandes', array('CODE'=>$reqInfo['CODE_REQ']));

                      if ($comand) {
                      	$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_commandes SET TOTAL=(TOTAL+'.$unit_prix*$qt.') WHERE ID_HOSPITAL_IBI_COMMANDES='.$comand['ID_HOSPITAL_IBI_COMMANDES'].'');
                      	    $idComande=$comand['ID_HOSPITAL_IBI_COMMANDES'];

                      }else{
                       $idComande= $this->model_rm->insert_last_id('pos_store_'.$store.'_ibi_commandes',array(
                        	'TITRE'=>$reqInfo['TITLE_REQ'],
                        	'CODE'=>$reqInfo['CODE_REQ'],
                        	'PATIENT_FILE_ID_HOSPITAL_IBI_COMMANDES'=>$reqInfo['PATIENT'],
                        	'TOTAL'=>$unit_prix*$qt,
                        	'DATE_CREATION_HOSPITAL_IBI_COMMANDES'=>date('Y-m-d H:i:s'),
                        	'CREATED_BY_HOSPITAL_IBI_COMMANDES'=>get_user_data('id'),
                        ));

                      }

                      $ins_prod=$this->model_rm->insert(' pos_store_'.$store.'_ibi_commandes_produits',array(
                      	'REF_PRODUCT_CODEBAR'=>$code,
                      	'REF_COMMAND_CODE'=>$reqInfo['CODE_REQ'],
                      	'HOSPITAL_IBI_COMMANDES_ID'=>$idComande,
                      	'QUANTITE'=>$qt,
                      	'PRIX'=>$unit_prix,
                      	'PRIX_TOTAL'=>$unit_prix*$qt,
                      	'DISCOUNT_TYPE'=>'percentage',
                      	'NAME'=>$nom,
                      	'DEPARTMENT'=>18,
                      	'CREATED_BY_HOSPITAL_IBI_COMMANDES_PRODUITS'=>get_user_data('id'),
                      	'DATE_COMMANDE_PRODUITS'=>date('Y-m-d H:i:s'),
                      	'DATE_CREATION_HOSPITAL_IBI_COMMANDES_PRODUITS'=>date('Y-m-d H:i:s')
                      ));



        			}

        			

        		}//endif action !=rejetter


        		if ($action=='rejetter') {
	        		$statut=2;
	        		$data['msg']='annulation reussie avec success';
	        	}else{
	        		 $statut=1;
	        		 $data['msg']='approbation reussie avec success';
	        	}

        		$up=$this->model_rm->update('hospital_ibi_article_requisition', array('CODEBAR_ARTICLE_REQ'=>$code, 'ID_REQ'=>$idreq),array('STATUS_PROD_REQ'=>$statut, 'APROUVED_BY_PROD_REQ'=>get_user_data('id'),'QT_ARTICLE_REQ'=>$qt, 'APROUVED_BY_STORE'=>$store));

               //UPDATE LE STATUT DE LA REQUISITION (ENCOURS, APPROUVER, REJETER)
        		// $upReq=$this->model_rm->countrows('hospital_ibi_article_requisition',array('ID_REQ'=>$idreq));
                 
                 
        		$DataReq=$this->model_rm->getList('hospital_ibi_article_requisition',array('ID_REQ'=>$idreq));

        		$confirm=0;
        		foreach ($DataReq as $key ) {
        		   if ($key['STATUS_PROD_REQ']==1 OR $key['STATUS_PROD_REQ']==2) {
        		   	$confirm+=1;
        		   }
        		}

        		if ($confirm==count($DataReq)) {
        			$this->model_rm->update('hospital_ibi_requisition', array('ID_REQ'=>$idreq), array('STATUS_REQ'=>1));
        		}

        		 if($confirm>0 AND $confirm<count($DataReq)) {
        			$this->model_rm->update('hospital_ibi_requisition', array('ID_REQ'=>$idreq), array('STATUS_REQ'=>3));
        		}

        		

        }

			 $data['req']=$this->getAllData($store,$idreq);
			 echo json_encode($data);

	}


	public function getAllData($store, $idreq){

			return $this->model_rm->getRequete('SELECT ID_ARTICLE_REQ, DESIGN_ARTICLE, QT_ARTICLE_REQ, CODEBAR_ARTICLE_REQ, APROUVED_RETOUR_ARTICLE_BY,APROUVED_BY_STORE, QT_RETOUR_ARTICLE_REQ, QUANTITY_ARTICLE, ID_REQ, full_name, STATUS_PROD_REQ, PRIX_DE_VENTE_ARTICLE FROM hospital_ibi_article_requisition AS R 
				
				LEFT JOIN pos_store_'.$store.'_ibi_articles AS A ON R.CODEBAR_ARTICLE_REQ=A.CODEBAR_ARTICLE
				LEFT JOIN aauth_users AS U ON R.APROUVED_BY_PROD_REQ=U.id
				WHERE R.ID_REQ='.$idreq.' AND A.DELETE_STATUS_ARTICLE=0');
	}


	public function returnQ(){
		$idreq=$this->input->post('idreq');
        $idR=$this->input->post('idR');
        $store=$this->input->post('store');

        $getR=$this->model_rm->getOne('hospital_ibi_requisition', array('ID_REQ'=>$idR));

		$getArticle=$this->model_rm->getOne('hospital_ibi_article_requisition', array('ID_ARTICLE_REQ'=>$idreq));


        //ajout des quantites retournees dans la boutique
		$add_qt_currentB=$this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+'.$getArticle['QT_RETOUR_ARTICLE_REQ'].') WHERE CODEBAR_ARTICLE="'.$getArticle['CODEBAR_ARTICLE_REQ'].'"  ');

			$insertflow=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', array(
				'REF_COMMAND_CODE_SF'=>$getR['CODE_REQ'],
				'REF_ARTICLE_BARCODE_SF'=>$getArticle['CODEBAR_ARTICLE_REQ'],
				'QUANTITE_SF'=>$getArticle['QT_RETOUR_ARTICLE_REQ'],
				'TYPE_SF'=>'transfert_in',
				'UNIT_PRICE_SF'=>$getArticle['PRIX_ARTICLE_REQ'],
				'TOTAL_PRICE_SF'=>$getArticle['QT_RETOUR_ARTICLE_REQ']*$getArticle['PRIX_ARTICLE_REQ'],
				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
				'CREATED_BY_SF'=>get_user_data('id')
			));
            
            //verifier si la requision est de type patient
			if (empty($getR['PATIENT']) OR $getR['PATIENT']==0) {
				 
              //soustraire la quantite dans la boutique qui retourne le produit
            $sub_qt_Boutique=$this->model_rm->getUpdate('UPDATE pos_store_'.$getR['FROM_STORE'].'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-'.$getArticle['QT_RETOUR_ARTICLE_REQ'].') WHERE CODEBAR_ARTICLE="'.$getArticle['CODEBAR_ARTICLE_REQ'].'"  ');

			$insertflow=$this->model_rm->insert('pos_store_'.$getR['FROM_STORE'].'_ibi_articles_stock_flow', array(
				'REF_COMMAND_CODE_SF'=>$getR['CODE_REQ'],
				'REF_ARTICLE_BARCODE_SF'=>$getArticle['CODEBAR_ARTICLE_REQ'],
				'QUANTITE_SF'=>$getArticle['QT_RETOUR_ARTICLE_REQ'],
				'TYPE_SF'=>'transfert_out',
				'UNIT_PRICE_SF'=>$getArticle['PRIX_ARTICLE_REQ'],
				'TOTAL_PRICE_SF'=>$getArticle['QT_RETOUR_ARTICLE_REQ']*$getArticle['PRIX_ARTICLE_REQ'],
				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
				'CREATED_BY_SF'=>get_user_data('id')
			));

			}else{
           
                  $this->model_rm->getUpdate('UPDATE pos_store_'.$store.'_ibi_commandes SET TOTAL=(TOTAL-'.$getArticle['PRIX_ARTICLE_REQ']*$getArticle['QT_RETOUR_ARTICLE_REQ'].') WHERE CODE="'.$getR['CODE_REQ'].'" ');
                  
                 $update_prod=$this->model_rm->getUpdate('UPDATE  pos_store_'.$store.'_ibi_commandes_produits SET PRIX_TOTAL=(PRIX_TOTAL-'.$getArticle['PRIX_ARTICLE_REQ']*$getArticle['QT_RETOUR_ARTICLE_REQ'].'), QUANTITE=(QUANTITE-'.$getArticle['QT_RETOUR_ARTICLE_REQ'].') WHERE REF_PRODUCT_CODEBAR="'.$getArticle['CODEBAR_ARTICLE_REQ'].'" AND REF_COMMAND_CODE="'.$getR['CODE_REQ'].'" ');

    			

			}

       


        //update la requisition en ajoutant l'utilisateur qui a aprouve
	    $up=$this->model_rm->update('hospital_ibi_article_requisition', array('ID_ARTICLE_REQ'=>$idreq), array('APROUVED_RETOUR_ARTICLE_BY'=>get_user_data('id')));


	    if ($up) {
	    	echo json_encode(array('msg'=>'approbation reussi avec success'));
	    }
	}

	
}



/* End of file hospital_ibi_requisition.php */
/* Location: ./application/controllers/administrator/Hospital Ibi Requisition.php */