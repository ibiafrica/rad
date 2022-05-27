<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Pos Depenses Controller
 *| --------------------------------------------------------------------------
 *| Pos Depenses site
 *|
 */
class pos_depenses extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_pos_depenses');
    }

    /**
     * show all Pos Depensess
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {


        $this->is_allowed('pos_depenses_list');

        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
        $cat = $this->input->get('CATEGORIE_DEPENSE_UP');
        $filter = $this->input->get('q');
        $field     = $this->input->get('f');

        $this->data['pos_depensess'] = $this->model_pos_depenses->get($date_start, $date_end, $filter, $field, $this->limit_page, $offset);

        // var_dump($this->data['pos_depensess']);exit();

         $this->data['pos_depenses_counts'] = $this->model_pos_depenses->count_all($date_start, $date_end, $filter, $field);

        $config = [
            'base_url'     => 'administrator/pos_depenses/index/',
            'total_rows'   => $this->model_pos_depenses->count_all($date_start, $date_end, $filter, $field),
            'per_page'     => $this->limit_page,
            'uri_segment'  => 4,
        ];

        $this->data['pagination'] = $this->pagination($config);

        $this->template->title('Pos Depenses List');
        $this->render('backend/standart/administrator/pos_depenses/pos_depenses_list', $this->data);
    }

    /**
     * Add new pos_depensess
     *
     */
    public function add()
    {
        $this->is_allowed('pos_depenses_add');

        $this->template->title('Pos Depenses New');
        $this->render('backend/standart/administrator/pos_depenses/pos_depenses_add', $this->data);
    }

    /**
     * Add New Pos Depensess
     *
     * @return JSON
     */
    public function add_save()
    {
        if (!$this->is_allowed('pos_depenses_add', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }


        $type_activite = $this->input->post('TYPE_ACTIVITE');
        $name_depense = $this->db->get_where('type_activite_depense', ['ID_ACTIVITE' => $type_activite])->row_array()['DESIGN_ACTIVITE'];
        $CATEGORIE_DEPENSE = $this->input->post('CATEGORIE_DEPENSE');


        $this->form_validation->set_rules('TYPE_ACTIVITE', 'TYPE ACTIVITE', 'trim|required');
        $this->form_validation->set_rules('CATEGORIE_DEPENSE', 'CATEGORIE_DEPENSE', 'trim|required');
        $this->form_validation->set_rules('TYPE_ACTIVITE', 'TYPE ACTIVITE', 'trim|required');
        $this->form_validation->set_rules('MONTANT_DEPENSE', 'MONTANT_DEPENSE', 'trim|required');


        $URI = $this->input->post('URI');
        $titre = "Activite " . $name_depense;
        $GET_SHIFT = $this->db->query("SELECT * FROM cashier_shifts WHERE SHIFT_STATUS = 0 ")->row_array();

        if ($this->form_validation->run()) {

            if ($type_activite == 2) {

                $save_data = [
                    'NOM_DEPENSE' => $titre,
                    'TYPE_ACTIVITE_CAISSE' => $type_activite,
                    'MONTANT_APPROVIONNEMENT' => $this->input->post('MONTANT_DEPENSE'),
                    'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE'),
                    'CREATE_BY_DEPENSE' => get_user_data('id'),
                    'ID_SHIFT' => $GET_SHIFT['ID_SHIFT'],
                    'ID_CATEGORIE_DEPENSE' => $CATEGORIE_DEPENSE
                ];
            } else {

                $save_data = [
                    'NOM_DEPENSE' => $titre,
                    'TYPE_ACTIVITE_CAISSE' => $type_activite,
                    'MONTANT_DEPENSE' => $this->input->post('MONTANT_DEPENSE'),
                    'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE'),
                    'CREATE_BY_DEPENSE' => get_user_data('id'),
                    'ID_SHIFT' => $GET_SHIFT['ID_SHIFT'],
                    'ID_CATEGORIE_DEPENSE' => $CATEGORIE_DEPENSE
                ];
            }



            $save_pos_depenses = $this->model_pos_depenses->store($save_data);
            if ($save_pos_depenses) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_pos_depenses;
                    $this->data['message'] = cclang('success_save_data_stay', [
                        anchor('administrator/pos_depenses/edit/' . $save_pos_depenses, 'Edit Pos Depenses'),
                        anchor('administrator/pos_depenses/index', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_save_data_redirect', [
                            anchor('administrator/pos_depenses/edit/' . $save_pos_depenses, 'Edit Pos Depenses')
                        ]),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/pos_depenses/index');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/pos_depenses/index');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * Update view Pos Depensess
     *
     * @var $id String
     */
    public function edit($id = 0)
    {


        $this->is_allowed('pos_depenses_update');
        $ider = $this->uri->segment(3);
        $this->data['pos_depenses'] = $this->model_pos_depenses->find($ider);

        $this->template->title('Pos Depenses Update');
        $this->render('backend/standart/administrator/pos_depenses/pos_depenses_update', $this->data);
    }

    /**
     * Update Pos Depensess
     *
     * @var $id String
     */
    public function edit_save($id)
    {

        /*var_dump($id);exit;*/
        if (!$this->is_allowed('pos_depenses_update', false)) {
            echo json_encode([
                'success' => false,
                'message' => cclang('sorry_you_do_not_have_permission_to_access')
            ]);
            exit;
        }

        $type_activite = $this->input->post('TYPE_ACTIVITE_UP');

        $name_depense = $this->db->get_where('type_activite_depense', ['ID_ACTIVITE' => $type_activite])->row_array()['DESIGN_ACTIVITE'];
        $title = "Activite " . $name_depense;

        $this->form_validation->set_rules('TYPE_ACTIVITE_UP', 'TYPE ACTIVITE', 'trim|required');
        $this->form_validation->set_rules('MONTANT_DEPENSE_UP', 'MONTANT DEPENSE', 'trim|required');
        $this->form_validation->set_rules('ID_CATEGORIE_DEPENSE_UP', 'CATEGORIE DEPENSE', 'trim|required');



        if ($this->form_validation->run()) {
            if ($type_activite == 2) {

                $save_data = [
                    'NOM_DEPENSE' => $title,
                    'TYPE_ACTIVITE_CAISSE' => $this->input->post('TYPE_ACTIVITE_UP'),
                    'ID_CATEGORIE_DEPENSE' => $this->input->post('ID_CATEGORIE_DEPENSE_UP'),
                    'MONTANT_DEPENSE' => null,
                    'MONTANT_APPROVIONNEMENT' => $this->input->post('MONTANT_DEPENSE_UP'),
                    'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE_UP'),
                ];
            } else {
                $save_data = [
                    'NOM_DEPENSE' => $title,
                    'TYPE_ACTIVITE_CAISSE' => $this->input->post('TYPE_ACTIVITE_UP'),
                    'MONTANT_DEPENSE' => $this->input->post('MONTANT_DEPENSE_UP'),
                    'MONTANT_APPROVIONNEMENT' => null,
                    'ID_CATEGORIE_DEPENSE' => $this->input->post('ID_CATEGORIE_DEPENSE_UP'),
                    'DESCRIPTION_DEPENSE' => $this->input->post('DESCRIPTION_DEPENSE_UP'),
                ];
            }

            // var_dump($save_data);exit;

            $save_pos_depenses = $this->model_pos_depenses->change($id, $save_data);

            if ($save_pos_depenses) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $id;
                    $this->data['message'] = cclang('success_update_data_stay', [
                        anchor('administrator/pos_depenses/index', ' Go back to list')
                    ]);
                } else {
                    set_message(
                        cclang('success_update_data_redirect', []),
                        'success'
                    );

                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('administrator/pos_depenses/index');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('administrator/pos_depenses/index');
                }
            }
        } else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

        echo json_encode($this->data);
    }

    /**
     * delete Pos Depensess
     *
     * @var $id String
     */
    public function delete($id = null)
    {

        $this->is_allowed('pos_depenses_delete');

        $this->load->helper('file');

        $arr_id = $this->input->get('id');
        $commentValue = $this->input->get('inputValue');
        $remove = false;

        $delete_save = array('DATE_DELETE_DEPENSE' => date("Y-m-d h:i:s"), 'DELETE_STATUS_DEPENSE' => 1, "DELETE_COMMENT_DEPENSE" => $commentValue, "DELETE_BY_DEPENSE" => get_user_data('id'));
        if (!empty($id)) {
            $remove = $this->db->update("pos_depenses", $delete_save, array("ID_DEPENSE" => $id));
        } elseif (count($arr_id) > 0) {
            foreach ($arr_id as $id) {
                $remove = $this->_remove($id, $commentValue);
            }
        }

        if ($remove) {
            set_message(cclang('has_been_deleted', 'pos_depenses'), 'success');
        } else {
            set_message(cclang('error_delete', 'pos_depenses'), 'error');
        }

        redirect_back();
    }

    /**
     * View view Pos Depensess
     *
     * @var $id String
     */
    public function view($id = 0)
    {
        $this->is_allowed('pos_depenses_view');

        $ider = $this->uri->segment(3);
        $this->data['pos_depenses'] = $this->model_pos_depenses->join_avaiable()->filter_avaiable()->find($ider);
        // var_dump($this->data['pos_depenses']); exit;
        $this->template->title('Pos Depenses Detail');
        $this->render('backend/standart/administrator/pos_depenses/pos_depenses_view', $this->data);
    }




   
    /**
     * delete Pos Depensess
     *
     * @var $id String
     */
    private function _remove($id, $commentValue)
    {
        $pos_depenses = $this->model_pos_depenses->find($id);

        $delete_save = array(
            'DELETED_STATUS_' => 1,
            'DELETED_DATE_' => date('Y-m-d H:i:s'),
            'DELETED_USER_' => get_user_data('id'),
            'DELETED_COMMENT_' => $commentValue
        );


        $this->is_allowed('dette_envers_tiers');
        $filter = $this->input->get('q');
        $field     = $this->input->get('f');


        $date_start = $this->input->get('date_start');
        $date_end = $this->input->get('date_end');
    }



    public function get_depenses()
    {
        $ider = $this->input->post('id');
        $get_depenses = $this->db->query('SELECT * FROM pos_depenses WHERE ID_DEPENSE =' . $ider . ' ')->row_array();

        // var_dump($get_depenses);exit();

        echo json_encode($get_depenses);
    }


    /**
     * Export to excel
     *
     * @return Files Excel .xls
     */
    public function export()
    {
        $this->is_allowed('pos_depenses_export');

        $this->model_pos_depenses->export('pos_depenses', 'pos_depenses');
    }

    /**
     * Export to PDF
     *
     * @return Files PDF .pdf
     */
    public function export_pdf()
    {

        $this->is_allowed('pos_depenses_export');
        $this->model_pos_depenses->impression_depense_pdf('pos_depenses', 'pos_depenses');
    }
}



/* End of file pos_depenses.php */
/* Location: ./application/controllers/administrator/Pos Depenses.php */