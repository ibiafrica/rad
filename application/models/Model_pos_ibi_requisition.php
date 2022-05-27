<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_pos_ibi_requisition extends MY_Model
{
    private $primary_key     = 'ID_REQ';
    private $table_name     = 'pos_ibi_requisition';
    private $field_search     = ['TITLE_REQ', 'CODE_REQ','DESCRIPTION_REQ','DATE_CREATION_REQ'];


    public function __construct()
    {
        $config = array(
            'primary_key'     => $this->primary_key,
            'table_name'     => $this->table_name,
            'field_search'     => $this->field_search,
        );

        parent::__construct($config);
    }


    public function table_name()
    {
        $store_prefix= $this->uri->segment(2);
        $table_name='pos_ibi_requisition';
        return $table_name;
    }


    public function count_all($status=null,$critere =null,$critere1 =null, $q = null, $field = null)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "pos_ibi_requisition." . $field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "pos_ibi_requisition." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "pos_ibi_requisition." . $field . " LIKE '%" . $q . "%' )";
        }

         if(is_null($status)){
            $this->join_avaiable()->filter_avaiable();
            $this->db->where('DELETE_STATUS_REQ', 0);

            $this->db->where('FROM_STORE', $this->uri->segment(2));
            $this->db->where($where);
         }


       else if(!empty($critere)){
            $this->join_avaiable()->filter_avaiable();
            $this->db->where($where);
            $this->db->where('DELETE_STATUS_REQ', 0);
            $this->db->where('STATUS_REQ',$status);

            $this->db->where('DATE_CREATION_REQ >=',$critere);
            $this->db->where('DATE_CREATION_REQ <=',$critere1);

        }

         else{
            $this->join_avaiable()->filter_avaiable();
            $this->db->where('DELETE_STATUS_REQ', 0);
            $this->db->where('STATUS_REQ', $status);
            $this->db->where('FROM_STORE', $this->uri->segment(2));
            $this->db->where($where);
         }

        $query = $this->db->get($this->table_name);

        return $query->num_rows();
    }

    function get($status = null,$critere=null, $critere1=null, $q = null, $field = null, $limit = 0, $offset = 0, $select_field =[])
               // ($status_on,$date_start,$date_end,$filter, $field, $this->limit_page, $offset);
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = null;
        $q = $this->scurity($q);
        $field = $this->scurity($field);
        // $limiter = 100;


        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' OR CONCAT(pos_ibi_requisition.TITLE_REQ) LIKE '%" . $q . "%'";
                } else {
                    $where .= "OR " . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '(' . $where . ')';
        } else {
            $where .= "(" . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) and count($select_field)) {
            $this->db->select($select_field);
        }

        if(is_null($status)){
            $this->join_avaiable()->filter_avaiable();
            $this->db->where($where);
            $this->db->where('DELETE_STATUS_REQ', 0);
            $this->db->where('FROM_STORE', $this->uri->segment(2));
        }

        else if(!empty($critere)){
        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_REQ', 0);
        $this->db->where('STATUS_REQ',$status);
             $this->db->where('FROM_STORE', $this->uri->segment(2));

        $this->db->where('DATE_CREATION_REQ >=',$critere);
        $this->db->where('DATE_CREATION_REQ <=',$critere1);

        }
        else{

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_REQ', 0);
        $this->db->where('STATUS_REQ',$status);
            $this->db->where('FROM_STORE', $this->uri->segment(2));

        // $this->db->where('DATE_CREATION_REQ >=',$critere);
        // $this->db->where('DATE_CREATION_REQ <=',$critere1);
        }


        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.' . $this->primary_key, "DESC");
        $query = $this->db->get($this->table_name());

        return $query->result();
    }

    public function join_avaiable()
    {
        return $this;
    }

    public function filter_avaiable()
    {
  

        return $this;
    }


    
   public function register($table_requis,$data){
        $query=$this->db->insert($table_requis,$data);
        $insertId = $this->db->insert_id();
        if ($query) {
        return $insertId;
        }else{
            return false;
        }
    }





    
     
    function modify_Quantity($table,$condition,$dataQuantity){


        $this->db->where($condition);
        $query=$this->db->update($table, $dataQuantity);
        if ($query) {
        return true;
        }else{
            return false;
        }
}


     
    function incomming_bs($table,$condition,$dataIncomming){


        $this->db->where($condition);
        $query=$this->db->update($table, $dataIncomming);
        if ($query) {
        return true;
        }else{
            return false;
        }
}




function sous_requete($table,$condition,$dataIncomming){


    $this->db->where($condition);
    $query=$this->db->update($table, $dataIncomming);
    if ($query) {
    return true;
    }else{
        return false;
    }
}



public function let($table,$critere){
    $this->db->where($critere);
    $request = $this->db->get($table);
    return $request->result_array();
} 


function getter($table, $condition) {
    $this->db->where($condition);
    $query = $this->db->get($table);
    return $query->num_rows();

}


public function getOneOff($critere){
    $req = $this->db->select("*")
                 ->from('pos_ibi_article_requisition')
                 ->join('pos_ibi_requisition','pos_ibi_requisition.ID_REQ = pos_ibi_article_requisition.ID_REQ','left')
                 ->where($critere)
                 ->get();
          return $req->row_array();

}





public function RequisitionFront($table,$where){
    $this->db->where($where);
    $request =$this->db->get($where);
    return $query->num_rows;
                        
}





}


/* End of file Model_hospital_ibi_requisition.php */
/* Location: ./application/models/Model_hospital_ibi_requisition.php */
