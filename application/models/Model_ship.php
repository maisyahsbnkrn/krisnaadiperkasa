<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ship extends MY_Model {

	private $primary_key 	= 'id_ship';
	private $table_name 	= 'ship';
	private $field_search 	= ['name', 'ship_name'];

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
	            	if($field == 'name'){
	            		$where .= "company.".$field . " LIKE '%" . $q . "%' ";
	            	}else{
	            		$where .= "ship.".$field . " LIKE '%" . $q . "%' ";
	            	}
	                
	            } else {
	            	if($field == 'name'){
	            		$where .= "OR " . "company.".$field . " LIKE '%" . $q . "%' ";
	            	}else{
						$where .= "OR " . "ship.".$field . " LIKE '%" . $q . "%' ";
	            	}
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	if($field == 'name'){
        		$where .= "(" . "company.".$field . " LIKE '%" . $q . "%' )";
        	}else{
        		$where .= "(" . "ship.".$field . " LIKE '%" . $q . "%' )";
        	}
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
	            	if($field == 'name'){
	            		$where .= "company.".$field . " LIKE '%" . $q . "%' ";
	            	}else{
	            		$where .= "ship.".$field . " LIKE '%" . $q . "%' ";
	            	}
	                
	            } else {
	            	if($field == 'name'){
	            		$where .= "OR " . "company.".$field . " LIKE '%" . $q . "%' ";
	            	}else{
						$where .= "OR " . "ship.".$field . " LIKE '%" . $q . "%' ";
	            	}
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	if($field == 'name'){
        		$where .= "(" . "company.".$field . " LIKE '%" . $q . "%' )";
        	}else{
        		$where .= "(" . "ship.".$field . " LIKE '%" . $q . "%' )";
        	}
        	
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ship.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		$this->db->join('company', 'company.id_company = ship.company', 'LEFT');
	    $this->db->join('ship_type', 'ship_type.id_ship_type = ship.ship_type', 'LEFT');
	    
    	return $this;
	}

}

/* End of file Model_ship.php */
/* Location: ./application/models/Model_ship.php */