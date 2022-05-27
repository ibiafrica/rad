<?php
defined('BASEPATH') OR exit('No direct script access allowed');



class Model_list extends MY_Model {




     function insert($table,$data)
    {
        $query= $this->db->insert($table,$data);
        return($query)? true:false;
    }

    public function delete($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->delete($table);
        if($query){
        return TRUE;
       }
    }


 function insert_last_id($table, $data) {
                 $this->db->set($data);
        $query = $this->db->insert($table);
       
       if ($query) {
            return $this->db->insert_id();
        }

    }

      public function getListes($table,$critere = array()){
        $this->db->where($critere);
        $this->db->group_by('TYPE_EXPRESS_ID');
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function getListese($table,$critere = array()){
        $this->db->where($critere);
        $this->db->group_by('ID_KILOGRAME');
        $query = $this->db->get($table);
        return $query->result_array();

    }

     public function getLists($table,$critere = array()){
        $this->db->where($critere);
        // $this->db->group_by('ID_KILOGRAME');
        // $this->db->order_by('ID_KILOGRAME DESC');
        $query = $this->db->get($table);
        return $query->result_array();

    }

    public function getOne($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->row_array();
    }

    public function getList($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->result_array();
    }

    public function countrows($table,$critere = array()){
        $this->db->where($critere);
        $query = $this->db->get($table);
        return $query->num_rows();
    }

    public function update($table,$critere = array(),$data = array()){
        $this->db->where($critere);
        $query = $this->db->update($table,$data);
        if($query){
        return TRUE;
       }
    }

    function getRequete($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->result_array();
      }
    }

    function getRequeteOne($requete){
      $query=$this->db->query($requete);
      if ($query) {
         return $query->row_array();
      }
    }

    function getListLimit($table,$limit,$cond=array())
    {
     $this->db->limit($limit);
     $this->db->where($cond);
     $query= $this->db->get($table);
     
      if($query)
       {
           return $query->result_array();
       }   
    }



}