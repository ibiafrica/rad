<?php
defined('BASEPATH') or exit('No direct script access allowed');


/*update pos_ibi_commandes fl join pos_paiements c set fl.DATE_PAIEMENT_COMMANDE = c.DATE_CREATION_PAIEMENT WHERE fl.ID_pos_IBI_COMMANDES = c.COMMANDE_ID */

class Approvisionnements extends Admin
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('model_pos_ibi_approvisionnements');
       
        $this->load->model('model_rm');
    }
    public function index($offset = 0)
    {
        $offset = $this->uri->segment(4);
        $store = $this->uri->segment(2);

        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');

        $date_starts = $date_start . ' 00:00:00';
        $date_ends = $date_end . ' 23:59:59';

        // print_r($date_starts);exit;

        $this->is_allowed('approvisionnements_list');
        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $filter = $this->input->get('q');
        $field  = $this->input->get('f');

        $this->data['approvisionnements'] = $this->model_pos_ibi_approvisionnements->get($date_start, $date_end, $filter, $field, $this->limit_page = 100, $offset);
     

        $this->data['approvisionnements_counts'] = $this->model_pos_ibi_approvisionnements->count_all($filter, $field);
        $config = [
            'base_url'     => 'approvisionnements/' . $store . '/index',
            'total_rows'   => $this->model_pos_ibi_approvisionnements->count_all($filter, $field),
            'per_page'     => $this->limit_page =100,
            'uri_segment'  => 4,
        ];


        $this->data['pagination'] = $this->pagination($config);
        $this->template->title('Liste des approvisionnements');
          // var_dump($this->data['approvisionnements']);exit;
        $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_list', $this->data);
    }
    /**
     * Add new approvisionnements
     *
     */
    public function add()
    {
        $store = $this->uri->segment(2);
        $this->is_allowed('approvisionnements_add');
        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->data['fournisseurs'] = $this->db->query('SELECT *FROM pos_ibi_fournisseurs WHERE
         DELETE_STATUS_FOURNISSEUR=0')->result_array();

        $this->data['stores'] = $this->db->query('SELECT *FROM pos_ibi_stores WHERE ID_STORE= ' . $store . ' ')->result_array();

        $this->template->title('Nouveau approvisionnement');
        $this->data['getProduit'] = $this->db->query('SELECT * FROM pos_ibi_ingredients WHERE "DELETE_STATUS_INGREDIENT" = 0 ')->result();
        $this->data['boutique'] = $this->model_pos_ibi_approvisionnements->getBoutique('SELECT *FROM pos_ibi_stores WHERE STATUS_STORE="opened"  AND ID_STORE!=' . $store . '');
        $this->data['etat_ingredient'] = $this->model_pos_ibi_approvisionnements->getBoutique('SELECT *FROM etat_ingredients');
        
       /* $this->data['type_requisition'] = $this->model_pos_ibi_approvisionnements->getBoutique('SELECT *FROM pos_ibi_requisition req WHERE  req.ID_REQ NOT IN (SELECT ID_REQUISITION FROM  pos_store_2_ibi_arrivages WHERE DELETE_STATUS_ARRIVAGE = 0  AND TYPE_APPROVISIONNEMENT !="Sans_demande" ) AND STATUS_REQ =3 AND DATE_CREATION_REQ > "2021-05-30 00:00:00" AND DELETE_STATUS_REQ =0 ORDER BY ID_REQ DESC');*/

        $this->data['type_requisition'] = $this->model_pos_ibi_approvisionnements->getBoutique('SELECT *FROM pos_ibi_requisition req WHERE STATUS_REQ =2 AND DATE_CREATION_REQ > "2021-05-30 00:00:00" AND DELETE_STATUS_REQ =0 ORDER BY ID_REQ DESC');
        
        // echo "<pre>";
        // print_r($this->data['type_requisition']);exit;
        
        $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_add', $this->data);
    }
    public function add_type($prefix)
    {
        $this->is_allowed('approvisionnements_add');

        $data = array(
            'TITRE_ARRIVAGE' => $this->input->post('titre_arrivage'),
            'DESCRIPTION_ARRIVAGE' => $this->input->post('description'),
            'TYPE_ARRIVAGE' => $this->input->post('type_approvisionnememt'),
            'DATE_CREATION_ARRIVAGE' => date("Y-m-d H:i:s"),
            'CREATED_BY_ARRIVAGE' => get_user_data('id')
        );
        $save_type = $this->model_pos_ibi_approvisionnements->insert('pos_store_' . $prefix . '_ibi_arrivages', $data);
        if ($save_type) {
            $arrivages = $this->model_pos_ibi_approvisionnements->getList('pos_store_' . $prefix . '_ibi_arrivages', array('DELETE_STATUS_ARRIVAGE' => 0));

            $resultat = "<option>Choisir un titre</option>";
            foreach ($arrivages as $arrivage) {
                $resultat .= "<option value='" . $arrivage->ID_ARRIVAGE . "' items='" . $arrivage->TYPE_ARRIVAGE . "'>" . $arrivage->TITRE_ARRIVAGE . "</option>";
            }
        }
        echo json_encode($resultat);
    }
    public function update_type_add($prefix)
    {
        $this->is_allowed('approvisionnements_update');

        $table = 'pos_store_' . $prefix . '_ibi_type_approvisionnement';
        $id_arrivage = $this->input->post('id_arrivage');

        $data = array(
            'TITRE_ARRIVAGE' => $this->input->post('titre_arrivage'),
            'DESCRIPTION_ARRIVAGE' => $this->input->post('description'),
            'TYPE_ARRIVAGE' => $this->input->post('type_approvisionnememt'),
            'DATE_CREATION_ARRIVAGE' => date("Y-m-d H:i:s"),
            'CREATED_BY_ARRIVAGE' => get_user_data('id')
        );
        $update_type = $this->model_pos_ibi_approvisionnements->update('pos_store_' . $prefix . '_ibi_arrivages', array('ID_ARRIVAGE' => $id_arrivage), $data);
        if ($update_type) {
            $arrivages = $this->model_pos_ibi_approvisionnements->getList('pos_store_' . $prefix . '_ibi_arrivages', array('DELETE_STATUS_ARRIVAGE' => 0));

            $resultat = "<option>Choisir un titre</option>";
            foreach ($arrivages as $arrivage) {
                if ($arrivage->ID_ARRIVAGE == $id_arrivage) {
                    $resultat .= "<option selected value='" . $arrivage->ID_ARRIVAGE . "' items='" . $arrivage->TYPE_ARRIVAGE . "'>" . $arrivage->TITRE_ARRIVAGE . "</option>";
                } else {
                    $resultat .= "<option value='" . $arrivage->ID_ARRIVAGE . "' items='" . $arrivage->TYPE_ARRIVAGE . "'>" . $arrivage->TITRE_ARRIVAGE . "</option>";
                }
            }
        }
        echo json_encode($resultat);
    }

    public function add_save($prefix)
    {
         $montant = $this->input->post('MONTANT_PAYER');
            $montant_payer = "";
        if ($montant ==0) {
            $montant_payer = $this->input->post('MONTANT_PAYERS');
        } else {
            $montant_payer = $montant;

        }

        $type_payement = $this->input->post('TYPE_P');

        if ($type_payement=='') {
           
           $type_payement =0;
        }

        else{
           $type_payement = $this->input->post('TYPE_P');

        }

        $fournisseurs = $this->input->post('Fournisseurs');

        if ($fournisseurs=='') {
           
           $fournisseurs =0;
        }

        else{
           $fournisseurs = $this->input->post('Fournisseurs');  
        }

        //print_r($obj); exit;

        $requisition_get_bs = $this->input->post('requisition_get_bs');
        $id_req ="";

        if ($prefix == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        if (!$this->is_allowed('hospital_ibi_requisition_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }
     
   
        $type = $this->input->post('type_approvisionnememt');
        if ($type == 'Sans_demande') {
            $titre = $this->input->post('TITRES');
            $id_req = '';
            $this->form_validation->set_rules('TITRES', 'TITRE', 'trim|required', array('required' => 'Veuillez entrer le titre'));
        } else {
            $titre = $this->input->post('TITRE');
            $id_req = $requisition_get_bs;
        $this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required', array('required' => 'Veuillez entrer le titre'));

        $this->form_validation->set_rules('QUANTITY_INGREDIENT[]', 'QTE APPROVISIONNER', 'trim|required', array('required' => 'Veuillez entrer la Quantité approvisionné'));

        $this->form_validation->set_rules('PRIX_INGREDIENT[]', 'PRIX APPROVISIONNER', 'trim|required', array('required' => 'Veuillez entrer le prix approvisionné'));
        

        }

         $year = date("Y");
                $last = $this->db->select("*")
                    ->from('pos_store_2_ibi_arrivages')
                    ->where('YEAR(DATE_CREATION_ARRIVAGE)', $year)
                    ->order_by('ID_ARRIVAGE', 'DESC')
                    ->limit(1)
                    ->get()->result();
                $code_next = 1;
                $zeros = "0000";
                if (sizeof($last) > 0) {
                    $iter = strlen($last[0]->ID_ARRIVAGE);
                    $code_next = $last[0]->ID_ARRIVAGE + 1;
                    $zeros = "";
                    while ($iter < 5) {
                        $zeros = $zeros . "0";
                        $iter++;
                    }
                }
                $code_approvisionnement = $zeros . $code_next . '/' . date('m/y');

        if ($this->form_validation->run()) {

            $value_arrivages = 0;
            $quantites = 0;
            for ($i = 0; $i < count($_POST['NOM_INGREDIENT']); $i++) {
                $qte = $_POST['QUANTITY_INGREDIENT'][$i];
                $prix = $_POST['PRIX_INGREDIENT'][$i];
                $value_arrivages += ($qte*$prix);
                $quantites += $_POST['QUANTITY_INGREDIENT'][$i];
            }

            $zero = 0;
            $save_data = [
                'TITRE_ARRIVAGE' => $titre,
                'DESCRIPTION_ARRIVAGE' => $this->input->post('description'),
                'TYPE_APPROVISIONNEMENT' => $type,
                'CODE_ARRIVAGE' => 'APPR/'.$code_approvisionnement,
                'VALUE_ARRIVAGE' => $value_arrivages,
                'MONTANT_PAYER_FOURNISSEUR' => $montant_payer,
                'ITEMS_ARRIVAGE' => $quantites,
                'ID_REQUISITION' =>$id_req,
                'REF_PROVIDERS_ARRIVAGE' => $zero,
                'DELETE_STATUS_ARRIVAGE'=>0,
                'DATE_CREATION_ARRIVAGE' => date('Y-m-d H:i:s'),
                'CREATED_BY_ARRIVAGE' => get_user_data('id')

            ];

            $save_id = $this->model_pos_ibi_approvisionnements->register('pos_store_2_ibi_arrivages', $save_data);
            $insertId = $this->db->insert_id();

            $montant = 0;



        $QT_REQUISITIONNER =0;
        $PRIX_REQUISITIONNER =0;

        if(is_null($this->input->post('QT_REQ')) || is_null($this->input->post('PRIX_REQ')) ){
           $QT_REQUISITIONNER =0;
           $PRIX_REQUISITIONNER =0;
        }
        else{
            $PRIX_REQUISITIONNER = $this->input->post("PRIX_REQ");
            $QT_REQUISITIONNER = $this->input->post("QT_REQ");

        }
        // var_dump($QT_REQUISITIONNER);exit();

        $total_requisition =0;

        $montant = 0;


            for ($i = 0; $i < count($_POST['NOM_INGREDIENT']); $i++) {

                 $total_requisition = $QT_REQUISITIONNER[$i] * $PRIX_REQUISITIONNER[$i];

                /*if (isset($_POST['MONTANT_PAYER'][$i]) and $_POST['MONTANT_PAYER'][$i] > 0) {
                    $montant = $_POST['MONTANT_PAYER'][$i];
                } else {
                    $montant = 0;
                }*/

                $data = [
                    'TYPE_PAYEMENT' => $type_payement,
                    'MONTANT_PAYER' => $montant,
                    'CODE_BAR' => $_POST['CODE_BAR'][$i],
                    'ID_APPOVISIONNEMENT' => $insertId,
                    'QUANTITE_ARRIVAGE_DETAIL' => $_POST['QUANTITY_INGREDIENT'][$i],
                    'PRIX_UNITAIRE' => $_POST['PRIX_INGREDIENT'][$i],
                    'FROM_STORE' =>$prefix,
                    'PRIX_REQUISITIONNER' => $PRIX_REQUISITIONNER[$i],
                    'QUANTITE_REQUISITIONNER' => $QT_REQUISITIONNER[$i],
                    'TOTAL_REQUISITIONNER'=>$total_requisition,
                    'ID_FOURNISSEUR' =>  $fournisseurs,
                    'DATE_CREATION_ARRIVAGE_DETAIL' => date('Y-m-d H:i:s'),
                    'CREATE_BY_ARRIVAGE_DETAIL' => get_user_data('id')
                ];


                //print_r(base_url('approvisionnements/' . $prefix . '/index')); exit();

     

                $ins = $this->model_pos_ibi_approvisionnements->insert('pos_store_detail_arrivage', $data);

                if ($ins ) {

                    if ($type != 'Sans_demande') {

                       $this->db->query('UPDATE pos_ibi_article_requisition SET STATUS_PROD_REQ=6 WHERE ID_REQ='.$id_req.' AND CODEBAR_INGREDIENT_REQ="'.$_POST['CODE_BAR'][$i].'"');
                    }

                  
                   
                  
                }


            }

         


            if ($save_id) {

                if ($type != 'Sans_demande') {


                 $nombre_art= $this->db->query('SELECT * FROM pos_ibi_article_requisition WHERE ID_REQ='.$id_req);

                   $nombre_art_req= $this->db->query('SELECT * FROM pos_store_detail_arrivage a, pos_store_2_ibi_arrivages r WHERE r.ID_ARRIVAGE=a.ID_APPOVISIONNEMENT AND r.ID_REQUISITION='.$id_req);

                   if ($nombre_art->num_rows() == $nombre_art_req->num_rows()) {
                      
                      $this->db->query('UPDATE pos_ibi_requisition SET STATUS_REQ=6 WHERE ID_REQ='.$id_req);
                   }

               }
                   
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_id;
                    $this->data['message'] = 'approvisionnement envoyée';
                } else {
                    set_message('approvisionnement envoyée', 'success');



                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('approvisionnements/' . $prefix . '/index/');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('requisition/' . $prefix . '/index/');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }
    public function view()
    {
        $id = $this->uri->segment(4);
        $prefix = $this->uri->segment(2);
        $critere = array(
            "ID_APPOVISIONNEMENT" => $id
        );

        $this->is_allowed('approvisionnements_view');
        if ($prefix == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->data['approvisionnements_counts'] = $this->db->query("SELECT * FROM 
        pos_store_detail_arrivage WHERE ID_APPOVISIONNEMENT = $id AND DELETE_STATUS_ARRIVAGE_DETAIL =0")->num_rows();

        $this->data['approvisionnements'] = $this->model_pos_ibi_approvisionnements->getRequete('
select * from 
    (SELECT ID_ARTICLE AS ID,
         UNITE_ARTICLE AS UNITE, 
         CODEBAR_ARTICLE AS CODEBAR,
		 DESIGN_ARTICLE AS NOM_ART, 
		 QUANTITY_ARTICLE AS QTE,
		 PRIX_DACHAT_ARTICLE AS PRIX,
		  IS_INGREDIENT AS TYPES
		FROM `pos_store_' . $prefix . '_ibi_articles`  WHERE DELETE_STATUS_ARTICLE =0 ) rq1
          INNER JOIN pos_store_detail_arrivage
          INNER JOIN pos_store_2_ibi_arrivages
          INNER JOIN aauth_users 

           ON aauth_users.id = pos_store_detail_arrivage.CREATE_BY_ARRIVAGE_DETAIL AND
            pos_store_2_ibi_arrivages.ID_ARRIVAGE = pos_store_detail_arrivage.ID_APPOVISIONNEMENT
           AND pos_store_detail_arrivage.CODE_BAR = rq1.CODEBAR
        
           WHERE ID_APPOVISIONNEMENT = "' . $id . '"

         ');

        // echo "<pre>";
        // print_r($this->data['approvisionnements']);exit;

        $this->template->title('Detail de l\'approvisionnement');
        $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_view', $this->data);
    }


    public function edit_save($store = 0, $id_arrivage = 0, $id_arr_detail = 0)
    {

        $QUANTITE_INGREDIENT = $this->input->post('QUANTITE_INGREDIENT');
        $UNIT_PRICE = $this->input->post('UNIT_PRICE');
        $ID_INGREDIENT = $this->input->post('ID_INGREDIENT');
        $CODEBAR = $this->input->post('CODEBAR');
        $ID_APPOVISIONNEMENT = $this->input->post('ID_APPOVISIONNEMENT');
        $ID_ARRIVAGE_DETAIL = $this->input->post('ID_ARRIVAGE_DETAIL');

        /*$FOURNISSEUR = $this->input->post('FOURNISSEUR');
        $TYPE_PAYEMENT = $this->input->post('TYPE_PAYEMENT');
        $MONTANT_PAYER = $this->input->post('MONTANT_PAYER');*/

        $dataArrivageDetail = array("QUANTITE_ARRIVAGE_DETAIL" => $QUANTITE_INGREDIENT, "PRIX_UNITAIRE" => $UNIT_PRICE);


        $this->db->where(array("ID_ARRIVAGE_DETAIL" => $ID_ARRIVAGE_DETAIL));
        $this->db->set($dataArrivageDetail);
        $up = $this->db->update("pos_store_detail_arrivage");

        if ($up) {
          
            $data['approvisionnements'] = $this->model_pos_ibi_approvisionnements->getRequete('
         select * from
         (SELECT ID_ARTICLE AS ID,
         UNITE_ARTICLE AS UNITE,
         CODEBAR_ARTICLE AS CODEBAR,
         DESIGN_ARTICLE AS NOM_ART,
         QUANTITY_ARTICLE AS QTE,
         PRIX_DACHAT_ARTICLE AS PRIX,
         IS_INGREDIENT AS TYPES
         FROM `pos_store_' . $store . '_ibi_articles` WHERE DELETE_STATUS_ARTICLE =0 )rq1
         INNER JOIN pos_store_detail_arrivage
         INNER JOIN pos_store_2_ibi_arrivages
         INNER JOIN aauth_users

         ON aauth_users.id = pos_store_detail_arrivage.CREATE_BY_ARRIVAGE_DETAIL AND
         pos_store_2_ibi_arrivages.ID_ARRIVAGE = pos_store_detail_arrivage.ID_APPOVISIONNEMENT
         AND pos_store_detail_arrivage.CODE_BAR = rq1.CODEBAR

         WHERE ID_APPOVISIONNEMENT = "' . $ID_APPOVISIONNEMENT . '"

         ');
        }
        echo json_encode($data['approvisionnements']);
    }


    public function delete_arrivage($prefix, $id)
    {
        $this->is_allowed('approvisionnements_delete');

        if ($prefix == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $CommentValue = $this->input->get('inputValue');

        $get_arrivage = $this->model_pos_ibi_approvisionnements->getOne(
            'pos_store_' . $prefix . '_ibi_arrivages',
            array('ID_ARRIVAGE' => $id)
        );
 

        if ($get_arrivage['STATUS_ARRIVAGE'] > 0) {
            set_message('Impossible de supprimer ce type approvisionnement', 'error');
            
        } else{

        $get_arrivage = $this->model_pos_ibi_approvisionnements->getOne(
            'pos_store_' . $prefix . '_ibi_arrivages',
            array('ID_ARRIVAGE' => $id)
        );
 

        /*if ($get_arrivage['VALUE_ARRIVAGE'] > 0) {
            set_message('Impossible de supprimer ce type approvisionnement, il n\'est pas vide', 'error');
            redirect_back();
        }*/

        $criteres['ID_ARRIVAGE'] = $id;

        $critere['ID_APPOVISIONNEMENT'] = $id;

        $update_arrivage = array(
            'DELETE_STATUS_ARRIVAGE' => 1,
            'DELETE_DATE_ARRIVAGE' => date('Y-m-d H:i:s'),
            'DELETE_BY_ARRIVAGE' => get_user_data('id'),
            'DELETE_COMMENT_ARRIVAGE' => $CommentValue
        );

        $update_arrivage_detail = array(
            'DELETE_STATUS_ARRIVAGE_DETAIL' => 1,
            'STATUS_ARRIVAGE_DETAIL' =>2,
            'DELETE_DATE_ARRIVAGE_DETAIL' => date('Y-m-d H:i:s'),
            'DELETE_BY_ARRIVAGE_DETAIL' => get_user_data('id'),
            'DELETE_COMMENT_ARRIVAGE_DETAIL' => $CommentValue
        );

        $delete_arrivage = $this->model_pos_ibi_approvisionnements->update('pos_store_' . $prefix . '_ibi_arrivages', $criteres, $update_arrivage);

        if ($delete_arrivage) {

            $this->model_pos_ibi_approvisionnements->update('pos_store_detail_arrivage', $critere, $update_arrivage_detail);

        $arrivagess = $this->db->query("SELECT * FROM pos_store_detail_arrivage WHERE ID_APPOVISIONNEMENT=".$id);

        $stores=0;

        foreach ($arrivagess->result() as $values) {

            $stores=$values->FROM_STORE;

            $datas = [
                    'REF_ARTICLE_BARCODE_SF' => $values->CODE_BAR,
                    'QUANTITE_SF' => $values->QUANTITE_ARRIVAGE_DETAIL,
                    'TYPE_SF' => 'stock_in_delete',
                    'UNIT_PRICE_SF' => $values->PRIX_UNITAIRE,
                    'TOTAL_PRICE_SF' => ($values->PRIX_UNITAIRE*$values->QUANTITE_ARRIVAGE_DETAIL),
                    'ID_ARRIVAGE' => $id,
                    'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
                    'CREATED_BY_SF' => get_user_data('id')
                ];

        //echo '<pre>'; print_r($datas);

        $insert = $this->model_pos_ibi_approvisionnements->insert('pos_store_'.$stores.'_ibi_articles_stock_flow', $datas);
        }

       


        if ($get_arrivage['TYPE_APPROVISIONNEMENT'] != 'Sans_demande') {

                       $this->db->query('UPDATE pos_ibi_article_requisition SET STATUS_PROD_REQ=3 WHERE ID_REQ='.$get_arrivage['ID_REQUISITION'].' AND STATUS_PROD_REQ NOT IN (4,5)');
                    }



                 $nombre_art= $this->db->query('SELECT * FROM pos_ibi_article_requisition WHERE ID_REQ='.$get_arrivage['ID_REQUISITION']);

                   $nombre_art_req= $this->db->query('SELECT * FROM pos_store_detail_arrivage a, pos_store_2_ibi_arrivages r WHERE r.ID_ARRIVAGE=a.ID_APPOVISIONNEMENT AND r.ID_REQUISITION='.$get_arrivage['ID_REQUISITION']);

                   if ($nombre_art->num_rows() == $nombre_art_req->num_rows()) {
                      
                      $this->db->query('UPDATE pos_ibi_requisition SET STATUS_REQ=3 WHERE ID_REQ='.$get_arrivage['ID_REQUISITION']);
                   }

              

            set_message(cclang('has_been_deleted', 'arrivage'), 'success');
        } else {
            set_message(cclang('error_delete', 'arrivage'), 'error');
        }
    }

        redirect_back();
    }
    public function delete($prefix, $id_arrivage, $id_arriv_detail)
    {
        $this->is_allowed('approvisionnements_delete');

        if ($prefix == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }
        $CommentValue = $this->input->post('inputValue');

        // SUPPRESSION EN SUSPENSE START


        $data = array(
            "STATUS_ARRIVAGE_DETAIL" => 2,
            "DELETE_COMMENT_ARRIVAGE_DETAIL" => $CommentValue,
            "DELETE_BY_ARRIVAGE_DETAIL" => get_user_data('id'),
            "DELETE_DATE_ARRIVAGE_DETAIL" => date("Y-m-d H:i:"),
            "DELETE_STATUS_ARRIVAGE_DETAIL" => 1
        );

        $this->db->where(array("ID_ARRIVAGE_DETAIL" => $id_arriv_detail));
        $this->db->set($data);
        $up = $this->db->update("pos_store_detail_arrivage");


        echo json_encode($up);
    }


    public function ajustement()
    {
        $store = $this->uri->segment(2);
        $this->is_allowed('approvisionnements_ajustement');

        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }
        redirect('approvisionnements/' . $store . '/ajust');
    }
    public function ajust()
    {
        $store = $this->uri->segment(2);
        $this->is_allowed('approvisionnements_ajustement');
        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }
        $store_prefix = 'store_' . $this->uri->segment(2);

        $this->data['getProduit'] = $this->db->query('select * from pos_' . $store_prefix . '_ibi_articles WHERE DELETE_STATUS_ARTICLE = 0')->result();

        $this->template->title('Ajustement quantite');
        $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_ajust', $this->data);
    }
    public function ajust_add_save($store)
    {
        if (!$this->is_allowed('approvisionnements_ajustement', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('TYPE_SF', 'Operation', 'trim|required');
        $this->form_validation->set_rules('quantite[]', 'Quantite', 'trim|required|is_natural_no_zero');
        $this->form_validation->set_rules('article[]', 'Article', 'trim|required');


        if ($this->form_validation->run()) {

            $codebar = $this->input->post('codebar');
            $quantRest = $this->input->post('quantRest');
            $quantite_ajust = $this->input->post('quantite');


            for ($i = 0; $i < count($codebar); $i++) {

                $save_data = [

                    'REF_ARTICLE_BARCODE_SF' => $codebar[$i],
                    'QUANTITE_SF' => $quantite_ajust[$i],
                    'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
                    'CREATED_BY_SF' => get_user_data('id'),
                    'TYPE_SF' => $this->input->post('TYPE_SF'),
                    'DESCRIPTION_SF' => $this->input->post('DESCRIPTION_SF'),
                ];

                $save_ajustement = $this->model_pos_ibi_approvisionnements->insert('pos_store_' . $store . '_ibi_articles_stock_flow', $save_data);

                $article = $this->model_pos_ibi_approvisionnements->getOne('pos_store_' . $store . '_ibi_articles', array('CODEBAR_ARTICLE' => $codebar[$i],));

                $quantite_add = $article['QUANTITY_ARTICLE'] - $quantite_ajust[$i];

                $update_data = [
                    'QUANTITY_ARTICLE' => $quantite_add,
                ];

                $this->db->where('CODEBAR_ARTICLE', $codebar[$i]);
                $article_update = $this->db->update('pos_store_' . $store . '_ibi_articles', $update_data);
            }

            if ($save_ajustement and $article_update) {

                set_message(
                    cclang('success_save_data_redirect', [
                        anchor('')
                    ]),
                    'success'
                );

                $this->data['success'] = true;
                $this->data['redirect'] = base_url('administrator/approvisionnements/' . $store . '/ajust');
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/approvisionnements/' . $store . '/ajust');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }
    public function prints()
    {
        $store = $this->uri->segment(2);
        $id_arrivage = $this->uri->segment(4);
        $this->is_allowed('approvisionnements_print');
        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $arrivages = $this->model_pos_ibi_approvisionnements->getOne('pos_store_'.$store.'_ibi_arrivages', array('ID_ARRIVAGE' => $id_arrivage,));

        $this->data['arrivage'] = $arrivages;

        $author = $this->model_pos_ibi_approvisionnements->getOne('aauth_users', array('id' => $arrivages['CREATED_BY_ARRIVAGE']));
        $this->data['author'] = $author;

        $stock_flow = $this->db->query('SELECT SUM(QUANTITE_SF) AS QUANTITE, SUM(UNIT_PRICE_SF) AS PRIX_UNITAIRE, SUM(TOTAL_PRICE_SF) AS PRIX_TOTAL FROM pos_store_' . $store . '_ibi_articles_stock_flow WHERE REF_SHIPPING_SF="' . $id_arrivage . '" AND DELETE_STATUS_SF=0')->row_array();
        $this->data['stock_flow'] = $stock_flow;
        // $this->data['approvisionnements'] = $this->model_pos_ibi_approvisionnements->get_produit($store, $id_arrivage);
        $critere = array("ID_ARRIVAGE" => $id_arrivage);
        $this->data['approvisionnements'] = $this->model_pos_ibi_approvisionnements->get_prints_articles($store, $critere);
        //  ECHO"<pre>";
        // print_r( $this->data['approvisionnements'] );
        // exit;
        $this->render('backend/standart/administrator/pos_ibi_approvisionnements/pos_ibi_approvisionnements_print', $this->data);
    }
    //    start approvisionement

    public function get_all_requisition($ider = null)
    {

        $critere = array("DELETE_STATUS_REQ" => 0);
        $getRequisition = $this->model_pos_ibi_approvisionnements->getListerRequisition("pos_ibi_requisition", $critere);

        $list_requisition = "";
        foreach ($getRequisition as $key) {
            $list_requisition .= '
              <option value="' . $key->ID_REQ . '">' . $key->TITLE_REQ . '</option>
          ';
        }
        $responser['jsonOneRequisition'] = $list_requisition;
        echo json_encode($responser);
    }

    public function getRequisitionDetail($id_requisition = 0)
    {

        // $critere =array("ID_REQ"=>1);
        $getRequisition_detail = $this->db->query("SELECT * FROM pos_ibi_article_requisition WHERE STATUS_PROD_REQ!=3 AND DELETE_STATUS_PROD_REQ=0");

        $list_requisition_detail = "";
        foreach ($getRequisition_detail as $val) {
            $list_requisition_detail .= '
             <tr>
               <td> "' . $val["CODEBAR_INGREDIENT_REQ"] . '"</td>
               <td> "' . $val["NOM_INGREDIENT_REQ"] . '"</td>
               <td> "' . $val["PRIX_INGREDIENT_REQ"] . '"</td>
               <td> "' . $val["TOTAL_INGREDIENT_REQ"] . '"</td>

             </tr>
         
      ';
        }
        $response['jsonAllRequisitionDetail'] = $list_requisition_detail;
        echo json_encode($response);
    }

    //    end approvisionnement
    public function getCode()
    {
        $lastid = $this->db->query("SELECT lpad(max(ID_REQ)+1,5,0) as Maxcount , max(CODE_REQ) as
     CODE_REQ FROM  pos_ibi_requisition")->row_array();

        //  var_dump($lastid);
        //  exit;

        $code = $lastid['CODE_REQ'];

        if (date('m') == substr($code, 9, 2)) {
            return 'REQ' . $lastid['Maxcount'] . '/' . date('m/Y');
        } else {
            return "REQ00001/" . date('m/Y');
        }
    }

    public function add_approvisio($store = 0)
    {

  $get_last_id = $this->db->query('select MAX(ID_INGREDIENT) as STORES from pos_ibi_ingredients WHERE
    STORES= "' . $store . '" ');

        foreach ($get_last_id->result() as $key) {
            $idmax = $key->STORES;
        }


        $idmax++;

        if ($idmax > 0) {
            $nbr_caractere = strlen($idmax);

            if ($nbr_caractere == 1) {
                $code_bar = 'B200000' . $idmax;
            } else if ($nbr_caractere == 2) {
                $code_bar = 'B20000' . $idmax;
            } else if ($nbr_caractere == 3) {
                $code_bar = 'B2000' . $idmax;
            } else if ($nbr_caractere == 4) {
                $code_bar = 'B200' . $idmax;
            } else if ($nbr_caractere == 5) {
                $code_bar = 'B20' . $idmax;
            } else if ($nbr_caractere == 6) {
                $code_bar = 'B2' . $idmax;
            }
        } else {
            $code_bar = 'B2000000';
        }


        $this->form_validation->set_rules('DESIGN_INGREDIENT', 'DESIGN INGREDIENT', 'trim|required');
        $this->form_validation->set_rules('QUANTITY_INGREDIENT', 'QUANTITY INGREDIENT', 'trim|required');
        $this->form_validation->set_rules('PRIX_DACHAT_INGREDIENT', 'PRIX DACHAT INGREDIENT', 'trim|required');
        $this->form_validation->set_rules('UNITE_INGREDIENT', 'UNITE INGREDIENT', 'trim|required');
        $boutique_sans_demande = $this->form_validation->set_rules('boutique_sans_demande', 'BOUTIQUE', 'trim|required');

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        if (!$this->is_allowed('hospital_ibi_requisition_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');
        $this->form_validation->set_rules('typeReq', 'typeReq', 'trim|required');

        if ($this->form_validation->run()) {
            $typeReq = $this->input->post('typeReq');

            if ($typeReq == 'S_USER') {
                $patient = $this->input->post('SIMPLE_USER');
                if (isset($patient) and !empty($patient)) {
                    $destination = 0;
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Merci de selectionner L Ingredient!'
                    ]);
                    exit;
                }
            }

            if ($typeReq == 'B') {
                $btq = $this->input->post('boutique_sans_demande');
                if (isset($btq) and !empty($btq)) {
                    $patient = '';
                    $destination = $btq;
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Merci de selectionner la boutique!'
                    ]);
                    exit;
                }
            }



            $save_data = [
                'PATIENT' => $patient,
                'DESTINATION_STORE_REQ' => $destination,
                'FROM_STORE' => $store,
                'TITLE_REQ' => $this->input->post('TITRE'),
                'DATE_CREATION_REQ' => date('Y-m-d H:i:s'),
                'CREATED_BY_REQ' => get_user_data('id'),
                'AUTHOR_REQ' => get_user_data('id'),
                'CODE_REQ' => $this->getCode()

            ];

            $save_id = $this->model_pos_ibi_approvisionnements->register('pos_ibi_requisition', $save_data);
            $lastId = $this->db->insert_id();


            for ($i = 0; $i < count($design); $i++) {
                $data = [
                    'NOM_INGREDIENT_REQ' => $this->input->post('DESIGN_INGREDIENT'),
                    'QT_INGREDIENT_REQ' => $this->input->post('QUANTITY_INGREDIENT'),
                    'ID_REQ' => $lastId,
                    'PRIX_INGREDIENT_REQ ' => $this->input->post('PRIX_DACHAT_INGREDIENT'),
                    'TOTAL_INGREDIENT_REQ' => $this->input->post('PRIX_DACHAT_INGREDIENT'),
                    'CODEBAR_INGREDIENT_REQ' => $code_bar
                ];


                //  var_dump($data);
                //  exit;
                $ins = $this->model_pos_ibi_approvisionnements->insert_detail('pos_ibi_article_requisition', $data);
            }



            if ($save_id) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_id;
                    $this->data['message'] = 'approvisionnement envoyée';
                } else {
                    set_message('approvisionnement envoyée', 'success');



                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('requisition/' . $store . '/index/');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('requisition/' . $store . '/index/');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }



    public function getIngredients()
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if ($name == 'PATIENT') {
            $id = 1;
        }

        $data = $this->model_pos_ibi_approvisionnements->getList('pos_ibi_ingredients', array('DELETE_STATUS_INGREDIENT' => 0, 'STORES' => $id));
        echo json_encode($data);
    }





    public function get_data_for_requisition()
    {
        $one = 1;
        $confirm = 3;
        $requisition_get_bs = $this->input->post('requisition_get_bs');
        $STORES = $this->uri->segment(2);



$getterData =  $this->model_pos_ibi_approvisionnements->getRequete('
select * from 
    ( SELECT
         ID_ARTICLE AS ID,
         UNITE_ARTICLE AS UNITE,
         CODEBAR_ARTICLE AS CODEBAR,
         DESIGN_ARTICLE AS NOM_ART, 
         QUANTITY_ARTICLE AS QTE,
         PRIX_DACHAT_ARTICLE AS PRIX,
        "article" AS TYPES
        FROM pos_store_' . $STORES . '_ibi_articles) rq1
          INNER JOIN pos_ibi_requisition
          INNER JOIN pos_ibi_article_requisition 
          INNER JOIN aauth_users 

           ON aauth_users.id = pos_ibi_requisition.CREATED_BY_REQ AND
            pos_ibi_article_requisition.ID_REQ = pos_ibi_requisition.ID_REQ
           AND pos_ibi_article_requisition.CODEBAR_INGREDIENT_REQ = rq1.CODEBAR
        
           WHERE  pos_ibi_article_requisition.STATUS_PROD_REQ = 2 AND pos_ibi_article_requisition.DELETE_STATUS_REQ=0 AND pos_ibi_article_requisition.ID_REQ = "' . $requisition_get_bs . '"

         ');


        //  ECHO "<pre>";
        //    print_r($getterData); exit;

        $getter = "";

        $fournisseurs = $this->db->query('SELECT * FROM pos_ibi_fournisseurs WHERE
         DELETE_STATUS_FOURNISSEUR=0')->result_array();

        $fContent = '<select id="Fournisseurs" name="Fournisseurs[]" class="form-control">
       <option value="0">---select---</option>';
        foreach ($fournisseurs as $f) {
            $fContent .= '<option value="' . $f["ID_FOURNISSEUR"] . '"> ' . $f["NOM_FOURNISSEUR"] . '</option> ';
        }

        $fContent .= '</select>';

        foreach ($getterData as $key) {

            $getter .= "

            <tr> 
              <td> " . $key['CODEBAR'] . " <input type='hidden' name ='CODE_BAR[]' value='" . $key['CODEBAR'] . "'> </td>
              <td> " . $key['NOM_ART'] . " <input type='hidden' name ='NOM_INGREDIENT[]' id='NOM_INGREDIENT'
               value ='" . $key['ID'] . " ' > </td>
              <td width='100' hidden> <input type='number' name ='QT_REQ[]' value='" . $key['QT_INGREDIENT_REQ'] . "'> </td>
              <td width='100' hidden>  <input type='number' name ='PRIX_REQ[]' value='" . $key['PRIX_INGREDIENT_REQ'] . "'>  </td>

              <td width='200'> <input class='form-control' type='number' id='QUANTITY_INGREDIENT' name ='QUANTITY_INGREDIENT[]' value='" . $key['QT_INGREDIENT_REQ'] . "'> 
              </td>
              <td  width='200'> <input class='form-control' type='number' id='PRIX_INGREDIENT' name ='PRIX_INGREDIENT[]' value='" . $key['PRIX_INGREDIENT_REQ'] . "'> </td>
              <!--<td width='150'>
                  " . $fContent . "
              </td>
              <td width='200'>
                 <select name='TYPE_P[]' class='form-control TYPE_P'>
                    <option value='0'>--Selectionner--</option>
                    <option value='1'>Impayé</option>
                    <option value='2'>Payé</option>     
                      
                 </select>
              </td>

               <td width='200'> <input class='form-control MONTANT_PAYER' type='number' name='MONTANT_PAYER[]'  readonly value=''> 
               </td>-->

               <td width=''> <input class='form-control' type='text' name='TOTALS[]' id='TOTALS' readonly value='". $key['QT_INGREDIENT_REQ']*$key['PRIX_INGREDIENT_REQ']."'> 
               </td>

               <td> <input type='hidden'value=' class='idA'>
                <button class='btn btn-sm btn-warning del'><i class='fa fa-close'></i></button>
              </td>
              
               
                <input type='hidden' name ='ID_REQUISITION' id='ID_REQUISITION' value ='" . $key['ID_REQ'] . "' >
                <input type ='hidden' name = 'CODEBARE_INGREDIENT[]'  value ='" . $key['CODEBAR'] . "'>

                
                <input type = 'hidden' name = 'PRIX_REQUISITIONNER[]' id ='PRIX_REQUISITIONNER[]' value ='" . $key["PRIX_INGREDIENT_REQ"] . "'>
                <input type = 'hidden' name = 'QUANTITE_REQUISITIONNER[]' id ='QUANTITE_REQUISITIONNER[]' value ='" . $key["QT_INGREDIENT_REQ"] . "'>


                <input type='hidden' name ='ID_REQUISITION' id='ID_REQUISITION' value ='" . $key['ID_REQ'] . " '>
                <input type='hidden' name ='ID_REQUISITION' id='ID_REQUISITION' value ='" . $key['ID_REQ'] . " '>
                
                <input type='hidden'  name ='QT_INGREDIENT_EXIST[]' id='QT_INGREDIENT_EXIST' value='" . $key['QTE'] . " '>  
                <input type='hidden' name ='PRIX_INGREDIENT_EXIST[]' id='PRIX_INGREDIENT' value='" . $key['PRIX'] . "'>         

            </tr>
        
         ";
        }

        $datas['M'] = "";
        $datas['jsonList'] = $getter;
        echo json_encode($datas);
    }



    public function approvisionnerIngredient()
    {
        //echo $this->input->post('store').'/'.$this->input->post('id_approvi');exit;
        // start last code  for depense and stock
        $montant_payer = $this->input->post('montant');
        $store = $this->input->post('store');
        $id_approvision = $this->input->post('id_approvi');
        $type_payement = $this->input->post('payement');
        $nom_f = $this->input->post('nom_f');
        $id_fournisseur = $this->input->post('id_fournisseur');

        //echo $this->input->post('store').'/'.$this->input->post('id_approvi').'/'.$montant_payer.'/'.$type_payement.'/'.$nom_f.'/'.$id_fournisseur;exit;
        /*$quantite = $this->input->post('quantite');
        $price = $this->input->post('price');
        
        $QTE_x_PRICE = $quantite * $price;

        $CODEBAR = $this->input->post('codebar');
        
        $store = $this->input->post('store');
        $type_produit = $this->input->post('type_produit');*/

        $TOTAL=0;

        $QTE_x_PRICE =0;

        $QTE_x_PRICES=0;

        $ID = $this->db->query("SELECT *  FROM pos_store_2_ibi_arrivages WHERE ID_ARRIVAGE =" . $id_approvision . " ")->row_array();

        $request = $this->db->query("SELECT *  FROM pos_store_detail_arrivage WHERE ID_APPOVISIONNEMENT =" . $id_approvision . " AND FROM_STORE=".$store." AND STATUS_ARRIVAGE_DETAIL=0 ");

        foreach ($request->result() as $value) {

        $codebar = $value->CODE_BAR;

        //$id_fournisseur= $valu->ID_FOURNISSEUR;

        $QTE_x_PRICES += ($value->QUANTITE_ARRIVAGE_DETAIL * $value->PRIX_UNITAIRE);

        $QTE_x_PRICE = $value->QUANTITE_ARRIVAGE_DETAIL * $value->PRIX_UNITAIRE;
           
        $GET_ARTICLE = $this->db->query("SELECT * FROM pos_store_" . $store . "_ibi_articles WHERE CODEBAR_ARTICLE = '".$codebar."' ")->row_array();

          $QTE_ART = $GET_ARTICLE['QUANTITY_ARTICLE'];
          $PRIX_ART = $GET_ARTICLE['PRIX_DACHAT_ARTICLE'];

          $CMPE_ARTICLE_PRICE = round((($QTE_ART * $PRIX_ART) + ($value->QUANTITE_ARRIVAGE_DETAIL * $value->PRIX_UNITAIRE)) / ($QTE_ART + $value->QUANTITE_ARRIVAGE_DETAIL));


          $critere_article = array("CODEBAR_ARTICLE" => $codebar);
            
            $critere_arrivage = array("CODE_BAR" => $codebar,'ID_APPOVISIONNEMENT'=>$id_approvision,'FROM_STORE'=>$store,"STATUS_ARRIVAGE_DETAIL"=>0);


          $updata_article = array(
                "QUANTITY_ARTICLE" => ($QTE_ART+ $value->QUANTITE_ARRIVAGE_DETAIL),
                "PRIX_DACHAT_ARTICLE" => $CMPE_ARTICLE_PRICE,
                "APPROVISIONNER_ARTICLE_BY" => get_user_data('id')
            );

         //print_r($updata_article);

            $up_quant_price_articles = $this->model_pos_ibi_approvisionnements->update(
                "pos_store_" . $store . "_ibi_articles",
                $critere_article,
                $updata_article
            );
 //print_r($updata_article);

             $STOCK_IN = "stock_in";

              $TOTAL = ($value->QUANTITE_ARRIVAGE_DETAIL*$value->PRIX_UNITAIRE);

            $data_flow = array(

                "REF_ARTICLE_BARCODE_SF" => $codebar,
                "QUANTITE_SF" => $value->QUANTITE_ARRIVAGE_DETAIL,
                "UNIT_PRICE_SF" => $value->PRIX_UNITAIRE,
                "TOTAL_PRICE_SF" => $TOTAL,
                "TYPE_SF" => $STOCK_IN,
                "ID_ARRIVAGE" => $id_approvision,
                "DATE_CREATION_SF" => date('Y-m-d H:i:s'),
                "REF_PROVIDER_SF" => $id_fournisseur,
                "CREATED_BY_SF" => get_user_data('id')

            );

            $data = array("STATUS_ARRIVAGE_DETAIL" => 1,'PRIX_APPROVISIONNER'=>$QTE_x_PRICE);
            $insert_stock = $this->model_pos_ibi_approvisionnements->register("pos_store_" . $store . "_ibi_articles_stock_flow", $data_flow);

            $up_status_arr = $this->model_pos_ibi_approvisionnements->update("pos_store_detail_arrivage", $critere_arrivage, $data);
        }

        $GET_APPROVISIONNEMENT = $this->db->query("SELECT *  FROM pos_store_2_ibi_arrivages WHERE ID_ARRIVAGE = " . $id_approvision . " ")->row_array();

           /* $DATA_SINGLE  = array('NOM_DEPENSE' => $GET_APPROVISIONNEMENT['CODE_ARRIVAGE'], 'ID_CATEGORIE_DEPENSE' =>1,'CREATE_BY_DEPENSE' => get_user_data('id'), 'MONTANT_APPROVIONNEMENT' => $QTE_x_PRICES, 'MONTANT_DEPENSE' =>$QTE_x_PRICES, 'ID_APPROVISIONNEMENT' => $id_approvision);
        $INSERT_DEPENSE = $this->model_pos_ibi_approvisionnements->register("pos_depenses", $DATA_SINGLE);*/

        $INSERT_ARRIVAGE = $this->db->query("UPDATE pos_store_2_ibi_arrivages SET STATUS_ARRIVAGE='1' WHERE ID_ARRIVAGE=".$id_approvision);


        //Payement fourisseur
        $idD = 0;
        if ($montant_payer > 0 && ($id_fournisseur!='')) {

            /*$idD = $this->model_rm->insert_last_id('pos_depenses', array(
                'NOM_DEPENSE' => 'payement fournisseur ' . $nom_f,
                'MONTANT_DEPENSE' => $montant_payer,
                'DESCRIPTION_DEPENSE' => 'payement fournisseur ' . $nom_f,
                'ID_CATEGORIE_DEPENSE' => 3,
                'CREATE_BY_DEPENSE' => get_user_data('id'),
                'DATE_CREATE_DEPENSE' => date('Y-m-d H:i:s'),

            ));*/
       

        $data_payement = [

            'MONTANT_PF' => $TOTAL,
            'PAYER_PF ' => $montant_payer,
            'RESTE_PF' => $TOTAL - $montant_payer,
            'FOURNISSEUR_ID' => $id_fournisseur,
            'TYPE_PAYEMENT_PF' => $type_payement,
            'DATE_CREATION_PF' => date('Y-m-d H:i:s'),
            'CREATED_BY_PF' => get_user_data('id'),
            'APPROVISIONNEMENT_REF' => $id_approvision
        ];

        $insPay = $this->model_rm->insert('pos_ibi_payement_fournisseur', $data_payement);

    }

        echo json_encode($INSERT_ARRIVAGE);
    }

    // end__last_ code depense and stock




   public function autorisation_approvisionnement(){

     $id_approvisionnement = $this->input->post('id_approvisionnement');

     // var_dump($id_approvisionnement);exit();

     $critere  = array('ID_ARRIVAGE' => $id_approvisionnement);
     $datas_save  = array('DELETE_STATUS_ARRIVAGE' =>0);
         

      $this->db->where($critere);
        $this->db->set($datas_save);
        $update = $this->db->update("pos_store_2_ibi_arrivages");

        if($update){
            echo TRUE;
        }
 
   }





    public function getterOneOff($id_arrivage_de = 0)
    {
        $ider = $this->input->post('id_arrivage_de');
        $result_bs = $this->db->query(" SELECT * FROM pos_store_detail_arrivage WHERE 
    ID_ARRIVAGE_DETAIL = $ider")->row_array();

        $fournisseurs = $this->model_rm->getList('pos_ibi_fournisseurs', array('DELETE_STATUS_FOURNISSEUR' => 0));

        $fContent = '<select id="Fournisseurs" name="Fournisseurs" class="form-control chosen chosen-select-deselect">
       <option value="0">---select---</option>';
        foreach ($fournisseurs as $f) {
            $result_bs['ID_FOURNISSEUR'] == $f["ID_FOURNISSEUR"] ? $selected = 'selected' : $selected = '';
            $fContent .= '<option ' . $selected . ' value="' . $f["ID_FOURNISSEUR"] . '"> ' . $f["NOM_FOURNISSEUR"] . '</option> ';
        }

        $fContent .= '</select>';

        $result_bs['fournisseur'] = $fContent;

        echo json_encode($result_bs);
    }
}
