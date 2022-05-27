<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_demande extends MY_Model
{

	private $primary_key 	= 'id_demand';
	private $field_search 	=['id_demand', 'status_id_demand', 'date_creation_demand', 'date_mod_demand', 'author_demand'];

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
     $store_prefix= $this->uri->segment(4);
     $table_name='pos_store_'.$store_prefix.'_ibi_demand_achat';
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
					$where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' )";
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
					$where .= "".$this->table_name()."." . $field . " LIKE '%" . $q . "%' ";
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

		$this->join_avaiable()->filter_avaiable();
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by(''.$this->table_name().'.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name());

		return $query->result();
	}
	public function join_avaiable() {
        $this->db->join('aauth_users', 'aauth_users.id ='.$this->table_name().'.author_demand','LEFT');
        return $this;
    }

    public function filter_avaiable() {
        // $this->db->where('AUTHOR', get_user_data('id'));
        
        return $this;
    }

	public function random_code($store)
    {
            $randomString = '';
            $dateyear = date('Y');
            $suffix = 'DA';

            $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,6,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(ref_id_demand,'".$suffix."','') AS UNSIGNED)) as Maxcount from pos_store_".$store."_ibi_demand_achat d WHERE YEAR(d.date_creation_demand)='".$dateyear."')t");
            
             foreach ($lastid->result_array() as $key => $value) {
                
                if($value['Maxcounts']==NULL){
                    $Countmax="000001";
                }else{
                    $Countmax=$value['Maxcounts'];
                }
             }

            $randomString = $suffix.''.$Countmax.'-'.$dateyear;

        return $randomString;

    }

    public function shuffle_code($store){
            
        $randomString = '';
        $datemonth=date('m');
        $dateyear=date('Y');
        $maxdate='/'.date('m').'/'.date('Y');

        $lastid = $this->db->query("SELECT LPAD(MAX(Maxcount)+1,5,0) as Maxcounts from (SELECT MAX(CAST(REPLACE(NUMERO_BON_COMMANDE,'".$maxdate."','') AS UNSIGNED)) as Maxcount from pos_store_1_ibi_bon_commande bc1 WHERE YEAR(bc1.DATE_CREATION_BON_COMMANDE)='".$dateyear."' AND MONTH(bc1.DATE_CREATION_BON_COMMANDE)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_BON_COMMANDE,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_2_ibi_bon_commande bc2 WHERE YEAR(bc2.DATE_CREATION_BON_COMMANDE)='".$dateyear."' AND MONTH(bc2.DATE_CREATION_BON_COMMANDE)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_BON_COMMANDE,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_3_ibi_bon_commande bc3 WHERE YEAR(bc3.DATE_CREATION_BON_COMMANDE)='".$dateyear."' AND MONTH(bc3.DATE_CREATION_BON_COMMANDE)='".$datemonth."' UNION  SELECT MAX(CAST(REPLACE(NUMERO_BON_COMMANDE,'".$maxdate."','') AS UNSIGNED)) as Maxcount FROM pos_store_6_ibi_bon_commande bc6 WHERE YEAR(bc6.DATE_CREATION_BON_COMMANDE)='".$dateyear."' AND MONTH(bc6.DATE_CREATION_BON_COMMANDE)='".$datemonth."')t");
        
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

    public function bon_providers_count_all($store, $q = null, $field = null)
	{
		$field_search 	=['ID_BON_COMMANDE', 'NUMERO_BON_COMMANDE', 'REF_CODE_BON_COMMANDE', 'REF_PROVIDER_BON_COMMANDE', 'DATE_CREATION_BON_COMMANDE', 'AUTHOR_BON_COMMANDE'];

		$iterasi = 1;
		$num = count($field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable_bon($store);
		$this->db->where($where);
		$this->db->where('TYPE_BON_COMMANDE','bn_provider');
		$query = $this->db->get("pos_store_".$store."_ibi_bon_commande");

		return $query->num_rows();
	}
	
	public function get_bon_providers($store, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$field_search 	=['ID_BON_COMMANDE', 'NUMERO_BON_COMMANDE', 'REF_CODE_BON_COMMANDE', 'REF_PROVIDER_BON_COMMANDE', 'DATE_CREATION_BON_COMMANDE', 'AUTHOR_BON_COMMANDE'];

		$iterasi = 1;
		$num = count($field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable_bon($store);
		$this->db->where($where);
		$this->db->where('TYPE_BON_COMMANDE','bn_provider');
		$this->db->limit($limit, $offset);
		$this->db->order_by("pos_store_".$store."_ibi_bon_commande.ID_BON_COMMANDE", "DESC");
		$query = $this->db->get("pos_store_".$store."_ibi_bon_commande");
       
		return $query->result();
	}

	public function bon_cashiers_count_all($store, $q = null, $field = null)
	{
		$field_search 	=['ID_BON_COMMANDE', 'NUMERO_BON_COMMANDE', 'REF_CODE_BON_COMMANDE', 'REF_PROVIDER_BON_COMMANDE', 'DATE_CREATION_BON_COMMANDE', 'AUTHOR_BON_COMMANDE'];

		$iterasi = 1;
		$num = count($field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable_bon($store);
		$this->db->where($where);
		$this->db->where('TYPE_BON_COMMANDE','bn_cashier');
		$query = $this->db->get("pos_store_".$store."_ibi_bon_commande");

		return $query->num_rows();
	}

	public function get_bon_cashiers($store, $q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$field_search 	=['ID_BON_COMMANDE', 'NUMERO_BON_COMMANDE', 'REF_CODE_BON_COMMANDE', 'REF_PROVIDER_BON_COMMANDE', 'DATE_CREATION_BON_COMMANDE', 'AUTHOR_BON_COMMANDE'];

		$iterasi = 1;
		$num = count($field_search);
		$where = NULL;
		$q = $this->scurity($q);
		$field = $this->scurity($field);

		if (empty($field)) {
			foreach ($field_search as $field) {
				if ($iterasi == 1) {
					$where .= "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_".$store."_ibi_bon_commande." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable_bon($store);
		$this->db->where($where);
		$this->db->where('TYPE_BON_COMMANDE','bn_cashier');
		$this->db->limit($limit, $offset);
		$this->db->order_by("pos_store_".$store."_ibi_bon_commande.ID_BON_COMMANDE", "DESC");
		$query = $this->db->get("pos_store_".$store."_ibi_bon_commande");
       
		return $query->result();
	}

	public function join_avaiable_bon($store){
		 $this->db->join('aauth_users', 'aauth_users.id =pos_store_'.$store.'_ibi_bon_commande.AUTHOR_BON_COMMANDE','LEFT');
		 $this->db->join('pos_ibi_fournisseurs', 'pos_ibi_fournisseurs.ID =pos_store_'.$store.'_ibi_bon_commande.REF_PROVIDER_BON_COMMANDE','LEFT');
        return $this;
	}

}

