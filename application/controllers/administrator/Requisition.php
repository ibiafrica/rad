<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Ibi Requisition Controller
 *| --------------------------------------------------------------------------
 *| Pos Ibi Requisition site
 *|
 */
class Requisition extends Admin
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_pos_ibi_requisition');
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
        $this->is_allowed('pos_ibi_requisition_list');

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $filter = $this->input->get('q');
        $field     = $this->input->get('f');

        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $status_on = $this->input->get('status_on');


        $this->data['requisition'] = $this->model_pos_ibi_requisition->get($status_on, $date_start, $date_end, $filter, $field, $this->limit_page = 100, $offset);
        $this->data['req_counts'] = $this->model_pos_ibi_requisition->count_all($status_on, $date_start, $date_end, $filter, $field);


        $config = [
            'base_url'     => 'requisition/' . $store . '/index/',
            'total_rows'   => $this->model_pos_ibi_requisition->count_all($status_on, $date_start, $date_end, $filter, $field),
            'per_page'     => $this->limit_page = 100,
            'uri_segment'  => 4,
        ];

        $this->data['pagination'] = $this->pagination($config);
        $this->template->title('Pos Ibi Requisition List');
        $this->render('backend/standart/administrator/requisition/pos_ibi_requisition_list', $this->data);
    }

    /**
     * Add new pos_ibi_requisitions
     *
     */
    public function add()
    {
        $store = $this->uri->segment(2);

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_requisition_add');

        $this->data['stores'] = $this->model_rm->getRequete('SELECT * FROM pos_ibi_stores
         WHERE STATUS_STORE="opened"  AND ID_STORE =' . $store . '');


        $this->template->title('Pos Ibi Requisition New');
        $this->render('backend/standart/administrator/requisition/pos_ibi_requisition_add', $this->data);
    }

    /**
     * Add New Pos Ibi Requisitions
     *
     * @return JSON
     */

    public function getCode()
   {
          $query = $this->db->query("SELECT SUBSTRING_INDEX(SUBSTRING_INDEX(SUBSTRING_INDEX(CODE_REQ,'/',1),'/',1),'Q',-1)as code, ID_REQ FROM pos_ibi_requisition WHERE DELETE_STATUS_REQ=0 AND MONTH(DATE_CREATION_REQ) = MONTH(CURDATE()) ORDER BY ID_REQ DESC LIMIT 1 ");
                if ($query->num_rows() > 0)  //Ensure that there is at least one result 
                {
                    foreach ($query->result() as $row)  //Iterate through results
                        {
                                $req_id = $row->ID_REQ + 1 ;
                                $req_id_next =  $row->code+1; 
                        }
                } else {
                        $req_id_next = 1;
                        $req_id = 1;
                 }

            $bre = strlen($req_id_next);
            if($bre==1){
                $numero_req= 'REQ0000'.$req_id_next.'/'.date('m/Y');
            }
            else if($bre==2){
                $numero_req='REQ000'.$req_id_next.'/'.date('m/Y');
            }else if($bre==3){
                $numero_req= 'REQ00'.$req_id_next.'/'.date('m/Y');
            }
            else if($bre==4){
                $numero_req= 'REQ00'.$req_id_next.'/'.date('m/Y');
            }
            else{
                $numero_req='REQ'.$req_id_next.'/'.date('m/Y');
            } 

            return $numero_req;

  }




    public function deleterArticle()
    {

        $ider_Article = $this->input->post('ider_Article');

        $deleter = $this->model_rm->delete('pos_ibi_article_requisition', array('CODEBAR_INGREDIENT_REQ' => $ider_Article));

        echo json_encode($deleter);
    }



    public function add_save($store = 0)
    {

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        if (!$this->is_allowed('pos_ibi_requisition_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');
        $this->form_validation->set_rules('typeReq', 'typeReq', 'trim|required');
        $this->form_validation->set_rules('PRIX_INGREDIENT[]', 'PRIX', 'trim|required');
        $this->form_validation->set_rules('QUANTITY_INGREDIENT[]', 'QUANTITY', 'trim|required');

        if ($this->form_validation->run()) {
            $typeReq = $this->input->post('typeReq');

            if ($typeReq == 'P') {
                $patient = $this->input->post('PATIENT');
                if (isset($patient) and !empty($patient)) {
                    $destination = 0;
                } else {
                    echo json_encode([
                        'success' => false,
                        'message' => 'Merci de selectionner L Article!'
                    ]);
                    exit;
                }
            }

            if ($typeReq == 'B') {
                $btq = $this->input->post('BOUTIQUE');
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



            $save_id = $this->model_pos_ibi_requisition->register('pos_ibi_requisition', $save_data);
            $insertId = $this->db->insert_id();
            // $LastId = $this->db->query("SELECT ID_REQ FROM pos_ibi_requisition ORDER BY ID_REQ DESC LIMIT 1");

            // var_dump($insertId);exit;

            for ($i = 0; $i < count($_POST['NOM_INGREDIENT']); $i++) {
                $data = [
                    'NOM_INGREDIENT_REQ' => $_POST['NOM_INGREDIENT'][$i],
                    'QT_INGREDIENT_REQ' => $_POST['QUANTITY_INGREDIENT'][$i],
                    'ID_REQ' => $insertId,
                    'FROM_STORES' => $store,
                    'UNIT_INGREDIENT' => $_POST['UNIT_INGREDIENT'][$i],
                    'PRIX_INGREDIENT_REQ ' => $_POST['PRIX_INGREDIENT'][$i],
                    'TOTAL_INGREDIENT_REQ' => $_POST['QUANTITY_INGREDIENT'][$i] * $_POST['PRIX_INGREDIENT'][$i],
                    'CODEBAR_INGREDIENT_REQ' => $_POST['CODE_BAR'][$i]
                ];

                $ins = $this->model_rm->insert('pos_ibi_article_requisition', $data);
            }

            // dump($data);
            // die;

            if ($save_id) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_id;
                    $this->data['message'] = 'requisition envoyée';
                } else {
                    set_message('requisition envoyée', 'success');



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

    /**
     * Update view Pos Ibi Requisitions
     *
     * @var $id String
     */

    public function edit()
    {
        $id = $this->uri->segment(4);
        $store = $this->uri->segment(2);

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_requisition_update');

        $this->data['requisition'] = $this->model_pos_ibi_requisition->find($id);
        $this->data['articles'] = $this->model_rm->getList('pos_ibi_article_requisition', array('ID_REQ' => $id, 'FROM_STORES' => $store));

        $this->template->title('Pos Ibi Requisition Update');
        $this->render('backend/standart/administrator/requisition/pos_ibi_requisition_update', $this->data);
    }

    /**s
     * Update Pos Ibi Requisitions
     *
     * @var $id String
     */
    public function edit_save($store, $id)
    {



        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        if (!$this->is_allowed('pos_ibi_requisition_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }


        $this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
        $this->form_validation->set_rules('TITRE', 'TITRE', 'trim|required');
        $this->form_validation->set_rules('Q_INGREDIENT[]', 'QUANTITE', 'trim|required');
        $this->form_validation->set_rules('PRIX_INGREDIENT[]', 'PRIX', 'trim|required');

        $this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');
        if ($this->form_validation->run()) {
            $save_data = [
                'DESTINATION_STORE_REQ' => $this->input->post('BOUTIQUE'),
                'TITLE_REQ' => $this->input->post('TITRE'),
                'DATE_MOD_REQ' => date('Y-m-d H:i:s'),
                'MODIFIED_BY_REQ' => get_user_data('id'),

            ];


            $save_id = $this->model_pos_ibi_requisition->change($id, $save_data);
            $del = $this->model_rm->delete('pos_ibi_article_requisition', array('ID_REQ' => $id, 'FROM_STORES' => $store));

            // $condition = array("ID_INGREDIENT_REQ"=>$id);

            for ($i = 0; $i < count($_POST['NOM_INGREDIENT']); $i++) {
                $data = [
                    'NOM_INGREDIENT_REQ' => $_POST['NOM_INGREDIENT'][$i],
                    'QT_INGREDIENT_REQ' => $_POST['Q_INGREDIENT'][$i],
                    'PRIX_INGREDIENT_REQ' => $_POST['PRIX_INGREDIENT'][$i],
                    'FROM_STORES' => $store,
                    'UNIT_INGREDIENT' => $_POST['UNIT_INGREDIENT'][$i],
                    'TOTAL_INGREDIENT_REQ' => $_POST['Q_INGREDIENT'][$i] * $_POST['PRIX_INGREDIENT'][$i],
                    'APROUVED_BY_PROD_REQ' => $_POST['APROUVED_BY_PROD_REQ'][$i],
                    'STATUS_PROD_REQ' => $_POST['STATUS_PROD_REQ'][$i],
                    'CODEBAR_INGREDIENT_REQ' => $_POST['CODE'][$i],
                    'ID_REQ' => $id

                    // var_dump($_POST['APROUVED_BY_PROD_REQ']);
                ];
                // exit;

                $ins = $this->model_rm->insert('pos_ibi_article_requisition', $data);
            }

            if ($save_id) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/requisition', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('requisition/' . $store . '/index');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('requisition/' . $store . '/index');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Pos Ibi Requisitions
     *
     * @var $id String
     */



    public function Suppprimer($store = 0, $id = null)
    {

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_article_requisition');
        $this->load->helper('file');

        $check = $this->model_rm->getOne('pos_ibi_article_requisition', array('ID_INGREDIENT_REQ' => $id, 'FROM_STORES' => $store))['STATUS_PROD_REQ'];

        // or avec avec ca on vas rien supprimer if ($check==0 || $check ==1) {

        if ($check == 1) {
            set_message("cette Article est deja encours ", "error");
            redirect_back();
            exit();
        }

        $msg = $this->input->get('inputValue');
        $remove = false;

        if (!empty($id)) {
            $remove = $this->model_rm->delete('pos_ibi_article_requisition', array('ID_INGREDIENT_REQ' => $id, 'FROM_STORES' => $store));
        }
        if ($remove) {
            set_message('suppression reussie', 'success');
        } else {
            set_message('une erreur est survennue', 'error');
        }

        redirect_back();
    }


    public function deletes($store = 0, $id = null)
    {

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_requisition_delete');
        $this->load->helper('file');

        $check = $this->model_rm->getOne('pos_ibi_article_requisition', array('ID_REQ' => $id, 'FROM_STORES' => $store))['STATUS_PROD_REQ'];

        // or avec avec ca on vas rien supprimer if ($check==0 || $check ==1) {

        if ($check == 1) {
            set_message("cette article est deja encours", "error");
            redirect_back();
            exit();
        }

        $msg = $this->input->get('inputValue');
        $remove = false;

        if (!empty($id)) {
            $remove = $this->model_rm->update(
                'pos_ibi_article_requisition',
                array('ID_REQ' => $id),
                array(
                    'DELETE_DATE_REQ' => date('Y-m-d H:i:s'),
                    'DELETED_COMMENT_REQ' => $msg,
                    'STATUS_PROD_REQ' => 5,
                    'DELETE_STATUS_REQ' =>1,
                    'DELETED_BY_REQ ' => get_user_data('id')
                )
            );
        }
        if ($remove) {

            $this->model_rm->update(
                'pos_ibi_requisition',
                array('ID_REQ' => $id),
                array(
                    'DELETE_DATE_REQ' => date('Y-m-d H:i:s'),
                    'DELETED_COMMENTS_REQ' => $msg,
                    'STATUS_REQ' => 5,
                    'DELETE_STATUS_REQ' => 1,
                    'DELETED_BY_REQ ' => get_user_data('id')
                )
            );

            set_message('Suppression reussie', 'success');
        } else {
            set_message('une erreur est survennue', 'error');
        }

        redirect_back();
    }


    public function delete($store = 0, $id = null)
    {

        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_requisition_delete');
        $this->load->helper('file');

        $check = $this->model_rm->getOne('pos_ibi_article_requisition', array('ID_INGREDIENT_REQ' => $id, 'FROM_STORES' => $store))['STATUS_PROD_REQ'];

        // or avec avec ca on vas rien supprimer if ($check==0 || $check ==1) {

        if ($check == 1) {
            set_message("cette article est deja encours", "error");
            redirect_back();
            exit();
        }

        $msg = $this->input->get('inputValue');
        $remove = false;

        if (!empty($id)) {
            $remove = $this->model_rm->update(
                'pos_ibi_article_requisition',
                array('ID_INGREDIENT_REQ' => $id, 'FROM_STORES' => $store),
                array(
                    'DELETE_DATE_REQ' => date('Y-m-d H:i:s'),
                    'DELETED_COMMENT_REQ' => $msg,
                    'STATUS_PROD_REQ' => 4,
                    'DELETE_STATUS_REQ' =>1,
                    'DELETED_BY_REQ ' => get_user_data('id')
                )
            );
        }
        if ($remove) {
            set_message('annulation reussie', 'success');
        } else {
            set_message('une erreur est survennue', 'error');
        }

        redirect_back();
    }



    /**
     * View view Pos Ibi Requisitions
     *
     * @var $id String
     */
    public function view()
    {

        $id = $this->uri->segment(4);
        $store = $this->uri->segment(2);
        if ($store == 0) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $check = $this->model_rm->getOne('pos_ibi_requisition', array('ID_REQ' => $id))['FROM_STORE'];

        if ($check != $store) {
            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
        }

        $this->is_allowed('pos_ibi_requisition_view');
        $this->data['requisition'] = $this->model_pos_ibi_requisition->join_avaiable()->filter_avaiable()->find($id);
        $this->data['produits'] = $this->model_rm->getList('pos_ibi_article_requisition', array('ID_REQ' => $id,'DELETE_STATUS_REQ' =>0, 'FROM_STORES' => $store));


        $this->data['requis_list'] = $this->db->query("SELECT SUM(TOTAL_INGREDIENT_REQ) AS MONTANT_REQ FROM pos_ibi_article_requisition WHERE ID_REQ = " . $id . " AND STATUS_PROD_REQ =2 ")->row_array();
        // echo "<pre>";
        // var_dump($this->data['requis_list']);

        // exit;
        $this->template->title('Pos Ibi Requisition Detail');
        $this->render('backend/standart/administrator/requisition/pos_ibi_requisition_view', $this->data);
    }


    public function returnQ()
    {
        $id = $this->input->post('id');
        $qt = $this->input->post('qt');
        $store = $this->input->post('store');
        $idreq = $this->input->post('idreq');


        $up = $this->model_rm->getUpdate('UPDATE pos_ibi_article_requisition SET QT_RETOUR_ARTICLE_REQ=(QT_RETOUR_ARTICLE_REQ+' . $qt . ') WHERE ID_ARTICLE_REQ=' . $id . '');

        if ($up) {
            echo json_encode(array(
                'msg' => 'requisition envoyée',
                'link' => base_url('requisition/' . $store . '/view/' . $idreq)
            ));
        }
    }

    /**
     * delete Pos Ibi Requisitions
     *
     * @var $id String
     */
    private function _remove($id)
    {
        $pos_ibi_requisition = $this->model_pos_ibi_requisition->find($id);

        return $this->model_pos_ibi_requisition->remove($id);
    }



    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('pos_ibi_requisition_export');

        $this->model_pos_ibi_requisition->export('pos_ibi_requisition', 'pos_ibi_requisition');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {
        $this->is_allowed('pos_ibi_requisition_export');

        $this->model_pos_ibi_requisition->pdf('pos_ibi_requisition', 'pos_ibi_requisition');
    }


    public function getIngredientPrincipale($uri)
    {
        // var_dump($uri); exit;
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if ($name == 'PATIENT') {
            $id = 1;
        }

        $data = $this->model_rm->getRequete('
     SELECT ID_ARTICLE AS ID,
         U.ID_UNITE AS UNITE,
         U.DESIGNATION_UNITE AS UNITE_DESIGN,
         A.CODEBAR_ARTICLE AS CODEBAR,
		 A.DESIGN_ARTICLE AS NOM_ART, 
		 A.QUANTITY_ARTICLE AS QTE,
         A.IS_INGREDIENT AS TYPES,
		 A.PRIX_DACHAT_ARTICLE AS PRIX
        FROM pos_store_' . $uri . '_ibi_articles A LEFT JOIN unite_articles U ON U.ID_UNITE=A.UNITE_ARTICLE WHERE A.TYPE_ARTICLE=0 AND  A.DELETE_STATUS_ARTICLE = 0 AND A.STORE_ID_ARTICLE = "' . $uri . '"');

        //print_r($data); exit();

        echo json_encode($data);
    }






    public function getIngredients_modifier($uri, $id_requisition)
    {
        $id_req = $this->uri->segment(5);

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if ($name == 'PATIENT') {
            $id = 1;
        }


        $data = $this->model_rm->getRequete('
         SELECT ID_ARTICLE AS ID,
         U.ID_UNITE AS UNITE,
         U.DESIGNATION_UNITE AS UNITE_DESIGN,
         A.CODEBAR_ARTICLE AS CODEBAR,
         A.DESIGN_ARTICLE AS NOM_ART, 
         A.QUANTITY_ARTICLE AS QTE,
         A.PRIX_DACHAT_ARTICLE AS PRIX,
        "article" AS TYPES
        FROM pos_store_' . $uri . '_ibi_articles A LEFT JOIN unite_articles U ON U.ID_UNITE=A.UNITE_ARTICLE WHERE A.TYPE_ARTICLE=0 AND A.DELETE_STATUS_ARTICLE = 0 AND A.STORE_ID_ARTICLE= ' . $uri . ' 
        AND A.CODEBAR_ARTICLE NOT IN (SELECT CODEBAR_INGREDIENT_REQ FROM pos_ibi_article_requisition WHERE ID_REQ = ' . $id_req . ' )

        ');

        // var_dump($data);exit;

        echo json_encode($data);
    }



    public function getIngredients($uri)
    {
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        if ($name == 'PATIENT') {
            $id = 1;
        }


        $data = $this->model_rm->getRequete('
        SELECT ID_ARTICLE AS ID,
         U.ID_UNITE AS UNITE,
         U.DESIGNATION_UNITE AS UNITE_DESIGN,
         A.CODEBAR_ARTICLE AS CODEBAR,
         A.DESIGN_ARTICLE AS NOM_ART, 
         A.QUANTITY_ARTICLE AS QTE,
         A.PRIX_DACHAT_ARTICLE AS PRIX,
		"article" AS TYPES
        FROM pos_store_' . $uri . '_ibi_articles A LEFT JOIN unite_articles U ON U.ID_UNITE=A.UNITE_ARTICLE WHERE  A.DELETE_STATUS_ARTICLE = 0 ');

        echo json_encode($data);
    }

    public function getNotify()
    {
        $status = $this->input->post('status');
        $store = $this->input->post('store');

        $data = $this->model_rm->getRequete('SELECT *FROM pos_ibi_requisition');
        echo json_encode($data);
    }


    public function getType()
    {
        $store = $this->input->post('store');
        $type = $this->input->post('type');

        if ($type == 'B') {

            $boutique = $this->model_rm->getRequete('SELECT *FROM pos_ibi_stores WHERE STATUS_STORE="opened"  AND ID_STORE!=' . $store . '');

            $contentB = '<select class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="BOUTIQUE" onchange="getArticles(this)">
          <option value="">---Selectionner une boutique---</option>';

            foreach ($boutique as $key) {
                $contentB .= '<option value=' . $key['ID_STORE'] . '> ' . $key['NAME_STORE'] . '</option>';
            }

            $contentB .= '</select>';

            echo $contentB;
        } else {

            if ($type == 'P') {
                $patient = $this->model_rm->getList('patient_file', array('DELETED_STATUS_PATIENT_FILE' => 0, 'PATIENT_FILE_STATUS' => 0));

                $contentB = '<select class="form-control chosen chosen-select-deselect" id="BOUTIQUE" name="PATIENT" prix="900" onchange="getArticles(this)">
          <option value="">---Selectionner le patient---</option>';

                foreach ($patient as $key) {
                    $n = $this->model_rm->getOne('patients', array('ID_PATIENT' => $key['PATIENT_ID']));
                    $name = $n['NOM_PATIENT'] . '-' . $n['PRENOM_PATIENT'];
                    $contentB .= '<option value=' . $key['PATIENT_ID'] . '> ' . $key['PATIENT_FILE_CODE'] . '---------' . $name . '</option>';
                }

                $contentB .= '</select>';

                echo $contentB;
            }
        }
    }

    public function incomming($ider)
    {

        $id = $ider;

        //print_r($id);exit();




        //$dataIncomming = array('STATUS_REQ' => 1);
        //$condition = array('ID_REQ' => $ider, 'AUTHOR_REQ' => get_user_data('id'));

       // $suppression = $this->db->query("SELECT * FROM pos_ibi_requisition
                      // WHERE ID_REQ = " . $ider . "")->num_rows();

        /*if ($suppression) {*/


            $modify = $this->model_pos_ibi_requisition->incomming_bs('pos_ibi_requisition', array('ID_REQ' => $ider), array('STATUS_REQ' => 1));
            $m = $this->model_pos_ibi_requisition->incomming_bs('pos_ibi_article_requisition', array('ID_REQ' => $ider,"STATUS_PROD_REQ!="=> '4',), array('STATUS_PROD_REQ' => 1));
        //}

        if ($modify) {
            echo "success request";
        } else {
            echo "error";
        }
    }



    function modifyQuantinty($store, $Quant, $ider, $price, $users)
    {
        // var_dump($ider); exit;

        $dataQuantity = array('QT_INGREDIENT_REQ' => $Quant, 'ID_INGREDIENT_REQ' => $ider, "PRIX_INGREDIENT_REQ" => $price, 'STATUS_PROD_REQ' => 2);



        $dataQuantity_user = array('QT_INGREDIENT_REQ' => $Quant, 'ID_INGREDIENT_REQ' => $ider, "PRIX_INGREDIENT_REQ" => $price);
        $condition = array('ID_INGREDIENT_REQ' => $ider, 'FROM_STORES' => $store);
        $table = "pos_ibi_article_requisition";

        if (($users) != "user") {
            $modify = $this->model_pos_ibi_requisition->modify_Quantity($table, $condition, $dataQuantity);
        } else {
            $modify = $this->model_pos_ibi_requisition->modify_Quantity($table, $condition, $dataQuantity_user);
        }

        if ($modify) {
            echo "success request";
        } else {
            echo "error";
        }
    }


    public function confirmer($ider, $URI)
    {

        $ID_REQ = $this->input->post('ID_REQ');
        $Quant = $this->input->post('Quant');
        $price = $this->input->post('price');

        $total_somme = $Quant * $price;
        $GET_SHIFT = $this->db->query("SELECT * FROM cashier_shifts WHERE SHIFT_STATUS =0 ORDER BY ID_SHIFT DESC ")->row_array();

        $get_depense = $this->db->query("SELECT * FROM pos_depenses WHERE ID_REQUISITION = '" . $ID_REQ . "' ")->row_array();

        if (!is_null($get_depense)) {
            $UpSomsDeps = $total_somme + $get_depense['MONTANT_DEPENSE'];
        } else {
            $UpSomsDeps = $total_somme + 0;
        }
        //$get_depense = $this->db->query("SELECT * FROM pos_depenses WHERE ID_REQUISITION = '".$ID_REQ."' ")->row_array();

        $UpSomsDeps = $total_somme + $get_depense['MONTANT_DEPENSE'];

        $get_requisition = $this->db->query("SELECT * FROM pos_ibi_requisition WHERE ID_REQ = '" . $ID_REQ . "' ")->row_array();

        $dataApprouved = array('STATUS_PROD_REQ' => 2, "APROUVED_BY_PROD_REQ" => get_user_data('id'));
        $condition = array('ID_INGREDIENT_REQ' => $ider, 'FROM_STORES' => $URI);

        $modify = $this->model_pos_ibi_requisition->incomming_bs('pos_ibi_article_requisition', $condition, $dataApprouved);
        if ($modify) {
            echo "success request";
        } else {
            echo "error";
        }
    }


    public function AutoriserRequisition($id_requisition, $quantites, $URI)
    {

        $REQUISITION = $this->db->query("SELECT * FROM pos_ibi_requisition WHERE ID_REQ = " . $id_requisition . "  ")->row_array();

        $this->data["message"] = "correct";
        $datas = array('STATUS_PROD_REQ' => 3);
        $critere = array('ID_REQ' => $id_requisition, "STATUS_PROD_REQ" => 1,"STATUS_PROD_REQ!="=> '4');

        $response = "TRUE";
        /*$status = $this->db->query("SELECT * FROM pos_ibi_article_requisition WHERE ID_REQ = 
       $id_requisition AND FROM_STORES =" . $URI . " ")->result_array();

        $GET_SHIFT = $this->db->query("SELECT * FROM cashier_shifts WHERE SHIFT_STATUS =0 ORDER BY ID_SHIFT DESC ")->row_array();


        foreach ($status as $value) {
            if ($value['STATUS_PROD_REQ'] == 0 || $value['STATUS_PROD_REQ'] == 1) {
                $response = "FALSE";
            }
        }*/
        if ($response == 'TRUE') {
            // $value = $this->db->query("SELECT SUM(TOTAL_INGREDIENT_REQ) AS DEPENSE FROM pos_ibi_article_requisition WHERE ID_REQ = " . $id_requisition . " AND FROM_STORES = " . $URI . "  ")->row_array();

            // $DATAS_DEPENSE = array('ID_REQUISITION' => $id_requisition, 'MONTANT_DEPENSE' => $value['DEPENSE'], 'NOM_DEPENSE' => $REQUISITION['CODE_REQ'], 'CREATE_BY_DEPENSE' => get_user_data('id'), 'ID_CATEGORIE_DEPENSE' => 1,'ID_SHIFT'=>$GET_SHIFT['ID_SHIFT']);
            // $ADD_DEPENSE = $this->model_pos_ibi_requisition->register('pos_depenses', $DATAS_DEPENSE);

            // var_dump($DATAS_DEPENSE);exit;
            $updater = $this->model_pos_ibi_requisition->incomming_bs('pos_ibi_article_requisition', $critere, $datas);

            $update_requisition = $this->model_pos_ibi_requisition->incomming_bs(
                'pos_ibi_requisition',
                array('ID_REQ' => $id_requisition),
                array('STATUS_REQ' => 3, 'AUTORIZED_BY_PROD_REQ' => get_user_data('id'),'DATE_AUTORISED_PROD_REQ'=>date("Y-m-d H:i:s"))
            );
            if ($updater) {
                $data['message'] = "success";
            } else {
                $data['message'] =  "echec";
            }
        } else {
            $data['message'] = "echec";
        }
        echo ($data['message']);
    }





    public function ApprobationRequisition()
    {

        $activIdRequisition = $this->input->post('activIdRequisition');

        $datas = array('STATUS_PROD_REQ' => 2, "APROUVED_BY_PROD_REQ" => get_user_data('id'));


        if (!empty($activIdRequisition)) {
 

            $this->db->where(["STATUS_PROD_REQ!="=> '4',"ID_REQ" => $activIdRequisition]);

            $this->db->set($datas);
            $updater = $this->db->update("pos_ibi_article_requisition");

            $update_requisition = $this->model_pos_ibi_requisition->incomming_bs(
                'pos_ibi_requisition',
                array('ID_REQ' => $activIdRequisition),
                array('STATUS_REQ' => 2, 'APROUVED_BY_REQ' => get_user_data('id'),'DATE_APROUVED_REQ'=>date('Y-m-d H:i:s'))
            );
            if ($update_requisition) {
                $data['message'] = "success";
            } else {
                $data['message'] =  "echec";
            }
        } else {
            $data['message'] = "echec";
        }
        echo ($data['message']);
    }






    public function approuver($ider)
    {

        $dataApprouved = array('STATUS_PROD_REQ' => 2, 'APROUVED_BY_PROD_REQ' => get_user_data('id'));
        $condition = array('ID_INGREDIENT_REQ' => $ider);

        $modify = $this->model_pos_ibi_requisition->incomming_bs('pos_ibi_article_requisition', $condition, $dataApprouved);

        if ($modify) {
            echo "success request";
        } else {
            echo "error";
        }
    }


    public function requsitionnerAll($store, $id_requisition)
    {

        $up_Data = array('APROUVED_BY_STORE' => 2, 'APROUVED_BY_PROD_REQ' => get_user_data('id'));
        $critere = array('ID_REQ' => $id_requisition);
        $number = 2;
        $I = 1;
        $query = $this->model_pos_ibi_requisition->getOneOff($critere);

        print_r($query);
        exit;

        $modify = $this->db->query("UPDATE pos_ibi_requisition SET STATUS_REQ = ( CASE  WHEN 'ID_REQ' < 1 THEN 'STATUS_REQ' +1  ELSE STATUS_REQ END ) ");

        if ($modify) {
            echo "success request";
        } else {
            echo "error";
        }
    }





    public function getterOneOff($store = 0)
    {
        $id_ingredient = $this->input->post('id_ingredient');
        $result_bs = $this->db->query(" SELECT * FROM pos_ibi_article_requisition WHERE 
     ID_INGREDIENT_REQ = " . $id_ingredient . "  ")->row_array();


        echo json_encode($result_bs);
    }




    public function modification_mars($uri, $requisition)
    {

        $quantites = $this->input->post('QUANTITE_INGREDIENT');
        $id_requisition = $this->input->post('ID_REQ');
        $id_ingredient_req = $this->input->post('ID_INGREDIENT');
        $code_bar = $this->input->post('CODEBAR');
        $prix_unitaire = $this->input->post('UNIT_PRICE');

        $prix_tot = $prix_unitaire*$quantites;

        $critere  = array('ID_INGREDIENT_REQ' => $id_ingredient_req, 'ID_REQ' => $id_requisition);
        $datas_save  = array('QT_INGREDIENT_REQ' => $quantites, 'PRIX_INGREDIENT_REQ' => $prix_unitaire,'TOTAL_INGREDIENT_REQ ' => $prix_tot);


        $this->db->where($critere);
        $this->db->set($datas_save);
        $update = $this->db->update("pos_ibi_article_requisition");

        if ($update) {
            echo TRUE;
        }
    }
}







/* End of file pos_ibi_requisition.php */
/* Location: ./application/controllers/administrator/Pos Ibi Requisition.php */
