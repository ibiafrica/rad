<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_livraison extends MY_Model {

	private $primary_key 	= 'ID_LIVRAISON';
	// private $table_name 	= 'pos_store_2_ibi_livraison';
	private $field_search 	= ['NUMERO_LIVRAISON', 'REF_CODE_REQ_LIVRAISON', 'TYPE_LIVRAISON', 'DEMANDEUR_LIVRAISON', 'DATE_CREATION_LIVRAISON', 'DATE_MOD_LIVRAISON', 'AUTHOR_LIVRAISON', 'TOTAL_QUANTITE_LIVRAISON'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_livraison';
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
        // $this->db->where('AUTHOR_LIVRAISON', get_user_data('id'));
        
        return $this;
    }
    public function shuffle_code($store){
            
            $randomString = '';
            $datemonth=date('m');
            $dateyear=date('Y');
            $maxdate='/'.date('m').'/'.date('Y');

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_LIVRAISON,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_livraison l1 WHERE YEAR(l1.DATE_CREATION_LIVRAISON)='".$dateyear."' AND MONTH(l1.DATE_CREATION_LIVRAISON)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_LIVRAISON,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_livraison l2 WHERE YEAR(l2.DATE_CREATION_LIVRAISON)='".$dateyear."' AND MONTH(l2.DATE_CREATION_LIVRAISON)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_LIVRAISON,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_livraison l3 WHERE YEAR(l3.DATE_CREATION_LIVRAISON)='".$dateyear."' AND MONTH(l3.DATE_CREATION_LIVRAISON)='".$datemonth."')t");
            
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="00001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $date=date('Y-m-d');
            $annee=date("Y", strtotime($date));
            $mois=date("m", strtotime($date));


            $randomString = $Countmax.'/'.$mois.'/'.$annee;


        return $randomString;

    }
    public function getListFilter($store, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "lvr.REF_CODE_REQ_LIVRAISON LIKE '%" . $criteres . "%' ";
      $where1 = "lvrp.REF_PRODUCT_CODEBAR_LIVR_PRODUIT LIKE '%" . $criteres1 . "%' ";
      $this->db->select('lvrp.*,lvr.NUMERO_LIVRAISON,lvr.REF_CODE_REQ_LIVRAISON,lvr.AUTHOR_LIVRAISON,lvr.DATE_CREATION_LIVRAISON');
      $this->db->from('pos_store_'.$store.'_ibi_livraison_produit lvrp');
      $this->db->join('pos_store_'.$store.'_ibi_livraison lvr','lvr.NUMERO_LIVRAISON = lvrp.REF_NUM_LIVR_PRODUIT');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store, $criteres = NULL, $criteres1 = NULL)
    {
      $where = "lvr.REF_CODE_REQ_LIVRAISON LIKE '%" . $criteres . "%' ";
      $where1 = "lvrp.REF_PRODUCT_CODEBAR_LIVR_PRODUIT LIKE '%" . $criteres1 . "%' ";
      $this->db->select('lvrp.*,lvr.NUMERO_LIVRAISON,lvr.REF_CODE_REQ_LIVRAISON,lvr.AUTHOR_LIVRAISON,lvr.DATE_CREATION_LIVRAISON');
      $this->db->from('pos_store_'.$store.'_ibi_livraison_produit lvrp');
      $this->db->join('pos_store_'.$store.'_ibi_livraison lvr','lvr.NUMERO_LIVRAISON = lvrp.REF_NUM_LIVR_PRODUIT');
      $this->db->where($where);
      $this->db->where($where1);
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }

}

/* End of file Model_livraison.php */
/* Location: ./application/models/Model_livraison.php */