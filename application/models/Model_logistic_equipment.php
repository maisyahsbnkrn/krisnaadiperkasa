<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_logistic_equipment extends MY_Model {

	private $primary_key 	= 'id_logistic_equipment';
	private $table_name 	= 'logistic_equipment';
	private $field_search 	= ['logistic_equipment_name', 'logistic_maker', 'logistic_equipment_type', 'logistic_serial_number', 'quantity', 'price','unit'];

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
	                $where .= "logistic_equipment.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "logistic_equipment.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "logistic_equipment.".$field . " LIKE '%" . $q . "%' )";
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
                            $where .= "logistic_equipment.".$field . " LIKE '%" . $q . "%' ";
                        } else {
                            $where .= "OR " . "logistic_equipment.".$field . " LIKE '%" . $q . "%' ";
                        }
                        $iterasi++;
                    }

                    $where = '('.$where.')';
            } else {
                    $where .= "(" . "logistic_equipment.".$field . " LIKE '%" . $q . "%' )";
            }

            if (is_array($select_field) AND count($select_field)) {
                    $this->db->select($select_field);
            }
		
//            $this->join_avaiable();
            $this->db->where($where);
            $this->db->limit($limit, $offset);
            $this->db->order_by('logistic_equipment.'.$this->primary_key, "DESC");
            $query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
            $this->db->join('logistic_equipment_type', 'logistic_equipment_type.id_logistic_equipment_type = logistic_equipment.logistic_equipment_name', 'LEFT');
	    $this->db->join('logistic_equipment_type logistic_equipment_type1', 'logistic_equipment_type1.id_logistic_equipment_type = logistic_equipment.logistic_maker', 'LEFT');
	    $this->db->join('logistic_equipment_type logistic_equipment_type2', 'logistic_equipment_type2.id_logistic_equipment_type = logistic_equipment.logistic_equipment_type', 'LEFT');
	    
    	return $this;
	}
        
        public function get_selected_by_name_maker($logistic_equipment_name,$logistic_equipment_maker){
            if($logistic_equipment_name==""&&$logistic_equipment_maker==""){
                
            }else{
                $this->db->where('logistic_equipment_type_name',  str_replace('%20', ' ', $logistic_equipment_name));
                $this->db->where('logistic_equipment_type_maker',  str_replace('%20', ' ', $logistic_equipment_maker));
            }
            return $this->db->get('logistic_equipment_type')->result();
        }
        
         public function get_selected_by_name($logistic_equipment_name){
                $param = $logistic_equipment_name;
                $this->db->distinct(); 
                $this->db->select('logistic_equipment_type_maker');
                $this->db->where('logistic_equipment_type_name', $param);
            
            return $this->db->get('logistic_equipment_type')->result();
        }

}

/* End of file Model_logistic_equipment.php */
/* Location: ./application/models/Model_logistic_equipment.php */