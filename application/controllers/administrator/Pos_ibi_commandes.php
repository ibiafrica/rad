<?php
defined('BASEPATH') or exit('No direct script access allowed');



/*update pos_store_5_ibi_articles_stock_flow fl join pos_ibi_commandes c set fl.DATE_CREATION_SF = c.DATE_CREATION_POS_IBI_COMMANDES WHERE c.CODE = fl.REF_COMMAND_CODE_SF*/




/**
 *| --------------------------------------------------------------------------
 *| Pos Ibi Commandes Controller
 *| --------------------------------------------------------------------------
 *| Pos Ibi Commandes site
 *|
 */
class pos_ibi_commandes extends Admin
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_rm');
		$this->load->model('model_pos_ibi_commandes');
	}

	/**
	 * show all Pos Ibi Commandess
	 *
	 * @var $offset String
	 */
	public function index($offset = 0)
	{
		$this->is_allowed('pos_ibi_commandes_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$status 	= $this->input->get('status');
		$type 	= $this->input->get('type_commande');
		$shift = $this->input->get('shift');

		if ($shift != '') {
			$debut = '';
			$fin = '';
		} else {
			$debut = $this->input->get('DEBUT');
			$fin = $this->input->get('FIN');
		}


		$this->data['start'] = $debut;
		$this->data['end'] = $fin;

		$commandes = $this->model_pos_ibi_commandes->get($debut, $fin, $shift,$type, $filter, $field, $status, 100, $offset);
		// $commandes = $this->db->select("*")->from("pos_ibi_commandes")->get()->result();
		// print_r($commandes);
		// die;
		// $total_headers = $this->model_pos_ibi_commandes->get_total_header($shift, $filter, $field, $status, 200, $offset);
		$this->data['pos_ibi_commandes_counts'] = $this->model_pos_ibi_commandes->count_all($debut, $fin, $shift,$type, $filter, $status, $field);

		// var_dump($total_headers);
		// exit;

		for ($c = 0; $c < sizeof($commandes); $c++) {
			$current_c = $commandes[$c];
			$bons = [];
			$prods = $this->db->select("*")
				->from("pos_ibi_commandes_produits cp")
				->join("pos_ibi_stores st", "st.ID_STORE = cp.STORE_ID_POS_IBI_COMMANDES_PRODUITS")
				->where("cp.POS_IBI_COMMANDES_ID", $current_c->ID_POS_IBI_COMMANDES)
				->where("cp.QUANTITE >", 0)
				->get()->result();

			$current_c->PRODUCTS = $prods;
			for ($cp = 0; $cp < sizeof($prods); $cp++) {
				if (!isset($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS])) {
					$bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS] = [];
					// $bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS][0]['STOCK'] = $prods[$cp]->NAME_STORE;
					// $bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS][0]['VENTE'] = $prods[$cp]->REF_COMMAND_CODE;
				}
				array_push($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS], $prods[$cp]);
			}
			$current_c->BON = array_values($bons);
		}

		$this->data['pos_ibi_commandess'] = $commandes;
		$this->data['statut'] = $status;
		$this->data['total_somme'] = 0;
		$config = [
			'base_url'     => 'administrator/pos_ibi_commandes/index/',
			'total_rows'   =>  $this->model_pos_ibi_commandes->count_all($debut, $fin, $shift,$type, $filter, $status, $field),
			'per_page'     => 100,
			'uri_segment'  => 4,
		];

		$this->data['clients_list'] = json_encode($this->db->select("NOM_CLIENT, PRENOM, ID_CLIENT")->from("pos_clients")
			->where("DELETE_STATUS_CLIENT", 0)->get()->result());
		if ($type=='') {
			
			$this->data['pagination'] = $this->pagination($config);
		}else{
			$this->data['pagination'] = '';
		}
		
		$this->data['params'] = $this->model_rm->getOne("contribuable");
		$this->template->title('Pos Ibi Commandes List');
		// dump($this->data);die;
		$this->render('backend/standart/administrator/pos_ibi_commandes/pos_ibi_commandes_list', $this->data);
	}


	public function sendFacturesJournaliere($id)
	{

		$credentials = $this->db->query("SELECT username,password FROM contribuable")->row();

        $credentials->password = htmlspecialchars($credentials->password);

        $req = $this->db->query('SELECT * FROM contribuable');

        $tva=0;

		 if ($req->num_rows() >0) {
        
        $tva = $req->row()->vat_taxpayer;
        $tpp = new stdClass;
        $tpp->tp_type = $req->row()->tp_type;
        $tpp->tp_name = $req->row()->tp_name;
        $tpp->tp_TIN = $req->row()->tp_TIN;
        $tpp->tp_trade_number = $req->row()->tp_trade_number;
        $tpp->tp_postal_number = $req->row()->tp_postal_number;
        $tpp->tp_phone_number = $req->row()->tp_phone_number;
        $tpp->tp_address_province = $req->row()->tp_address_province;
        $tpp->tp_address_commune = $req->row()->tp_address_commune;
        $tpp->tp_address_quartier = $req->row()->tp_address_quartier;
        $tpp->tp_address_avenue = $req->row()->tp_address_avenue;
        $tpp->tp_address_rue = $req->row()->tp_address_rue;
        $tpp->tp_address_number = $req->row()->tp_address_number;
        $tpp->vat_taxpayer = $req->row()->vat_taxpayer;
        $tpp->ct_taxpayer = $req->row()->ct_taxpayer;
        $tpp->tl_taxpayer = $req->row()->tl_taxpayer;
        $tpp->tp_fiscal_center = $req->row()->tp_fiscal_center;
        $tpp->tp_activity_sector = $req->row()->tp_activity_sector;
        $tpp->tp_legal_form = $req->row()->tp_legal_form;
    }
		$resquest = $this->db->query("SELECT pro.TVA,p.ID_POS_IBI_COMMANDES, p.CODE AS Invoice_Number,pro.NAME_PRODUIT AS NOM_ARTICLE, pro.QUANTITE AS QUANTITE, pro.PRIX_VENDU AS P_U,'0' AS Item_CT, '0' AS Item_TL, (pro.QUANTITE*(pro.PRIX_VENDU-(pro.PRIX_VENDU - (pro.PRIX_VENDU/pro.TVA)))) AS Item_Price_NVAT, (pro.PRIX_VENDU - (pro.PRIX_VENDU/pro.TVA)) AS TVA,(pro.QUANTITE*pro.PRIX_VENDU) AS Item_Price_WVAT,(pro.QUANTITE*pro.PRIX_VENDU) AS Item_Total_Amount
		FROM pos_ibi_commandes p INNER JOIN pos_ibi_commandes_produits pro ON p.CODE=pro.REF_COMMAND_CODE WHERE pro.DELETED_STATUS_POS_IBI_COMMANDES_PRODUITS=0 AND p.ID_POS_IBI_COMMANDES ='" . $id . "'");


		$resquests = $this->db->query("SELECT p.ID_POS_IBI_COMMANDES,cl.ID_CLIENT, p.CODE AS invoice_number,p.DATE_CREATION_POS_IBI_COMMANDES AS invoice_date, concat(cl.NOM_CLIENT,' ',cl.PRENOM)AS customer_name, cl.NIF_CLIENT AS customer_TIN,cl.ADRESSE_CLIENT AS customer_address,'' AS Payment_Type,if(cl.AVEC_TVA=0,'0','1') AS vat_customer_payer,'-' AS invoice_type,'' AS cancelled_invoice_ref,p.DATE_CREATION_POS_IBI_COMMANDES AS invoice_signature_date
		FROM pos_ibi_commandes p INNER JOIN  pos_clients cl ON cl.ID_CLIENT=p.CLIENT_ID_COMMANDE WHERE p.ID_POS_IBI_COMMANDES  ='" . $id . "'  GROUP BY p.CODE ")->result();

		//dd($resquest->result());die;

		$dataObject = [];
		$clientObject = [];
		$obj = [];

		foreach ($resquest->result() as $key) {

			$commandeData = $key->ID_POS_IBI_COMMANDES > 0 ?  $key->Invoice_Number : "";

			if (!isset($obj[$commandeData][$key->NOM_ARTICLE])) {
				$dataaa = new stdClass;
				$dataaa->item_designation = $key->NOM_ARTICLE;
				$dataaa->item_quantity = $key->QUANTITE;
				$dataaa->item_price = $key->P_U;
				$dataaa->item_ct = $key->Item_CT;
				$dataaa->item_tl = $key->Item_TL;
				$dataaa->item_price_nvat = round($key->Item_Price_NVAT);
				$dataaa->vat = round($key->TVA);
				$dataaa->item_price_wvat = $key->Item_Price_WVAT;
				$dataaa->item_total_amount = $key->Item_Total_Amount;
				if (!isset($obj[$commandeData])) {
					$obj[$commandeData] = [];
				}
				array_push($obj[$commandeData], $dataaa);
			}
		}



		foreach ($resquests as $key => $value) {
			if (isset($obj[$value->invoice_number])) {
				$datas = new stdClass;
            // 'tp_type'->$obj[$tp_type];
             $date_range = new DateTime($value->invoice_date);

             $signature = $req->row()->tp_TIN . '/' . $credentials->username . '/' . $date_range->format('YmdHis') . '/' . $value->invoice_number;
             $datas->invoice_number = $value->invoice_number;
             $datas->invoice_date = $value->invoice_date;
             $datas->customer_name = $value->customer_name;
             $datas->customer_TIN = $value->customer_TIN;
             $datas->custom_address = $value->customer_address;
             $datas->vat_customer_payer = '0';
             $datas->payment_type = $value->Payment_Type;

             $datas->cancelled_invoice_ref = $value->cancelled_invoice_ref;

             $datas->invoice_signature = $signature;

             $datas->invoice_signature_date = $value->invoice_date;
             
             $datas->invoice_items = $obj[$value->invoice_number];

            $values = (object) array_merge((array) $tpp, (array) $datas);
            array_push($clientObject, $values);
			}
		}


		    $login = new stdClass;
            $login->username = $credentials->username;
            $login->password = $credentials->password;
            $sendFacture = ['all_data' => array_values($clientObject), 'loginData' => $login];
    
   
        return $sendFacture;
	}


    public function multiSend()
    {


        $credentials = $this->db->query("SELECT username,password FROM `contribuable`")->row();

        $credentials->password = htmlspecialchars($credentials->password);

         $results = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE SYNC_OBR = 0 ORDER BY DATE_CREATION_POS_IBI_COMMANDES DESC LIMIT 50")->result();


        $num = 1;
        $str = '';
        foreach ($results as $value) {
            if(count($results)==$num){
                $str.=$value->ID_POS_IBI_COMMANDES;

            }
            else{
                $str.=$value->ID_POS_IBI_COMMANDES.',';
            }
            $num+=1;
        }


        $facture_listes_obr = "(" .$str.")";

       // print_r($facture_listes_obr);exit;

        $contribuable = $this->db->query('SELECT * FROM contribuable');

        $tpp = new stdClass;
        $tpp->tp_type =$contribuable->row()->tp_type;
        $tpp->tp_name = $contribuable->row()->tp_name;
        $tpp->tp_TIN = $contribuable->row()->tp_TIN;
        $tpp->tp_trade_number = $contribuable->row()->tp_trade_number;
        $tpp->tp_postal_number = $contribuable->row()->tp_postal_number;
        $tpp->tp_phone_number = $contribuable->row()->tp_phone_number;
        $tpp->tp_address_province = $contribuable->row()->tp_address_province;
        $tpp->tp_address_commune = $contribuable->row()->tp_address_commune;
        $tpp->tp_address_quartier = $contribuable->row()->tp_address_quartier;
        $tpp->tp_address_avenue = $contribuable->row()->tp_address_avenue;
        $tpp->tp_address_rue = $contribuable->row()->tp_address_rue;
        $tpp->tp_address_number = $contribuable->row()->tp_address_number;
        $tpp->vat_taxpayer = $contribuable->row()->vat_taxpayer;
        $tpp->ct_taxpayer = $contribuable->row()->ct_taxpayer;
        $tpp->tl_taxpayer = $contribuable->row()->tl_taxpayer;
        $tpp->tp_fiscal_center = $contribuable->row()->tp_fiscal_center;
        $tpp->tp_activity_sector = $contribuable->row()->tp_activity_sector;
        $tpp->tp_legal_form = $contribuable->row()->tp_legal_form;



        $resquest = $this->db->query("SELECT pro.TVA,p.ID_POS_IBI_COMMANDES, p.CODE AS Invoice_Number,pro.NAME_PRODUIT AS NOM_ARTICLE, pro.QUANTITE AS QUANTITE, pro.PRIX_VENDU AS P_U,'0' AS Item_CT, '0' AS Item_TL, (pro.QUANTITE*(pro.PRIX_VENDU-(pro.PRIX_VENDU - (pro.PRIX_VENDU/pro.TVA)))) AS Item_Price_NVAT, (pro.PRIX_VENDU - (pro.PRIX_VENDU/pro.TVA)) AS TVA,(pro.QUANTITE*pro.PRIX_VENDU) AS Item_Price_WVAT,(pro.QUANTITE*pro.PRIX_VENDU) AS Item_Total_Amount
		FROM pos_ibi_commandes p INNER JOIN pos_ibi_commandes_produits pro ON p.CODE=pro.REF_COMMAND_CODE WHERE pro.DELETED_STATUS_POS_IBI_COMMANDES_PRODUITS=0 AND p.ID_POS_IBI_COMMANDES IN ".$facture_listes_obr."  ORDER BY p.CODE")->result();

        $resquests = $this->db->query("SELECT p.ID_POS_IBI_COMMANDES,cl.ID_CLIENT, p.CODE AS invoice_number,p.DATE_CREATION_POS_IBI_COMMANDES AS invoice_date, concat(cl.NOM_CLIENT,' ',cl.PRENOM)AS customer_name, cl.NIF_CLIENT AS customer_TIN,cl.ADRESSE_CLIENT AS customer_address,'' AS Payment_Type,if(cl.AVEC_TVA=0,'0','1') AS vat_customer_payer,'-' AS invoice_type,'' AS cancelled_invoice_ref,p.DATE_CREATION_POS_IBI_COMMANDES AS invoice_signature_date
		FROM pos_ibi_commandes p INNER JOIN  pos_clients cl ON cl.ID_CLIENT=p.CLIENT_ID_COMMANDE WHERE p.ID_POS_IBI_COMMANDES IN ".$facture_listes_obr."  ORDER BY p.CODE")->result();


        //dd($resquests->result());die;

        $dataObject=[];
        $clientObject=[];
        $obj=[];

        foreach ($resquest as $key) {
            
            $commandeData = $key->ID_POS_IBI_COMMANDES > 0 ?  $key->Invoice_Number : "";
            
            if (!isset($obj[$commandeData][$key->NOM_ARTICLE])) {
                $dataaa = new stdClass;
                $dataaa->item_designation = $key->NOM_ARTICLE;
                $dataaa->item_quantity = $key->QUANTITE;
                $dataaa->item_price = $key->P_U;
                $dataaa->item_ct = $key->Item_CT;
                $dataaa->item_tl = $key->Item_TL;
                $dataaa->item_price_nvat = $key->Item_Price_NVAT;
                $dataaa->vat = $key->TVA;
                $dataaa->item_price_wvat = $key->Item_Price_WVAT;
                $dataaa->item_total_amount = $key->Item_Total_Amount;
                if(!isset($obj[$commandeData])) {
                    $obj[$commandeData] = [];
                }
                array_push($obj[$commandeData], $dataaa);
            }
        
    }
    
    foreach ($resquests as $key => $value) {
        if(isset($obj[$value->invoice_number])) {
            // 'tp_type'->$obj[$tp_type];

            $datas = new stdClass;
            // 'tp_type'->$obj[$tp_type];
             $date_range = new DateTime($value->invoice_date);

             $signature = $contribuable->row()->tp_TIN . '/' . $credentials->username . '/' . $date_range->format('YmdHis') . '/' . $value->invoice_number;
             $datas->invoice_number = $value->invoice_number;
             $datas->invoice_date = $value->invoice_date;
             $datas->customer_name = $value->customer_name;
             $datas->customer_TIN = $value->customer_TIN;
             $datas->custom_address = $value->customer_address;
             $datas->vat_customer_payer = '0';
             $datas->payment_type = $value->Payment_Type;

             $datas->cancelled_invoice_ref = $value->cancelled_invoice_ref;

             $datas->invoice_signature = $signature;

             $datas->invoice_signature_date = $value->invoice_date;
             
             $datas->invoice_items = $obj[$value->invoice_number];
            
            $values = (object) array_merge((array) $tpp, (array) $datas);
            array_push($clientObject, $values);
            // $value = $values;
        }
    }

            $login = new stdClass;
            $login->username = $credentials->username;
            $login->password = $credentials->password;
            $out = ['all_data' => array_values($clientObject), 'loginData' => $login];

        //echo "<pre>";print_r($out);die;

        echo json_encode($out);
    }



	/*public function update_stock_flow()
	{
		

		$request = $this->db->query('SELECT CP.STORE_ID_POS_IBI_COMMANDES_PRODUITS,CP.REF_COMMAND_CODE,CP.REF_PRODUCT_CODEBAR,CP.SHIFT_ID,CP.QUANTITE,CP.PRIX_VENDU,CP.PRIX_TOTAL,CP.DATE_CREATION_POS_IBI_COMMANDES_PRODUITS,C.CREATED_BY_POS_IBI_COMMANDES FROM pos_ibi_commandes_produits CP,pos_ibi_commandes C
		 WHERE C.ID_POS_IBI_COMMANDES=CP.POS_IBI_COMMANDES_ID AND CP.STORE_ID_POS_IBI_COMMANDES_PRODUITS >0')->result();

		foreach ($request as $key) {
			
			$data= array(
				'REF_ARTICLE_BARCODE_SF'=> $key->REF_PRODUCT_CODEBAR,
				'QUANTITE_SF' => $key->QUANTITE,
				'REF_COMMAND_CODE_SF'=> $key->REF_COMMAND_CODE,
				'QUANTITE_SF' => $key->QUANTITE,
				'SHIFT_ID_S'=> $key->SHIFT_ID,
				'TYPE_SF' => 'sale',
				'UNIT_PRICE_SF'=> $key->PRIX_VENDU,
				'TOTAL_PRICE_SF' => $key->PRIX_TOTAL,
				'DATE_CREATION_SF'=> $key->DATE_CREATION_POS_IBI_COMMANDES_PRODUITS,
				'CREATED_BY_SF' => $key->CREATED_BY_POS_IBI_COMMANDES,
				'REF_ARTICLE_BARCODE_SF'=> $key->REF_PRODUCT_CODEBAR,
				'QUANTITE_SF' => $key->QUANTITE,
			);

			$qq=$this->db->query('DELETE FROM pos_store_'.$key->STORE_ID_POS_IBI_COMMANDES_PRODUITS.'_ibi_articles_stock_flow WHERE REF_COMMAND_CODE_SF LIKE "VEN%"');

			if ($qq) {

				$donne =$this->db->insert("pos_store_".$key->STORE_ID_POS_IBI_COMMANDES_PRODUITS."_ibi_articles_stock_flow",$data);
			}

		}

	}*/



	public function facture_view($id)
	{
		$this->is_allowed('pos_ibi_commandes_update');
		$this->data['commande'] = $this->model_rm->getOne('pos_ibi_commandes', array("ID_POS_IBI_COMMANDES" => $id));

		$this->data['prods'] = $this->db->select("*")
			->from("pos_ibi_commandes_produits ")
			->where("REF_COMMAND_CODE", $this->data['commande']['CODE'])
			->where("QUANTITE >", 0)
			->get()->result();


		$this->data['clients'] = $this->db->get_where('pos_clients', array('ID_CLIENT' => $this->data['commande']['CLIENT_ID_COMMANDE']))->row();

		$this->data['info'] = $this->model_rm->getOne('contribuable');

		$this->template->title('Pos Ibi Commandes Update');
		$this->render('backend/standart/administrator/pos_ibi_commandes/facture_view', $this->data);
	}

	public function reduction_itm($id, $reduction)
	{
		$up = $this->model_rm->update("pos_ibi_commandes_produits", array("ID_POS_IBI_COMMANDES_PRODUITS" => $id), array("DISCOUNT_PERCENT" => $reduction));

		if ($up) {
			echo json_encode(array("msg" => "reduction faite avec success!!!!", "success" => true));
		} else {
			echo json_encode(array("msg" => "erreur!!!!", "success" => false));
		}
	}


	public function reduction_com($id, $reduction)
	{
		$up = $this->model_rm->update("pos_ibi_commandes", array("ID_POS_IBI_COMMANDES" => $id), array("REDUCTION_COMMANDE" => $reduction));

		if ($up) {
			echo json_encode(array("msg" => "reduction faite avec success!!!!", "success" => true));
		} else {
			echo json_encode(array("msg" => "erreur!!!!", "success" => false));
		}
	}


	public function void_to_request($offset = 0)
	{

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		$status 	= $this->input->get('status');
		$shift = $this->input->get('shift');

		$debut = $this->input->get('DEBUT');
		$fin = $this->input->get('FIN');

		$this->data['start'] = $debut;
		$this->data['end'] = $fin;

		$commandes = $this->model_pos_ibi_commandes->get_void_request($debut, $fin, $shift, $filter, $field, $status, $this->limit_page, $offset);
		$this->data['pos_ibi_commandes_counts'] = $this->model_pos_ibi_commandes->count_all_void_request($debut, $fin, $shift, $filter, $status, $field);

		for ($c = 0; $c < sizeof($commandes); $c++) {
			$current_c = $commandes[$c];
			$bons = [];
			$prods = $this->db->select("*")
				->from("pos_ibi_commandes_produits cp")
				->join("pos_ibi_stores st", "st.ID_STORE = cp.STORE_ID_POS_IBI_COMMANDES_PRODUITS")
				->where("cp.POS_IBI_COMMANDES_ID", $current_c->ID_POS_IBI_COMMANDES)
				->where("cp.QUANTITE >", 0)
				->get()->result();

			$current_c->PRODUCTS = $prods;
			for ($cp = 0; $cp < sizeof($prods); $cp++) {
				if (!isset($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS])) {
					$bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS] = [];
				}
				array_push($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS], $prods[$cp]);
			}
			$current_c->BON = array_values($bons);
		}

		$this->data['pos_ibi_commandess'] = $commandes;
		$config = [
			'base_url'     => 'administrator/pos_ibi_commandes/void_to_request/',
			'total_rows'   => $this->model_pos_ibi_commandes->count_all_void_request($debut, $fin, $filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['clients_list'] = json_encode($this->db->select("NOM_CLIENT, PRENOM, ID_CLIENT")->from("pos_clients")
			->where("DELETE_STATUS_CLIENT", 0)->get()->result());
		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Ibi Commandes List');
		$this->render('backend/standart/administrator/pos_ibi_commandes/void_request', $this->data);
	}


	public function facture_imprimer($offset = 0)
	{

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');
		//$status 	= $this->input->get('status');
		$shift = $this->input->get('shift');

		$debut = $this->input->get('DEBUT');
		$fin = $this->input->get('FIN');

		$this->data['start'] = $debut;
		$this->data['end'] = $fin;

		$commandes = $this->model_pos_ibi_commandes->get_facture_imprimer($debut, $fin, $shift, $filter, $field, 100, $offset);
		$this->data['pos_ibi_commandes_counts'] = $this->model_pos_ibi_commandes->count_facture_imprimer($debut, $fin, $shift, $filter, $field);

		for ($c = 0; $c < sizeof($commandes); $c++) {
			$current_c = $commandes[$c];
			$bons = [];
			$prods = $this->db->select("*")
				->from("pos_ibi_commandes_produits cp")
				->join("pos_ibi_stores st", "st.ID_STORE = cp.STORE_ID_POS_IBI_COMMANDES_PRODUITS")
				->where("cp.POS_IBI_COMMANDES_ID", $current_c->ID_POS_IBI_COMMANDES)
				->where("cp.QUANTITE >", 0)
				->get()->result();

			$current_c->PRODUCTS = $prods;
			for ($cp = 0; $cp < sizeof($prods); $cp++) {
				if (!isset($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS])) {
					$bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS] = [];
				}
				array_push($bons[$prods[$cp]->STORE_ID_POS_IBI_COMMANDES_PRODUITS], $prods[$cp]);
			}
			$current_c->BON = array_values($bons);
		}

		$this->data['pos_ibi_commandess'] = $commandes;
		$config = [
			'base_url'     => 'administrator/facture_imprimer/index/',
			'total_rows'   => $this->model_pos_ibi_commandes->count_facture_imprimer($debut, $fin, $filter, $field),
			'per_page'     => 100,
			'uri_segment'  => 4,
		];

		$this->data['clients_list'] = json_encode($this->db->select("NOM_CLIENT, PRENOM, ID_CLIENT")->from("pos_clients")
			->where("DELETE_STATUS_CLIENT", 0)->get()->result());
		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pos Ibi Commandes List');
		$this->render('backend/standart/administrator/pos_ibi_commandes/facture_imprimer', $this->data);
	}


	public function debloquer_facture($id)
	{

		$data = array(
			'PRINT_COUNT' => 0,
		);
		$critere_commande = array("ID_POS_IBI_COMMANDES" => $id);

		$debloquer_facture = $this->model_pos_ibi_commandes->modification('pos_ibi_commandes', $critere_commande, $data);

		if ($debloquer_facture) {
			set_message('success');
		} else {
			set_message('error');
		}

		redirect_back();
	}


	public function det_pdf_detail_by_status()
	{
		$detail = $this->uri->segment(4);
		$commandes = $this->model_pos_ibi_commandes->get_commande_status_rapport($detail);

		$this->template->title('Pos Ibi Commandes List');
		$this->data['commande'] = $commandes;
		$this->render('backend/standart/administrator/pos_ibi_commandes/rapport_pdf_by_statut', $this->data);
	}


	public function facture_remise()
	{
		$id_commande = $this->uri->segment(4);
		$data = $this->db->get_where('pos_ibi_commandes_produits', array('POS_IBI_COMMANDES_ID' => $id_commande))->result();
		$this->data['produits'] = $data;

		$this->template->title('Pos Ibi Commandes List');
		$this->render('backend/standart/administrator/pos_ibi_commandes/facture_remise', $this->data);
	}



	public function update_montant_du()
	{

		$req = $this->db->query('SELECT SUM(pro.PRIX_TOTAL) AS MONTANT,p.ID_POS_IBI_COMMANDES FROM pos_ibi_commandes_produits pro,pos_ibi_commandes p WHERE p.ID_POS_IBI_COMMANDES=pro.POS_IBI_COMMANDES_ID AND  p.DATE_CREATION_POS_IBI_COMMANDES >="2021-09-02 08:20:06" AND (p.COMMANDE_STATUS = 10 OR p.COMMANDE_STATUS = 11) GROUP BY pro.POS_IBI_COMMANDES_ID');

		foreach ($req->result() as $key) {


			$up = $this->db->query("UPDATE pos_ibi_commandes SET MONTANT_DU='" . $key->MONTANT . "' WHERE ID_POS_IBI_COMMANDES='" . $key->ID_POS_IBI_COMMANDES . "'");
		}


		if ($up) {
			echo json_encode(array("msg" => "reduction faite avec success!!!!", "success" => true));
		} else {
			echo json_encode(array("msg" => "erreur!!!!", "success" => false));
		}
	}

	/**
	 * Add new pos_ibi_commandess
	 *
	 */
	public function add()
	{
		$this->is_allowed('pos_ibi_commandes_add');

		$this->template->title('Pos Ibi Commandes New');
		$this->render('backend/standart/administrator/pos_ibi_commandes/pos_ibi_commandes_add', $this->data);
	}

	/**
	 * Add New Pos Ibi Commandess
	 *
	 * @return JSON
	 */
	public function add_save()
	{
		if (!$this->is_allowed('pos_ibi_commandes_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}



		if ($this->form_validation->run()) {

			$save_data = [];


			$save_pos_ibi_commandes = $this->model_pos_ibi_commandes->store($save_data);

			if ($save_pos_ibi_commandes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pos_ibi_commandes;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pos_ibi_commandes/edit/' . $save_pos_ibi_commandes, 'Edit Pos Ibi Commandes'),
						anchor('administrator/pos_ibi_commandes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
							anchor('administrator/pos_ibi_commandes/edit/' . $save_pos_ibi_commandes, 'Edit Pos Ibi Commandes')
						]),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_commandes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_commandes');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}

	public function transfer_command($client_id, $cmd_id)
	{
		$update_service = array(
			
			'DATE_MOD_POS_IBI_COMMANDES' => date('Y-m-d H:i:s'),
			'CLIENT_ID_COMMANDE' => $client_id,
			
		);

		$update = $this->db->update("pos_ibi_commandes", $update_service, array("ID_POS_IBI_COMMANDES" => $cmd_id));
		if ($update) {
			echo json_encode(["success" => true]);
		} else {
			echo json_encode(["success" => false]);
		}
	}

	/**
	 * Update view Pos Ibi Commandess
	 *
	 * @var $id String
	 */
	public function edit($id)
	{
		$this->is_allowed('pos_ibi_commandes_update');

		$this->data['pos_ibi_commandes'] = $this->model_pos_ibi_commandes->find($id);

		$this->template->title('Pos Ibi Commandes Update');
		$this->render('backend/standart/administrator/pos_ibi_commandes/pos_ibi_commandes_update', $this->data);
	}

	/**
	 * Update Pos Ibi Commandess
	 *
	 * @var $id String
	 */
	public function edit_save($id)
	{
		if (!$this->is_allowed('pos_ibi_commandes_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
			]);
			exit;
		}


		if ($this->form_validation->run()) {

			$save_data = [
				'CLIENT_ID_COMMANDE' => $this->input->post('CLIENT_ID_COMMANDE'),
				'DATE_CREATION_POS_IBI_COMMANDES' => $this->input->post('DATE_CREATION_POS_IBI_COMMANDES'),
				'CREATED_BY_POS_IBI_COMMANDES' => $this->input->post('CREATED_BY_POS_IBI_COMMANDES'),
			];


			$save_pos_ibi_commandes = $this->model_pos_ibi_commandes->change($id, $save_data);

			if ($save_pos_ibi_commandes) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pos_ibi_commandes', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', []),
						'success'
					);

					$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pos_ibi_commandes');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pos_ibi_commandes');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}



	public function detail_commandes()
	{

		$debut = $this->input->post('debut');
		$fin = $this->input->post('fin');

		$get_command_detail = $this->db->query("SELECT * FROM pos_ibi_commandes_produits WHERE DATE_CREATION_POS_IBI_COMMANDES_PRODUITS >= '" . $debut.' 00:00:00'. "' AND  DATE_CREATION_POS_IBI_COMMANDES_PRODUITS <='".$fin.' 23:59:59'."'")->row_array();
	}



	public function delete($id = null)
	{
		$this->is_allowed('pos_ibi_commandes_delete');

		$this->load->helper('file');

		$commentValue = $this->input->get('inputValue');
		$arr_id = $this->input->get('id');
		$GET_FACT = $this->db->query("SELECT * FROM facturer_reserver WHERE ID_FACTURE = " . $id . " ")->num_rows();

		$remove = false;
		$critere = array('ID_FACTURE' => $id);
		$critere_commande = array("ID_POS_IBI_COMMANDES" => $id);
		$datas = array(
			'DELETED_DATE_POS_IBI_COMMANDES' => date('Y-m-d h:i:s'),
			'DELETED_STATUS_POS_IBI_COMMANDES' => 1,
			'DELETED_USER_POS_IBI_COMMANDES' => get_user_data('id'),
			'DELETED_COMMENT_POS_IBI_COMMANDES' => $commentValue
		);

		if ($GET_FACT != 0) {
			$mod = $this->model_pos_ibi_commandes->suppression("facturer_reserver", $critere);
		} else {
		}
		if (!empty($id)) {
			$remove = $this->model_pos_ibi_commandes->modification('pos_ibi_commandes', $critere_commande, $datas);
		} elseif (count($arr_id) > 0) {
			foreach ($arr_id as $id) {
				$remove = $this->model_pos_ibi_commandes->modification('pos_ibi_commandes', $critere_commande, $datas);
			}
		}
		if ($remove) {
			set_message(cclang('has_been_deleted', 'pos_ibi_commandes'), 'success');
		} else {
			set_message(cclang('error_delete', 'pos_ibi_commandes'), 'error');
		}

		redirect_back();
	}



	public function annulation_commande_paiement($id_commands)
	{
		$id_command = $this->input->post('id_command');
		$id_paiement = $this->input->post('id_paiement');
		$montant_paiement = $this->input->post('montant_paiement');

		$get_command = $this->db->query("SELECT SUM(PRIX_VENDU*QUANTITE) AS MONTANT_COMMAND FROM pos_ibi_commandes_produits WHERE POS_IBI_COMMANDES_ID = '" . $id_command . "' ")->row_array();

		$get_paiement = $this->db->query("SELECT SUM(MONTANT_PAIEMENT) AS MONTANT_PAIEMENT FROM pos_paiements WHERE COMMANDE_ID = '" . $id_command . "' AND STATUT_ANNULATION = 0 ")->row_array();

		$condition_cmd = array('ID_POS_IBI_COMMANDES' => $id_command);
		$data_cmd = array('COMMANDE_STATUS' => 0);


		if ($get_paiement['MONTANT_PAIEMENT'] == $montant_paiement) {
			$statut_command = $this->model_rm->update('pos_ibi_commandes', $condition_cmd, array('COMMANDE_STATUS' => 0));
		} elseif ($montant_paiement >= $get_command['MONTANT_COMMAND']) {
			$statut_command = $this->model_rm->update('pos_ibi_commandes', $condition_cmd, $data_cmd);
		} elseif ($montant_paiement < $get_command['MONTANT_COMMAND']) {
			$this->db->where($condition_cmd);
			$this->db->set('COMMANDE_STATUS', 1);
			$statut_command = $this->db->update('pos_ibi_commandes');
			// $statut_command = $this->model_rm->update('pos_ibi_commandes', $condition_cmd, array('COMMANDE_STATUS' => 1));
		} else {
		}

		if ($statut_command) {

			$up_paiement = $this->model_rm->update('pos_paiements', array('ID_PAIEMENT' => $id_paiement), array('STATUT_ANNULATION' => 1));
		}

		echo json_encode($up_paiement);
	}



	public function view($commande_id)
	{

		$ref_codebar_command = $this->db->get_where('pos_ibi_commandes', ['ID_POS_IBI_COMMANDES' => $commande_id])->row_array()['CODE'];
		$this->is_allowed('pos_ibi_commandes_view');
		$data['shift'] = $this->db->query('SELECT SHIFT_STATUS FROM cashier_shifts WHERE SHIFT_STATUS=0');
		$data['liste_paiement'] = $this->model_pos_ibi_commandes->Commande_paiement($commande_id);
		$data['restant'] = $this->model_pos_ibi_commandes->Commande_paiement_count_montant($commande_id);

		$data['total_res'] = $this->model_pos_ibi_commandes->Commande_paiement_count_montant_total_res($commande_id);

		$product = $this->db->get_where('pos_ibi_commandes_produits', array("REF_COMMAND_CODE" => $ref_codebar_command))->result();


		$data['command'] = $this->db->get_where('pos_ibi_commandes', array('ID_POS_IBI_COMMANDES' => $commande_id))->row();
		$elmtPrix = 0;
		foreach ($product as $pr) {
			$elmtPrix += $pr->QUANTITE * $pr->PRIX_VENDU;
		}
		$data['total'] = $elmtPrix;


		$this->template->title('Pos Ibi Commandes Detail');
		$this->render('backend/standart/administrator/pos_ibi_commandes/pos_ibi_commandes_view', $data);
	}



	/**
	 * Export to excel
	 *
	 * @return Files Excel .xls
	 */
	public function export()
	{
		$this->is_allowed('pos_ibi_commandes_export');

		$this->model_pos_ibi_commandes->export('pos_ibi_commandes', 'pos_ibi_commandes');
	}

	/**
	 * Export to PDF
	 *
	 * @return Files PDF .pdf
	 */
	public function export_pdf()
	{
		$this->is_allowed('pos_ibi_commandes_export');

		$this->model_pos_ibi_commandes->pdf('pos_ibi_commandes', 'pos_ibi_commandes');
	}


	public function detail_commande($id)
	{

		$data['liste_commande'] = $this->model_pos_ibi_commandes->Detail_commande($id);
		$this->render('backend/standart/administrator/pos_ibi_commande/pos_ibi_commande_detail_facture', $data);
	}


	public function reservation_fact()
	{

		$ID_CMD = $this->input->post('id_commande');
		$GET_CMD = $this->db->query("SELECT * FROM pos_ibi_commandes WHERE ID_POS_IBI_COMMANDES =" . $ID_CMD . "  ")->row_array();

		$GET_CMD_PRODUCT = $this->db->query("SELECT SUM(PRIX_TOTAL) AS TOTAL_COMMANDE FROM pos_ibi_commandes_produits WHERE POS_IBI_COMMANDES_ID =" . $ID_CMD . "  ")->row_array()['TOTAL_COMMANDE'];


		$year = date("Y");
		$last = $this->db->select("*")
			->from('facturer_reserver')
			->where('YEAR(DATE_FACT_RESERVER)', $year)
			->order_by('ID_FACT_RESERVER', 'DESC')
			->limit(1)
			->get()->result();
		$code_next = 1;
		$zeros = "0000";

		if (sizeof($last) > 0) {
			$iter = strlen($last[0]->ID_FACT_RESERVER);
			$code_next = $last[0]->ID_FACT_RESERVER + 1;
			$zeros = "";
			while ($iter < 5) {
				$zeros = $zeros . "0";
				$iter++;
			}
		}
		$code = $zeros . $code_next . '/' . date('m/y');
		$DATA_SAVES  = array(
			'CODE_FACT_RESERVER' => 'FACT' . $code,
			'ID_FACTURE' => $ID_CMD,
			'MONTANT_FACT_RESERVER' => $GET_CMD_PRODUCT,
			'ID_CLIENT' => $GET_CMD['CLIENT_ID_COMMANDE'],
			'	CREATE_BY_FACT_RESERVER' => get_user_data('id')
		);

		$INSERTIONS = $this->model_pos_ibi_commandes->RESERVATION("facturer_reserver", $DATA_SAVES);
		echo json_encode($INSERTIONS);
	}



	public function facturer_reserver_bs($offset = 0)
	{

		$this->is_allowed('pos_ibi_commandes_list');
		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['facturation'] = $this->model_pos_ibi_commandes->get_facture($filter, $field, $this->limit_page = 20, $offset);

		$this->data['count_reserv_facture'] = $this->model_pos_ibi_commandes->count_all_facture($filter, $field);
		$config = [
			'base_url'     => 'administrator/pos_ibi_commandes/facturer_reserver_bs/',
			'total_rows'   => $this->model_pos_ibi_commandes->count_all_facture($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];
		$this->data['pagination'] = $this->pagination($config);
		$this->template->title('Factures Reservers');
		$this->render('backend/standart/administrator/pos_ibi_commandes/facturer_reserver_bs', $this->data);
	}




	public function suppression_facture()
	{

		$ID_FACTURE = $this->input->post('id_facture');
		$CRITERE  = array('ID_FACT_RESERVER' => $ID_FACTURE);
		$DATA_MODIFIC  = array(
			'DELETE_STATUS' => 1,
			'DELETE_BY' => get_user_data('id'),
			'DATE_DELETE' => date('Y-m-d h:i:s')
		);

		$UPDATE = $this->model_pos_ibi_commandes->modification("facturer_reserver", $CRITERE, $DATA_MODIFIC);
		echo json_encode($UPDATE);
	}

	public function get_shift()
	{
		# code...
		$shift_data = $this->db->query('SELECT * FROM `cashier_shifts` ')->result();
		$shift = [];

		foreach ($shift_data as $k) {
			# code...
			$shift[] = $k;
		}

		//echo json_encode($shift_data);

		$this->response([
			'data' => $shift
		], API::HTTP_OK);
	}

	public function facture_remise_add($id)
	{
		$commande = $id;

		$type_remise = $this->input->post('type_remise');
		$globale_remise = $this->input->post('total_all_val');
		$requete = null;

		for ($count = 0; $count < count($_POST['PRIX_VENDU']); $count++) {
			//update commande total remise 
			$this->db->query('UPDATE pos_ibi_commandes SET TOTAL_DISCOUNT=' . $globale_remise . ' WHERE ID_POS_IBI_COMMANDES=' . $commande);
			//---------------------------//
			if ($type_remise == 1) {
				$requete = $this->db->query('UPDATE pos_ibi_commandes_produits SET DISCOUNT_PERCENT=' . $_POST["discount"][$count] . ',DISCOUNT_ESPECE=0 WHERE ID_POS_IBI_COMMANDES_PRODUITS=' . $_POST['produit_id'][$count]);
				// $requete=$this->db->query('UPDATE pos_ibi_commandes_produits SET DISCOUNT_PERCENT='.$_POST["discount"][$count].',DISCOUNT_ESPECE=0,PRIX_VENDU='.$_POST["PRIX_VENDU"][$count].',PRIX_TOTAL='.$_POST["prix_total"][$count].' WHERE ID_POS_IBI_COMMANDES_PRODUITS='.$_POST['produit_id'][$count]);
			} else {
				$requete = $this->db->query('UPDATE pos_ibi_commandes_produits SET DISCOUNT_ESPECE=' . $_POST["discount"][$count] . ',DISCOUNT_PERCENT=0 WHERE ID_POS_IBI_COMMANDES_PRODUITS=' . $_POST['produit_id'][$count]);
			}
		}
		if ($requete) {
			echo json_encode([
				'message' => set_message('La remise a ete effectuer avec success', 'success'),
				'success' => true,
				'redirect' => base_url('administrator/pos_ibi_commandes')
			]);
		} else {
			echo json_encode([
				'message' => set_message('Une erreur est survenue lors de la remise', 'error'),
				'success' => true,
				'redirect' => base_url('administrator/pos_ibi_commandes')
			]);
		}
	}
}


/* End of file pos_ibi_commandes.php */
/* Location: ./application/controllers/administrator/Pos Ibi Commandes.php */