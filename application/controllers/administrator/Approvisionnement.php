<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Approvisionnement extends Admin
{
     public function __construct()
      {
        parent::__construct();
        $this->load->model('model_approvisionnement');
        $this->load->model('model_registers');
        $this->load->model('model_dashboard');
      }
    public function index($store = 0, $offset= 0)
    {
      $this->is_allowed('approvisionnement_list');
      if($store == 0){

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
        redirect('administrator/store');
               
          }

   
     $filter = $this->input->get('q');
     $field  = $this->input->get('f');
     
      $this->data['approvisionnements'] = $this->model_approvisionnement->get($filter,$field, $this->limit_page, $offset);
      $this->data['approvisionnement_counts'] = $this->model_approvisionnement->count_all($filter, $field);
      $config = [
        'base_url'   => 'administrator/approvisionnement/index/'.$store.'/',
        'total_rows'   => $this->model_approvisionnement->count_all($filter, $field),
        'per_page'     => $this->limit_page,
        'uri_segment'  => 5,
      ];

      $this->data['pagination'] = $this->pagination($config);
      $this->template->title('Liste des approvisionnements');
      $this->render('backend/standart/administrator/approvisionnement/approvisionnement_list', $this->data);
  }

  /**
   * Add new approvisionnements
   *
   */
  public function add($store = 0)
    {
      $this->is_allowed('approvisionnement_add');
      if($store == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/store');
             
        }    

      $this->template->title('Nouveau approvisionnement');
      $this->data['getProduit']=$this->model_approvisionnement->getList('pos_store_'.$store.'_ibi_articles');

      $this->render('backend/standart/administrator/approvisionnement/approvisionnement_add', $this->data);
  }

  public function search_produits($store)
  {
    $datasearch = $this->input->post('datasearch');

    $this->data['getProduits'] = $this->model_dashboard->getRequete('SELECT * FROM pos_store_'.$store.'_ibi_articles WHERE DESIGN_ARTICLE LIKE "%'.$datasearch.'%" AND DELETED_STATUS = 0 OR CODEBAR_ARTICLE LIKE "%'.$datasearch.'%" AND DELETED_STATUS = 0 OR SKU_ARTICLE LIKE "%'.$datasearch.'%" AND DELETED_STATUS = 0 ');
    
    echo json_encode($this->data['getProduits']);
  }

  public function search_bon_commande($store)
  {
    $datasearch = $this->input->post('datasearch');

    $this->data['getCommandes'] = $this->model_dashboard->getRequete('SELECT * FROM pos_store_'.$store.'_ibi_bon_commande WHERE STATUT_BON_COMMANDE=0 AND NUMERO_BON_COMMANDE LIKE "%'.$datasearch.'%"');
    
    echo json_encode($this->data['getCommandes']);
  }

  public function add_($store)
  {
    $bonCommande = $this->input->post('bonCommande');

    // $this->data['bon_commande_produit'] = $this->model_registers->getList('pos_store_'.$store.'_ibi_bon_commande_detail',array('REF_NUM_BON_COMMANDE_DET'=>$bonCommande));
    $this->data['bon_commande_produit'] = $this->model_dashboard->getRequete('SELECT * FROM pos_store_'.$store.'_ibi_bon_commande_detail CD, pos_store_'.$store.'_ibi_bon_commande BC WHERE REF_NUM_BON_COMMANDE_DET="'.$bonCommande.'" AND CD.REF_NUM_BON_COMMANDE_DET = BC.NUMERO_BON_COMMANDE');

    echo json_encode($this->data['bon_commande_produit']);

  }

  public function add_save($prefix)
  {
 
      if (!$this->is_allowed('approvisionnement_add',false)) {
            echo json_encode([
              'success' => false,
              'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }
  
    $this->form_validation->set_rules('ID_ARRIVAGE','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Choisir un titre de l\'approvisionnement</font>'));
    $this->form_validation->set_rules('codebar[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs codebarre est obligatoire</font>'));

    $this->form_validation->set_rules('ID_FOURNISSEUR','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Choisir le nom du fournisseur</font>'));
    $this->form_validation->set_rules('quantite[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs des quantites est obligatoire</font>'));
    $this->form_validation->set_rules('price[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs des prix est obligatoire</font>'));
    if(!empty($this->input->post('status_active'))) {
      for($s = 0; $s < count($this->input->post('status_active')); $s++) {
        if($this->input->post('status_active')[$s] == 1) {
          echo json_encode([
            'success' => false,
            'message' => 'Certains articles sont indisponibles'
          ]);
          exit;
        }
      }
    }
  
    if ($this->form_validation->run()) {
    
       $titre = $this->input->post('ID_ARRIVAGE');
       $fournisseur = $this->input->post('ID_FOURNISSEUR');
       $quantite = $this->input->post('quantite');
       $price = $this->input->post('price');
       $codebar = $this->input->post('codebar');

       $save_data_appr = array(

            'ID_TYPE_APPROVISIONNEMENT' => $titre,
            'CODE_APPROVISIONNEMENT' => $this->model_approvisionnement->shuffle_code_approv($prefix),
            'ID_FOURNISSEUR_APPROVISIONNEMENT' => $fournisseur,
            'DATE_CREATION_APPROVISIONNEMENT' => date("Y-m-d H:i:s"),
            'AUTHOR_APPROVISIONNEMENT' => get_user_data('id')

          );
               
       $save_approvisionnement = $this->model_approvisionnement->insert_last_id('pos_store_'.$prefix.'_ibi_approvisionnement',$save_data_appr );

       for ($i=0; $i<count($codebar); $i++) { 

        $save_data_sf = [

            'REF_ARTICLE_BARCODE_SF' => $codebar[$i],
            'QUANTITE_SF' => $quantite[$i],
            'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
            'AUTHOR_SF' => get_user_data('id'),
            'UNIT_PRICE_SF' => $price[$i],
            'TOTAL_PRICE_SF' => $price[$i]*$quantite[$i],
            'REF_SHIPPING_SF' => $save_approvisionnement,
            'SUPPLIER_REFERENCE_SF' => $fournisseur,
            'TYPE_SF' => 'stock_padding',

            ];

          $save_stock_flow = $this->model_registers->insert('pos_store_'.$prefix.'_ibi_articles_stock_flow',$save_data_sf);

        }
       
      if ($save_approvisionnement) {

          set_message(
            cclang('success_save_data_redirect', [
              anchor('administrator/approvisionnement/edit/'.$this->uri->segment(4).'/'. $save_approvisionnement, 'Edit Approvisionnement')
            ]),
            'success'
          );

          $this->data['success'] = true;
          $this->data['redirect'] = base_url('administrator/approvisionnement/index/'.$this->uri->segment(4));
        
      } else {
       
          $this->data['success'] = false;
          $this->data['message'] = cclang('data_not_change');
          $this->data['redirect'] = base_url('administrator/approvisionnement/index/'.$this->uri->segment(4));
      }
    } else {
      $this->data['success'] = false;
      $this->data['message'] = validation_errors();
    }

    echo json_encode($this->data);
  }

  /**
   * Update view Approvisionnements
   *
   * @var $id String
   */
  public function edit($prefix = 0,$id_approvisionnement)
  {  
         
       $this->is_allowed('approvisionnement_update');
       if($prefix == 0){

        set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
        redirect('administrator/store');
           
      }
      $this->data['approvisionnement'] = $this->model_registers->getOne('pos_store_'.$prefix.'_ibi_approvisionnement',array('ID_APPROVISIONNEMENT' =>$id_approvisionnement));

      $this->data['type_approvisionnement'] = $this->model_registers->getOne('pos_store_'.$prefix.'_ibi_type_approvisionnement', array('ID_TYPE_APPROVISIONNEMENT'=>$this->data['approvisionnement']['ID_TYPE_APPROVISIONNEMENT']));

      $this->data['approvisionnement_produits'] = $this->model_approvisionnement->getList_approv($prefix,$id_approvisionnement);
 
      $this->template->title('Modification de l\'approvisionnement');
      $this->render('backend/standart/administrator/approvisionnement/approvisionnement_update',$this->data);

  }
    
  public function edit_save($prefix = 0,$id_approvisionnement)
  {

    if (!$this->is_allowed('approvisionnement_update', false)) {
      echo json_encode([
        'success' => false,
        'message' => cclang('sorry_you_do_not_have_permission_to_access')
      ]);
      exit;
    }
    
    $this->form_validation->set_rules('ID_ARRIVAGE','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Choisir un titre de l\'approvisionnement</font>'));
    $this->form_validation->set_rules('codebar[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs codebarre est obligatoire</font>'));

    $this->form_validation->set_rules('ID_FOURNISSEUR','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Choisir le nom du fournisseur</font>'));
    $this->form_validation->set_rules('quantite[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs des quantites est obligatoire</font>'));
    $this->form_validation->set_rules('price[]','','trim|required',array('required'=>'<font style="color:red;font-size:15px;">Le champs des prix est obligatoire</font>'));
    if(!empty($this->input->post('status_active'))) {
      for($s = 0; $s < count($this->input->post('status_active')); $s++) {
        if($this->input->post('status_active')[$s] == 1) {
          echo json_encode([
            'success' => false,
            'message' => 'Certains articles sont indisponibles'
          ]);
          exit;
        }
      }
    }
    
    if ($this->form_validation->run()) {

          $titre = $this->input->post('ID_ARRIVAGE');
          $fournisseur = $this->input->post('ID_FOURNISSEUR');
          $quantite = $this->input->post('quantite');
          $price = $this->input->post('price');
          $codebar = $this->input->post('codebar');

          $table_approvisionnement = 'pos_store_'.$prefix.'_ibi_approvisionnement';
           
          $update_data_appr = array(
            
            'ID_TYPE_APPROVISIONNEMENT' => $titre,
            'ID_FOURNISSEUR_APPROVISIONNEMENT' => $fournisseur,
            'DATE_MOD_APPROVISIONNEMENT' => date("Y-m-d H:i:s"),
            'AUTHOR_MOD_APPROV' => get_user_data('id')

          );
             
          $update_approvisionnement = $this->model_registers->update('pos_store_'.$prefix.'_ibi_approvisionnement', array('ID_APPROVISIONNEMENT'=>$id_approvisionnement),$update_data_appr);

          for ($i=0;$i<count($codebar);$i++)
          {
            $stock_flow_count = $this->model_registers->record_countsome('pos_store_'.$prefix.'_ibi_articles_stock_flow',array('REF_ARTICLE_BARCODE_SF'=>$codebar[$i],'REF_SHIPPING_SF'=>$id_approvisionnement));

            if($stock_flow_count < 1){

              $save_data_sf = [

                'REF_ARTICLE_BARCODE_SF' => $codebar[$i],
                'QUANTITE_SF' => $quantite[$i],
                'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
                'AUTHOR_SF' => get_user_data('id'),
                'UNIT_PRICE_SF' => $price[$i],
                'TOTAL_PRICE_SF' => $price[$i]*$quantite[$i],
                'SUPPLIER_REFERENCE_SF' => $fournisseur,
                'REF_SHIPPING_SF' => $id_approvisionnement,
                'TYPE_SF' => 'stock_padding',

                ];

              $save_stock_flow = $this->model_registers->insert('pos_store_'.$prefix.'_ibi_articles_stock_flow',$save_data_sf);

            }else{

              $update_data_sf = [

                'QUANTITE_SF' => $quantite[$i],
                'DATE_MOD_SF' => date('Y-m-d H:i:s'),
                'AUTHOR_SF' => get_user_data('id'),
                'REF_COMMAND_CODE_SF' => '',
                'UNIT_PRICE_SF' => $price[$i],
                'TOTAL_PRICE_SF' => $price[$i]*$quantite[$i],
                'SUPPLIER_REFERENCE_SF' => $fournisseur,

                ];

              $save_stock_flow = $this->model_registers->update('pos_store_'.$prefix.'_ibi_articles_stock_flow',array('REF_ARTICLE_BARCODE_SF'=>$codebar[$i], 'REF_SHIPPING_SF'=>$id_approvisionnement),$update_data_sf);
            }

        }

        if ($update_approvisionnement and $save_stock_flow){

          set_message(
            cclang('success_update_data_redirect', []),
            'success'
          );

          $this->data['success'] = true;
          $this->data['redirect'] = base_url('administrator/approvisionnement/index/'.$this->uri->segment(4));
        
        }else {

            $this->data['success'] = false;
            $this->data['message'] = cclang('data_not_change');
            $this->data['redirect'] = base_url('administrator/approvisionnement/index/'.$this->uri->segment(4)); 
        }
      }
       else {
        $this->data['success'] = false;
        $this->data['message'] = validation_errors();
      }

    echo json_encode($this->data);
  }
  public function view($prefix=0,$id)
  {
      $this->is_allowed('approvisionnement_view');
      if($prefix == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/store');
        }
      $this->data['approvisionnement_counts'] = $this->model_approvisionnement->count_all_produit($prefix,$id);
      $this->data['approvisionnements'] = $this->model_approvisionnement->get_produit($prefix,$id);
      $this->data['approv'] = $this->model_dashboard->getRequeteOne('SELECT typ.DESIGN_TYPE_APPROVISIONNEMENT,app.DATE_CREATION_APPROVISIONNEMENT,aut.username FROM pos_store_'.$prefix.'_ibi_approvisionnement app LEFT JOIN pos_store_'.$prefix.'_ibi_type_approvisionnement typ ON typ.ID_TYPE_APPROVISIONNEMENT=app.ID_TYPE_APPROVISIONNEMENT LEFT JOIN aauth_users aut ON aut.ID=app.AUTHOR_APPROVISIONNEMENT WHERE app.ID_APPROVISIONNEMENT='.$id.'');

      $this->template->title('Detail de l\'approvisionnement');
      $this->render('backend/standart/administrator/approvisionnement/approvisionnement_view',$this->data);
  }

  public function ajustement($index = 0, $store){

    $this->is_allowed('approvisionnement_ajustement');

    if($store == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/store');
             
        }
        redirect('administrator/approvisionnement/ajust/'.$store.'');
  }
  public function ajust($store = 0)
  {
    $this->is_allowed('approvisionnement_ajustement');

    if($store == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/store');
        }
    $store_prefix = 'store_'.$this->uri->segment(4);

    $this->data['getProduit'] = $this->db->query('SELECT * FROM pos_'.$store_prefix.'_ibi_articles WHERE STATUS_ARTICLE = 1')->result();

    $this->template->title('Ajustement quantite');
    $this->render('backend/standart/administrator/approvisionnement/approvisionnement_ajustement', $this->data);
    
  }
  public function ajust_add_save($store){

    if (!$this->is_allowed('approvisionnement_ajustement', false)) {
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
        

        for ($i=0; $i < count($codebar) ; $i++) {

          $save_data = [
            
            'REF_ARTICLE_BARCODE_SF' => $codebar[$i],
            'QUANTITE_SF' => $quantite_ajust[$i],
            'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
            'AUTHOR_SF' => get_user_data('id'), 
            'TYPE_SF' => $this->input->post('TYPE_SF'),
            'DESCRIPTION_SF' => $this->input->post('DESCRIPTION_SF'),
          ];


          
        if($this->input->post('TYPE_SF') != 'additionner'){

	        if($quantite_ajust[$i] > $quantRest[$i])
	        {
            echo json_encode([
                'success' => false,
                'message' => ('La quantité saisie est supérieure à la quantité restante dans le stock')
                ]);
              exit;
             }
           }
  
              $save_ajustement = $this->model_registers->insert('pos_store_'.$store.'_ibi_articles_stock_flow',$save_data);

              $article = $this->model_registers->getOne('pos_store_'.$store.'_ibi_articles', array('CODEBAR_ARTICLE'=>$codebar[$i],));

            if($article['STOCK_ENABLED_ARTICLE'] == 1){

              if($this->input->post('TYPE_SF') == 'additionner'){
                $quantite_add = $article['QUANTITE_RESTANTE_ARTICLE']+$quantite_ajust[$i];
                if($quantite_add < 0){
                  $quantite_add = $quantite_ajust[$i];
                }
                $quantite_def = $article['DEFECTUEUX_ARTICLE'];
              }else{
                $quantite_add = $article['QUANTITE_RESTANTE_ARTICLE']-$quantite_ajust[$i];
                if($quantite_add < 0){
                  $quantite_add = 0;
                }
                $quantite_def = $article['DEFECTUEUX_ARTICLE']+$quantite_ajust[$i];
                if($quantite_def < 0){
                  $quantite_def = $quantite_ajust[$i];
                }
              }

                  $update_data = [
                                 'DEFECTUEUX_ARTICLE'=> $quantite_def,
                                 'QUANTITE_RESTANTE_ARTICLE'=> $quantite_add,
                               ];
                        
                  $this->db->where('CODEBAR_ARTICLE',$codebar[$i]);
                  $article_update = $this->db->update('pos_store_'.$store.'_ibi_articles',$update_data);

              }else{
                $article_update = 1;
              }   
        
        }

          if ($save_ajustement and $article_update) {
            
              set_message(
                cclang('success_save_data_redirect', [
                anchor('')
              ]), 'success');

              $this->data['success'] = true;
              $this->data['redirect'] = base_url('administrator/approvisionnement/ajust/'.$store);
            
          } else {
            if ($this->input->post('save_type') == 'stay') {
              $this->data['success'] = false;
              $this->data['message'] = cclang('data_not_change');
            } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
              $this->data['redirect'] = base_url('administrator/approvisionnement/ajust/'.$store.'');
            }
          }

        } else {
          $this->data['success'] = false;
          $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);

  }
  public function add_type($prefix)
  {
    $this->is_allowed('approvisionnement_add_type');
      
        $data = array(
        'DESIGN_TYPE_APPROVISIONNEMENT' => $this->input->post('titre_arrivage'),
        'DESCRIPTION_TYPE_APPROVISIONNEMENT' => $this->input->post('description'),
        'AUTHOR_TYPE_APPROVISIONNEMENT' => get_user_data('id'),
        'DATE_CREATION_TYPE_APPROVISIONNEMENT' => date('Y-m-d h-i-s')
           );
        $save_type = $this->model_registers->insert('pos_store_'.$prefix.'_ibi_type_approvisionnement',$data);

        if ($save_type) {
            $arrivages = $this->model_registers->getList('pos_store_' . $prefix . '_ibi_type_approvisionnement',array('DELETE_TYPE_APPROVISIONNEMENT'=>0));

            $resultat = "<option>Choisir un titre</option>";
            foreach ($arrivages as $arrivage) {
                $resultat .= "<option value='" . $arrivage['ID_TYPE_APPROVISIONNEMENT'] . "'>" . $arrivage['DESIGN_TYPE_APPROVISIONNEMENT'] . "</option>";
            }
        }
        echo json_encode($resultat);
        
   }
  public function update_type_add($prefix)
  {
      $this->is_allowed('approvisionnement_update');
       
      $table = 'pos_store_'.$prefix.'_ibi_type_approvisionnement';
      $id_arrivage = $this->input->post('id_arrivage');

      $data = array(
          'DESIGN_TYPE_APPROVISIONNEMENT' => $this->input->post('titre_arrivage'),
          'DESCRIPTION_TYPE_APPROVISIONNEMENT' => $this->input->post('description'),
          'AUTHOR_TYPE_APPROVISIONNEMENT' => get_user_data('id'),
          'DATE_MOD_TYPE_APPROVISIONNEMENT' => date("Y-m-d H:i:s"),
        ); 

      $update_type = $this->model_registers->update('pos_store_' . $prefix . '_ibi_type_approvisionnement', array('ID_TYPE_APPROVISIONNEMENT' => $id_arrivage), $data);
        if ($update_type) {
            $arrivages = $this->model_registers->getList('pos_store_' . $prefix . '_ibi_type_approvisionnement', array('DELETE_TYPE_APPROVISIONNEMENT' => 0));

            $resultat = "<option>Choisir un titre</option>";
            foreach ($arrivages as $arrivage) {
                if ($arrivage['ID_TYPE_APPROVISIONNEMENT'] == $id_arrivage) {
                    $resultat .= "<option selected value='" . $arrivage['ID_TYPE_APPROVISIONNEMENT'] . "'>" . $arrivage['DESIGN_TYPE_APPROVISIONNEMENT'] . "</option>";
                } else {
                    $resultat .= "<option value='" . $arrivage['ID_TYPE_APPROVISIONNEMENT'] . "'>" . $arrivage['DESIGN_TYPE_APPROVISIONNEMENT'] . "</option>";
                }
            }
        }
      echo json_encode($resultat);  
        
    }

   public function delete_produit($prefix=0,$ID_APPROVISIONNEMENT_PRODUIT)
   {

      $this->is_allowed('approvisionnement_delete');

      if($prefix == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/store');
             
        }

      $stock_flow = $this->model_registers->getOne('pos_store_'.$prefix.'_ibi_articles_stock_flow',array('ID_SF' => $ID_APPROVISIONNEMENT_PRODUIT));

      $criteres['ID_SF'] = $ID_APPROVISIONNEMENT_PRODUIT;

      $delete_cart = $this->model_registers->delete('pos_store_'.$prefix.'_ibi_articles_stock_flow',$criteres);

      if ($delete_cart) {
          set_message(cclang('has_been_deleted', 'approvisionnement'), 'success');
      } else {
          set_message(cclang('error_delete', 'approvisionnement'), 'error');
      }
      redirect_back();

  }
  public function delete($store, $id_approv) {
    $this->is_allowed('approvisionnement_delete');
    if($store == 0){
      set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
      redirect('administrator/store');
         
    }
    $get_stock_flow_count = $this->model_dashboard->countrows('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv, 'TYPE_SF'=> 'stock_in'));
    $get_stock_flow = $this->model_registers->getList('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv, 'TYPE_SF'=> 'stock_in'));

    $verif = null;

    $delete_art = null;
    $delete_appr = null;

    if($get_stock_flow_count > 0) {

      foreach($get_stock_flow as $get_stock_flow) {

        $article = $this->model_approvisionnement->getone('pos_store_'.$store.'_ibi_articles', array('CODEBAR_ARTICLE'=>$get_stock_flow['REF_ARTICLE_BARCODE_SF']));

        $quantite_add = $article['QUANTITE_RESTANTE_ARTICLE'] - $get_stock_flow['QUANTITE_SF'];
        $quantite_article = $article['QUANTITY_ARTICLE'] - $get_stock_flow['QUANTITE_SF'];
        $update_data = [
                       'QUANTITY_ARTICLE'=> $quantite_article,
                       'QUANTITE_RESTANTE_ARTICLE'=> $quantite_add,
                       'PRIX_DACHAT_ARTICLE'=> $get_stock_flow['UNIT_PRICE_SF'],
                     ];
                     
                          
        $this->db->where('CODEBAR_ARTICLE',$get_stock_flow['REF_ARTICLE_BARCODE_SF']);
        $verif = $this->db->update('pos_store_'.$store.'_ibi_articles',$update_data);
      }

      if($verif) {
        $delete_art = $this->model_dashboard->delete('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv));
        $delete_appr = $this->model_dashboard->delete('pos_store_'.$store.'_ibi_approvisionnement', array('ID_APPROVISIONNEMENT'=> $id_approv));
      }
    } else {
      $delete_art = $this->model_dashboard->delete('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv));
        $delete_appr = $this->model_dashboard->delete('pos_store_'.$store.'_ibi_approvisionnement', array('ID_APPROVISIONNEMENT'=> $id_approv));
    }

    if ($delete_appr) {
          set_message('Le produit a été supprimé', 'success');
      } else {
          set_message('erreur de suppression', 'error');
      }

      redirect_back();

  }
  public function approuved($store, $id_approv, $id = null)
  {

    $this->is_allowed('approvisionnement_approuved');

      $arr_id = $this->input->get('id');
      $approuved = false;
      if (!empty($id)) {
        $approuved = $this->_approuved($store,$id_approv,$id);
      } elseif (count($arr_id) >0) {
        foreach ($arr_id as $id) {
          $approuved = $this->_approuved($store,$id_approv,$id);
        }
      }

      if ($approuved) {
          set_message('Le produit a été approuvé', 'success');
      } else {
          set_message('erreur approuvée', 'error');
      }

      redirect_back();

  }

  public function _approuved($store, $id_approv, $id)
  {
    
    $get_stock_flow = $this->model_registers->getOne('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv, 'REF_ARTICLE_BARCODE_SF'=> $id));

    $approv = $this->model_registers->getOne('pos_store_'.$store.'_ibi_approvisionnement', array('ID_APPROVISIONNEMENT'=>$id_approv));
   
    $stock_flow = $this->model_registers->update('pos_store_'.$store.'_ibi_articles_stock_flow', array('REF_SHIPPING_SF'=> $id_approv, 'REF_ARTICLE_BARCODE_SF'=> $id), array('TYPE_SF'=> 'stock_in','REF_COMMAND_CODE_SF'=>$approv['CODE_APPROVISIONNEMENT'],'REF_PROVIDER_SF'=>get_user_data('id')));

    $article = $this->model_approvisionnement->getone('pos_store_'.$store.'_ibi_articles', array('CODEBAR_ARTICLE'=>$id,));

    $quantite_add = $article['QUANTITE_RESTANTE_ARTICLE'] + $get_stock_flow['QUANTITE_SF'];
    if($quantite_add < 0){
      $quantite_add = $get_stock_flow['QUANTITE_SF'];
    }
    $quantite_article = $article['QUANTITY_ARTICLE'] + $get_stock_flow['QUANTITE_SF'];
    if($quantite_article < 0){
      $quantite_article = $get_stock_flow['QUANTITE_SF'];
    }
    $update_data = [
                   'QUANTITY_ARTICLE'=> $quantite_article,
                   'QUANTITE_RESTANTE_ARTICLE'=> $quantite_add,
                   'PRIX_DACHAT_ARTICLE'=> $get_stock_flow['UNIT_PRICE_SF'],
                 ];
                 
                      
    $this->db->where('CODEBAR_ARTICLE',$id);
    return $this->db->update('pos_store_'.$store.'_ibi_articles',$update_data);
  }
  public function prints($prefix=0,$ID_APPROVISIONNEMENT)
  {
      $this->is_allowed('approvisionnement_print');
       if($prefix == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
      redirect('administrator/store');
             
        }
  
      $approvisionnement = $this->model_approvisionnement->getone('pos_store_'.$prefix.'_ibi_approvisionnement',array('ID_APPROVISIONNEMENT'=>$ID_APPROVISIONNEMENT,));

      $QUANTITE_TOTAL = $this->db->query('SELECT SUM(QUANTITE_SF) AS QUANTITE  FROM pos_store_'.$prefix.'_ibi_articles_stock_flow WHERE REF_SHIPPING_SF="'.$ID_APPROVISIONNEMENT.'"');  
      $QUANTITE = $QUANTITE_TOTAL->row_array();
      $this->data['quantite_totale_produit'] = $QUANTITE;

      $PRIX_UNITAIRE = $this->db->query('SELECT SUM(UNIT_PRICE_SF) AS PRIX_UNITAIRE  FROM pos_store_'.$prefix.'_ibi_articles_stock_flow WHERE REF_SHIPPING_SF="'.$ID_APPROVISIONNEMENT.'"');
      $PRIX_UNITAIRE_TOTAL = $PRIX_UNITAIRE->row_array();
      $this->data['prix_unitaire_produit'] = $PRIX_UNITAIRE_TOTAL;

      $PRIX_TOTAL = $this->db->query('SELECT SUM(TOTAL_PRICE_SF) AS PRIX_TOTAL  FROM pos_store_'.$prefix.'_ibi_articles_stock_flow WHERE REF_SHIPPING_SF="'.$ID_APPROVISIONNEMENT.'"');
      $PRIX_PRODUIT_TOTAL = $PRIX_TOTAL->row_array();


      $this->data['prix_total_produit']=$PRIX_PRODUIT_TOTAL;

      $this->data['approvisionnements'] =$this->model_approvisionnement->get_produit($prefix,$ID_APPROVISIONNEMENT);

      $this->data['approv'] = $this->model_dashboard->getRequeteOne('SELECT typ.DESIGN_TYPE_APPROVISIONNEMENT,app.DATE_CREATION_APPROVISIONNEMENT,aut.username FROM pos_store_'.$prefix.'_ibi_approvisionnement app LEFT JOIN pos_store_'.$prefix.'_ibi_type_approvisionnement typ ON typ.ID_TYPE_APPROVISIONNEMENT=app.ID_TYPE_APPROVISIONNEMENT LEFT JOIN aauth_users aut ON aut.ID=app.AUTHOR_APPROVISIONNEMENT WHERE app.ID_APPROVISIONNEMENT='.$ID_APPROVISIONNEMENT.'');

       $this->render('backend/standart/administrator/approvisionnement/approvisionnement_print', $this->data);
    }

    /**
  * Export to excel
  *
  * @return Files Excel .xls
  */
  public function export($store)
  {
      $this->is_allowed('approvisionnement_export');

      if($store == 0){

        set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
        redirect('administrator/store');
               
      }
      $ID_TYPE_APPROVISIONNEMENT = $this->input->get('ID_TYPE_APPROVISIONNEMENT');
      
      $this->data['approvisionnements'] = $this->model_approvisionnement->getListFilter($store,$ID_TYPE_APPROVISIONNEMENT);
      $this->data['approvisionnement_counts'] = $this->model_approvisionnement->getListFilter_count($store,$ID_TYPE_APPROVISIONNEMENT);
      $this->data['ID_TYPE_APPROVISIONNEMENT'] = $ID_TYPE_APPROVISIONNEMENT;
      $this->render('backend/standart/administrator/approvisionnement/approvisionnement_export', $this->data);
  }

  
}
