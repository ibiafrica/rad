<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_requisition_recu_trans extends MY_Model
{

	private $primary_key 	= 'ID_REQ';
	private $table_name 	= 'pos_ibi_requisition_trans';
	private $field_search 	= ['TITLE_REQ', 'CODE_REQ'];


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
					$where .= "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' )";
		}
         
		$this->join_avaiable()->filter_avaiable();
		$this->db->where('DELETE_STATUS_REQ',0);
		$this->db->where('FROM_STORE!='.$this->uri->segment(2).'');
		$this->db->where('(DESTINATION_STORE_REQ='.$this->uri->segment(2).' OR DESTINATION_STORE_REQ=0)');
        $this->db->where($where);
        
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
					$where .= "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' ";
				} else {
					$where .= "OR " . "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' ";
				}
				$iterasi++;
			}

			$where = '(' . $where . ')';
		} else {
			$where .= "(" . "pos_ibi_requisition_trans." . $field . " LIKE '%" . $q . "%' )";
		}

		if (is_array($select_field) and count($select_field)) {
			$this->db->select($select_field);
		}
        // $this->db->where("(email = $user OR username = $user)");
		$this->join_avaiable()->filter_avaiable();
		$this->db->where('DELETE_STATUS_REQ', 0);
		$this->db->where('FROM_STORE!='.$this->uri->segment(2).'');
		
		$this->db->where('(DESTINATION_STORE_REQ='.$this->uri->segment(2).' OR DESTINATION_STORE_REQ=0)');
		$this->db->where($where);
		$this->db->limit($limit, $offset);
		$this->db->order_by('pos_ibi_requisition_trans.' . $this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable()
	{

		return $this;
	}

	public function filter_avaiable()
	{
		// $this->db->where('CREATED_BY_REQ', get_user_data('id'));
		// $this->db->where('MODIFIED_BY_REQ', get_user_data('id'));
		// $this->db->where('DELETE_STATUS_REQ',>0et_user_data('id'));

		// $where = "FROM_STORE=".$this->uri->segment(2)." OR DESTINATION_STORE_REQ=".$this->uri->segment(2);
		//    $this->db->where($where);


		return $this;
	}
}

/* End of file Model_pos_ibi_requisition_trans.php */
/* Location: ./application/models/Model_pos_ibi_requisition_trans.php */