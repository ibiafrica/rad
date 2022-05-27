<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Zanzi extends API
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
	}


	public function index_get()
	{
		$departement = $this->db->get('pos_ibi_stores',array('DELETE_STATUS_STORE'=>0))->result();
		$departement_arr = [];

		foreach ($departement as $dep) {
			$departement_arr[] = $dep;
		}

		$data['departements'] = $departement_arr;

		$this->response([
			'status' 	=> true,
			'message' 	=> 'Donnees departements',
			'data'	 	=> $data
		], API::HTTP_OK);
	}


	public function login_post()
	{
      $json = file_get_contents('php://input');
      $params = json_decode($json);

      $get=$this->model_rm->getRequeteOne('SELECT G.id AS group_id, G.name AS group_name, A.id AS user_id, A.full_name FROM aauth_groups G
			JOIN aauth_user_to_group AG ON AG.group_id=G.id
			JOIN aauth_users A ON A.id=AG.user_id
			WHERE A.pin_code="'.$params->password.'"');

     
       $this->response($get, API::HTTP_OK);
	   
	}

	public function orders_get($id)
	{

		$get=$this->model_rm->getRequete('
			SELECT 
			 CP.REF_PRODUCT_CODEBAR AS article_codebar,
			 A.NATURE_ARTICLE AS article_nature, 
			 A.TYPE_ARTICLE AS article_type, 
			 CL.ID_CLIENT AS client_id,  
			 CL.NOM_CLIENT AS client_name, 
			 CL.PRENOM AS client_prenom, 
			 CP.ID_pos_IBI_COMMANDES_PRODUITS AS cmd_id, 
			 CP.REF_COMMAND_CODE AS code, 
			 CP.DATE_COMMANDE_PRODUITS AS created_at, 
			 CP.DISCOUNT_PERCENT AS discount_percent, 
			 CP.NAME AS prod_name,
			 CP.PRIX AS prod_price, 
			 CP.QUANTITE AS prod_quantity, 
			 AUTH.full_name AS responsable, 
			 CM.TABLE_ID AS table_id, 
			 CM.tva AS tva
			FROM pos_ibi_commandes_produits CP 
			JOIN pos_ibi_commandes CM ON CP.pos_IBI_COMMANDES_ID=CM.ID_pos_IBI_COMMANDES
			LEFT JOIN pos_clients CL ON CL.ID_CLIENT=CM.CLIENT_ID_COMMANDE
			LEFT JOIN pos_store_1_ibi_articles A ON A.ID_ARTICLE=CP.REF_COMMAND_CODE
			LEFT JOIN aauth_users AUTH ON CP.CREATED_BY_pos_IBI_COMMANDES_PRODUITS=AUTH.id 
			WHERE CP.CREATED_BY_pos_IBI_COMMANDES_PRODUITS='.$id.''
		);

     



     
       $this->response($get, API::HTTP_OK);
	   
	}

	public function stores_complete_get()
	{

		foreach ($this->model_rm->getList('pos_ibi_stores', array('IS_POS'=>1)) as $key ) {
			$req[]=$this->model_rm->getRequete('
				SELECT * FROM 
				pos_store_'.$key['ID_STORE'].'_ibi_articles  A
				JOIN pos_ibi_articles_categories C ON A.REF_CATEGORIE_ARTICLE=C.ID_CATEGORIE
				JOIN pos_ibi_stores ST ON ST.ID_STORE=A.STORE_ID_ARTICLE

				'
			);
		}
        
        $result=[];
		for ($i=0; $i <count($req) ; $i++) { 
			$myarray=$req[$i];

            if (sizeof($myarray)>0) {

	            $obj=[];
	            $store_id=0;
	           
				for ($j=0; $j <count($myarray) ; $j++) {

					$item=$myarray[$i];

					
	                $store_id=$item['ID_STORE'];
	                $name_store=$item['NAME_STORE'];

	                $obj['categories'][]=array(
	                	"articles"=>array(
	                		array(
	                			"article_codebar"=>$item['CODEBAR_ARTICLE'],
	                			"article_id"=>$item['ID_ARTICLE'],
	                			"article_name"=>$item['DESIGN_ARTICLE'],
	                			"article_store"=>$item['ID_STORE'],
	                			"categorie_id"=>$item['ID_CATEGORIE'],
	                			"codebar"=>$item['CODEBAR_ARTICLE'],
	                			"price"=>$item['PRIX_DACHAT_ARTICLE'],
	                			"quantity"=>$item['QUANTITY_ARTICLE'],
	                			"type"=>$item['TYPE_ARTICLE']

	                		)
	                	),
	                	"categore_id"=>$item['ID_CATEGORIE'],
	                	"categorie_name"=>$item['NOM_CATEGORIE']
	                );
	                


				}

	     
	           $obj['store_id']=$store_id;
	           $obj['store_name']=$name_store;

			   $result[]=$obj;

            }
		}

     
        // print "<pre>";

        // print_r($req);
        // print "</pre>";  

        // exit();


     
       $this->response($result, API::HTTP_OK);
	   
	}



	public function orders_details_get($id)
	{

		$get=$this->model_rm->getList('pos_ibi_commandes_produits', array('pos_IBI_COMMANDES_ID'=>$id));
		$result=array();
   
		foreach ($get as $key ) {
			$obj=(object)[];
			$obj->article_codebar=$key['REF_PRODUCT_CODEBAR'];
			$obj->discount=$key['DISCOUNT_PERCENT'];
			$obj->name=$key['NAME'];
			$obj->prix=$key['PRIX'];
			$obj->prod_id=$key['ID_pos_IBI_COMMANDES_PRODUITS'];
			$obj->quantite=$key['QUANTITE'];

           $result["products"][]=$obj;
		}
		$result["success"]="product list found";
     
        $this->response($result, API::HTTP_OK);
	   
	}

	public function waiters_get()
	{

		$get=$this->model_rm->getList('aauth_users', array('banned'=>0));
		$result=array();
   
		foreach ($get as $key ) {

			$obj=(object)[];
			$obj->full_name=$key['full_name'];
			$obj->user_id=$key['id'];

            $result[]=$obj;
		}
		
     
        $this->response($result, API::HTTP_OK);
	   
	}

	public function clients_get()
	{

		

		$get=$this->model_rm->getRequete('
			SELECT * 
			FROM pos_clients C
			JOIN client_file CF ON CF.CLIENT_ID=C.ID_CLIENT
			WHERE CLIENT_FILE_STATUS=0');

		$result=array();
   
		foreach ($get as $key ) {

			$obj=(object)[];
			$obj->client_file_code=$key['CLIENT_FILE_CODE'];
			$obj->client_file_id=$key['CLIENT_FILE_ID'];
			$obj->client_id=$key['CLIENT_ID'];
			$obj->client_name=$key['NOM_CLIENT'];
			$obj->client_prenom=$key['PRENOM'];
			$obj->discount_boisson=$key['DISCOUNT_BOISSON'];
			$obj->discount_food=$key['DISCOUNT_FOOD'];
			$obj->phone_number=$key['TEL_CLIENTS'];
			$obj->type_client=$key['TYPE_CLIENT_ID'];

            $result[]=$obj;
		}
		
     
        $this->response($result, API::HTTP_OK);
	   
	}

	public function orders_split_get()
	{
       
        $get=$this->model_rm->getRequete('
			SELECT 
			 CP.REF_PRODUCT_CODEBAR AS article_codebar,
			 A.NATURE_ARTICLE AS article_nature, 
			 A.TYPE_ARTICLE AS article_type, 
			 CL.ID_CLIENT AS client_id,  
			 CL.NOM_CLIENT AS client_name, 
			 CL.PRENOM AS client_prenom, 
			 CP.ID_pos_IBI_COMMANDES_PRODUITS AS cmd_id, 
			 CP.REF_COMMAND_CODE AS code, 
			 CP.DATE_COMMANDE_PRODUITS AS created_at, 
			 CP.DISCOUNT_PERCENT AS discount_percent, 
			 CP.NAME AS prod_name,
			 CP.PRIX AS prod_price, 
			 CP.QUANTITE AS prod_quantity, 
			 AUTH.full_name AS responsable, 
			 CM.TABLE_ID AS table_id, 
			 CM.tva AS tva
			FROM pos_ibi_commandes_produits CP 
			JOIN pos_ibi_commandes CM ON CP.pos_IBI_COMMANDES_ID=CM.ID_pos_IBI_COMMANDES
			LEFT JOIN pos_clients CL ON CL.ID_CLIENT=CM.CLIENT_ID_COMMANDE
			LEFT JOIN pos_store_1_ibi_articles A ON A.ID_ARTICLE=CP.REF_COMMAND_CODE
			LEFT JOIN aauth_users AUTH ON CP.CREATED_BY_pos_IBI_COMMANDES_PRODUITS=AUTH.id 
		    WHERE CM.COMMANDE_SPLIT_REQUEST=0 AND CM.COMMANDE_STATUS=0 AND CM.DELETED_STATUS_pos_IBI_COMMANDES=0'
		);
		
     
        $this->response($get, API::HTTP_OK);
	   
	}

	public function payements_modes_get()
	{

		$result=$this->model_rm->getRequete('
			SELECT 
			 ID_MODE_PAIEMENT AS mode_id,
			 DESIGNATION_PAIEMENT_MODE AS mode_name
			FROM mode_paiement');
		
     
        $this->response($result, API::HTTP_OK);
	   
	}

	public function payements_factures_get()
	{

		$result=$this->model_rm->getRequete('
			SELECT 
			 ID_TYPE_FACTURE AS type_id,
			 DESIGNATION_TYPE_FACTURE AS type_name
			FROM type_facture');
		
     
        $this->response($result, API::HTTP_OK);
	   
	}

    
  


    
}

/* End of file User.php */
/* Location: ./application/controllers/api/User.php */