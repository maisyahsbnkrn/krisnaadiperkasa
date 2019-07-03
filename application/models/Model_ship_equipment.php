<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ship_equipment extends MY_Model {

	private $primary_key 	= 'id_equipment';
	private $table_name 	= 'ship_equipment';
	private $field_search 	= ['company', 'ship_name', 'name', 'maker', 'type'];

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
                            $where .= "ship_equipment.".$field . " LIKE '%" . $q . "%' ";
                        } else {
                            $where .= "OR " . "ship_equipment.".$field . " LIKE '%" . $q . "%' ";
                        }
                        $iterasi++;
                    }

                    $where = '('.$where.')';
            } else {
                    $where .= "(" . "ship_equipment.".$field . " LIKE '%" . $q . "%' )";
            }

//                    $this->join_avaiable();
                    $this->db->where($where);
                    $query = $this->db->get($this->table_name);

                    return $query->num_rows();
	}
        
        public function count_all_filter($company, $ship_name){
            $where = "ship_equipment.company LIKE '%" . $company . "%' AND ship_equipment.ship_name LIKE '%" . $ship_name . "%' ";
            $this->db->where($where);
            $this->db->order_by('ship_equipment.id_equipment', "ASC");
            $query = $this->db->get($this->table_name);
            return $query->num_rows(); 
        }
        
        public function get_filter($company, $ship_name,$limit = 0, $offset = 0){
            $where = "ship_equipment.company LIKE '%" . $company . "%' AND ship_equipment.ship_name LIKE '%" . $ship_name . "%' ";
            $this->db->where($where);
            $this->db->limit($limit, $offset);

            $this->db->order_by('ship_equipment.id_equipment', "ASC");
            $query = $this->db->get($this->table_name);
            return $query->result(); 
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
                            $where .= "ship_equipment.".$field . " LIKE '%" . $q . "%' ";
                        } else {
                            $where .= "OR " . "ship_equipment.".$field . " LIKE '%" . $q . "%' ";
                        }
                        $iterasi++;
                    }

                    $where = '('.$where.')';
            } else {
                    $where .= "(" . "ship_equipment.".$field . " LIKE '%" . $q . "%' )";
            }

            if (is_array($select_field) AND count($select_field)) {
                    $this->db->select($select_field);
            }
		
     //	$this->join_avaiable();
            $this->db->where($where);
            $this->db->limit($limit, $offset);
            $this->db->order_by('ship_equipment.id_equipment', "ASC");
            $query = $this->db->get($this->table_name);
            return $query->result();
        
//        $query = $this->db->query("select distinct *,ship_equipment.id_equipment as id,company.name as company, ship.ship_name as ship_name,ship_equipment.name as name,ship_equipment.maker as maker,ship_equipment.type as type FROM `ship_equipment` LEFT JOIN `company` ON `company`.`id_company` = `ship_equipment`.`company` LEFT JOIN `ship` ON `ship`.`id_ship` = `ship_equipment`.`ship_name` LEFT JOIN `logistic_equipment` ON `logistic_equipment`.`logistic_equipment_name` = `ship_equipment`.`name` LEFT JOIN `logistic_equipment` `logistic_equipment1` ON `logistic_equipment1`.`id_logistic_equipment` = `ship_equipment`.`maker` LEFT JOIN `logistic_equipment` `logistic_equipment2` ON `logistic_equipment2`.`id_logistic_equipment` = `ship_equipment`.`type` WHERE (`ship_equipment`.`company` LIKE '%%' OR `ship_equipment`.`ship_name` LIKE '%%' OR `ship_equipment`.`name` LIKE '%%' OR `ship_equipment`.`serial_number` LIKE '%%' ) ORDER BY `ship_equipment`.`id_equipment` ASC LIMIT 10");
//        return $query->result();
	}

	public function join_avaiable() {
//            $this->db->join('company', 'company.name = ship_equipment.company', 'LEFT');
//	    $this->db->join('ship', 'ship.ship_name = ship_equipment.ship_name', 'LEFT');
//	    $this->db->join('logistic_equipment', 'logistic_equipment.logistic_equipment_name = ship_equipment.name', 'LEFT');
//	    $this->db->join('logistic_equipment logistic_equipment1', 'logistic_equipment1.logistic_maker = ship_equipment.maker', 'LEFT');
//	    $this->db->join('logistic_equipment logistic_equipment2', 'logistic_equipment2.logistic_equipment_type = ship_equipment.type', 'LEFT');
//	    
//    	return $this;
            $this->db->select('*');
            $this->db->select('ship_equipment.name as logistic_equipment_name');
            $this->db->join('company', 'company.id_company = ship_equipment.company', 'LEFT');
	    $this->db->join('ship', 'ship.id_ship = ship_equipment.ship_name', 'LEFT');
	    $this->db->join('logistic_equipment', 'logistic_equipment.logistic_equipment_name = ship_equipment.name', 'LEFT');
	    $this->db->join('logistic_equipment logistic_equipment1', 'logistic_equipment1.id_logistic_equipment = ship_equipment.maker', 'LEFT');
	    $this->db->join('logistic_equipment logistic_equipment2', 'logistic_equipment2.id_logistic_equipment = ship_equipment.type', 'LEFT');
	    
            return $this;
	}
        
        public function get_selected_by_name($company){
            if($company==""){
                
            }else{
//                $this->db->distinct(); 
//                $this->db->select('ship_name');
                $this->db->where('company',  str_replace('%20', ' ', $company));
            }
            return $this->db->get('ship')->result();
        }

}

/* End of file Model_ship_equipment.php */
/* Location: ./application/models/Model_ship_equipment.php */