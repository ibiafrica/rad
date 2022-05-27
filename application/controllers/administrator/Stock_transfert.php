<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stock_transfert extends Admin
{
     public function __construct()
      {
        parent::__construct();
        $this->load->model('model_pos_ibi_stores');
        $this->load->model('model_hospital_ibi_stock_transfert');
      }
    public function index($store = 0, $offset= 0)
    {
      $this->is_allowed('stock_transfert_list');
      if($store == 0){

            set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
            redirect('administrator/stores');
               
          }

     $filter = $this->input->get('q');
     $field  = $this->input->get('f');
     
      $this->data['stock_transfert']= $this->model_hospital_ibi_stock_transfert->get($filter,$field, $this->limit_page, $offset);
      $this->data['stock_transfert_counts'] =$this->model_hospital_ibi_stock_transfert->count_all($filter, $field);
      $config =[
        'base_url'   => 'administrator/stock_transfert/index/'.$store.'/',
        'total_rows'   => $this->model_hospital_ibi_stock_transfert->count_all($filter, $field),
        'per_page'     => $this->limit_page,
        'uri_segment'  => 5,
      ];

      $this->data['pagination'] = $this->pagination($config);
      $this->template->title('Historique de transfert');
      $this->render('backend/standart/administrator/hospital_ibi_stock_transfert/hospital_ibi_stock_transfert_list', $this->data);
    }
    public function add($store = 0)
    {
      $this->is_allowed('stock_transfert_add');
      if($store == 0){

          set_message('Veuillez selectionner un store pour avoir accès aux données', 'error');
          redirect('administrator/stores');
             
        }    

      $this->template->title('Nouveau transfert');
      $this->data['getProduit']=$this->model_pos_ibi_stores->getList('pos_store_'.$store.'_ibi_articles', array('DELETE_STATUS_ARTICLE'=>0));

      $this->render('backend/standart/administrator/hospital_ibi_stock_transfert/hospital_ibi_stock_transfert_add', $this->data);
  }
}