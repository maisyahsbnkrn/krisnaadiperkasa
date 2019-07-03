<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Task Equipment Controller
*| --------------------------------------------------------------------------
*| Task Equipment site
*|
*/
class Task_equipment extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_task_equipment');
	}

	/**
	* show all Task Equipments
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('task_equipment_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['task_equipments'] = $this->model_task_equipment->get($filter, $field, $this->limit_page, $offset);
		$this->data['task_equipment_counts'] = $this->model_task_equipment->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/task_equipment/index/',
			'total_rows'   => $this->model_task_equipment->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Task Equipment List');
		$this->render('backend/standart/administrator/task_equipment/task_equipment_list', $this->data);
	}
        
        public function ap($order_number)
	{
	    $this->is_allowed('task_equipment_add');
	    
	    $this->data['order_number'] = $order_number;
            
	    $this->template->title('Input Logistic Equipment');
	    $this->render('backend/standart/administrator/task_equipment/task_equipment_add', $this->data);
	}
	
	/**
	* Add new task_equipments
	*
	*/
	public function add()
	{
		$this->is_allowed('task_equipment_add');

		$this->template->title('Task Equipment New');
		$this->render('backend/standart/administrator/task_equipment/task_equipment_add', $this->data);
	}

	/**
	* Add New Task Equipments
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('task_equipment_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('order_number_task', 'Order Number', 'trim|required');
		$this->form_validation->set_rules('task_equipment_name', 'Equipment Name', 'trim|required');
		$this->form_validation->set_rules('task_equipment_maker', 'Equipment Maker', 'trim|required');
		$this->form_validation->set_rules('task_equipment_type', 'Equipment Type', 'trim|required');
		$this->form_validation->set_rules('task_equipment_quantity', 'Quantity', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'order_number_task' => $this->input->post('order_number_task'),
				'task_equipment_name' => $this->input->post('task_equipment_name'),
				'task_equipment_maker' => $this->input->post('task_equipment_maker'),
				'task_equipment_type' => $this->input->post('task_equipment_type'),
				'task_equipment_quantity' => $this->input->post('task_equipment_quantity'),
			];

			$task_equipment_name = $this->input->post('task_equipment_name');
                        $task_equipment_maker = $this->input->post('task_equipment_maker');
                        $task_equipment_type = $this->input->post('task_equipment_type');
                        $task_equipment_stock = $this->input->post('task_equipment_stock');
                        $task_equipment_quantity = $this->input->post('task_equipment_quantity');
                        $task_equipment_stock_available = $task_equipment_stock-$task_equipment_quantity;
                        
			$save_task_equipment = $this->model_task_equipment->store($save_data);
                        $this->model_task_equipment->update_stock($task_equipment_name,$task_equipment_maker,$task_equipment_type,$task_equipment_stock_available);

			if ($save_task_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] = $save_task_equipment;
					$this->data['message'] = "Your data has been successfully saved into the database.";
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/task_equipment/edit/' . $save_task_equipment, 'Edit Task Equipment')
					]), 'success');

                                        $this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/task_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
                                        $this->data['success'] = false;
                                        $this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/task_equipment');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Task Equipments
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('task_equipment_update');

		$this->data['task_equipment'] = $this->model_task_equipment->find($id);

		$this->template->title('Task Equipment Update');
		$this->render('backend/standart/administrator/task_equipment/task_equipment_update', $this->data);
	}

	/**
	* Update Task Equipments
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('task_equipment_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('order_number_task', 'Order Number', 'trim|required');
		$this->form_validation->set_rules('task_equipment_name', 'Equipment Name', 'trim|required');
		$this->form_validation->set_rules('task_equipment_maker', 'Equipment Maker', 'trim|required');
		$this->form_validation->set_rules('task_equipment_type', 'Equipment Type', 'trim|required');
		$this->form_validation->set_rules('task_equipment_quantity', 'Quantity', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'order_number_task' => $this->input->post('order_number_task'),
				'task_equipment_name' => $this->input->post('task_equipment_name'),
				'task_equipment_maker' => $this->input->post('task_equipment_maker'),
				'task_equipment_type' => $this->input->post('task_equipment_type'),
				'task_equipment_quantity' => $this->input->post('task_equipment_quantity'),
			];

			
			$save_task_equipment = $this->model_task_equipment->change($id, $save_data);

			if ($save_task_equipment) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/task_equipment', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/task_equipment');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/task_equipment');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Task Equipments
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('task_equipment_delete');

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
            set_message(cclang('has_been_deleted', 'task_equipment'), 'success');
        } else {
            set_message(cclang('error_delete', 'task_equipment'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Task Equipments
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('task_equipment_view');

		$this->data['task_equipment'] = $this->model_task_equipment->join_avaiable()->find($id);

		$this->template->title('Task Equipment Detail');
		$this->render('backend/standart/administrator/task_equipment/task_equipment_view', $this->data);
	}
	
	/**
	* delete Task Equipments
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$task_equipment = $this->model_task_equipment->find($id);

		
		
		return $this->model_task_equipment->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('task_equipment_export');

		$this->model_task_equipment->export('task_equipment', 'task_equipment');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('task_equipment_export');

		$this->model_task_equipment->pdf('task_equipment', 'task_equipment');
	}
        
         public function get_logistic_maker($logistic_equipment_name){
            $logistic_maker= $this->model_task_equipment->get_selected_by_name($logistic_equipment_name);
            
            $lists = "<option value=''>Select Equipment Maker</option>";
            foreach ($logistic_maker as $data) {
                $lists .= "<option value='" . $data->logistic_maker . "'>" . $data->logistic_maker . "</option>";
            }
        
            $callback = array(
                'list_logistic_maker' => $lists
            );
            
            echo json_encode($callback);
        }
        
        public function get_logistic_equipment_type(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            
            $logistic_equipment_type_types= $this->model_task_equipment->get_selected_by_name_maker($logistic_equipment_name,$logistic_equipment_maker);
            
            $lists = "<option value=''>Select Logistic Equipment Type</option>";
            foreach ($logistic_equipment_type_types as $data) {
                $lists .= "<option value='" . $data->logistic_equipment_type . "'>" . $data->logistic_equipment_type . "</option>";
            }
        
            $callback = array(
                'list_logistic_equipment_type' => $lists
            );
            
            echo json_encode($callback);
        }
       
         public function get_logistic_equipment_stock(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            $logistic_equipment_type = $this->input->get('logistic_equipment_type');  
            
            $logistic_equipment_stock= $this->model_task_equipment->get_selected_by_name_maker_type($logistic_equipment_name,$logistic_equipment_maker,$logistic_equipment_type);
            
            foreach ($logistic_equipment_stock as $data) {
                $lists = $data->quantity ;
            }
        
            $callback = array(
                'list_logistic_equipment_stock' => $lists
            );
            
            echo json_encode($callback);
        }
}


/* End of file task_equipment.php */
/* Location: ./application/controllers/administrator/Task Equipment.php */