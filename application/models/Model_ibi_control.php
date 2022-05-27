<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Model_ibi_control extends MY_Model {

    private $primary_key    = 'ID_CONTROL';
    private $table_name     = 'pos_control_stockHide';
    private $field_search   = array('DESIGNATION_CONTROL', 'QTE_OPENING_CONTROL','TRANSFERT_CONTROL');

    public function __construct()
    {
        $config = array(
            'primary_key'   => $this->primary_key,
            'table_name'    => $this->table_name,
            'field_search'  => $this->field_search,
         );

        parent::__construct($config);
    }




   public function updt($table, $criteres=array(), $data=array()) {
        $this->db->where($criteres);
        $query = $this->db->update($table, $data);
        return ($query) ? true : false;
    }


    public function Insr($table,$data){
        $query=$this->db->insert($table,$data);
        $lastId = $this->db->insert_id();
        return ($lastId) ? true : false;
    }



    public function queryControl($table, $critere = array())
    {
        $this->db->where($critere);
        $this->db->order_by('ID_CONT DESC');
        $query = $this->db->get($table);
        return $query->result();
    }


     public function print_control()
    {
        $store = $this->uri->segment(2);
        $this->db->where($critere);
        $this->db->order_by('ID_CONT DESC');
        $query = $this->db->get($table);
        return $query->result();
    }



}