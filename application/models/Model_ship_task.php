<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Model_ship_task extends MY_Model {

	private $primary_key 	= 'id_task';
	private $table_name 	= 'ship_task';
	private $field_search 	= ['company', 'ship_name', 'order_number', 'schedule', 'status'];

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
	                $where .= "ship_task.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "ship_task.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "ship_task.".$field . " LIKE '%" . $q . "%' )";
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
	                $where .= "ship_task.".$field . " LIKE '%" . $q . "%' ";
	            } else {
	                $where .= "OR " . "ship_task.".$field . " LIKE '%" . $q . "%' ";
	            }
	            $iterasi++;
	        }

	        $where = '('.$where.')';
        } else {
        	$where .= "(" . "ship_task.".$field . " LIKE '%" . $q . "%' )";
        }

        if (is_array($select_field) AND count($select_field)) {
        	$this->db->select($select_field);
        }
		
	$this->join_avaiable();
        $this->db->where($where);
        $this->db->limit($limit, $offset);
        $this->db->order_by('ship_task.'.$this->primary_key, "DESC");
	$query = $this->db->get($this->table_name);
	return $query->result();
	}

	public function join_avaiable() {
            $this->db->join('company', 'company.id_company = ship_task.company', 'LEFT');
	    $this->db->join('ship', 'ship.id_ship = ship_task.ship_name', 'LEFT');
	    $this->db->join('scope_types', 'scope_types.id_scope_type = ship_task.scope_type', 'LEFT');
	    $this->db->join('survey_type', 'survey_type.id_survey_type = ship_task.survey_type', 'LEFT');
	    $this->db->join('aauth_users', 'aauth_users.id = ship_task.engineer', 'LEFT');
            $this->db->join('job_status', 'job_status.id_job_status = ship_task.status', 'LEFT');
	    
    	return $this;
	}
        
         public function get__survey_type() {
            return $this->db->get('survey_type')->result();
        }
        
        public function getTerritory($company){
            if($company==""){
                
            }else{
                $this->db->where('id_company',  $company);
            }
            return $this->db->get('company')->result();
        }
        
         public function getSelectedTarif($jenis_survey){
            if($jenis_survey==""){
                
            }else{
                $this->db->where('name',  $jenis_survey);
            }
            return $this->db->get('survey_tarif')->result();
        }
        
         public function get_repairTarif() {
            return $this->db->get('repair_tarif')->result();
        }
        
         public function get_installationTarif() {
            return $this->db->get('installation_tarif')->result();
        }
        
}

/* End of file Model_ship_task.php */
/* Location: ./application/models/Model_ship_task.php */