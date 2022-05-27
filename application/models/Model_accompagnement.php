<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_accompagnement extends MY_Model {

    private $primary_key    = 'ID_ACCOMPAGNEMENT';
    private $table_name     = 'pos_accompagnement';
    private $field_search   = ['DESIGNATION_ACCOMPAGNEMENT', 'DATE_CREATED ', '  CREATE_BY_ACCOMPAGNEMENT'];

    public function __construct()
    {
        $config = array(
            'primary_key'   => $this->primary_key,
            'table_name'    => $this->table_name,
            'field_search'  => $this->field_search,
         );

        parent::__construct($config);
    }







    public function count_all($store,$q = null, $field = null)
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "pos_accompagnement.".$field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "pos_accompagnement.".$field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '('.$where.')';
        } else {
            $where .= "(" . "pos_accompagnement.".$field . " LIKE '%" . $q . "%' )";
        }

        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('ACCOMPAGNEMENT_STATUS',0);
               $this->db->where('ID_STORE',$store);

        $query = $this->db->get($this->table_name);

        return $query->num_rows();
    }

    public function get($store,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
    {
        $iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
        $field = $this->scurity($field);

        if (empty($field)) {
            foreach ($this->field_search as $field) {
                if ($iterasi == 1) {
                    $where .= "pos_accompagnement.".$field . " LIKE '%" . $q . "%' ";
                } else {
                    $where .= "OR " . "pos_accompagnement.".$field . " LIKE '%" . $q . "%' ";
                }
                $iterasi++;
            }

            $where = '('.$where.')';
        } else {
            $where .= "(" . "pos_accompagnement.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
            $this->db->select($select_field);
        }
        
        $this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('ACCOMPAGNEMENT_STATUS',0);
       $this->db->where('ID_STORE',$store);

        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_accompagnement.'.$this->primary_key, "DESC");
        $query = $this->db->get($this->table_name);

        return $query->result();
    }

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        $this->db->where('CREATE_BY_ACCOMPAGNEMENT', get_user_data('id'));
        
        return $this;
    }

}

/* End of file pos_accompagnement.php */
/* Location: ./application/models/pos_accompagnement.php */