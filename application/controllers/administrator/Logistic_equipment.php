<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Logistic Equipment Controller
*| --------------------------------------------------------------------------
*| Logistic Equipment site
*|
*/
class Logistic_equipment extends Admin	
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
		$this->is_allowed('logistic_equipment_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logistic_equipments'] = $this->model_logistic_equipment->get($filter, $field, $this->limit_page, $offset);
		$this->data['logistic_equipment_counts'] = $this->model_logistic_equipment->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/logistic_equipment/index/',
			'total_rows'   => $this->model_logistic_equipment->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Logistic Equipment List');
		$this->render('backend/standart/administrator/logistic_equipment/logistic_equipment_list', $this->data);
	}
	
	/**
	* Add new logistic_equipments
	*
	*/
	public function add()
	{
		$this->is_allowed('logistic_equipment_add');

		$this->template->title('Logistic Equipment New');
		$this->render('backend/standart/administrator/logistic_equipment/logistic_equipment_add', $this->data);
	}

	/**
	* Add New Logistic Equipments
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('logistic_equipment_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('logistic_equipment_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type', 'Type', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_equipment_name' => $this->input->post('logistic_equipment_name'),
				'logistic_maker' => $this->input->post('logistic_maker'),
				'logistic_equipment_type' => $this->input->post('logistic_equipment_type'),
				'price' => $this->input->post('price'),
				'quantity' => $this->input->post('quantity'),
				'unit' => $this->input->post('unit'),
			];

			
			$save_logistic_equipment = $this->model_logistic_equipment->store($save_data);

			if ($save_logistic_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_logistic_equipment;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/logistic_equipment/edit/' . $save_logistic_equipment, 'Edit Logistic Equipment'),
						anchor('administrator/logistic_equipment', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/logistic_equipment/edit/' . $save_logistic_equipment, 'Edit Logistic Equipment')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_equipment');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Logistic Equipments
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('logistic_equipment_update');

		$this->data['logistic_equipment'] = $this->model_logistic_equipment->find($id);

		$this->template->title('Logistic Equipment Update');
		$this->render('backend/standart/administrator/logistic_equipment/logistic_equipment_update', $this->data);
	}

	/**
	* Update Logistic Equipments
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('logistic_equipment_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('logistic_equipment_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type', 'Type', 'trim|required');
		$this->form_validation->set_rules('quantity', 'Quantity', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_equipment_name' => $this->input->post('logistic_equipment_name'),
				'logistic_maker' => $this->input->post('logistic_maker'),
				'logistic_equipment_type' => $this->input->post('logistic_equipment_type'),
				'logistic_serial_number' => $this->input->post('logistic_serial_number'),
				'quantity' => $this->input->post('quantity'),
				'unit' => $this->input->post('unit'),
			];

			
			$save_logistic_equipment = $this->model_logistic_equipment->change($id, $save_data);

			if ($save_logistic_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/logistic_equipment', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_equipment');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Logistic Equipments
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('logistic_equipment_delete');

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
            set_message(cclang('has_been_deleted', 'logistic_equipment'), 'success');
        } else {
            set_message(cclang('error_delete', 'logistic_equipment'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Logistic Equipments
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('logistic_equipment_view');

		$this->data['logistic_equipment'] = $this->model_logistic_equipment->join_avaiable()->find($id);

		$this->template->title('Logistic Equipment Detail');
		$this->render('backend/standart/administrator/logistic_equipment/logistic_equipment_view', $this->data);
	}
	
	/**
	* delete Logistic Equipments
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$logistic_equipment = $this->model_logistic_equipment->find($id);

		
		
		return $this->model_logistic_equipment->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('logistic_equipment_export');

		$this->model_logistic_equipment->export('logistic_equipment', 'logistic_equipment');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('logistic_equipment_export');

		$this->model_logistic_equipment->pdf('logistic_equipment', 'logistic_equipment');
	}
        
        // public function get_logistic_maker($logistic_equipment_name){
        //     $logistic_maker= $this->model_logistic_equipment->get_selected_by_name($logistic_equipment_name);
            
        //     $lists = "<option value=''>Select Logistic Maker</option>";
        //     foreach ($logistic_maker as $data) {
        //         $lists .= "<option value='" . $data->logistic_equipment_type_maker . "'>" . $data->logistic_equipment_type_maker . "</option>";
        //     }
        
        //     $callback = array(
        //         'list_logistic_maker' => $lists
        //     );
            
        //     echo json_encode($callback);
        // }

		public function get_logistic_maker(){
			// $logistic_equipment_name =  $this->input->get('logistic_equipment_name'); 
			$logistic_equipment_name=$_GET['logistic_equipment_name'];
			$logistic_maker= $this->model_logistic_equipment->get_selected_by_name($logistic_equipment_name);
            
            $lists = "<option value=''>Select Logistic Maker</option>";
            foreach ($logistic_maker as $data) {
                $lists .= "<option value='" . $data->logistic_equipment_type_maker . "'>" . $data->logistic_equipment_type_maker . "</option>";
            }
        
            $callback = array(
                'list_logistic_maker' => $lists
            );
            
            echo json_encode($callback);
        }
        
        public function get_logistic_equipment_type(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            
            $logistic_equipment_type_types= $this->model_logistic_equipment->get_selected_by_name_maker($logistic_equipment_name,$logistic_equipment_maker);
            
            $lists = "<option value=''>Select Logistic Equipment Type</option>";
            foreach ($logistic_equipment_type_types as $data) {
                $lists .= "<option value='" . $data->logistic_equipment_type_types . "'>" . $data->logistic_equipment_type_types . "</option>";
            }
        
            $callback = array(
                'list_logistic_equipment_type' => $lists
            );
            
            echo json_encode($callback);
        }
        
        
}


/* End of file logistic_equipment.php */
/* Location: ./application/controllers/administrator/Logistic Equipment.php */