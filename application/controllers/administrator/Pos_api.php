<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pos Clients Controller
*| --------------------------------------------------------------------------
*| Pos Clients site
*|
*/
class pos_api extends Admin	
{

   public function __construct()
	{
		parent::__construct();
	}

   public function index()
	{
		$departement = $this->db->get('pos_ibi_stores')->result();
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


	public function categorie()
	{
	  
		$store = $this->db->get_where('pos_ibi_stores')->result();
		$categorie = "";
	   foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$categorie .="SELECT s.*,cat.* FROM pos_ibi_articles_categories cat,pos_ibi_stores s where cat.STORE_ID=".$store_id." AND cat.STORE_ID=s.ID_STORE ";
			$categorie .= " UNION ALL ";
		}

		$categorie.='@';
		$categorie =str_replace('UNION ALL @', '', $categorie);

	   $donnees = $this->db->query($categorie)->result();
	   $categorie_arr = [];

	   if ($donnees) {
		
		foreach ($donnees as $cat) {

			$categorie_arr[]=[
				'ID_CATEGORIE'=>$cat->ID_CATEGORIE,
				'NOM_CATEGORIE'=>$cat->NOM_CATEGORIE,
				'DESCRIPTION_CATEGORIE'=>$cat->DESCRIPTION_CATEGORIE,
				'PARENT_REF_ID_CATEGORIE'=>$cat->PARENT_REF_ID_CATEGORIE,
				'DATE_CREATION_CATEGORIE'=>$cat->DATE_CREATION_CATEGORIE,
				'CREATED_BY_CATEGORIE'=>$cat->CREATED_BY_CATEGORIE,
				'STORES'=>[
						'ID_STORE'=>$cat->ID_STORE,
						'STATUS_STORE'=>$cat->STATUS_STORE,	
						'NAME_STORE'=>$cat->NAME_STORE,
						'DESCRIPTION_STORE'=>$cat->DESCRIPTION_STORE,						   
						'DATE_CREATION_STORE'=>$cat->DATE_CREATION_STORE,
						'CREATED_BY_STORE'=>$cat->CREATED_BY_STORE,
				]
			];

			
	   }

			$data['categorie']=$categorie_arr;
			$this->response([
				'status'=>true,
				'message'=>'donnees des categorie',
				'data'=>$data
			],API::HTTP_OK);

			} else {
					$this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
			}
	   
	}

    //Recuperation des tous les articles par stores
    public function articles()
	{
	   $store = $this->db->get_where('pos_ibi_stores')->result();
		$articles = "";
	   foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$articles .="SELECT * FROM pos_store_".$store_id."_ibi_articles";
			$articles .= " UNION ALL ";
		}
		
		$articles.='@';
		$articles =str_replace('UNION ALL @', '', $articles);

		$donnee =$this->db->query($articles)->result();
		$articles_arr = [];
		foreach ($donnee as $art) {
			$articles_arr[] = $art;
		}

		$data['articles']=$articles_arr;
		$this->response([
			'status'=>true,
			'message'=>'donnees des articles',
			'data'=>$data
		],API::HTTP_OK);
	}

  
// //Articles categorie
 public function store_categorie($store)
	{
	   $store = $this->db->query('SELECT s.*,cat.* FROM  pos_ibi_stores s, pos_ibi_articles_categories cat WHERE cat.STORE_ID=s.ID_STORE AND ID_STORE='.$store);
		
		$store_arr=[];
		$categorie_arr=[];
		$data =[];

	   if ($store->num_rows()>0) {

		   foreach ($store->result() as $t) {
				$data['ID_STORE']=$t->ID_STORE;
				$data['STATUS_STORE']=$t->STATUS_STORE;
				$data['NAME_STORE']=$t->NAME_STORE;
				$data['DESCRIPTION_STORE']=$t->DESCRIPTION_STORE;
				$data['DATE_CREATION_STORE']=$t->DATE_CREATION_STORE;
				$data['CREATED_BY_STORE']=$t->DESCRIPTION_STORE;
				$data[]=[
					'categorie'=>[
						   'ID_CATEGORIE'=>$t->ID_CATEGORIE,
						   'NOM_CATEGORIE'=>$t->NOM_CATEGORIE,						   
						   'DESCRIPTION_CATEGORIE'=>$t->DESCRIPTION_CATEGORIE,
						   'PARENT_REF_ID_CATEGORIE'=>$t->PARENT_REF_ID_CATEGORIE,			
						   'DATE_CREATION_CATEGORIE'=>$t->DATE_CREATION_CATEGORIE,
						   'CREATED_BY_CATEGORIE'=>$t->CREATED_BY_CATEGORIE,
					]
				];

     	   }
		}

	   $this->response([
		   'status'=>true,
		   'message'=>'donnees categorie store',
		   'data'=>$data
	   ],API::HTTP_OK);
	}


// 		//Articles categorie
 public function article_categorie($store,$categorie)
	{

	   $categorie = $this->db->query('SELECT art.*,cat.* FROM  pos_store_'.$store.'_ibi_articles art, pos_ibi_articles_categories cat WHERE cat.ID_CATEGORIE=art.REF_CATEGORIE_ARTICLE AND cat.STORE_ID='.$store.' AND ID_CATEGORIE='.$categorie);
		
		$store_arr=[];
		$categorie_arr=[];
		$data =[];

	   if ($categorie->num_rows()>0) {

		   foreach ($categorie->result() as $t) {
				$data['ID_CATEGORIE']=$t->ID_CATEGORIE;
				$data['NOM_CATEGORIE']=$t->NOM_CATEGORIE;
				$data['STORE_ID']=$t->STORE_ID;
				$data['DESCRIPTION_CATEGORIE']=$t->DESCRIPTION_CATEGORIE;
				$data['PARENT_REF_ID_CATEGORIE']=$t->PARENT_REF_ID_CATEGORIE;
				$data['DATE_CREATION_CATEGORIE']=$t->DATE_CREATION_CATEGORIE;
				$data['CREATED_BY_CATEGORIE']=$t->CREATED_BY_CATEGORIE;
				$data['DELETE_STATUS_CATEGORIE']=$t->DELETE_STATUS_CATEGORIE;
				$data[]=[
					'articles'=>[
						   'ID_ARTICLE'=>$t->ID_ARTICLE,
						   'DESIGN_ARTICLE'=>$t->DESIGN_ARTICLE,						   'TYPE_ARTICLE'=>$t->TYPE_ARTICLE,
						   'CODEBAR_ARTICLE'=>$t->CODEBAR_ARTICLE,	 					   'QUANTITY_ARTICLE'=>$t->QUANTITY_ARTICLE,
						   'PRIX_DE_VENTE_ARTICLE'=>$t->PRIX_DE_VENTE_ARTICLE,						   'PRIX_DACHAT_ARTICLE'=>$t->PRIX_DACHAT_ARTICLE,
						   'UNITE_ARTICLE'=>$t->UNITE_ARTICLE,						   'MARGE_ARTICLE'=>$t->MARGE_ARTICLE,
						   'DATE_CREATION_ARTICLE'=>$t->DATE_CREATION_ARTICLE,						   'DELETE_STATUS_ARTICLE'=>$t->DELETE_STATUS_ARTICLE,
						   'DELETE_BY_ARTICLE'=>$t->DELETE_BY_ARTICLE,
					]
				];

     	   }
		}

	   $this->response([
		   'status'=>true,
		   'message'=>'donnees des articles',
		   'data'=>$data
	   ],API::HTTP_OK);

	}


	 public function get_all_store()
	{
	   $store = $this->db->get_where('pos_ibi_stores')->result();
		$articles = "";
		$store_arr=[];
		$all_data = [];
	   foreach ($store as $key) {
			$store_id = $key->ID_STORE;
			$articles .="SELECT cat.*,art.* FROM pos_ibi_articles_categories cat,pos_store_".$store_id."_ibi_articles art WHERE  art.REF_CATEGORIE_ARTICLE=cat.ID_CATEGORIE ";
			$articles .= " UNION ALL ";
		}
		
		$articles.='@';
		$articles =str_replace('UNION ALL @', '', $articles);

		$donnee =$this->db->query($articles)->result();
		$articles_arr = [];
		foreach ($donnee as $art) {
			//$articles_arr['store'];
			$articles_arr[]=[
			// $articles_arr['ID_CATEGORIE'] =>$art->ID_CATEGORIE,
			// $articles_arr['NOM_CATEGORIE'] => $art->NOM_CATEGORIE,
			// // $articles_arr['STORE_ID'] => $art->STORE_ID,
			// $articles_arr['DESCRIPTION_CATEGORIE'] => $art->DESCRIPTION_CATEGORIE,
			// $articles_arr['PARENT_REF_ID_CATEGORIE'] => $art->PARENT_REF_ID_CATEGORIE,
			// $articles_arr['DATE_CREATION_CATEGORIE'] => $art->DATE_CREATION_CATEGORIE,
			// $articles_arr['CREATED_BY_CATEGORIE'] => $art->CREATED_BY_CATEGORIE,
			// $articles_arr['DELETE_STATUS_CATEGORIE'] => $art->DELETE_STATUS_CATEGORIE,
			$articles_arr[] = [
					'articles'=>[
						   'ID_ARTICLE'=>$art->ID_ARTICLE,
						   'DESIGN_ARTICLE'=>$art->DESIGN_ARTICLE,						   'REF_CATEGORIE_ARTICLE'=>$art->REF_CATEGORIE_ARTICLE,						   'TYPE_ARTICLE'=>$art->TYPE_ARTICLE,
						   'CODEBAR_ARTICLE'=>$art->CODEBAR_ARTICLE,						   'QUANTITY_ARTICLE'=>$art->QUANTITY_ARTICLE,
						   'PRIX_DE_VENTE_ARTICLE'=>$art->PRIX_DE_VENTE_ARTICLE,						   'PRIX_DACHAT_ARTICLE'=>$art->PRIX_DACHAT_ARTICLE,
						   'UNITE_ARTICLE'=>$art->UNITE_ARTICLE,						   'MARGE_ARTICLE'=>$art->MARGE_ARTICLE,
						   'DATE_CREATION_ARTICLE'=>$art->DATE_CREATION_ARTICLE,						   'DELETE_STATUS_ARTICLE'=>$art->DELETE_STATUS_ARTICLE,
						   'DELETE_BY_ARTICLE'=>$art->DELETE_BY_ARTICLE,
					]
						]
					];
				}

				$data=[
						'categorie'=>$articles_arr,
						'article'=>[
					       'articles'=>$articles_arr
						]
				];
			//$data['store']=$all_data;	
			$data['categorie']=$articles_arr;
				$this->response([
					'status'=>true,
					'message'=>'donnees des articles',
					'data'=>$data
					// 'data'=>'donneee'
				],API::HTTP_OK);
		
}




			//Commande pour touts les status
		public function get_all_commande($status=0)
		{

		 	 $commande_data=[];
			 if ($status==1) {
			$Commande = $this->db->get_where('pos_ibi_commandes',array('	COMMANDE_STATUS'=>$status))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
			 }

			 } elseif ($status==2) {

			$Commande = $this->db->get_where('pos_ibi_commandes',array('	COMMANDE_STATUS'=>$status))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
			 }

			 }elseif ($status==3) {

			 $Commande = $this->db->get_where('pos_ibi_commandes',array('COMMANDE_STATUS'=>$status))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
			 }
			 }elseif ($status==4) {
			 $Commande = $this->db->get_where('pos_ibi_commandes',array('COMMANDE_STATUS'=>$status))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
			 }
			 }else{
			$Commande = $this->db->get_where('pos_ibi_commandes',array('	COMMANDE_STATUS'=>0))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
			 }

			 }
		
             
			 $data=$commande_data;
			 $this->response([
				 'status'=>true,
				 'message'=>'commande recuperer avec success',
				 'donnees'=>$data
			 ],API::HTTP_OK);
				

		}

		public function get_commande_created_by($id_user)
		{
		    
			$commande_data=[];
			$Commande = $this->db->get_where('pos_ibi_commandes',array('CREATED_BY_pos_IBI_COMMANDES'=>$id_user))->result();
			  foreach ($Commande as $k) {
               $commande_data[]=$k;
		}

		     $data=$commande_data;
			 $this->response([
				 'status'=>true,
				 'message'=>'commande recuperer avec success',
				 'donnees'=>$data
			 ],API::HTTP_OK);
	 }

	 //Function la creation de la methode de paiement
	 public function mode_paiement_add()
	 {
		 $designation = $this->input->post('designation');
		 $description = $this->input->post('description');
		 $data=[
			 'DESIGNATION_PAIEMENT_MODE'=>$designation,
			 'DESCRIPTION_PAIEMENT_MODE'=>$description,
			 'CREATED_BY_PAIEMENT_MODE'=>get_user_data('id')
		 ];

		 $query = $this->db->insert('mode_paiement',$data);
		 if ($query) {
			  $this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Ajouter avec success',
			 ],API::HTTP_OK);

		 } else {
			$this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		 }
		 
	 }

	 public function mode_paiement_list()
	 {
		$query=$this->db->get('mode_paiement')->result();
		$donnee_arr=[];
		 if ($query) {
			foreach ($query as $k) {
				$donnee_arr[]=$k;
			}
				$data=$donnee_arr;
				$this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Recuperer avec success',
				 'donnee'=>$data
			 ],API::HTTP_OK);
		 } else {
				$this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Ajouter avec success',
				 'donnee'=>[]
			 ],API::HTTP_OK);
		 }
		 
	
	 }

	 //Fonction de la suppression 
	 public function mode_paiement_delete()
	 {   
		 $id=$this->input->post('id');
		//  var_dump($_POST);
		//  exit;
		 $this->db->where('ID_PAIEMENT',$id);
		 $query=$this->db->delete('mode_paiement');

		  if ($query) {
	          $this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Supprimer avec success'
			 ],API::HTTP_OK);
			  } else {
                  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		  }
		  
	 }


   public function mode_paiement_update()
	 {   
		 $id=$this->input->post('id');
		 $designation = $this->input->post('designation');
		 $description = $this->input->post('description');
		 $data=[
			 'DESIGNATION_PAIEMENT_MODE'=>$designation,
			 'DESCRIPTION_PAIEMENT_MODE'=>$description,
			 'CREATED_BY_PAIEMENT_MODE'=>get_user_data('id')
		 ];

		 $this->db->where('ID_PAIEMENT',$id);
		 $this->db->set($data);
		 $query=$this->db->update('mode_paiement');

		  if ($query) {
	          $this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Modifier  avec success'
			 ],API::HTTP_OK);
			  } else {
                  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		  }
		  
	 }

	//Crud paiements lists
	public function paiement_list()
	{
		 $requete = $this->db->get('pos_paiements')->result();
		
		 $donnee_arr=[];

		 if ($requete) {
			
			 foreach ($requete as $k) {
				 # code...
                 $donnee_arr[]=$k;
			 }

			  $data=$donnee_arr;
			  $this->response([
				 'status'=>true,
				 'message'=>'Mode de paiement Modifier  avec success',
				 'donnees'=>$data
			 ],API::HTTP_OK);

		 } else {
			  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		 }
		 
	}

	public function paiement_add()
	{
		
		// $store_id = $this->input->post('store');
		$commande_id = $this->input->post('commande_id');
		$montant = $this->input->post('montant');
		$user_id = $this->input->post('user_id');
		$type_paiement = $this->input->post('type_paiement');
		$data = [
			// 'STORE_ID_PAIEMENT'=>$store_id,
			'MONTANT_PAIEMENT'=>$montant,
			'COMMANDE_ID'=>$commande_id,
			'PAYMENT_TYPE_PAIEMENT'=>$type_paiement,
			'DATE_CREATION_PAIEMENT'=>date('Y-m-d H:m:s'),
			'CREATED_BY_PAIEMENT'=>$user_id
		];

		$requete = $this->db->insert('pos_paiements',$data);
		if ($requete) {
			  $this->response([
				 'status'=>true,
				 'message'=>'Enregistrer avec success'
			 ],API::HTTP_OK);
		} else {
			
			  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		}
		
	}



   public function paiement_update()
	{
		
		$store_id = $this->input->post('store');
		$id = $this->input->post('id');
		$montant = $this->input->post('montant');
		$user_id = $this->input->post('user_id');
		$type_paiement = $this->input->post('type_paiement');
		$data = [
			'STORE_ID_PAIEMENT'=>$store_id,
			'MONTANT_PAIEMENT'=>$montant,
			'PAYMENT_TYPE_PAIEMENT'=>$type_paiement,
			'DATE_CREATION_PAIEMENT'=>date('Y-m-d H:m:s'),
			'CREATED_BY_PAIEMENT'=>$user_id
		];

         $this->db->where('ID_PAIEMENT',$id);
		 $this->db->set($data);
		 $query=$this->db->update('pos_paiements');

    		if ($query) {
			  $this->response([
				 'status'=>true,
				 'message'=>'Enregistrer avec success'
			 ],API::HTTP_OK);
		} else {
			
			  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		}
		
	}


	public function paiement_delete()
	{
		
		 $store_id = $this->input->post('store');	    
		 $id=$this->input->post('id');


	     $this->db->where('ID_PAIEMENT',$id);
		 $this->db->where('STORE_ID_PAIEMENT',$store_id);
		 $this->db->set('DELETED_STATUS_PAIEMENT',$id);
		 $query=$this->db->update('pos_paiements');

    		if ($query) {
			  $this->response([
				 'status'=>true,
				 'message'=>'Enregistrer avec success'
			 ],API::HTTP_OK);
		} else {
			
			  $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
		}
		
	}


	//Fonction des shifts

	public function shift_add()
	{
		$shift_start = $this->input->post('shift_start');
		$shift_end = $this->input->post('shift_end');
		$created_by_shift = $this->input->post('created_by_shift');
		$data=[
			'SHIFT_START'=>date('Y-m-d H:m:s'),
			'CREATED_BY_SHIFT'=>$created_by_shift,
		];


		$query = $this->db->insert('cashier_shifts',$data);
		if ($query) {
             $this->response([
				 'status'=>true,
				 'message'=>'Enregistrer avec success'
			 ],API::HTTP_OK);	
			} else {
                 $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
			}
		
	}

	//Update shift status

	 public function shift_update()
	 {
		$id = $this->input->post('id');
		$created_by_shift = $this->input->post('created_by_shift');

		$data=[
			'SHIFT_END'=>date('Y-m-d H:m:s'),
			'SHIFT_STATUS'=>0,
			'CREATED_BY_SHIFT'=>$created_by_shift,
		];

        
         $this->db->where('ID_SHIFT',$id);
		 $this->db->set($data);
		 $query=$this->db->update('cashier_shifts');
		 		if ($query) {
             $this->response([
				 'status'=>true,
				 'message'=>'Enregistrer avec success'
			 ],API::HTTP_OK);	
			} else {
                 $this->response([
					'status' => false,
					'message' => validation_errors()
				], API::HTTP_NOT_ACCEPTABLE);
			}	
		 }

	  public function get_all_users()
	  {
		  # code...
		  $query = $this->db->query('SELECT u.*,g.id as ID_GROUP,g.name as NAME_GROUP,g.definition as DEFINITION FROM aauth_users u,aauth_groups g,aauth_user_to_group ug WHERE  u.id=ug.user_id AND g.id=ug.group_id')->result();
		  $data_arr=[];

		    if ($query) {
			 foreach ($query as $k) {
			  $data_arr[]=[
				  'id'=>$k->id,
				  'email'=>$k->email,
				  'oauth_uid'=>$k->oauth_uid,
				  'oauth_provider'=>$k->oauth_provider,
				  'pass'=>$k->pass,
				  'username'=>$k->username,
				  'full_name'=>$k->full_name,
				  'pin_code'=>$k->pin_code,
				  'avatar'=>$k->avatar,
				  'boutique'=>$k->boutique,
				  'store_allowed'=>$k->STORE_ALLOWED,
				  'GROUP'=>[
					  'group_id'=>$k->ID_GROUP,
					  'name'=>$k->NAME_GROUP,
					  'defainition'=>$k->DEFINITION
				  ]
			];
		  }
		    $data=$data_arr;
		     $this->response([
				 'status'=>true,
				 'message'=>'Donnees recuperer  avec success',
				 'donnee'=>$data
			 ],API::HTTP_OK);	

			} else {
	            $this->response([
				 'status'=>true,
				 'message'=>'Donnees recuperer  avec success',
				 'donnee'=>[]
			 ],API::HTTP_OK);	
			}
	  }


	public function get_all_clients()
	  {
		  # code...
		  $query = $this->db->query('SELECT cl.*,clf.* FROM  pos_clients cl,client_file clf   ')->result();
		  $data_arr=[];

		    if ($query) {
			 foreach ($query as $k) {
			  $data_arr[]=[
				  'ID_CLIENT'=>$k->ID_CLIENT,
				  'TYPE_CLIENT_ID'=>$k->TYPE_CLIENT_ID,
				  'NOM_CLIENT'=>$k->NOM_CLIENT,
				  'PRENOM'=>$k->PRENOM,
				  'TEL_CLIENTS'=>$k->TEL_CLIENTS,
				  'DATE_CREATION_CLIENT'=>$k->DATE_CREATION_CLIENT,
				  'CREATED_BY_CLIENT'=>$k->CREATED_BY_CLIENT,
				  'DELETE_STATUS_CLIENT'=>$k->DELETE_STATUS_CLIENT,
				  'DELETE_COMMENT_CLIENT'=>$k->DELETE_COMMENT_CLIENT,
				  'DATE_MOD_CLIENT'=>$k->DATE_MOD_CLIENT,
				  'DELETE_BY_CLIENT'=>$k->DELETE_BY_CLIENT,
				  'MODIFIED_BY_CLIENT'=>$k->MODIFIED_BY_CLIENT,
				  'FICHE_CLIENTS'=>[
					  'CLIENT_FILE_ID'=>$k->CLIENT_FILE_ID,
					  'CLIENT_FILE_CODE'=>$k->CLIENT_FILE_CODE,
					  'CLIENT_ID'=>$k->CLIENT_ID,
					  'CLIENT_FILE_STATUS'=>$k->CLIENT_FILE_STATUS,
					  'DISCOUNT_BOISSON'=>$k->DISCOUNT_BOISSON,
					  'DISCOUNT_FOOD'=>$k->DISCOUNT_FOOD,
					  'DATE_CREATION_CLIENT_FILE'=>$k->DATE_CREATION_CLIENT_FILE,
					  'CREATED_BY_CLIENT_FILE'=>$k->CREATED_BY_CLIENT_FILE
				  ]
				  ];
		  }
		    $data=$data_arr;
		     $this->response([
				 'status'=>true,
				 'message'=>'Donnees recuperer avec success',
				 'donnee'=>$data
			 ],API::HTTP_OK);	

			} else {
	               $this->response([
				 'status'=>true,
				 'message'=>'Donnees recuperer avec success',
				 'donnee'=>[]
			 ],API::HTTP_OK);	
			}
	  }

}