<?php defined('BASEPATH') OR exit('No direct script access allowed');


class Offlinesync extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}


	public function index($offset = 0)
	{


	}


	public function parameterCommand(){
	    $valueComming = $_POST['commande'];
		$itms = json_decode($valueComming, true);

		$arrayCommand = [
           'CODE'=>$itms['code'],
           'TABLE_ID'=>$itms['table_id'],
           'COMMANDE_STATUS'=>$itms['status'],
           'PRINT_COUNT'=>$itms['print_count'],
           'ID_CASHIER_SHIFT'=>$itms['shift_id'],
           'CLIENT_ID_COMMANDE'=>$itms['client_id'],
           'CREATED_BY_pos_IBI_COMMANDES'=>$itms['created_by'],
           'DATE_CREATION_pos_IBI_COMMANDES'=>$itms['date_creation_cmd']

		];

		$inseSync = $this->model_rm->insert_last_id('pos_ibi_commandes',$arrayCommand);
		$idCommand = $this->db->insert_id();

        for ($i = 0; $i < count($itms['produits']); $i++) {
            $prodItems = $itms['produits'][$i];

            $arrayProduct = [
                   'ID_pos_IBI_COMMANDES_PRODUITS'=>$prodItems['cmd_prod_id'],
                   'PRIX'=>$prodItems['prix'],
                   'NAME'=>$prodItems['name'],
                   'SHIFT_ID'=>$itms['shift_id'],
                   'REF_COMMAND_CODE'=>$itms['code'],
                   'QUANTITE'=>$prodItems['quantite'],
                   'pos_IBI_COMMANDES_ID'=>$idCommand,
                   'REF_PRODUCT_CODEBAR'=>$prodItems['codebar'],
                   'PRIX_TOTAL'=>$prodItems['quantite'] * $prodItems['prix'],
                   'STORE_ID_pos_IBI_COMMANDES_PRODUITS'=>$prodItems['store_id'],
                   'CREATED_BY_pos_IBI_COMMANDES_PRODUITS'=>$prodItems['created_by'],
                   'DATE_CREATION_pos_IBI_COMMANDES_PRODUITS'=>$prodItems['date_cmd_produit']
            ];

              $insert_product = $this->model_rm->register('pos_ibi_commandes_produits',$arrayProduct);

                // ------------------------ adjust qte ------------------------------------
             $article = $this->db->get_where('pos_store_'.$prodItems["store_id"].'_ibi_articles',['CODEBAR_ARTICLE'=>$prodItems['codebar']])->row_array();

             $updTe= $this->model_rm->update('pos_store_'.$prodItems["store_id"].'_ibi_articles',['CODEBAR_ARTICLE'=>$prodItems['codebar']],['QUANTITY_ARTICLE'=>$prodItems['quantite'] - $article['QUANTITY_ARTICLE']]);
                // -------------------------adjudt qte end --------------------------------
	            
	            // ------------------------ add stockFlow ------------------------------------
	             if($updTe){
	                $arrayFlow = [
                      'REF_ARTICLE_BARCODE_SF'=>$prodItems['codebar'],
                      'REF_COMMAND_CODE_SF'=>$idCommand,
                      'SHIFT_ID_S'=>$itms['shift_id'],
                      'QUANTITE_SF'=>$prodItems['quantite'],
                      'UNIT_PRICE_SF'=>$prodItems['prix'],
                      'TOTAL_PRICE_SF'=>$prodItems['quantite'] * $prodItems['prix'],
                      'CREATED_BY_SF'=>$itms['created_by']
	                ];

	                $insert_flow = $this->model_rm->insert('pos_store_'.$prodItems['store_id'].'_ibi_articles_stock_flow',$arrayFlow);
	             }
	            // ------------------------ add stockFlow ------------------------------------

            }

            if($insert_flow){
            	echo json_encode(['response'=>'requete envoyer!!..', 'status'=>'ok']);
            }


	     }





















}