<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *| --------------------------------------------------------------------------
 *| Resto Store Ccontrol_stock_bs Controller
 *| --------------------------------------------------------------------------
 *| Resto Store Ccontrol_stock_bs site
 *|
 */
class Control_stock extends Admin
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_ibi_control');
    }

    /**
     * show all Hospital stock_control
     *
     * @var $offset String
     */
    public function index($offset = 0)
    {
      $btk=$this->uri->segment(2);
      $date_start=$this->input->get('date_start');
      $date_end=$this->input->get('date_end');

       $ElemtWhere="";
       if(is_null($date_start)){
         $ElemtWhere= "STATUT_CONT=0 AND ID_STORES=".$btk." ";
       }else{
         $ElemtWhere= "STATUT_CONT=0 AND ID_STORES=".$btk." AND DATE_CREER_CONT BETWEEN '".$date_start."' AND '".$date_end."' ";
       }

       $this->data['controlers'] = $this->model_ibi_control->queryControl('control_ibi',$ElemtWhere);
        

        $this->data['date_start']=$date_start;
        $this->data['date_end'] = $date_end;


        $this->template->title('Listes de controle stock');
        $this->render('backend/standart/administrator/control_stock/controlStock_list', $this->data);   

    }


    public function print_controle($offset = 0)
    {
      $store=$this->uri->segment(2);
      
     

       $this->data['print_controllers'] = $this->db->query('SELECT * FROM pos_store_' . $store . '_ibi_articles WHERE DELETE_STATUS_ARTICLE=0 AND NATURE_ARTICLE NOT IN(1,2)')->result();
        
        $this->template->title('Listes de controle stock');
        $this->render('backend/standart/administrator/control_stock/controlStock_print', $this->data);   

    }


    public function add(){

        $btk=$this->uri->segment(2);
        $opening_start=$this->input->get('opening_start');
        $opening_close=$this->input->get('opening_close');

        if (empty($opening_start) && empty($opening_close)) {
           
         $opening_start = date("Y-m-d H:i:s");
         
         $opening_close = date("Y-m-d H:i:s");  
        }
        $condition_opening = "flow.DATE_CREATION_SF BETWEEN '".$opening_start."' AND '".$opening_close."' AND art.NATURE_ARTICLE NOT IN(1,2)";

        $getArticle_interval = $this->db->query("SELECT DISTINCT(art.CODEBAR_ARTICLE) as CODE ,art.ID_ARTICLE as ID ,art.DESIGN_ARTICLE as ART ,
        art.QUANTITY_ARTICLE as QTE, art.PRIX_DACHAT_ARTICLE as P_A,
         art.PRIX_DE_VENTE_ARTICLE as P_V FROM pos_store_".$btk."_ibi_articles art WHERE  DELETE_STATUS_ARTICLE=0 AND NATURE_ARTICLE NOT IN(1,2) ")->result();
        

        $dataArrays = [];
        $controlArray = [];
        $control_array_with_prev_control_data = [];

        $max_id_control=0;
         $controls = $this->db->query('SELECT MAX(ID_CONT) as MAX_ID FROM control_ibi WHERE STATUT_CONT=0')->row();

            $previous_controlstock_modifier = [];

            $max_id_control=$controls->MAX_ID;


            if ($max_id_control) {

                $previous_controlstock = $this->db->query('SELECT CODEBAR_CONTROL,RESTE_MANUEL_CONTROL FROM pos_control_stock_det WHERE ID_CONT='.$controls->MAX_ID.'')->result();
                foreach ($previous_controlstock as $value) {

                     $previous_controlstock_modifier[$value->CODEBAR_CONTROL] = $value;
                }
                
                
            }
            else{
                $max_id_control=0;
            }

            echo $this->data['response']=$max_id_control;

            //print_r($this->data['response']);exit;
            
        foreach ($getArticle_interval as $items) {
            
         

        // exit;
           
            $stockIssue = empty($stockIssue) ? 0 : $stockIssue;

            $stockIssue = ($this->db->query('SELECT SUM(QUANTITE_SF) AS QTE_SF_ISSUE FROM pos_store_'.$btk.'_ibi_articles_stock_flow WHERE REF_ARTICLE_BARCODE_SF ="'.$items->CODE.'" AND (TYPE_SF ="transfert_in") AND DATE_CREATION_SF BETWEEN "'.$this->input->get('opening_start').'" and "'.$this->input->get('opening_close').'"')->row_array()['QTE_SF_ISSUE']);
           
            $stockIssue = empty($stockIssue) ? 0 : $stockIssue;


           $qteSale = $this->db->query('SELECT SUM(QUANTITE_SF) AS QTE_SF_VENTE FROM pos_store_'.$btk.'_ibi_articles_stock_flow  WHERE REF_ARTICLE_BARCODE_SF ="'.$items->CODE.'" AND (TYPE_SF = "sale" || TYPE_SF= "sale_ingredient") AND DATE_CREATION_SF BETWEEN "'.$this->input->get('opening_start').'" and "'.$this->input->get('opening_close').'"')->row_array()['QTE_SF_VENTE'];

           
           $qteSaleRetour = $this->db->query('SELECT SUM(QUANTITE_SF) AS QTE_SF_VENTE FROM pos_store_'.$btk.'_ibi_articles_stock_flow  WHERE REF_ARTICLE_BARCODE_SF ="'.$items->CODE.'" AND (TYPE_SF= "sale_stock_in") AND DATE_CREATION_SF BETWEEN "'.$this->input->get('opening_start').'" and "'.$this->input->get('opening_close').'"')->row_array()['QTE_SF_VENTE'];
          
           $qteSale = $qteSale - $qteSaleRetour;

           $items->PREV_OPENING = empty($previous_controlstock_modifier[$items->CODE]->RESTE_MANUEL_CONTROL) ? 0 : $previous_controlstock_modifier[$items->CODE]->RESTE_MANUEL_CONTROL;

             $controlArray=$items;

        array_push($dataArrays, array("details" => $controlArray,"stockIssue" => $stockIssue,'qteSale'=>$qteSale));
            
         }

        //  print_r($dataArrays);
        // exit();

         $this->data['last_control'] = sizeof($controls) > 0;

          /*echo "<pre>"; print_r($dataArrays);
          exit; */  
        $this->data['date_opening']=$opening_start;
        $this->data['date_close']=$opening_close;
        
        $this->data['flow_interval']=$dataArrays;
        $this->template->title('Ajout de control stock');
        $this->render('backend/standart/administrator/control_stock/controlStock_add', $this->data);
    }

    public function add_save($btk){

        $titre="Control stock";
        $description=$this->input->post('DESCRIPTION');
        $dateStart_opening = $this->input->post('opening_start');
        $dateClose_opening = $this->input->post('opening_close');

       // print_r($btk.'/'.$dateClose_opening);exit;
        
        $article=$this->input->post('ARTICLES');
        $codebar=$this->input->post('CODEBAR');
        $opening_start_qte=$this->input->post('OPENING');
        $issue_start_qte=$this->input->post('ISSUES_TRANS');
        $tot_opening_issue=$this->input->post('TOT_OPEN_ISSUE');
        $prix_d_achat=$this->input->post('PRIX_ACHAT');
        $prix_achat_total=$this->input->post('ACHAT_TOT');

        $qte_vente=$this->input->post('QTE_VENTE');
        $prix_vente_total=$this->input->post('TOT_VENTE');
        $reste_auto_vent=$this->input->post('RESTE_AUTO_VENTE');
        $reste_man_vent=$this->input->post('RESTE_MAN_VENTE');
        $value_stock_vent=$this->input->post('VALUE_STOCK');

       $this->form_validation->set_rules('OPENING[]', 'Opening strart qté', 'trim|required', array('required' => 'Veuillez entrer la Quantité opening'));
        $this->form_validation->set_rules('ISSUES_TRANS[]', 'Opening close qté', 'trim|required', array('required' => 'Veuillez entrer Quantité transf. retrouver'));

        $this->form_validation->set_rules('RESTE_MAN_VENTE[]', 'Reste manuel', 'trim|required', array('required' => 'Veuillez entrer le reste vue manuellement '));

                $year = date("Y");
                $last = $this->db->select("*")
                    ->from('control_ibi')
                    ->where('YEAR(DATE_CREER_CONT)', $year)
                    ->order_by('ID_CONT', 'DESC')
                    ->limit(1)
                    ->get()->result();
                $code_next = 1;
                $zeros = "CTRL_IB_0000";
                if (sizeof($last) > 0) {
                    $iter = strlen($last[0]->ID_CONT);
                    $code_next = $last[0]->ID_CONT + 1;
                    $zeros = "CTRL_IB_";
                    while ($iter < 5) {
                        $zeros = $zeros . "0";
                        $iter++;
                    }
                }
            $code_control = $zeros . $code_next . '/' . date('m/y');
            
        if ($this->form_validation->run()) {
             $controle_data = array(
                'CODE_CONT'=>$code_control,
                'TITRE_CONT'=>$titre,
                'ID_STORES'=>$btk,
                'CONT_CREER_PAR'=>get_user_data('id'),
                'OPENING_START_CONT'=>$dateStart_opening,
                'OPENING_CLOSE_CONT'=>$dateClose_opening,
                'DESCRIPTION_CONT'=>$description
             );


             $ins=$this->model_ibi_control->insr('control_ibi',$controle_data);
             $last_id = $this->db->insert_id();
         

             for ($i = 0; $i < count($_POST['ARTICLES']); $i++)
               {
                 $det_control_data = array(
                   'DESIGNATION_CONTROL'=>$article[$i],
                   'CODEBAR_CONTROL'=> $codebar[$i],
                   'CODE_CONT'=>$code_control,
                   'ID_CONT'=>$last_id,
                   'QTE_OPENING_CONTROL'=>$opening_start_qte[$i],
                   'QTE_TRANSFERT_CONTROL'=>$issue_start_qte[$i],
                   'OPEN_TRANS_TOTAL'=>$tot_opening_issue[$i],
                   'PRIX_ACHAT_CONTROL'=>$prix_d_achat[$i],
                   'TOTAL_PRIX_OPENING'=>$prix_achat_total[$i],
                   'OPENING_START_CONTROL'=>$dateStart_opening,
                   'SALES_CONTROL'=>$qte_vente[$i],
                   'TOTAL_SALES_CONTROL'=>$prix_vente_total[$i],
                   'RESTE_STOCK_AUTOMATIQUE_CONTROL'=>$reste_auto_vent[$i],
                   'RESTE_MANUEL_CONTROL'=>$reste_man_vent[$i],
                   'TOTAL_VENTE_VENTE_CONTROL'=>$value_stock_vent[$i],
                   'OPENING_CLOSE_CONTROL'=>$dateClose_opening
                 );

                 $control_stock_flow = array(

                   'REF_ARTICLE_BARCODE_SF' => $codebar[$i],
                   'QUANTITE_SF' => $reste_man_vent[$i],
                   'REF_COMMAND_CODE_SF' => $code_control,
                   'TYPE_SF'=> 'inventory',
                   'UNIT_PRICE_SF' => $qte_vente[$i],
                   'DATE_CREATION_SF' => date('Y-m-d H:i:s'),
                   'CREATED_BY_SF' => get_user_data('id')

                );

                 // echo "<pre>"; print_r($det_control_data);

                 $insr_detail_control = $this->model_ibi_control->insr('pos_control_stock_det',$det_control_data);

                 $update_quantity_btk = $this->db->update(
                    'pos_store_' . $btk . '_ibi_articles',
                     ['QUANTITY_ARTICLE' => $reste_man_vent[$i]],['CODEBAR_ARTICLE' => $codebar[$i]]
                );

                $insert_stock = $this->model_ibi_control->insr('pos_store_' . $btk . '_ibi_articles_stock_flow', $control_stock_flow);
               }
               // exit;


            if ($insr_detail_control) {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = true;
                    $this->data['id']        = $save_id;
                    $this->data['message'] = 'control stock soumis';
                } else {
                    set_message('control soumis', 'success');
                    $this->data['success'] = true;
                    $this->data['redirect'] = base_url('control_stock/' . $btk . '/index/');
                }
            } else {
                if ($this->input->post('save_type') == 'stay') {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                } else {
                    $this->data['success'] = false;
                    $this->data['message'] = cclang('data_not_change');
                    $this->data['redirect'] = base_url('control_stock/' . $btk . '/index/');
                }
            }


          } 
          else {
            $this->data['success'] = false;
            $this->data['message'] = validation_errors();
        }

                echo json_encode($this->data);
        }


        public function view(){

        

        $id_control = $this->uri->segment(4);
        $this->data['user']= $this->db->query("SELECT * FROM control_ibi  WHERE ID_CONT ='".$id_control."' ")->row_array();
        $this->data['ctrl_detail'] = $this->db->get_where('pos_control_stock_det',array('ID_CONT'=>$id_control))->result();

         $this->template->title('Detail control stock');
         $this->render('backend/standart/administrator/control_stock/controlStock_view', $this->data);

        }       



    


}