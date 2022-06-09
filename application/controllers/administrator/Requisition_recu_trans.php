<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Ibi Requisition Controller
 *| --------------------------------------------------------------------------
 *| Pos Ibi Requisition site
 *|
 */
class Requisition_recu_trans extends Admin
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_requisition_recu_trans');
		$this->load->model('model_rm');
	}

	/**
	 * show all Pos Ibi Requisitions
	 *
	 * @var $offset String
	 */
	public function index()
	{
		$offset = $this->uri->segment(4);
		$store = $this->uri->segment(2);
		if ($store == 0) {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$this->is_allowed('pos_ibi_requisition_trans_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['requisition'] = $this->model_requisition_recu_trans->get($filter, $field, $this->limit_page=100, $offset);
		$this->data['req_counts'] = $this->model_requisition_recu_trans->count_all($filter, $field);

		$config = [
			'base_url'     => 'requisition_recu_trans/' . $store . '/index/',
			'total_rows'   => $this->model_requisition_recu_trans->count_all($filter, $field),
			'per_page'     => $this->limit_page=100,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Ibi Requisition List');
		$this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_recu', $this->data);
	}




	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_requisition_trans_export');

		$this->model_requisition_recu_trans->pdf('pos_ibi_requisition_trans', 'pos_ibi_requisition_trans');
	}



	public function approbation()
	{
		$this->is_allowed('pos_ibi_requisition_trans_view');

		$store = $this->uri->segment(2);
		$id = $this->uri->segment(4);
		if ($store == 0) {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}

		$check = $this->model_rm->getOne('pos_ibi_requisition_trans', array('ID_REQ' => $id))['DESTINATION_STORE_REQ'];

		if ($check == $store or $check == 0) {



			$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $id), array('STATUS_NOTIFY_REQ' => 1));

			$this->data['requisition'] = $this->model_requisition_recu_trans->join_avaiable()->filter_avaiable()->find($id);
			$this->data['produits'] = $this->getAllData($store,$id);

			$this->template->title('Pos Ibi Requisition Detail');
			$this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_approbation', $this->data);
		} else {
			set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/stores');
		}
	}

	
	public function Approuver($idreq,$action,$store,$qt){
		
       $reqInfo = $this->model_rm->getOne('pos_ibi_article_requisition_trans', array('ID_ARTICLE_REQ' => $idreq));
        
        $requisition=$this->model_rm->getOne('pos_ibi_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']));


		   if ($reqInfo['STATUS_PROD_REQ'] != 0) {
				set_message('Impossible d\'approuver cette requisition ', 'error');
			    redirect_back();
				exit();
			}

              
		   if ($action=='reject') {

		  	 $upstatut = $this->db->query('UPDATE pos_ibi_article_requisition_trans SET STATUS_PROD_REQ=2, APROUVED_BY_PROD_REQ='.get_user_data("id").' WHERE ID_ARTICLE_REQ='.$idreq.' ');


		  	 if ($upstatut) {

                	$DataReq = $this->model_rm->getList('pos_ibi_article_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']));

						
						$refuser=0;
						foreach ($DataReq as $key) {

							if ($key['STATUS_PROD_REQ'] == 2) {
								$refuser += 1;
							}


						}


						if ($refuser == count($DataReq)) {
						$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']), array('STATUS_REQ' => 2));
					}

					if ($refuser > 0 AND $refuser < count($DataReq)) {
						$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']), array('STATUS_REQ' => 3));
					}

                	
                	set_message('Requisition rejetee', 'success');
		            	
                }
		 		
		   }	


		   if ($action =='aprouver') {

				$article = $this->model_rm->getOne('pos_store_' . $store . '_ibi_articles', array('CODEBAR_ARTICLE' => $reqInfo['CODEBAR_ARTICLE_REQ']));

				if ($qt > $article['QUANTITY_ARTICLE']) {
					set_message('la quantité insuffisante', 'error');
		            redirect_back();
					exit();
				}

				$boutique1 = $this->model_rm->getUpdate('UPDATE pos_store_' . $store . '_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-' .$qt. ') WHERE CODEBAR_ARTICLE="' .$reqInfo['CODEBAR_ARTICLE_REQ']. '"  ');

				$insertflow = $this->model_rm->insert('pos_store_' .$store. '_ibi_articles_stock_flow', array(
					'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
					'REF_ARTICLE_BARCODE_SF' =>$reqInfo['CODEBAR_ARTICLE_REQ'],
					'QUANTITE_SF' => $qt,
					'TYPE_SF' => 'transfert_out',
					'UNIT_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'],
					'TOTAL_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'] * $qt,
					'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
					'CREATED_BY_SF' => get_user_data('id')
				));

				//check if article exist, if it exists quantity will be updated and if not , article will be created

				$chek = $this->model_rm->getOne('pos_store_' . $requisition['FROM_STORE'] . '_ibi_articles', array('CODEBAR_ARTICLE' => $reqInfo['CODEBAR_ARTICLE_REQ']));

				if ($chek) {

					//GESTION QUANTITE
					$upqt = $this->model_rm->getUpdate('UPDATE pos_store_' . $requisition['FROM_STORE'].'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+' .$qt. ')
        			 	    WHERE CODEBAR_ARTICLE="' .$reqInfo['CODEBAR_ARTICLE_REQ']. '"  ');

					$flow = $this->model_rm->insert('pos_store_' .$requisition['FROM_STORE'].'_ibi_articles_stock_flow', array(
					'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
					'REF_ARTICLE_BARCODE_SF' =>$reqInfo['CODEBAR_ARTICLE_REQ'],
					'QUANTITE_SF' => $qt,
					'TYPE_SF' => 'transfert_in',
					'UNIT_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'],
					'TOTAL_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'] * $qt,
					'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
					'CREATED_BY_SF' => get_user_data('id')
				));

				

				} else {
					$insert = $this->model_rm->insert(
						'pos_store_' . $requisition['FROM_STORE'] . '_ibi_articles',
						array(
							'IS_INGREDIENT' => $article['IS_INGREDIENT'],
							'ETAT_INGREDIENT_ARTICLE' => $article['ETAT_INGREDIENT_ARTICLE'],
							'UNITE_ARTICLE' => $article['UNITE_ARTICLE'],
							'DESIGN_ARTICLE' => $article['DESIGN_ARTICLE'],
							'CODEBAR_ARTICLE' => $article['CODEBAR_ARTICLE'],
							'PRIX_DACHAT_ARTICLE' => $reqInfo['PRIX_ARTICLE_REQ'],
							'ETAT_TVA' =>$article['ETAT_TVA'],
							'PRIX_DE_VENTE_ARTICLE' =>$article['PRIX_DE_VENTE_ARTICLE'],
							'QUANTITY_ARTICLE' => $qt,
							'STORE_ID_ARTICLE' => $requisition['FROM_STORE'],
							'DATE_CREATION_ARTICLE' => date('Y-m-d H:i:s'),
							'CREATED_BY_ARTICLE' => get_user_data('id')
						)
					);


						$flow2 = $this->model_rm->insert('pos_store_' .$requisition['FROM_STORE']. '_ibi_articles_stock_flow', array(
						'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
						'REF_ARTICLE_BARCODE_SF' =>$reqInfo['CODEBAR_ARTICLE_REQ'],
						'QUANTITE_SF' => $qt,
						'TYPE_SF' => 'transfert_in',
						'UNIT_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'],
						'TOTAL_PRICE_SF' => $reqInfo['PRIX_ARTICLE_REQ'] * $qt,
						'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
						'CREATED_BY_SF' => get_user_data('id')
						)
					 );

					
				 }

				 $upstatut = $this->db->query('UPDATE pos_ibi_article_requisition_trans SET STATUS_PROD_REQ=1,QT_ARTICLE_REQ='.$qt.', APROUVED_BY_PROD_REQ='.get_user_data("id").' WHERE ID_ARTICLE_REQ='.$idreq.' ');

                if ($upstatut) {

                	$DataReq = $this->model_rm->getList('pos_ibi_article_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']));

						$confirm = 0;
						
						foreach ($DataReq as $key) {
							if ($key['STATUS_PROD_REQ'] == 1 or $key['STATUS_PROD_REQ'] == 2) {
								$confirm += 1;
							}


						}

						if ($confirm == count($DataReq)) {
							$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']), array('STATUS_REQ' => 1,'APROUVED_BY_REQ' => get_user_data('id')));
						}

						if ($confirm > 0 AND $confirm < count($DataReq)) {
						$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $reqInfo['ID_REQ']), array('STATUS_REQ' => 3));
					}

                	set_message('Requisition approuvee', 'success');
					
                }




			
			    

			
			} //END IF ACTION==APROUVER


			redirect_back();


	}

	public function aprouveAll($ids=null){

	  $arr_id = $this->input->get('produits');
	  $store = $this->input->get('store');
	  $id_req = $this->input->get('id_req');
	  $qt = $this->input->get('qt');
      
      
    	$requisition=$this->model_rm->getOne('pos_ibi_requisition_trans', array('ID_REQ' => $id_req));

		for ($i=0; $i < count($arr_id); $i++ ){

			  $key=$this->model_rm->getOne('pos_ibi_article_requisition_trans', array('ID_ARTICLE_REQ'=>$arr_id[$i]));

			  $article = $this->model_rm->getOne('pos_store_' . $store . '_ibi_articles', array('CODEBAR_ARTICLE' => $key['CODEBAR_ARTICLE_REQ']));

			   if ($key['STATUS_PROD_REQ']==0 AND $qt[$i] <= $article['QUANTITY_ARTICLE']) {
			  
			

				$boutique1 = $this->model_rm->getUpdate('UPDATE pos_store_' . $store . '_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-' .$qt[$i]. ') WHERE CODEBAR_ARTICLE="' .$key['CODEBAR_ARTICLE_REQ']. '"  ');

				$insertflow = $this->model_rm->insert('pos_store_' .$store. '_ibi_articles_stock_flow', array(
					'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
					'REF_ARTICLE_BARCODE_SF' =>$key['CODEBAR_ARTICLE_REQ'],
					'QUANTITE_SF' => $qt[$i],
					'TYPE_SF' => 'transfert_out',
					'UNIT_PRICE_SF' => $key['PRIX_ARTICLE_REQ'],
					'TOTAL_PRICE_SF' => $key['PRIX_ARTICLE_REQ'] * $qt[$i],
					'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
					'CREATED_BY_SF' => get_user_data('id')
				));

				//check if article exist, if it exists quantity will be updated and if not , article will be created

				$chek = $this->model_rm->getOne('pos_store_' . $requisition['FROM_STORE'] . '_ibi_articles', array('CODEBAR_ARTICLE' => $key['CODEBAR_ARTICLE_REQ']));

				if ($chek) {

					//GESTION QUANTITE
					$upqt = $this->model_rm->getUpdate('UPDATE pos_store_' . $requisition['FROM_STORE'].'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+' .$qt[$i]. ')
        			 	    WHERE CODEBAR_ARTICLE="' .$key['CODEBAR_ARTICLE_REQ']. '"  ');

					$flow = $this->model_rm->insert('pos_store_' .$requisition['FROM_STORE'].'_ibi_articles_stock_flow', array(
					'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
					'REF_ARTICLE_BARCODE_SF' =>$key['CODEBAR_ARTICLE_REQ'],
					'QUANTITE_SF' => $qt[$i],
					'TYPE_SF' => 'transfert_in',
					'UNIT_PRICE_SF' => $key['PRIX_ARTICLE_REQ'],
					'TOTAL_PRICE_SF' => $key['PRIX_ARTICLE_REQ'] * $qt[$i],
					'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
					'CREATED_BY_SF' => get_user_data('id')
				));

				

				} else {
					$insert = $this->model_rm->insert(
						'pos_store_' . $requisition['FROM_STORE'] . '_ibi_articles',
						array(
							'IS_INGREDIENT' => $article['IS_INGREDIENT'],
							'ETAT_INGREDIENT_ARTICLE' => $article['ETAT_INGREDIENT_ARTICLE'],
							'UNITE_ARTICLE' => $article['UNITE_ARTICLE'],
							'DESIGN_ARTICLE' => $article['DESIGN_ARTICLE'],
							'CODEBAR_ARTICLE' => $article['CODEBAR_ARTICLE'],
							'PRIX_DACHAT_ARTICLE' => $key['PRIX_ARTICLE_REQ'],
							'PRIX_DE_VENTE_ARTICLE' =>$article['PRIX_DE_VENTE_ARTICLE'],
							'ETAT_TVA' =>$article['ETAT_TVA'],
							'QUANTITY_ARTICLE' => $qt[$i],
							'STORE_ID_ARTICLE' => $requisition['FROM_STORE'],
							'DATE_CREATION_ARTICLE' => date('Y-m-d H:i:s'),
							'CREATED_BY_ARTICLE' => get_user_data('id')
						)
					);


						$flow2 = $this->model_rm->insert('pos_store_' .$requisition['FROM_STORE']. '_ibi_articles_stock_flow', array(
						'REF_COMMAND_CODE_SF' => $requisition['CODE_REQ'],
						'REF_ARTICLE_BARCODE_SF' =>$key['CODEBAR_ARTICLE_REQ'],
						'QUANTITE_SF' => $qt[$i],
						'TYPE_SF' => 'transfert_in',
						'UNIT_PRICE_SF' => $key['PRIX_ARTICLE_REQ'],
						'TOTAL_PRICE_SF' => $key['PRIX_ARTICLE_REQ'] * $qt[$i],
						'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
						'CREATED_BY_SF' => get_user_data('id')
						)
					 );

					
				 }

				 $upstatut = $this->db->query('UPDATE pos_ibi_article_requisition_trans SET STATUS_PROD_REQ=1,QT_ARTICLE_REQ='.$qt[$i].', APROUVED_BY_PROD_REQ='.get_user_data("id").' WHERE ID_ARTICLE_REQ='.$key['ID_ARTICLE_REQ'].' ');

           }//ENDIF STATUS REQ=0

		}

		$DataReq = $this->model_rm->getList('pos_ibi_article_requisition_trans', array('ID_REQ' =>$id_req));

			$confirm = 0;
			foreach ($DataReq as $key) {
				if ($key['STATUS_PROD_REQ'] == 1 or $key['STATUS_PROD_REQ'] == 2) {
					$confirm += 1;
				}
			}

			if ($confirm == count($DataReq)) {
				$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $id_req), array('STATUS_REQ' => 1,'APROUVED_BY_REQ' => get_user_data('id')));
			}

			/*if ($confirm > 0 AND $confirm < count($DataReq)) {
				$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $id_req), array('STATUS_REQ' => 3));
			}*/

       /*$upReq=$this->model_rm->update('pos_ibi_requisition_trans', array('ID_REQ' => $id_req), array('STATUS_REQ' => 1));*/

       /*if ($upReq) {
       	set_message('toutes les articles ont ete approuvee', 'success');
       	
       }else{
          set_message('approbation echouee', 'warning');
       }*/

       redirect(base_url('requisition_recu_trans/'.$store.'/approbation/'.$id_req));

	}

	


	public function getAllData($store, $idreq)
	{

		return $this->model_rm->getRequete('
        SELECT 
         *
          FROM pos_store_' . $store . '_ibi_articles  AS T
          LEFT JOIN pos_ibi_article_requisition_trans AS R   
          ON R.CODEBAR_ARTICLE_REQ=T.CODEBAR_ARTICLE
          
          LEFT JOIN aauth_users AS U ON R.APROUVED_BY_PROD_REQ=U.id
          
          WHERE R.ID_REQ=' . $idreq . ' AND T.DELETE_STATUS_ARTICLE=0');
	}


	public function returnQ()
	{   
		
		$idreq = $this->input->post('idreq');
		$idR = $this->input->post('idR');
		$store = $this->input->post('store');

		$getR = $this->model_rm->getOne('pos_ibi_requisition_trans', array('ID_REQ' => $idR));

		$getArticle = $this->model_rm->getOne('pos_ibi_article_requisition_trans', array('ID_ARTICLE_REQ' => $idreq));


		//ajout des quantites retournees dans la boutique
		$add_qt_currentB = $this->model_rm->getUpdate('UPDATE pos_store_' . $store . '_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE+' . $getArticle['QT_RETOUR_ARTICLE_REQ'] . ') WHERE CODEBAR_ARTICLE="' . $getArticle['CODEBAR_ARTICLE_REQ'] . '"  ');

		$insertflow = $this->model_rm->insert('pos_store_' . $store . '_ibi_articles_stock_flow', array(
			'REF_COMMAND_CODE_SF' => $getR['CODE_REQ'],
			'REF_ARTICLE_BARCODE_SF' => $getArticle['CODEBAR_ARTICLE_REQ'],
			'QUANTITE_SF' => $getArticle['QT_RETOUR_ARTICLE_REQ'],
			'TYPE_SF' => 'transfert_in',
			'UNIT_PRICE_SF' => $getArticle['PRIX_ARTICLE_REQ'],
			'TOTAL_PRICE_SF' => $getArticle['QT_RETOUR_ARTICLE_REQ'] * $getArticle['PRIX_ARTICLE_REQ'],
			'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
			'CREATED_BY_SF' => get_user_data('id')
		));



		//soustraire la quantite dans la boutique qui retourne le produit
		$sub_qt_Boutique = $this->model_rm->getUpdate('UPDATE pos_store_' . $getR['FROM_STORE'] . '_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-' . $getArticle['QT_RETOUR_ARTICLE_REQ'] . ') WHERE CODEBAR_ARTICLE="' . $getArticle['CODEBAR_ARTICLE_REQ'] . '"  ');

		$insertflow = $this->model_rm->insert('pos_store_' . $getR['FROM_STORE'] . '_ibi_articles_stock_flow', array(
			'REF_COMMAND_CODE_SF' => $getR['CODE_REQ'],
			'REF_ARTICLE_BARCODE_SF' => $getArticle['CODEBAR_ARTICLE_REQ'],
			'QUANTITE_SF' => $getArticle['QT_RETOUR_ARTICLE_REQ'],
			'TYPE_SF' => 'transfert_out',
			'UNIT_PRICE_SF' => $getArticle['PRIX_ARTICLE_REQ'],
			'TOTAL_PRICE_SF' => $getArticle['QT_RETOUR_ARTICLE_REQ'] * $getArticle['PRIX_ARTICLE_REQ'],
			'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
			'CREATED_BY_SF' => get_user_data('id')
		));





		//update la requisition en ajoutant l'utilisateur qui a aprouve
		$up = $this->model_rm->update('pos_ibi_article_requisition_trans', array('ID_ARTICLE_REQ' => $idreq), array('APROUVED_RETOUR_ARTICLE_BY' => get_user_data('id')));


		if ($up) {
			set_message('approbation reussi avec success');
		}
	}
}
