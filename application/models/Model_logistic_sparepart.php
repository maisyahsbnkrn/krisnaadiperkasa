<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_logistic_sparepart extends MY_Model {

	private $primary_key 	= 'id_logistic_sparepart';
	private $table_name 	= 'logistic_sparepart';
	private $field_search 	= ['logistic_sparepart_equipment_name', 'logistic_sparepart_equipment_maker', 'logistic_sparepart_equipment_type', 'logistic_sparepart_name', 'unit', 'quantity'];

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
	                $where .= "logistic_sparepart.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "logistic_sparepart.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "logistic_sparepart.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "logistic_sparepart.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "logistic_sparepart.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "logistic_sparepart.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
//		$this->join_avaiable();
                $this->db->where($where);
                $this->db->limit($limit, $offset);
                $this->db->order_by('logistic_sparepart.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
//		$this->db->join('logistic_equipment', 'logistic_equipment.id_logistic_equipment = logistic_sparepart.logistic_sparepart_equipment_name', 'LEFT');
//                $this->db->join('logistic_equipment logistic_equipment1', 'logistic_equipment1.id_logistic_equipment = logistic_sparepart.logistic_sparepart_equipment_maker', 'LEFT');
//                $this->db->join('logistic_equipment logistic_equipment2', 'logistic_equipment2.id_logistic_equipment = logistic_sparepart.logistic_sparepart_equipment_type', 'LEFT');
//                $this->db->join('logistic_sparepart_type', 'logistic_sparepart_type.id_logistic_sparepart_type = logistic_sparepart.logistic_sparepart_name', 'LEFT');
//                $this->db->join('logistic_sparepart_type logistic_sparepart_type1', 'logistic_sparepart_type1.id_logistic_sparepart_type = logistic_sparepart.logistic_sparepart_type', 'LEFT');
//                $this->db->join('unit', 'unit.name_unit = logistic_sparepart.unit', 'LEFT');
	    
    	return $this;
	}
        
         public function get_selected_by_name($logistic_sparepart_name){
            if($logistic_sparepart_name==""){
                
            }else{
                $this->db->distinct(); 
                $this->db->select('logistic_sparepart_type_types');
                $this->db->where('logistic_sparepart_type_name',  str_replace('%20', ' ', $logistic_sparepart_name));
            }
            return $this->db->get('logistic_sparepart_type')->result();
        }

}

/* End of file Model_logistic_sparepart.php */
/* Location: ./application/models/Model_logistic_sparepart.php */