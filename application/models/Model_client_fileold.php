<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_client_file extends MY_Model {

	private $primary_key 	= 'ID_CLIENT_FILE';
	// private $table_name 	= 'pos_store_2_ibi_client_file';
	private $field_search 	= ['PROFORMA_ID_CLIENT_FILE', 'REF_CLIENT_FILE', 'REF_PROFORMA_CODE_CLIENT_FILE', 'NUMBER_PURCHASE_CLIENT_FILE', 'FILE_PURCHASE_CLIENT_FILE', 'COMMISSIONING_CLIENT_FILE', 'CONTRAT_GARANTIE_CLIENT_FILE', 'CONTRAT_MAINTENANCE_CLIENT_FILE', 'INVOICE_NUMBER_CLIENT_FILE', 'DATE_CREATION_CLIENT_FILE', 'DATE_MODIFICATION_CLIENT_FILE', 'OPERATING_STATUT', 'APPROUVE_BY', 'CLOSURE_DATE_CLIENT_FILE', 'CLOSURE_BY_CLIENT_FILE', 'AUTHOR'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name(),
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}
	public function table_name(){
       $store_prefix = $this->uri->segment(4);
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_client_file';
       return $table_name;
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
	                $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
		$query = $this->db->get($this->table_name());

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
	                $where .= "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "".$this->table_name().".".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        
        return $this;
    }
    function shuffle_code_file(){
    	    $randomString = '';
            $dateyear=date('Y');
            $lastid = $this->db->query("SELECT LPAD(MAX(INVOICE_NUMBER_CLIENT_FILE)+1,7,0) as Maxcounts FROM ".$this->table_name()."  WHERE YEAR(DATE_CREATION_CLIENT_FILE)='".$dateyear."'");
   
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="0000001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }
            $date=date('Y-m-d');
            $annee=date("Y", strtotime($date));
            $randomString = $Countmax.'/'.$annee;
        return $randomString;
    }

}

/* End of file Model_client_file.php */
/* Location: ./application/models/Model_client_file.php */