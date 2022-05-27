<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_depense extends MY_Model {

	private $primary_key 	= 'ID_DEPENSE';
	private $table_name 	= 'pos_ibi_depense';
	private $field_search 	= ['COMPTE_DEPENSE', 'NUMERO_DEPENSE', 'DESCRIPTION_DEPENSE', 'FOURNITURE_DEPENSE', 'MONTANT_DEPENSE', 'DATE_CREATION_DEPENSE', 'DATE_MOD_DEPENSE', 'AUTHOR_DEPENSE'];

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
	                $where .= "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->group_by('NUMERO_DEPENSE');
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
	                $where .= "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_ibi_depense.".$field . " LIKE '%" . $q . "%' )";
        }
        $select_field = ['*,SUM(pos_ibi_depense.MONTANT_DEPENSE) AS sumAmount'];
        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('CAST(NUMERO_DEPENSE as UNSIGNED)', "DESC");
        $this->db->group_by('NUMERO_DEPENSE');
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR_DEPENSE', get_user_data('id'));
        
        return $this;
    }
    function shuffle_code_depense(){

        $randomString = '';
        $dateyear=date('Y');
            
        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,4,0) as Maxcounts from (SELECT MAX(NUMERO_DEPENSE) as Maxcount from pos_ibi_depense d1 WHERE YEAR(d1.DATE_CREATION_DEPENSE)='".$dateyear."')t");
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="0001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $randomString = $Countmax;

        return $randomString;


    }

    public function getListFilter($store, $criteres, $criteres1){

    	$where = 'DATE_CREATION_DEPENSE >="'.$criteres.'" AND DATE_CREATION_DEPENSE <="'.$criteres1.'"';
    	$this->db->select('dp.*,fourn.NOM_FOURNITURE');
        $this->db->from('pos_ibi_depense dp');
        $this->db->join('pos_ibi_fourniture fourn','fourn.ID_FOURNITURE = dp.FOURNITURE_DEPENSE');
        $this->db->where($where);

        $query = $this->db->get();

	    if($query){
	      return $query->result();
	    }
    }
    public function getListFilter_count($store, $criteres, $criteres1)
    {
    	$where = 'DATE_CREATION_DEPENSE >="'.$criteres.'" AND DATE_CREATION_DEPENSE <="'.$criteres1.'"';
    	$this->db->select('dp.*,fourn.NOM_FOURNITURE');
        $this->db->from('pos_ibi_depense dp');
        $this->db->join('pos_ibi_fourniture fourn','fourn.ID_FOURNITURE = dp.FOURNITURE_DEPENSE');
        $this->db->where($where);

        $query = $this->db->get();

	    if($query){
	      return $query->num_rows();
	    }
    }

}

/* End of file Model_depense.php */
/* Location: ./application/models/Model_depense.php */