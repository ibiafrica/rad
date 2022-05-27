<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_pos_flux_caisse extends MY_Model {

	private $primary_key 	= 'ID_FLUX_CAISSE';
	private $table_name 	= 'pos_flux_caisse';
	private $field_search 	= ['NOM_FLUX_CAISSE', 'MONTANT_FLUX_CAISSE', 'TYPE_FLUX_CAISSE', 'CATEGORIE_FLUX', 'DESCRIPTION_FLUX', 'USER_CREATE_FLUX', 'DATE_CREATION_FLUX'];

	public function __construct()
	{
		$config = array(
			'primary_key' 	=> $this->primary_key,
		 	'table_name' 	=> $this->table_name,
		 	'field_search' 	=> $this->field_search,
		 );

		parent::__construct($config);
	}

	public function count_all($date_start, $date_end,$q = null, $field = null)
	{
		$critere_start = $date_start . " 00:00:00";
		$critere_end = $date_end . " 23:59:59";

		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
        $this->db->where('FLUX_DELETE_STATUS',0);
        if (!empty($date_start) AND !empty($date_end)) {
			
					$this->db->where('DATE_CREATION_FLUX >=', $critere_start);
					$this->db->where('DATE_CREATION_FLUX <=', $critere_end);
			}
		$query = $this->db->get($this->table_name);

		return $query->num_rows();
	}

	public function get($date_start, $date_end,$q = null, $field = null, $limit = 0, $offset = 0, $select_field = [])
	{
		$critere_start = $date_start . " 00:00:00";
		$critere_end = $date_end . " 23:59:59";
		$iterasi = 1;
        $num = count($this->field_search);
        $where = NULL;
        $q = $this->scurity($q);
		$field = $this->scurity($field);

        if (empty($field)) {
	        foreach ($this->field_search as $field) {
	            if ($iterasi == 1) {
	                $where .= "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "pos_flux_caisse.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable()->filter_avaiable();
        $this->db->where($where);
         if (!empty($date_start) AND !empty($date_end)) {
			
					$this->db->where('DATE_CREATION_FLUX >=', $critere_start);
					$this->db->where('DATE_CREATION_FLUX <=', $critere_end);
			}
        $this->db->where('FLUX_DELETE_STATUS',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_flux_caisse.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

    public function join_avaiable() {
        $this->db->join('pos_activite_flux_caisse', 'pos_activite_flux_caisse.ID_ACTIVITE = pos_flux_caisse.TYPE_FLUX_CAISSE', 'LEFT');
        $this->db->join('pos_categorie_flux_caisse', 'pos_categorie_flux_caisse.ID_CATEGORIE = pos_flux_caisse.CATEGORIE_FLUX', 'LEFT');
        
        return $this;
    }

    public function filter_avaiable() {
       // $this->db->where('USER_CREATE_FLUX', get_user_data('id'));
        
        return $this;
    }

}

/* End of file Model_pos_flux_caisse.php */
/* Location: ./application/models/Model_pos_flux_caisse.php */