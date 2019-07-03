<?php


defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Logistic Equipment Controller
*| --------------------------------------------------------------------------
*| Logistic Equipment site
*|
*/
class Ship_task_equipment extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_logistic_equipment');
	}

	/**
	* show all Logistic Equipments
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('ship_task_get_equipment');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logistic_equipments'] = $this->model_logistic_equipment->get($filter, $field, $this->limit_page, $offset);
		$this->data['logistic_equipment_counts'] = $this->model_logistic_equipment->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/ship_task/ship_task_equipment/',
			'total_rows'   => $this->model_logistic_equipment->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Logistic Equipment List');
		$this->render('backend/standart/administrator/ship_task/ship_task_get_equipment', $this->data);
	}
	
	 
}

 