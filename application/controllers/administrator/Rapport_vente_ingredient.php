<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Clients Controller
*| --------------------------------------------------------------------------
*| Pos Clients site
*|
*/
class Rapport_vente_ingredient extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}

	/**
	* show all Pos Clientss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pos_clients_list');

		$du = $this->input->get('du');
		$au = $this->input->get('au');
		$type = $this->input->get('type');
        $req='';

        if (!empty($du) AND !empty($au)) {
  
        	if (!empty($type)) {
        		$req=' AND T.ID_TYPE_CLIENT='.$type.'';
        	}

        	  $this->data['rapport']=$this->db->query(
			'SELECT T1.REF_PRODUCT_CODEBAR,T1.DESIGN_ARTICLE,T1.ID_ARTICLE, T1.INGREDIENT_ID, ART.DESIGN_ARTICLE AS NOM, ART.CODEBAR_ARTICLE AS CODE, T1.INGREDIENT_QUANTITY AS QTE FROM (SELECT CP.REF_PRODUCT_CODEBAR,A.DESIGN_ARTICLE,A.ID_ARTICLE, D.INGREDIENT_ID, SUM(D.INGREDIENT_QUANTITY) AS INGREDIENT_QUANTITY
				FROM pos_ibi_commandes_produits CP 
				JOIN pos_store_1_ibi_articles A ON A.CODEBAR_ARTICLE=CP.REF_PRODUCT_CODEBAR
				JOIN pos_ibi_articles_details D ON D.ARTICLE_ID=A.ID_ARTICLE
				WHERE CP.DATE_CREATION_pos_IBI_COMMANDES_PRODUITS BETWEEN "'.$du.'" AND "'.$au.'"
				GROUP BY D.INGREDIENT_ID
				) T1

				LEFT JOIN pos_store_1_ibi_articles ART ON ART.ID_ARTICLE=T1.INGREDIENT_ID')->result();
          }else{
        	$this->data['rapport']=[];
        }
	
       

		$this->template->title('Pos situation clients');
		$this->render('backend/standart/administrator/rapport/rapport_vente_ingredien', $this->data);
	}
	
	/**
	* Add new pos_clientss
	*
	*/
}


/* End of file pos_clients.php */
/* Location: ./application/controllers/administrator/Pos Clients.php */