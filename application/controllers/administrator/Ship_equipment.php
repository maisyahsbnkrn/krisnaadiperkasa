<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Ship Equipment Controller
*| --------------------------------------------------------------------------
*| Ship Equipment site
*|
*/
class Ship_equipment extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_ship_equipment');
	}

	/**
	* show all Ship Equipments
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('ship_equipment_list');

//		$filter = $this->input->get('q');
//		$field 	= $this->input->get('f');
//		$this->data['ship_equipments'] = $this->model_ship_equipment->get($filter, $field, $this->limit_page, $offset);
//		$this->data['ship_equipment_counts'] = $this->model_ship_equipment->count_all($filter, $field);
            
                $company =  $this->input->get('company');  
                $ship_name = $this->input->get('ship_name');  
                $this->data['ship_equipments'] = $this->model_ship_equipment->get_filter($company, $ship_name,$this->limit_page, $offset);
		$this->data['ship_equipment_counts'] = $this->model_ship_equipment->count_all_filter($company, $ship_name);

		$config = [
			'base_url'     => 'administrator/ship_equipment/index/',
			'total_rows'   => $this->model_ship_equipment->count_all_filter($company, $ship_name),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

//		$config = [
//			'base_url'     => 'administrator/ship_equipment/index/',
//			'total_rows'   => $this->model_ship_equipment->count_all($filter, $field),
//			'per_page'     => $this->limit_page,
//			'uri_segment'  => 4,
//		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ship Equipment List');
		$this->render('backend/standart/administrator/ship_equipment/ship_equipment_list', $this->data);
	}
        
        public function get_filter(){
            $company =  $this->input->get('company');  
            $ship_name = $this->input->get('ship_name');  
            
                $this->data['ship_equipments'] = $this->model_ship_equipment->get_filter($company, $ship_name);
		$this->data['ship_equipment_counts'] = $this->model_ship_equipment->count_all_filter($company, $ship_name);

		$config = [
			'base_url'     => 'administrator/ship_equipment/get_filter/',
			'total_rows'   => $this->model_ship_equipment->count_all_filter($company, $ship_name),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ship Equipment List');
		$this->render('backend/standart/administrator/ship_equipment/ship_equipment_list', $this->data);
	}
             
        
	
	/**
	* Add new ship_equipments
	*
	*/
	public function add()
	{
		$this->is_allowed('ship_equipment_add');

		$this->template->title('Ship Equipment New');
		$this->render('backend/standart/administrator/ship_equipment/ship_equipment_add', $this->data);
	}

	/**
	* Add New Ship Equipments
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('ship_equipment_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		

		if ($this->form_validation->run()) {
			$manufacture_date = null;
			$beacon = null;
			$battery = null;
			$hru = null;
			$magnetron = null;
			$ups_battery = null;
			$emergency_battery = null;
			$annual_test = null;
			if(!empty($this->input->post('manufacture_date'))){
				$manufacture_date = $this->input->post('manufacture_date');
			}
			if(!empty($this->input->post('beacon'))){
				$beacon = $this->input->post('beacon');
			}
			if(!empty($this->input->post('battery'))){
				$battery = $this->input->post('battery');
			}
			if(!empty($this->input->post('hru'))){
				$hru = $this->input->post('hru');
			}
			if(!empty($this->input->post('magnetron'))){
				$magnetron = $this->input->post('magnetron');
			}
			if(!empty($this->input->post('ups_battery'))){
				$ups_battery = $this->input->post('ups_battery');
			}
			if(!empty($this->input->post('emergency_battery'))){
				$emergency_battery = $this->input->post('emergency_battery');
			}
			if(!empty($this->input->post('annual_test'))){
				$annual_test = $this->input->post('annual_test');
			}

			$save_data = [
				'company' => $this->input->post('company'),
				'ship_name' => $this->input->post('ship_name'),
				'name' => $this->input->post('name'),
				'maker' => $this->input->post('maker'),
				'type' => $this->input->post('type'),
				'serial_number' => $this->input->post('serial_number'),
				'manufacture_date' => $this->input->post('manufacture_date'),
				'beacon' => $beacon,
				'battery' => $battery,
				'hru' => $hru,
				'magnetron' => $magnetron,
                'ups_battery' => $ups_battery,
                'emergency_battery' => $emergency_battery,
                'annual_test' => $annual_test,
			];

			
			$save_ship_equipment = $this->model_ship_equipment->store($save_data);

			if ($save_ship_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_ship_equipment;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/ship_equipment/edit/' . $save_ship_equipment, 'Edit Ship Equipment'),
						anchor('administrator/ship_equipment', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/ship_equipment/edit/' . $save_ship_equipment, 'Edit Ship Equipment')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_equipment');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Ship Equipments
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('ship_equipment_update');

		$this->data['ship_equipment'] = $this->model_ship_equipment->find($id);

		$this->template->title('Ship Equipment Update');
		$this->render('backend/standart/administrator/ship_equipment/ship_equipment_update', $this->data);
	}

	/**
	* Update Ship Equipments
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('ship_equipment_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('name', 'Name', 'trim|required');
		$this->form_validation->set_rules('maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('type', 'Type', 'trim|required');
		
		if ($this->form_validation->run()) {
			$manufacture_date = null;
			$beacon = null;
			$battery = null;
			$hru = null;
			$magnetron = null;
			$ups_battery = null;
			$emergency_battery = null;
			$annual_test = null;
			if(!empty($this->input->post('manufacture_date'))){
				$manufacture_date = $this->input->post('manufacture_date');
			}
			if(!empty($this->input->post('beacon'))){
				$beacon = $this->input->post('beacon');
			}
			if(!empty($this->input->post('battery'))){
				$battery = $this->input->post('battery');
			}
			if(!empty($this->input->post('hru'))){
				$hru = $this->input->post('hru');
			}
			if(!empty($this->input->post('magnetron'))){
				$magnetron = $this->input->post('magnetron');
			}
			if(!empty($this->input->post('ups_battery'))){
				$ups_battery = $this->input->post('ups_battery');
			}
			if(!empty($this->input->post('emergency_battery'))){
				$emergency_battery = $this->input->post('emergency_battery');
			}
			if(!empty($this->input->post('annual_test'))){
				$annual_test = $this->input->post('annual_test');
			}

			$save_data = [
				'company' => $this->input->post('company'),
				'ship_name' => $this->input->post('ship_name'),
				'name' => $this->input->post('name'),
				'maker' => $this->input->post('maker'),
				'type' => $this->input->post('type'),
				'serial_number' => $this->input->post('serial_number'),
				'manufacture_date' => $this->input->post('manufacture_date'),
				'beacon' => $beacon,
				'battery' => $battery,
				'hru' => $hru,
				'magnetron' => $magnetron,
                'ups_battery' => $ups_battery,
                'emergency_battery' => $emergency_battery,
                'annual_test' => $annual_test,
			];

			
			$save_ship_equipment = $this->model_ship_equipment->change($id, $save_data);

			if ($save_ship_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/ship_equipment', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_equipment');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Ship Equipments
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('ship_equipment_delete');

		$this->load->helper('file');

		$arr_id = $this->input->get('id');
		$remove = false;

		if (!empty($id)) {
			$remove = $this->_remove($id);
		} elseif (count($arr_id) >0) {
			foreach ($arr_id as $id) {
				$remove = $this->_remove($id);
			}
		}

		if ($remove) {
            set_message(cclang('has_been_deleted', 'ship_equipment'), 'success');
        } else {
            set_message(cclang('error_delete', 'ship_equipment'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Ship Equipments
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('ship_equipment_view');

		$this->data['ship_equipment'] = $this->model_ship_equipment->join_avaiable()->find($id);

		$this->template->title('Ship Equipment Detail');
		$this->render('backend/standart/administrator/ship_equipment/ship_equipment_view', $this->data);
	}
	
	/**
	* delete Ship Equipments
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$ship_equipment = $this->model_ship_equipment->find($id);

		
		
		return $this->model_ship_equipment->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('ship_equipment_export');

		$this->model_ship_equipment->export('ship_equipment', 'ship_equipment');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('ship_equipment_export');

		$this->model_ship_equipment->pdf('ship_equipment', 'ship_equipment');
	}
        
         public function get_ship_name($company){
            $ship_name= $this->model_ship_equipment->get_selected_by_name($company);
            
            $lists = "<option value=''>Select Ship Name</option>";
            foreach ($ship_name as $data) {
                $lists .= "<option value='" . $data->id_ship . "'>" . $data->ship_name . "</option>";
            }
        
            $callback = array(
                'list_ship_name' => $lists
            );
            
            echo json_encode($callback);
        }
}


/* End of file ship_equipment.php */
/* Location: ./application/controllers/administrator/Ship Equipment.php */