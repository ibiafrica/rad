<?php

defined('BASEPATH') or exit('No direct script access allowed');







class pos_ibi_requisition_trans extends Admin

{

    public function __construct()

    {

        parent::__construct();



        $this->load->model('model_pos_ibi_requisition_trans');

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

        $this->is_allowed('pos_ibi_requisition_trans_list');



        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');

            redirect('administrator/stores');

        }



        $filter = $this->input->get('q');

        $field     = $this->input->get('f');



        $this->data['requisition'] = $this->model_pos_ibi_requisition_trans->get($filter, $field, $this->limit_page, $offset);

        $this->data['req_counts'] = $this->model_pos_ibi_requisition_trans->count_all($filter, $field);



        $config = [

            'base_url'     => 'pos_ibi_requisition_trans/' . $store . '/index/',

            'total_rows'   => $this->model_pos_ibi_requisition_trans->count_all($filter, $field),

            'per_page'     => $this->limit_page,

            'uri_segment'  => 4,

        ];



        $this->data['pagination'] = $this->pagination($config);



        $this->template->title('Pos Ibi Requisition List');

        $this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_trans_list', $this->data);

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



        $this->data['stores'] = $this->model_rm->getRequete('SELECT *FROM pos_ibi_stores WHERE DELETE_STATUS_STORE=0 AND STATUS_STORE="opened"  AND ID_STORE!=' . $store . '');







        



        $this->template->title('Pos Ibi Requisition New');

        $this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_trans_add', $this->data);

    }



    /**

     * Add New Pos Ibi Requisitions

     *

     * @return JSON

     */



    public function getCode()

    {

        $lastid = $this->model_rm->getRequeteOne("SELECT lpad(max(ID_REQ)+1,5,0) as Maxcount , max(CODE_REQ) as

          CODE_REQ FROM  pos_ibi_requisition_trans");



        $code = $lastid['CODE_REQ'];



        if (date('m') == substr($code, 9, 2)) {

            return 'REQ' . $lastid['Maxcount'] . '/' . date('m/Y');

        } else {

            return "REQ00001/" . date('m/Y');

        }

    }









    //   public function My_ad($store=null){



    //     $this->form_validation->set_rules('NOM_INGREDIENT', 'NOM_INGREDIENT', 'trim|required');

    //     $this->form_validation->set_rules('CODE', 'CODE', 'trim|required');



    //      if($this->form_validation->run()){



    //      }





    //   }











    public function add_save($store = 0)

    {







        // $stores=$this->uri->segment(4);

        // print_r($stores);exit;



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





        $this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');

        //$this->form_validation->set_rules('RAISON_ID', 'Raison transfert', 'trim|required');



        if ($this->form_validation->run()) {



            $btq = $this->input->post('BOUTIQUE');

            $destination = $btq;



            $save_data = [

                'DESTINATION_STORE_REQ' => $destination,

                'FROM_STORE' => $store,

                'TYPE_REQ'=>$this->input->post('RAISON_ID'),

                'TITLE_REQ'=>$this->input->post('TITRE_TRANSF'),

                'DATE_CREATION_REQ' => date('Y-m-d H:i:s'),

                'CREATED_BY_REQ' => get_user_data('id'),

                'AUTHOR_REQ' => get_user_data('id'),

                'CODE_REQ' => $this->getCode()



            ];



            // $save_id = $this->model_pos_ibi_requisition_trans->register('pos_ibi_requisition',$save_data);

            // $insertId = $this->db->insert_id();



            $save_id = $this->model_pos_ibi_requisition_trans->store($save_data);



            for ($i = 0; $i < count($_POST['NOM_ARTICLE']); $i++) {

                $data = [

                    'NOM_ARTICLE_REQ' => $_POST['NOM_ARTICLE'][$i],

                    'QT_ARTICLE_REQ' => $_POST['Q_ARTICLE'][$i],

                    'PRIX_ARTICLE_REQ' => $_POST['PRIX_ARTICLE'][$i],

                    'TOTAL_ARTICLE_REQ' => $_POST['TOTAL_ARTICLE'][$i],

                    'CODEBAR_ARTICLE_REQ' => $_POST['CODE'][$i],

                    'ID_REQ' => $save_id,

                    'TYPES' => $_POST['TYPES'][$i]

                ];



                $ins = $this->model_rm->insert('pos_ibi_article_requisition_trans', $data);

            }







            if ($save_id) {

                if ($this->input->post('save_type') == 'stay') {

                    $this->data['success'] = true;

                    $this->data['id']        = $save_id;

                    $this->data['message'] = 'requisition envoyée';

                } else {

                    set_message('requisition envoyée', 'success');







                    $this->data['success'] = true;

                    $this->data['redirect'] = base_url('pos_ibi_requisition_trans/' . $store . '/index/');

                }

            } else {

                if ($this->input->post('save_type') == 'stay') {

                    $this->data['success'] = false;

                    $this->data['message'] = cclang('data_not_change');

                } else {

                    $this->data['success'] = false;

                    $this->data['message'] = cclang('data_not_change');

                    $this->data['redirect'] = base_url('pos_ibi_requisition_trans/' . $store . '/index/');

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



        $this->is_allowed('pos_ibi_requisition_trans_update');



        $this->data['requisition'] = $this->model_pos_ibi_requisition_trans->find($id);

        $this->data['articles'] = $this->model_rm->getList('pos_ibi_article_requisition_trans', array('ID_REQ' => $id));



        // echo"<pre>";

        // print_r($this->data['articles']);

        // exit();



        $this->template->title('Pos Ibi Requisition Update');

        $this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_trans_update', $this->data);

    }



    /**s

     * Update Pos Ibi Requisitions

     *

     * @var $id String

     */

    public function edit_save($store, $id)

    {

   //print_r($id);die;



        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');

            redirect('administrator/stores');

        }



        if (!$this->is_allowed('pos_ibi_requisition_trans_update', false)) {

            echo json_encode([

                'success' => false,

                'message' => cclang('sorry_you_do_not_have_permission_to_access')

            ]);

            exit;

        }





        $this->form_validation->set_rules('BOUTIQUE', 'BOUTIQUE', 'trim|required');

        $this->form_validation->set_rules('RAISON_ID', 'Raison transfert', 'trim|required');



        if ($this->form_validation->run()) {



            $save_data = [

                'DESTINATION_STORE_REQ' => $this->input->post('BOUTIQUE'),

                // 'TITLE_REQ'=>$this->input->post('TITRE'),

                'DATE_MOD_REQ' => date('Y-m-d H:i:s'),

                'MODIFIED_BY_REQ' => get_user_data('id'),

                'TYPE_REQ'=>$this->input->post('RAISON_ID'),



            ];





            $save_id = $this->model_pos_ibi_requisition_trans->change($id, $save_data);

            $del = $this->model_rm->delete('pos_ibi_article_requisition_trans', array('ID_REQ' => $id));







            for ($i = 0; $i < count($_POST['NOM_ARTICLE']); $i++) {

                $data = [

                    'NOM_ARTICLE_REQ' => $_POST['NOM_ARTICLE'][$i],

                    'QT_ARTICLE_REQ' => $_POST['Q_ARTICLE'][$i],

                    'PRIX_ARTICLE_REQ' => $_POST['PRIX_ARTICLE'][$i],

                    'TOTAL_ARTICLE_REQ' => $_POST['TOTAL_ARTICLE'][$i],

                    'CODEBAR_ARTICLE_REQ' => $_POST['CODE'][$i],

                    'ID_REQ' => $id,

                    'TYPES' => $_POST['TYPES'][$i]

                ];

            //dump($data);die;



                $ins = $this->model_rm->insert('pos_ibi_article_requisition_trans', $data);







                // $ins=$this->model_pos_ibi_requisition_trans->incomming_bs('pos_ibi_article_requisition_trans',$condition,$data);





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

                    $this->data['redirect'] = base_url('pos_ibi_requisition_trans/' . $store . '/index');

                }

            } else {

                if ($this->input->post('save_type') == 'stay') {

                    $this->data['success'] = false;

                    $this->data['message'] = cclang('data_not_change');

                } else {

                    $this->data['success'] = false;

                    $this->data['message'] = cclang('data_not_change');

                    $this->data['redirect'] = base_url('pos_ibi_requisition_trans/' . $store . '/index');

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

    public function delete($store = 0, $id = null)

    {



        // or ca pouvait etre 1 if ($store == 0 || $store ==1 ) { 



        if ($store == 0) {

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');

            redirect('administrator/stores');

        }



        $this->is_allowed('pos_ibi_requisition_delete');

        $this->load->helper('file');



        $check = $this->model_rm->getOne('pos_ibi_requisition_trans', array('ID_REQ' => $id))['STATUS_REQ'];





        // or avec avec ca on vas rien supprimer if ($check==0 || $check ==1) {



        if ($check == 1) {

            set_message("cette requisition est deja encours ou en attente", "error");

            redirect_back();

            exit();

        }



        $msg = $this->input->get('inputValue');

        $remove = false;



        if (!empty($id)) {

            $remove = $this->model_rm->update(

                'pos_ibi_requisition_trans',

                array('ID_REQ' => $id),

                array(

                    'DELETE_STATUS_REQ' => 1,

                    'DELETE_DATE_REQ' => date('Y-m-d H:i:s'),

                    'DELETED_COMMENTS_REQ' => $msg,

                    'DELETED_BY_REQ' => get_user_data('id')

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



        // $check=$this->model_rm->getOne('pos_ibi_requisition', array('ID_REQ'=>$id))['FROM_STORE'];



        // if ($check!=$store) {

        //     set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');

        //     redirect('administrator/stores');

        // }



        $this->is_allowed('pos_ibi_requisition_trans_view');



        $this->data['requisition'] = $this->model_pos_ibi_requisition_trans->join_avaiable()->filter_avaiable()->find($id);



        $this->data['produits'] = $this->model_rm->getList('pos_ibi_article_requisition_trans', array('ID_REQ' => $id));



        $this->template->title('Pos Ibi Requisition Detail');

        $this->render('backend/standart/administrator/pos_ibi_requisition_trans/pos_ibi_requisition_trans_view', $this->data);

    }





    public function returnQ()

    {

        $id = $this->input->post('id');

        $qt = $this->input->post('qt');

        $store = $this->input->post('store');

        $idreq = $this->input->post('idreq');





        $up = $this->model_rm->getUpdate('UPDATE pos_ibi_article_requisition_trans SET QT_RETOUR_ARTICLE_REQ=(QT_RETOUR_ARTICLE_REQ+' . $qt . ') WHERE ID_ARTICLE_REQ=' . $id . '');



        if ($up) {

            echo json_encode(

                array(

                    'msg' => 'requisition envoyée',

                    'link' => base_url('pos_ibi_requisition_trans/' . $store . '/view/' . $idreq)

                )

            );

        }

    }



    /**

     * delete Pos Ibi Requisitions

     *

     * @var $id String

     */

    private function _remove($id)

    {

        $pos_ibi_requisition = $this->model_pos_ibi_requisition_trans->find($id);



        return $this->model_pos_ibi_requisition_trans->remove($id);

    }















    /**

     * Export to excel

     *

     * @return Files Excel .xls

     */

    public function export()

    {

        $this->is_allowed('pos_ibi_requisition_export');



        $this->model_pos_ibi_requisition_trans->export('pos_ibi_requisition', 'pos_ibi_requisition');

    }



    /**

     * Export to PDF

     *

     * @return Files PDF .pdf

     */

    public function export_pdf()

    {

        $this->is_allowed('pos_ibi_requisition_export');



        $this->model_pos_ibi_requisition_trans->pdf('pos_ibi_requisition', 'pos_ibi_requisition');

    }



    public function getArticles()

    {



        $store_dest = $this->input->post('id');

        $store = $this->input->post('store');

        $typReq = $this->input->post('typReq');

        

        $req='';

    



        $data = $this->model_rm->getRequete(' 

        SELECT CODEBAR_ARTICLE AS CODEBAR,

        DESIGN_ARTICLE AS NOM_ART, 

        QUANTITY_ARTICLE AS QTE,

        PRIX_DACHAT_ARTICLE AS PRIX,

        IS_INGREDIENT AS TYPES

        FROM pos_store_' . $store_dest.'_ibi_articles WHERE TYPE_ARTICLE=0 AND DELETE_STATUS_ARTICLE=0 '.$req.' ');



        echo json_encode($data);

    }



    public function getNotify()

    {

        $status = $this->input->post('status');

        $store = $this->input->post('store');



        $data = $this->model_rm->getRequete('SELECT * FROM pos_ibi_requisition');

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

          <option value="">---Selectionner le client---</option>';



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



        $dataIncomming = array('STATUS_REQ' => 1);

        $condition = array('ID_REQ' => $id, 'AUTHOR_REQ' => 1);





        $modify = $this->model_pos_ibi_requisition_trans->incomming_bs('pos_ibi_requisition', $condition, $dataIncomming);



        if ($modify) {

            echo "success request";

        } else {

            echo "error";

        }

    }





    function modifyQuantinty($store, $Quant, $ider)

    {







        $dataQuantity = array('TOTAL_INGREDIENT_REQ' => $Quant, 'ID_INGREDIENT_REQ' => $ider);

        $condition = array('ID_INGREDIENT_REQ' => $ider);



        //  echo "<pre>";

        //   print_r($dataQuantity);

        //  exit();



        $table = "pos_ibi_article_requisition_trans";

        $modify = $this->model_pos_ibi_requisition_trans->modify_Quantity($table, $condition, $dataQuantity);





        if ($modify) {

            echo "success request";

        } else {

            echo "error";

        }

    }































    function approuver($ider)

    {



        $dataApprouved = array('STATUS_PROD_REQ' => 2, 'APROUVED_BY_PROD_REQ' => get_user_data('id'));

        $condition = array('ID_INGREDIENT_REQ' => $ider);





        $modify = $this->model_pos_ibi_requisition_trans->incomming_bs('pos_ibi_article_requisition_trans', $condition, $dataApprouved);



        if ($modify) {

            echo "success request";

        } else {

            echo "error";

        }

    }

}





/* End of file pos_ibi_requisition.php */

/* Location: ./application/controllers/administrator/Pos Ibi Requisition.php */

