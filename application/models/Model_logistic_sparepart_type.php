<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_logistic_sparepart_type extends MY_Model {

	private $primary_key 	= 'id_logistic_sparepart_type';
	private $table_name 	= 'logistic_sparepart_type';
	private $field_search 	= ['logistic_sparepart_type_name', 'logistic_sparepart_type_types'];

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
	                $where .= "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' )";
        }

		$this->join_avaiable();
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
	                $where .= "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "logistic_sparepart_type.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('logistic_sparepart_type.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		
    	return $this;
	}

}

/* End of file Model_logistic_sparepart_type.php */
/* Location: ./application/models/Model_logistic_sparepart_type.php */