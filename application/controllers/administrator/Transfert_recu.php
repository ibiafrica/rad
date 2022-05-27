<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Stock Transfert Controller
*| --------------------------------------------------------------------------
*| Hospital Store 1 Ibi Stock Transfert site
*|
*/
class Transfert_recu extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_transfert_recu');
		$this->load->model('model_rm');
	}

	/**
	* show all Hospital Store 1 Ibi Stock Transferts
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

		$this->is_allowed('pos_store_1_ibi_stock_transfert_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['transfert'] = $this->model_transfert_recu->get($filter, $field, $this->limit_page, $offset);


		$this->data['transfert_counts'] = $this->model_transfert_recu->count_all($filter, $field);

		$config = [
			'base_url'     => 'transfert_recu/'.$store.'/index/',
			'total_rows'   => $this->model_transfert_recu->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Transfer List');
		$this->render('backend/standart/administrator/stock_transfert/transfert_recu_list', $this->data);
	}
	
	

	

	

	
	public function view()
	{
		$store=$this->uri->segment(2);
		$id=$this->uri->segment(4);
		if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }
        
		$this->is_allowed('pos_store_1_ibi_stock_transfert_view');

		$this->model_rm->update('pos_store_1_ibi_stock_transfert',array('ID_ST'=>$id), array('STATUS_NOTIFY_TS'=>1));

		$this->data['transfert'] = $this->model_transfert_recu->join_avaiable()->filter_avaiable()->find($id);
		$this->data['produits']=$this->model_rm->getList('pos_store_1_ibi_stock_transfert_items', array('REF_TRANSFER_STI'=>$id));

		$this->template->title('Transfer Detail');
		$this->render('backend/standart/administrator/stock_transfert/transfert_recu_view', $this->data);
	}


	public function aprov($store, $id){
       

       if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

		$getB=$this->model_rm->getOne('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$id));

          if ($getB['DELETE_STATUS_ST'] == 1) {
            set_message('cet transfert a été annulé', 'error');
            redirect_back();
            exit();
        }


		
		$getprod=$this->model_rm->getList('pos_store_1_ibi_stock_transfert_items', array('REF_TRANSFER_STI'=>$id));
         $confirm=false;
		foreach ($getprod as $key) {
          //verifier si la quantite en stock est superieur ou egale a la quantite demandee
 
            $checkQt=$this->model_rm->getOne('pos_store_'.$getB['FROM_STORE_ST'].'_ibi_articles', array('CODEBAR_ARTICLE'=>$key['BARCODE_STI']))['QUANTITY_ARTICLE'];

            if ($checkQt>=$key['QUANTITY_STI']) {
             
            $statutTrans=$this->model_rm->update('pos_store_1_ibi_stock_transfert_items', array('ID_STI'=>$key['ID_STI']), array('STATUS_APPROV_TRANS_ITEM'=>1));

              

                  $upd=$this->model_rm->getUpdate('UPDATE pos_store_'.$getB['FROM_STORE_ST'].'_ibi_articles SET QUANTITY_ARTICLE=(QUANTITY_ARTICLE-'.$key['QUANTITY_STI'].') WHERE CODEBAR_ARTICLE="'.$key['BARCODE_STI'].'" ');
           
			$flowsender=$this->model_rm->insert('pos_store_'.$getB['FROM_STORE_ST'].'_ibi_articles_stock_flow', array(
	        				'REF_COMMAND_CODE_SF'=>$getB['CODE_TRANSFERT'],
	        				'REF_ARTICLE_BARCODE_SF'=>$key['BARCODE_STI'],
	        				'QUANTITE_SF'=>$key['QUANTITY_STI'],
	        				'TYPE_SF'=>'transfert_out',
	        				'UNIT_PRICE_SF'=>$key['UNIT_PRICE_STI'],
	        				'TOTAL_PRICE_SF'=>$key['UNIT_PRICE_STI']*$key['QUANTITY_STI'],
	        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
	        				'CREATED_BY_SF'=>get_user_data('id')
	        			  ));


			$check=$this->model_rm->getOne('pos_store_'.$store.'_ibi_articles', array('CODEBAR_ARTICLE'=>$key['BARCODE_STI']));

			if ($upd) {

					if (!empty($check)) {

					$up=$this->model_rm->update('pos_store_'.$store.'_ibi_articles',array('CODEBAR_ARTICLE'=>$key['BARCODE_STI']), array('QUANTITY_ARTICLE'=>$check['QUANTITY_ARTICLE']+$key['QUANTITY_STI']));
						
							$flow=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', array(
	        				'REF_COMMAND_CODE_SF'=>$getB['CODE_TRANSFERT'],
	        				'REF_ARTICLE_BARCODE_SF'=>$key['BARCODE_STI'],
	        				'QUANTITE_SF'=>$key['QUANTITY_STI'],
	        				'TYPE_SF'=>'transfert_in',
	        				'UNIT_PRICE_SF'=>$key['UNIT_PRICE_STI'],
	        				'TOTAL_PRICE_SF'=>$key['UNIT_PRICE_STI']*$key['QUANTITY_STI'],
	        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
	        				'CREATED_BY_SF'=>get_user_data('id')
	        			  ));
						
				   }else{

					$ins=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles',
			           array(
				 			'DESIGN_ARTICLE'=>$key['DESIGN_STI'],
				 			'CODEBAR_ARTICLE'=>$key['BARCODE_STI'],
				 			'PRIX_DE_VENTE_ARTICLE'=>$key['UNIT_PRICE_STI'],
				 			'QUANTITY_ARTICLE'=>$key['QUANTITY_STI'],
				 			'DATE_CREATION_ARTICLE'=>date('Y-m-d H:i:s'),
				 			'CREATED_BY_ARTICLE'=>get_user_data('id') 
				 		)); 

					$flow=$this->model_rm->insert('pos_store_'.$store.'_ibi_articles_stock_flow', array(
	        				'REF_COMMAND_CODE_SF'=>$getB['CODE_TRANSFERT'],
	        				'REF_ARTICLE_BARCODE_SF'=>$key['BARCODE_STI'],
	        				'QUANTITE_SF'=>$key['QUANTITY_STI'],
	        				'TYPE_SF'=>'transfert_in',
	        				'UNIT_PRICE_SF'=>$key['UNIT_PRICE_STI'],
	        				'TOTAL_PRICE_SF'=>$key['UNIT_PRICE_STI']*$key['QUANTITY_STI'],
	        				'DATE_CREATION_SF'=>date('Y-m-d H:i:s'),
	        				'CREATED_BY_SF'=>get_user_data('id')
	        			));
				}

			}


           }else{ $confirm=true; }//end if Qtcheck


			

		} 

        $aprov=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$id), array('APPROUVED_BY_ST'=>get_user_data('id'), 'APPROUVED_ST'=>1));
       
         if ($confirm) {
         	 set_message('quelques articles n\'ont pas pu etre approuvés suite au manque de quantité', 'success');
         }else{
         	set_message('tous les articles ont été approuvés avec success', 'success');
         }
        
		 redirect_back();

	}
	
	public function rejet($store=0, $id){
		
     if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }


        $rejet=$this->model_rm->update('pos_store_1_ibi_stock_transfert', array('ID_ST'=>$id), array('APPROUVED_BY_ST'=>get_user_data('id'), 'APPROUVED_ST'=>2));

		set_message('le transfer a été rejeté avec success', 'success');
		 redirect_back();

	}
	/**
	* delete Hospital Store 1 Ibi Stock Transferts
	*
	* @var $id String
	*/
	private function _remove($id ,$commentValue)
	{
		$pos_store_1_ibi_stock_transfert = $this->model_transfert_recu->find($id);

		
		         
		 $delete_save = array(
								'DELETED_STATUS_' => 1,
								'DELETED_DATE_' => date('Y-m-d H:i:s'),
								'DELETED_USER_' => get_user_data('id'),
								'DELETED_COMMENT_' => $commentValue
							);

		        $remove = $this->db->update("pos_store_1_ibi_stock_transfert",$delete_save,array("ID_ST"=>$id));
		return $remove;
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	
}


/* End of file pos_store_1_ibi_stock_transfert.php */
/* Location: ./application/controllers/administrator/Hospital Store 1 Ibi Stock Transfert.php */