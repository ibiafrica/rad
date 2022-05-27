<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_bon_sortie extends MY_Model {

	private $primary_key 	= 'ID';
	//private $table_name 	= 'pos_store_3_ibi_devis_bon';
	private $field_search 	= ['NUMERO_BON', 'REF_FICHE_CODE', 'DESCRIPTION', 'TYPE', 'DEMANDEUR', 'DATE_CREATION', 'DATE_MOD', 'AUTHOR', 'TOTAL'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name(),
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

    public function table_name()
    {
		$store_prefix = $this->uri->segment(4);
		$table_name     = 'pos_store_'.$store_prefix.'_ibi_devis_bon';
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
       // $this->db->order_by('pos_store_3_ibi_devis_bon.'.$this->primary_key, "DESC");

		$this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('aauth_users', 'aauth_users.id = '.$this->table_name().'.DEMANDEUR', 'LEFT');
        //$this->db->join('pos_store_3_ibi_devis_bon', 'pos_store_3_ibi_devis_bon.AUTHOR = aauth_users.id', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        //$this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }

	public function shuffle_code_for_sortie($store)
	{     
		$prefix='BS';

		$lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_BON,'".$prefix."','') AS UNSIGNED)) as Maxcount from  pos_store_".$store."_ibi_devis_bon)t");
		
		
		 foreach ($lastid->result_array() as $key => $value) {
			
			if($value['Maxcounts']==NULL){
				$Countmax="000001";
			}else{
				$Countmax=$value['Maxcounts'];
			}
		 }
		$randomString = $prefix.$Countmax;

	    return $randomString;

	}
	public function getListFilter($store, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "db.REF_FICHE_CODE LIKE '%" . $criteres . "%' AND db.STATUT_BON=0";
      $where1 = "dbp.REF_PRODUCT_CODEBAR LIKE '%" . $criteres1 . "%' ";
      $this->db->select('dbp.*,db.NUMERO_BON,db.REF_FICHE_CODE,db.DEMANDEUR,db.DATE_CREATION');
      $this->db->from('pos_store_'.$store.'_ibi_devis_bon_produit dbp');
      $this->db->join('pos_store_'.$store.'_ibi_devis_bon db','db.ID = dbp.REF_NUM_BON');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "db.REF_FICHE_CODE LIKE '%" . $criteres . "%' AND db.STATUT_BON=0";
      $where1 = "dbp.REF_PRODUCT_CODEBAR LIKE '%" . $criteres1 . "%' ";
      $this->db->select('dbp.*,db.NUMERO_BON,db.REF_FICHE_CODE,db.DEMANDEUR,db.DATE_CREATION');
      $this->db->from('pos_store_'.$store.'_ibi_devis_bon_produit dbp');
      $this->db->join('pos_store_'.$store.'_ibi_devis_bon db','db.ID = dbp.REF_NUM_BON');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }
}

/* End of file Model_pos_store_3_ibi_devis_bon.php */
/* Location: ./application/models/Model_pos_store_3_ibi_devis_bon.php */