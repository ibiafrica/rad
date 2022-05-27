<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_transfert_recu extends MY_Model
{

	private $primary_key 	= 'ID_ST';
	private $table_name 	= 'pos_store_1_ibi_stock_transfert';
	private $field_search 	= ['TITLE_ST', 'APPROUVED_BY_ST', 'DESTINATION_STORE_ST', 'FROM_STORE_ST', 'DATE_CREATION_ST', 'DATE_MOD_ST', 'CREATED_BY_ST', 'MODIFIED_BY_ST'];

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
					$where .= "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' )";
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where('DESTINATION_STORE_ST', $this->uri->segment(2));
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_ST',0);
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
					$where .= "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_store_1_ibi_stock_transfert." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}

		$this->join_avaiable()->filter_avaiable();
		$this->db->where('DESTINATION_STORE_ST', $this->uri->segment(2));
        $this->db->where($where);
        $this->db->where('DELETE_STATUS_ST',0);
        $this->db->limit($limit, $offset);
        $this->db->order_by('pos_store_1_ibi_stock_transfert.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{

		// $this->db->join('pos_ibi_stores', 'pos_ibi_stores.ID_STORE = emails.id', 'left');
		return $this;
	}

	public function filter_avaiable()
	{
		// $this->db->where('APPROUVED_BY_ST', get_user_data('id'));
		// $this->db->where('CREATED_BY_ST', get_user_data('id'));
		// $this->db->where('MODIFIED_BY_ST', get_user_data('id'));


		return $this;
	}
}

/* End of file Model_pos_store_1_ibi_stock_transfert.php */
/* Location: ./application/models/Model_pos_store_1_ibi_stock_transfert.php */