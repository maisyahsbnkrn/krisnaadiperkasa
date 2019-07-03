<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_task_equipment extends MY_Model {

	private $primary_key 	= 'id_task_equipment';
	private $table_name 	= 'task_equipment';
	private $field_search 	= ['order_number_task', 'task_equipment_name', 'task_equipment_maker', 'task_equipment_type', 'task_equipment_quantity'];

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
	                $where .= "task_equipment.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "task_equipment.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "task_equipment.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "task_equipment.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "task_equipment.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "task_equipment.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
		$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('task_equipment.'.$this->primary_key, "DESC");
		$query = $this->db->get($this->table_name);

		return $query->result();
	}

	public function join_avaiable() {
		
    	return $this;
	}
        
        public function get_selected_by_name($logistic_equipment_name){
            if($logistic_equipment_name==""){
                
            }else{
                $this->db->distinct(); 
                $this->db->select('logistic_maker');
                $this->db->where('logistic_equipment_name',  str_replace('%20', ' ', $logistic_equipment_name));
            }
            return $this->db->get('logistic_equipment')->result();
        }
        
        public function get_selected_by_name_maker($logistic_equipment_name,$logistic_equipment_maker){
            if($logistic_equipment_name==""&&$logistic_equipment_maker==""){
                
            }else{
                $this->db->distinct(); 
                $this->db->select('logistic_equipment_type');
                $this->db->where('logistic_equipment_name',  str_replace('%20', ' ', $logistic_equipment_name));
                $this->db->where('logistic_maker',  str_replace('%20', ' ', $logistic_equipment_maker));
               
            }
            return $this->db->get('logistic_equipment')->result();
        }
        
       
         public function get_selected_by_name_maker_type($logistic_equipment_name,$logistic_equipment_maker,$logistic_equipment_type){
            if($logistic_equipment_name==""&&$logistic_equipment_maker==""&&$logistic_equipment_type==""){
                
            }else{
                $this->db->distinct(); 
                $this->db->select('quantity');
                $this->db->where('logistic_equipment_name',  str_replace('%20', ' ', $logistic_equipment_name));
                $this->db->where('logistic_maker',  str_replace('%20', ' ', $logistic_equipment_maker));
                $this->db->where('logistic_equipment_type',  str_replace('%20', ' ', $logistic_equipment_type));
               
            }
            return $this->db->get('logistic_equipment')->result();
        }
        
       
        
         public function update_stock($task_equipment_name,$task_equipment_maker,$task_equipment_type,$task_equipment_stock_available){
  
             $this->db->set('quantity',$task_equipment_stock_available)
                      ->where('logistic_equipment_name',  str_replace('%20', ' ', $task_equipment_name))
                      ->where('logistic_maker',  str_replace('%20', ' ', $task_equipment_maker))
                      ->where('logistic_equipment_type',  str_replace('%20', ' ', $task_equipment_type))  
                      ->update('logistic_equipment');
            return true;
        }
        
        
         

}

/* End of file Model_task_equipment.php */
/* Location: ./application/models/Model_task_equipment.php */