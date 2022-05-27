<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_requisition extends MY_Model {

	private $primary_key 	= 'ID_REQUISITION';
	// private $table_name 	= 'pos_store_2_ibi_requisition';
	private $field_search 	= ['NUMERO_REQUISITION', 'REF_COMMAND_REQUISITION', 'TYPE_REQUISITION', 'DATE_CREATION_REQUISITION', 'DATE_APPROV_REQUISITION', 'APPROUVED_BY_REQUISITION', 'SIGN_REQUISITION', 'AUTHOR_REQUISITION', 'STATUT_REQUISITION'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_requisition';
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
                    $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
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
                    $where .= "OR " . "pos_ibi_clients.NOM_CLIENT LIKE '%" . $q . "%' ";
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
        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = '.$this->table_name().'.REF_CLIENT_REQUISITION', 'LEFT');

        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('APPROUVED_BY_REQUISITION', get_user_data('id'));
        // $this->db->where('SIGN_BY_REQUISITION', get_user_data('id'));
        // $this->db->where('AUTHOR_REQUISITION', get_user_data('id'));
        
        return $this;
    }
    public function generate_code_req($store){
    	$randomString = '';
            $dateyear=date('Y');
            $suffix='REQ';

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_REQUISITION,'".$suffix."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_requisition r1 WHERE YEAR(r1.DATE_CREATION_REQUISITION)='".$dateyear."' UNION SELECT MAX(CAST(REPLACE(NUMERO_REQUISITION,'".$suffix."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_requisition r2 WHERE YEAR(r2.DATE_CREATION_REQUISITION)='".$dateyear."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_REQUISITION,'".$suffix."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_requisition r3 WHERE YEAR(r3.DATE_CREATION_REQUISITION)='".$dateyear."')t");

            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="000001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $randomString = $suffix.''.$Countmax.'-'.date('Y');

        return $randomString;
    }

    public function getListFilter($store,$criteres,$criteres1)
    {
      
    //   $query = $this->db->query('SELECT REQUISITION.NUMERO_REQUISITION,REQUISITION.REF_COMMAND_REQUISITION,REQUISITION.TYPE_REQUISITION,REQUISITION.DATE_CREATION_REQUISITION,REQUISITION.APPROUVED_BY_REQUISITION,NAME_COMMAND_PROD,PPROD.NAME_PROFORMA_PROD,CPROD.REF_PRODUCT_CODEBAR_COMMAND_PROD,PPROD.REF_PRODUCT_CODEBAR_PROFORMA_PROD,CPROD.INLINE_COMMAND_PROD,PPROD.INLINE_PROFORMA_PROD FROM (SELECT req.NUMERO_REQUISITION,req.REF_COMMAND_REQUISITION,req.TYPE_REQUISITION,req.DATE_CREATION_REQUISITION,req.APPROUVED_BY_REQUISITION FROM pos_store_'.$store.'_ibi_requisition req WHERE DATE_CREATION_REQUISITION >="'.$criteres.'" AND DATE_CREATION_REQUISITION <="'.$criteres1.'") REQUISITION

    //     LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_COMMAND_PROD,REF_COMMAND_CODE_PROD,NAME_COMMAND_PROD,INLINE_COMMAND_PROD FROM (SELECT CP.REF_PRODUCT_CODEBAR_COMMAND_PROD,CP.REF_COMMAND_CODE_PROD,CP.NAME_COMMAND_PROD,CP.INLINE_COMMAND_PROD FROM pos_store_'.$store.'_ibi_commandes_produits CP,pos_store_'.$store.'_ibi_requisition R WHERE CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION="ibi_order_attente" )t )CPROD ON REQUISITION.REF_COMMAND_REQUISITION=CPROD.REF_COMMAND_CODE_PROD
            
    //     LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_PROFORMA_PROD,REF_PROFORMA_CODE_PROD,NAME_PROFORMA_PROD,INLINE_PROFORMA_PROD FROM (SELECT PP.REF_PRODUCT_CODEBAR_PROFORMA_PROD,PP.REF_PROFORMA_CODE_PROD,PP.NAME_PROFORMA_PROD,PP.INLINE_PROFORMA_PROD FROM pos_store_'.$store.'_ibi_proforma_produits PP,pos_store_'.$store.'_ibi_requisition R WHERE PP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION="ibi_order_proforma" )t )PPROD ON REQUISITION.REF_COMMAND_REQUISITION=PPROD.REF_PROFORMA_CODE_PROD');

    $query = $this->db->query('SELECT req.NUMERO_REQUISITION,req.REF_COMMAND_REQUISITION,req.TYPE_REQUISITION,req.DATE_CREATION_REQUISITION,req.APPROUVED_BY_REQUISITION FROM pos_store_'.$store.'_ibi_requisition req WHERE DATE_CREATION_REQUISITION >= "'.$criteres.'" AND DATE_CREATION_REQUISITION <="'.$criteres1.'" ');
       
      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store,$criteres,$criteres1)
    {
      $query = $this->db->query('SELECT REQUISITION.NUMERO_REQUISITION,REQUISITION.REF_COMMAND_REQUISITION,REQUISITION.TYPE_REQUISITION,REQUISITION.DATE_CREATION_REQUISITION,REQUISITION.APPROUVED_BY_REQUISITION,NAME_COMMAND_PROD,PPROD.NAME_PROFORMA_PROD,CPROD.REF_PRODUCT_CODEBAR_COMMAND_PROD,PPROD.REF_PRODUCT_CODEBAR_PROFORMA_PROD,CPROD.INLINE_COMMAND_PROD,PPROD.INLINE_PROFORMA_PROD FROM (SELECT req.NUMERO_REQUISITION,req.REF_COMMAND_REQUISITION,req.TYPE_REQUISITION,req.DATE_CREATION_REQUISITION,req.APPROUVED_BY_REQUISITION FROM pos_store_'.$store.'_ibi_requisition req WHERE DATE_CREATION_REQUISITION >="'.$criteres.'" AND DATE_CREATION_REQUISITION <="'.$criteres1.'") REQUISITION

        LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_COMMAND_PROD,REF_COMMAND_CODE_PROD,NAME_COMMAND_PROD,INLINE_COMMAND_PROD FROM (SELECT CP.REF_PRODUCT_CODEBAR_COMMAND_PROD,CP.REF_COMMAND_CODE_PROD,CP.NAME_COMMAND_PROD,CP.INLINE_COMMAND_PROD FROM pos_store_'.$store.'_ibi_commandes_produits CP,pos_store_'.$store.'_ibi_requisition R WHERE CP.REF_COMMAND_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION="ibi_order_attente" )t )CPROD ON REQUISITION.REF_COMMAND_REQUISITION=CPROD.REF_COMMAND_CODE_PROD
            
        LEFT JOIN (SELECT REF_PRODUCT_CODEBAR_PROFORMA_PROD,REF_PROFORMA_CODE_PROD,NAME_PROFORMA_PROD,INLINE_PROFORMA_PROD FROM (SELECT PP.REF_PRODUCT_CODEBAR_PROFORMA_PROD,PP.REF_PROFORMA_CODE_PROD,PP.NAME_PROFORMA_PROD,PP.INLINE_PROFORMA_PROD FROM pos_store_'.$store.'_ibi_proforma_produits PP,pos_store_'.$store.'_ibi_requisition R WHERE PP.REF_PROFORMA_CODE_PROD=R.REF_COMMAND_REQUISITION AND R.TYPE_REQUISITION="ibi_order_proforma" )t )PPROD ON REQUISITION.REF_COMMAND_REQUISITION=PPROD.REF_PROFORMA_CODE_PROD');

      if($query){
        return $query->num_rows();
      }
    }

    public function sum_quantite($suffix,$store,$criteres){
        
        if($suffix == 'ibi_order_attente'){
        $query = $this->db->query('SELECT r.NUMERO_REQUISITION,SUM(cp.QUANTITE_COMMAND_PROD) AS QUANTITE FROM pos_store_'.$store.'_ibi_requisition r JOIN pos_store_'.$store.'_ibi_commandes_produits cp ON cp.REF_COMMAND_CODE_PROD=r.REF_COMMAND_REQUISITION WHERE r.NUMERO_REQUISITION="'.$criteres.'" GROUP BY NUMERO_REQUISITION');
        }else{
        $query = $this->db->query('SELECT r.NUMERO_REQUISITION,SUM(cp.QUANTITE_PROFORMA_PROD) AS QUANTITE FROM pos_store_'.$store.'_ibi_requisition r JOIN pos_store_'.$store.'_ibi_proforma_produits cp ON cp.REF_PROFORMA_CODE_PROD=r.REF_COMMAND_REQUISITION WHERE r.NUMERO_REQUISITION="'.$criteres.'" GROUP BY NUMERO_REQUISITION');
        }
        if($query){
        return $query->row_array();
       }

    }

}

/* End of file Model_requisition.php */
/* Location: ./application/models/Model_requisition.php */