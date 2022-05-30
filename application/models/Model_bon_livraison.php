<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bon_livraison extends MY_Model {

	private $primary_key 	= 'ID_BL';
	private $table_name 	= 'bon_livraison';
	private $field_search 	= ['CODE_BL', 'REF_CLIENT_BL', 'STATUS_BL', 'STATUS_DELETE_BL', 'CREATE_BY_BL', 'DATE_CREATION_BL', 'DATE_MODIFICATION_BL'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($q = null, $field = null)
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "bon_livraison.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "bon_livraison.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "bon_livraison.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "bon_livraison.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "bon_livraison.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "bon_livraison.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUS_DELETE_BL', 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('bon_livraison.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
		$this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name.'.CREATE_BY_BL', 'LEFT');
		$this->db->join('clients', 'clients.ID_CLIENT  = '.$this->table_name.'.REF_CLIENT_BL', 'LEFT');
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

	public function random_code()
    {
		$randomString = '';
		$dateyear = date('Y');
		$suffix = 'BL';

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_BL,'".$suffix."','') AS UNSIGNED)) as Maxcount from bon_livraison  d WHERE YEAR(d.DATE_CREATION_BL)='".$dateyear."')t");
		
			foreach ($lastid->result_array() as $key => $value) {
			
				if($value['Maxcounts']==NULL){
					$Countmax="00001";
				}else{
					$Countmax=$value['Maxcounts'];
				}
			}

		$randomString = $suffix.''.$Countmax;

        return $randomString;

    }

}

/* End of file Model_bon_livraison.php */
/* Location: ./application/models/Model_bon_livraison.php */