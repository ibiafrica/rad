<?php
defined('BASEPATH') OR exit('No direct script access allowed');


    // SHOW ERRORS
    error_reporting(E_ALL);
    ini_set('display_errors', 'On');

class Model_proforma extends MY_Model {

	private $primary_key 	= 'ID_PROFORMA';
	private $field_search 	= ['TITRE_PROFORMA', 'CODE_PROFORMA', 'REF_CODE_COMMAND_PROFORMA', 'REF_CLIENT_PROFORMA', 'DATE_CREATION_PROFORMA', 'DATE_MOD_PROFORMA', 'AUTHOR_PROFORMA'];

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
       $table_name     = 'pos_store_'.$store_prefix.'_ibi_proforma';
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
    $this->db->where('STATUT_PROFORMA',0);
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
    $this->db->where('STATUT_PROFORMA',0);
    $this->db->limit($limit, $offset);
    $this->db->order_by(''.$this->table_name().'.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());
        
		return $query->result();
	}

    public function join_avaiable() {

        $this->db->join('pos_ibi_clients', 'pos_ibi_clients.ID_CLIENT = '.$this->table_name().'.REF_CLIENT_PROFORMA', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }
    public function shuffle_code(){
            
            $randomString = '';
            $datemonth=date('m');
            $maxdate='/'.date('m').'/'.date('Y');

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_proforma p1 WHERE MONTH(p1.DATE_CREATION)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_proforma p2 WHERE MONTH(p2.DATE_CREATION)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(CODE_PROFORMA,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_proforma p3 WHERE MONTH(p3.DATE_CREATION)='".$datemonth."')t");
            
            
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
    public function random_code($length = 6)

    {

            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

            $charactersLength = strlen($characters);

            $randomString = '';

            for ($i = 0; $i < $length; $i++) {

                $randomString .= $characters[rand(0, $charactersLength - 1)];

            }

        return $randomString;

    }

    public function getListFilter($store, $criteres, $criteres1)
    {
      $where = 'DATE_CREATION_PROFORMA >="'.$criteres.'" AND DATE_CREATION_PROFORMA <="'.$criteres1.'" AND STATUT_PROFORMA = 0';
      $this->db->select('prof.*,SUM(profp.PRIX_TOTAL_PROFORMA_PROD) AS PRIX_TOTAL,SUM(profp.DISCOUNT_AMOUNT_PROFORMA_PROD+profp.DISCOUNT_PERCENT_PROFORMA_PROD) AS DISCOUNT_MONTANT');
      $this->db->from('pos_store_'.$store.'_ibi_proforma prof');
      $this->db->join('pos_store_'.$store.'_ibi_proforma_produits profp','profp.REF_PROFORMA_CODE_PROD = prof.CODE_PROFORMA');
      $this->db->where($where);
      $this->db->group_by('profp.REF_PROFORMA_CODE_PROD');

      $query = $this->db->get();

      if($query){
        return $query->result();
      }
    }
    public function getListFilter_count($store, $criteres, $criteres1)
    {
      $where = 'DATE_CREATION_PROFORMA >="'.$criteres.'" AND DATE_CREATION_PROFORMA <="'.$criteres1.'" AND STATUT_PROFORMA = 0';
      $this->db->select('prof.*');
      $this->db->from('pos_store_'.$store.'_ibi_proforma prof');
      $this->db->join('pos_store_'.$store.'_ibi_proforma_produits profp','profp.REF_PROFORMA_CODE_PROD = prof.CODE_PROFORMA');
      $this->db->where($where);
      $this->db->group_by('profp.REF_PROFORMA_CODE_PROD');
      
      $query = $this->db->get();

      if($query){
        return $query->num_rows();
      }
    }

}

/* End of file Model_proforma.php */
/* Location: ./application/models/Model_proforma.php */