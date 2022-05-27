<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require FCPATH . '/vendor/autoload.php';
ini_set('max_execution_time', '0');
ini_set('memory_limit', '-1');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Rapport extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_articles');
		$this->load->model('model_categories');
		$this->load->model('model_registers');
		$this->load->model('model_facturation');
		$this->load->model('model_dashboard');

	}
    public function mouvements($index = 0, $store){

		$this->is_allowed('articles_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        redirect('administrator/rapport/mouvement/'.$store.'');
	}
	public function mouvement($store, $offset = 0){

		$this->is_allowed('articles_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $categorie = $this->input->get('categorie');
        $produit_name = $this->input->get('produit_name');
        // $date_depart = $this->input->get('date_depart');
        // $date_fin = $this->input->get('date_fin');
        $date_depart = $this->input->get('date_depart')? :date('Y').'-01-01';
        $date_fin = $this->input->get('date_fin')? :date('Y').'-12-31';
        $this->data['articles'] = $this->model_articles->getMouvFilter($store,$categorie,$produit_name, 50, $offset);
		$this->data['articles_counts'] = $this->model_articles->getMouvFilter_count($store,$categorie,$produit_name);
		$config = [
			'base_url'     => 'administrator/rapport/mouvement/'.$store,
			'total_rows'   => $this->model_articles->getMouvFilter_count($store,$categorie,$produit_name),
			'per_page'     => 50,
			'uri_segment'  => 5,
		];
        $this->data['categorie'] = $categorie;
        $this->data['produit_name'] = $produit_name;
        $this->data['date_depart'] = $date_depart;
        $this->data['date_fin'] = $date_fin;
        $this->data['pagination'] = $this->pagination($config);
        if($store == 3){
        	$this->render('backend/standart/administrator/articles/articles_mouvement_prod', $this->data);
        }else{
        	$this->render('backend/standart/administrator/articles/articles_mouvement', $this->data);
        }	

	}
	public function mvmts($index = 0, $store){

		$this->is_allowed('articles_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        redirect('administrator/rapport/mvmt/'.$store.'');
	}
	public function mvmt($store){

		$this->is_allowed('articles_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $categorie = $this->input->get('categorie');
        $produit_name = $this->input->get('produit_name');
        $date_precise = $this->input->get('date_precise');
        $this->data['articles'] = $this->model_articles->getMouvFilter($store,$categorie,$produit_name);
		$this->data['articles_counts'] = $this->model_articles->getMouvFilter_count($store,$categorie,$produit_name);
		$this->data['categorie'] = $categorie;
        $this->data['produit_name'] = $produit_name;
		$this->data['date_precise'] = $date_precise;
		if($store == 3){
        	$this->render('backend/standart/administrator/articles/articles_mvmt_prod', $this->data);
        }else{
        	$this->render('backend/standart/administrator/articles/articles_mvmt', $this->data);
        }
        
	}
	public function vente_details($index = 0,$store){

		$this->is_allowed('facturation_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        redirect('administrator/rapport/vente_detail/'.$store.'');
	}
	private function vente_requete($store, $critere1, $critere2) {
		$facturations = $this->model_facturation->getListReport($store,$critere1,$critere2);
		$facture = [];
		if(count($facturations) > 0) {
			foreach ($facturations as $fact) {
				if($fact->TYPE_FACTURE === 'is_commande') {
					$queryCommande = $this->db->query('SELECT CP.REF_PRODUCT_CODEBAR_COMMAND_PROD,CP.REF_COMMAND_CODE_PROD,
					CP.NAME_COMMAND_PROD,CP.QUANTITE_COMMAND_PROD,CP.PRIX_COMMAND_PROD,
					CP.PRIX_TOTAL_COMMAND_PROD,CP.DISCOUNT_AMOUNT_COMMAND_PROD,CP.DISCOUNT_PERCENT_COMMAND_PROD 
					FROM pos_store_'.$store.'_ibi_commandes_produits CP WHERE 
					CP.REF_COMMAND_CODE_PROD="'.$fact->REF_CODE_COMMAND_FACTURE.'" GROUP BY REF_PRODUCT_CODEBAR_COMMAND_PROD');
					if($queryCommande->num_rows() > 0) {
						$i = 0;
						$array = $queryCommande->result();
						for($j = 0;$j < count($array); $j++) {
							$commande = $array[$j];
								$data = [
								"REF_PRODUCT_CODEBAR_COMMAND_PROD"=> $commande->REF_PRODUCT_CODEBAR_COMMAND_PROD, 
								"NUMERO_FACTURE"=> $fact->NUMERO_FACTURE, 
								"REF_CODE_COMMAND_FACTURE" => $fact->REF_CODE_COMMAND_FACTURE,
								"TYPE_FACTURE"=>$fact->TYPE_FACTURE, 
								"AUTHOR_FACTURE"=>$fact->AUTHOR_FACTURE, 
								"DATE_CREATION_FACTURE"=>$fact->DATE_CREATION_FACTURE, 
								"REF_CLIENT_FACTURE"=>$fact->REF_CLIENT_FACTURE,
								"NAME_COMMAND_PROD"=>$commande->NAME_COMMAND_PROD, 
								"QUANTITE_COMMAND_PROD"=>$commande->QUANTITE_COMMAND_PROD,
								"PRIX_COMMAND_PROD"=>$commande->PRIX_COMMAND_PROD, 
								"PRIX_TOTAL_COMMAND_PROD"=>$commande->PRIX_TOTAL_COMMAND_PROD,
								"DISCOUNT_PERCENT_COMMAND_PROD"=>$commande->DISCOUNT_PERCENT_COMMAND_PROD, 
								"DISCOUNT_AMOUNT_COMMAND_PROD"=>$commande->DISCOUNT_AMOUNT_COMMAND_PROD
							];
							array_push($facture, $data);
						}
					}
				} 
				else if($fact->TYPE_FACTURE === 'is_proforma') {
					$queryProforma= $this->db->query('SELECT PP.REF_PRODUCT_CODEBAR_PROFORMA_PROD,PP.REF_PROFORMA_CODE_PROD,
					PP.NAME_PROFORMA_PROD,PP.QUANTITE_PROFORMA_PROD,PP.PRIX_PROFORMA_PROD,PP.PRIX_TOTAL_PROFORMA_PROD,
					PP.DISCOUNT_AMOUNT_PROFORMA_PROD,PP.DISCOUNT_PERCENT_PROFORMA_PROD 
					FROM pos_store_'.$store.'_ibi_proforma_produits PP WHERE 
					PP.REF_PROFORMA_CODE_PROD="'.$fact->REF_CODE_COMMAND_FACTURE.'" GROUP BY REF_PRODUCT_CODEBAR_PROFORMA_PROD');
					if($queryProforma->num_rows() > 0) {
						$array = $queryProforma->result();
						for($j = 0;$j < count($array); $j++) {
							$commande = $array[$j];
								$data = [
								"REF_PRODUCT_CODEBAR_PROFORMA_PROD"=> $commande->REF_PRODUCT_CODEBAR_PROFORMA_PROD, 
								"NUMERO_FACTURE"=> $fact->NUMERO_FACTURE, 
								"REF_CODE_COMMAND_FACTURE" => $fact->REF_CODE_COMMAND_FACTURE,
								"TYPE_FACTURE"=>$fact->TYPE_FACTURE, 
								"AUTHOR_FACTURE"=>$fact->AUTHOR_FACTURE, 
								"DATE_CREATION_FACTURE"=>$fact->DATE_CREATION_FACTURE, 
								"REF_CLIENT_FACTURE"=>$fact->REF_CLIENT_FACTURE,
								"NAME_PROFORMA_PROD"=>$commande->NAME_PROFORMA_PROD, 
								"QUANTITE_PROFORMA_PROD"=>$commande->QUANTITE_PROFORMA_PROD,
								"PRIX_PROFORMA_PROD"=>$commande->PRIX_PROFORMA_PROD, 
								"PRIX_TOTAL_PROFORMA_PROD"=>$commande->PRIX_TOTAL_PROFORMA_PROD,
								"DISCOUNT_PERCENT_PROFORMA_PROD"=>$commande->DISCOUNT_PERCENT_PROFORMA_PROD, 
								"DISCOUNT_AMOUNT_PROFORMA_PROD"=>$commande->DISCOUNT_AMOUNT_PROFORMA_PROD
							];
							array_push($facture, $data);
								
						}
					}
				}
			}
		}
		return $facture;
	}
	public function vente_detail($store){

		$this->is_allowed('facturation_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $date_depart1 = $this->input->get('date_depart');
        $date_fin1 = $this->input->get('date_fin');
        $date_depart = $date_depart1.' 00:00:00';
        $date_fin = $date_fin1.' 23:59:59';

		$facturations = $this->vente_requete($store,$date_depart,$date_fin);
		$this->data['facturation'] = $facturations;
		$this->data['date_depart'] = $date_depart1;
        $this->data['date_fin'] = $date_fin1;
		$this->data['facturation_counts'] = count($facturations);

		$this->render('backend/standart/administrator/facturation/facturation_report', $this->data);

	}
	public function situation_caisses($index = 0,$store){

		$this->is_allowed('facturation_report');

		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        redirect('administrator/rapport/situation_caisse/'.$store.'');
	}
	public function situation_caisse($store = 0){

		$this->is_allowed('depense_sitcaisse');
		if($store == 0){

        	set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
			redirect('administrator/store');
             
        }
        $date_depart1 = $this->input->get('date_depart');
        $date_fin1 = $this->input->get('date_fin');
        $date_depart = $date_depart1.' 00:00:00';
        $date_fin = $date_fin1.' 23:59:59';
        
        $this->data['situations'] = $this->model_registers->getSituation($date_depart,$date_fin);
        $this->data['situation_counts'] = $this->model_registers->getSituation_count($date_depart,$date_fin);

        $this->data['date_depart'] = $date_depart1;
        $this->data['date_fin'] = $date_fin1;

		$this->render('backend/standart/administrator/depense/depense_situation_caisse', $this->data);

	}

	public function export_data($store, $offset = 0) {

		$table['tableau'] = '';
		$categorie = $this->input->post('categorie');
        $produit_name = $this->input->post('produit_name');
        $date_depart = $this->input->post('date_depart');
        $date_fin = $this->input->post('date_fin');
        $limit = 1000000000000;
        $mvt_articles = $this->model_articles->getMouvFilter($store,$categorie,$produit_name, $limit, $offset);

		$table['tableau'] .= ' <table class="table table-bordered table-striped dataTable" id="export_all">

			<thead>

				<tr class="">

					<th>No</th>

					<th>Codebar</th>

					<th>Articles</th>

					<th>Famille</th>

					<th>Categorie</th>

					<th>Entrées</th>

					<th>Sorties</th>';

					if($store == 1 OR $store == 2) {
						$table['tableau'] .= '<th>Reservées</th>';
					}
					$table['tableau'] .= '
				</tr>

			</thead>

			<tbody id="tbody_export_all">';

			$i=0;
            foreach($mvt_articles as $article) {
              
	            $entree = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_in" AND DATE(DATE_CREATION_SF) >= "'.$date_depart.'" AND DATE_FORMAT(DATE_CREATION_SF, "%Y-%m-%d") <= "'.$date_fin.'"');
                $sortie = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_SF) AS QUANTITE_SF FROM pos_store_'.$this->uri->segment(4).'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF="'.$article->CODEBAR_ARTICLE.'" AND TYPE_SF="stock_out" AND DATE_FORMAT(DATE_CREATION_SF,"%Y-%m-%d") >= "'.$date_depart.'" AND DATE_FORMAT(DATE_CREATION_SF, "%Y-%m-%d") <= "'.$date_fin.'"');   
	             
	             $reserve = $this->model_registers->get_quantite_reserve($this->uri->segment(4),$article->CODEBAR_ARTICLE);

	             $livraison = $this->model_dashboard->getRequeteOne('SELECT SUM(QUANTITE_LIVR_PRODUIT) AS QUANTITE_LIVR_PRODUIT FROM pos_store_'.$this->uri->segment(4).'_ibi_livraison_produit lvp JOIN pos_store_'.$this->uri->segment(4).'_ibi_livraison lv ON lv.NUMERO_LIVRAISON=lvp.REF_NUM_LIVR_PRODUIT WHERE REF_PRODUCT_CODEBAR_LIVR_PRODUIT="'.$article->CODEBAR_ARTICLE.'" AND lv.DATE_CREATION_LIVRAISON >= "'.$date_depart.'" AND lv.DATE_CREATION_LIVRAISON <= "'.$date_fin.'"');
	             
	             $i++;
	             if(!isset($entree)){
	                $entree['QUANTITE_SF'] = 0;
	             }
	             if(!isset($sortie)){
	                $sortie['QUANTITE_SF'] = 0;
	             }
	             if(!isset($reserve)){
	                $reserve['QTE_RESERVE'] = 0;
	             }else{
	                $reserve['QTE_RESERVE'] = $reserve['QTE_RESERVE'] - $livraison['QUANTITE_LIVR_PRODUIT'];
	             }

	             $table['tableau'] .= '<tr> 
                   <td>'. $i .'</td>    
                   <td>'. $article->CODEBAR_ARTICLE .'</td> 
                   <td width="500">'. $article->DESIGN_ARTICLE .'</td> 
                   <td>'. $article->NOM_FAMILLE .'</td>
                   <td>'. $article->NOM_CATEGORIE .'</td>
                   <td>'. $entree['QUANTITE_SF'] .'</td>
                   <td>'. $sortie['QUANTITE_SF'] .'</td>';
                   if($store == 1 OR $store == 2) {
							$table['tableau'] .= '<td>'. $article->RESERVE_ARTICLE .'</td>';
						 }
                $table['tableau'] .= '</tr>';
         	}
         	$table['tableau'] .= '</tbody>
                </table>';
		
		echo json_encode($table);
	}

	public function export_vente($store) {
		$table['tableau'] = '';
        $date_depart1 = $this->input->post('date_depart');
        $date_fin1 = $this->input->post('date_fin');
        $date_depart = $date_depart1.' 00:00:00';
        $date_fin = $date_fin1.' 23:59:59';
		$vente_details = $this->vente_requete($store,$date_depart,$date_fin);

		$table['tableau'] .= ' <table class="table table-bordered table-striped dataTable" id="export_all">

			<thead>

				<tr class="">
					<th>N°</th>
	               <th>Date</th>
	               <th>N° Facture</th>
	               <th>Client</th>
	               <th>Codebar</th>
	               <th>Famille</th>
	               <th>Categorie</th>
	               <th>Articles</th>
	               <th>Quantités</th>
	               <th>CA HTVA</th>
	               <th>Rabais</th>
	               <th>Total HTVA</th>
	               <th>Total TVAC</th>
	               <th>Vendeur</th>
				</tr>

			</thead>

			<tbody id="tbody_export_all">';

			$i=0;
	         foreach($vente_details as $facturations){

				$author_fact = $this->model_registers->getOne('aauth_users',array('id'=>$facturations['AUTHOR_FACTURE']));
				$client_fact = $this->model_registers->getOne('pos_ibi_clients',array('ID_CLIENT'=>$facturations['REF_CLIENT_FACTURE']));
				
				if($facturations['TYPE_FACTURE'] == 'is_proforma'){
				   $type_facture = "Proforma";
				   $name_article = isset($facturations['NAME_PROFORMA_PROD']) ? $facturations['NAME_PROFORMA_PROD']: '';
				   $codebarre = isset($facturations['REF_PRODUCT_CODEBAR_PROFORMA_PROD']) ? $facturations['REF_PRODUCT_CODEBAR_PROFORMA_PROD'] : '';
				   $quantite = isset($facturations['QUANTITE_PROFORMA_PROD']) ? $facturations['QUANTITE_PROFORMA_PROD'] : 0;
				   $prix_unitaire = isset($facturations['PRIX_PROFORMA_PROD']) ? $facturations['PRIX_PROFORMA_PROD'] : '';
				   $amount_discount = isset($facturations['DISCOUNT_AMOUNT_PROFORMA_PROD']) ? $facturations['DISCOUNT_AMOUNT_PROFORMA_PROD']: 0;
				   $percent_discount = isset($facturations['DISCOUNT_PERCENT_PROFORMA_PROD']) ? $facturations['DISCOUNT_PERCENT_PROFORMA_PROD'] : 0;
				   $rabais = $amount_discount+$percent_discount;
				   $total_htva = isset($facturations['PRIX_TOTAL_PROFORMA_PROD']) ? $facturations['PRIX_TOTAL_PROFORMA_PROD'] : 0;
				   $tva = $total_htva*0.18;
				   $totalRabais = $total_htva - $rabais;
				   // $tva = $total_htva*0.18;
				   $total_tvac = $totalRabais*1.18;
				   // $total_tvac = $total_htva+$tva;
				 
				}else{
				   $type_facture = "Commande";
				   $name_article = isset($facturations['NAME_COMMAND_PROD']) ? $facturations['NAME_COMMAND_PROD'] : '';
				   $codebarre = isset($facturations['REF_PRODUCT_CODEBAR_COMMAND_PROD']) ? $facturations['REF_PRODUCT_CODEBAR_COMMAND_PROD'] : '';
				   $quantite = isset($facturations['QUANTITE_COMMAND_PROD']) ? $facturations['QUANTITE_COMMAND_PROD'] : 0;
				   $prix_unitaire = isset($facturations['PRIX_COMMAND_PROD']) ? $facturations['PRIX_COMMAND_PROD'] : 0;
				   $amount_discount = isset($facturations['DISCOUNT_AMOUNT_COMMAND_PROD']) ? $facturations['DISCOUNT_AMOUNT_COMMAND_PROD']: 0;
				   $percent_discount = isset($facturations['DISCOUNT_PERCENT_COMMAND_PROD']) ? $facturations['DISCOUNT_PERCENT_COMMAND_PROD'] : 0;
				   $rabais = $facturations['DISCOUNT_AMOUNT_COMMAND_PROD']+$facturations['DISCOUNT_PERCENT_COMMAND_PROD'];
				   $total_htva = isset($facturations['PRIX_TOTAL_COMMAND_PROD']) ? $facturations['PRIX_TOTAL_COMMAND_PROD'] : 0;
				   $totalRabais = $total_htva - $rabais;
				   // $tva = $total_htva*0.18;
				   $total_tvac = $totalRabais*1.18;

				}
	         $famille = $this->model_dashboard->getRequeteOne("SELECT fam.NOM_FAMILLE, cat.NOM_CATEGORIE FROM pos_store_".$store."_ibi_articles art LEFT JOIN pos_store_".$store."_famille fam ON fam.ID_FAMILLE = art.REF_CATEGORIE_ARTICLE LEFT JOIN pos_store_".$store."_ibi_categories cat ON cat.ID_CATEGORIE = art.REF_SOUS_CATEGORIE_ARTICLE WHERE art.CODEBAR_ARTICLE = '".$codebarre."'");
	         $famille_name = isset($famille['NOM_FAMILLE']) ? $famille['NOM_FAMILLE'] : '';
	         $category_name = isset($famille['NOM_CATEGORIE']) ? $famille['NOM_CATEGORIE'] : '';
	         $i++;
	         $table['tableau'] .='<tr> 
	               <td>'. $i .'</td>          
	               <td>'.$facturations->DATE_CREATION_FACTURE .'</td>
	               <td>'. _ent($facturations->NUMERO_FACTURE) .'</td>  
	               <td>'. $client_fact['NOM_CLIENT'] .'</td> 
	               <td>'. $codebarre .'</td>
	               <td>'. $famille_name .'</td>
	               <td>'. $category_name .'</td>
	               <td>'. _ent($name_article) .'</td>
	               <td>'. _ent($quantite) .'</td>
	               <td>'. _ent($prix_unitaire) .'</td>
	               <td>'. _ent($rabais) .'</td>
	               <td>'. _ent($total_htva) .'</td>
	               <td>'. _ent($total_tvac) .'</td>
	               <td>'. $author_fact['username'] .'</td> 

	            </tr>';
         	}
         	$table['tableau'] .= '</tbody>
                </table>';
		
		echo json_encode($table);
	}
	
}
