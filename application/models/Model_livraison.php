<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_livraison extends MY_Model {

	private $primary_key 	= 'ID_LIV';
	private $table_name 	= 'livraison';
	private $field_search 	= ['CODE_LIV', 'CLIENT_LIV', 'DATE_CREATION_LIV', 'DATE_MOD_LIV', 'AUTHOR', 'STATUS_LIV', 'STATUS_DELETE_LIV'];

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
	                $where .= "livraison.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "livraison.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "livraison.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUS_DELETE_LIV', 0);
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
	                $where .= "livraison.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "livraison.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "livraison.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('STATUS_DELETE_LIV', 0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('livraison.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function random_code()
    {
		$randomString = '';
		$dateyear = date('Y');
		$suffix = 'LV';

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_LIV,'".$suffix."','') AS UNSIGNED)) as Maxcount from livraison  d WHERE YEAR(d.DATE_CREATION_LIV)='".$dateyear."')t");
		
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

    public function join_avaiable() {
        $this->db->join('clients', 'clients.ID_CLIENT='.$this->table_name.'.CLIENT_LIV', 'LEFT');
        $this->db->join('aauth_users', 'aauth_users.id='.$this->table_name.'.AUTHOR', 'LEFT');
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }

}

/* End of file Model_livraison.php */
/* Location: ./application/models/Model_livraison.php */