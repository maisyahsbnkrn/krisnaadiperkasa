<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Task Sparepart Controller
*| --------------------------------------------------------------------------
*| Task Sparepart site
*|
*/
class Task_sparepart extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_task_sparepart');
	}

	/**
	* show all Task Spareparts
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('task_sparepart_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['task_spareparts'] = $this->model_task_sparepart->get($filter, $field, $this->limit_page, $offset);
		$this->data['task_sparepart_counts'] = $this->model_task_sparepart->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/task_sparepart/index/',
			'total_rows'   => $this->model_task_sparepart->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Task Sparepart List');
		$this->render('backend/standart/administrator/task_sparepart/task_sparepart_list', $this->data);
	}
        
        public function ap($order_number)
	{
	    $this->is_allowed('task_sparepart_add');
	    
	    $this->data['order_number'] = $order_number;
            
	    $this->template->title('Input Logistic Sparepart');
	    $this->render('backend/standart/administrator/task_sparepart/task_sparepart_add', $this->data);
	}
	
	/**
	* Add new task_spareparts
	*
	*/
	public function add()
	{
		$this->is_allowed('task_sparepart_add');

		$this->template->title('Task Sparepart New');
		$this->render('backend/standart/administrator/task_sparepart/task_sparepart_add', $this->data);
	}

	/**
	* Add New Task Spareparts
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('task_sparepart_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('order_number_task', 'Order Number', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('task_equipment_sparepart_name', 'Equipment Name', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_equipment_sparepart_maker', 'Equipment Maker', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_equipment_sparepart_type', 'Equipment Type', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_name', 'Sparepart Name', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_type', 'Sparepart Type', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_quantity', 'Quantity', 'trim|required|max_length[11]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'order_number_task' => $this->input->post('order_number_task'),
				'task_equipment_sparepart_name' => $this->input->post('task_equipment_sparepart_name'),
				'task_equipment_sparepart_maker' => $this->input->post('task_equipment_sparepart_maker'),
				'task_equipment_sparepart_type' => $this->input->post('task_equipment_sparepart_type'),
				'task_sparepart_name' => $this->input->post('task_sparepart_name'),
				'task_sparepart_type' => $this->input->post('task_sparepart_type'),
				'task_sparepart_quantity' => $this->input->post('task_sparepart_quantity'),
			];

			$task_equipment_sparepart_name = $this->input->post('task_equipment_sparepart_name');
                        $task_equipment_sparepart_maker = $this->input->post('task_equipment_sparepart_maker');
                        $task_equipment_sparepart_type = $this->input->post('task_equipment_sparepart_type');
                        $task_sparepart_name = $this->input->post('task_sparepart_name');
                        $task_sparepart_type = $this->input->post('task_sparepart_type');
                        $task_sparepart_stock = $this->input->post('task_sparepart_stock');
                        $task_sparepart_quantity = $this->input->post('task_sparepart_quantity');
                        $task_sparepart_stock_available = $task_sparepart_stock-$task_sparepart_quantity;
                        
			$save_task_sparepart = $this->model_task_sparepart->store($save_data);
                        $this->model_task_sparepart->update_stock($task_equipment_sparepart_name,$task_equipment_sparepart_maker,$task_equipment_sparepart_type,$task_sparepart_name,$task_sparepart_type,$task_sparepart_stock_available);

			if ($save_task_sparepart) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_task_sparepart;
					$this->data['message'] = "Your data has been successfully saved into the database.";
 
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/task_sparepart/edit/' . $save_task_sparepart, 'Edit Task Sparepart')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/task_sparepart');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/task_sparepart');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Task Spareparts
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('task_sparepart_update');

		$this->data['task_sparepart'] = $this->model_task_sparepart->find($id);

		$this->template->title('Task Sparepart Update');
		$this->render('backend/standart/administrator/task_sparepart/task_sparepart_update', $this->data);
	}

	/**
	* Update Task Spareparts
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('task_sparepart_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('order_number_task', 'Order Number', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('task_equipment_sparepart_name', 'Equipment Name', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_equipment_sparepart_maker', 'Equipment Maker', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_equipment_sparepart_type', 'Equipment Type', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_name', 'Sparepart Name', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_type', 'Sparepart Type', 'trim|required|max_length[250]');
		$this->form_validation->set_rules('task_sparepart_quantity', 'Quantity', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'order_number_task' => $this->input->post('order_number_task'),
				'task_equipment_sparepart_name' => $this->input->post('task_equipment_sparepart_name'),
				'task_equipment_sparepart_maker' => $this->input->post('task_equipment_sparepart_maker'),
				'task_equipment_sparepart_type' => $this->input->post('task_equipment_sparepart_type'),
				'task_sparepart_name' => $this->input->post('task_sparepart_name'),
				'task_sparepart_type' => $this->input->post('task_sparepart_type'),
				'task_sparepart_quantity' => $this->input->post('task_sparepart_quantity'),
			];

			
			$save_task_sparepart = $this->model_task_sparepart->change($id, $save_data);

			if ($save_task_sparepart) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/task_sparepart', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/task_sparepart');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/task_sparepart');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Task Spareparts
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('task_sparepart_delete');

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
            set_message(cclang('has_been_deleted', 'task_sparepart'), 'success');
        } else {
            set_message(cclang('error_delete', 'task_sparepart'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Task Spareparts
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('task_sparepart_view');

		$this->data['task_sparepart'] = $this->model_task_sparepart->join_avaiable()->find($id);

		$this->template->title('Task Sparepart Detail');
		$this->render('backend/standart/administrator/task_sparepart/task_sparepart_view', $this->data);
	}
	
	/**
	* delete Task Spareparts
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$task_sparepart = $this->model_task_sparepart->find($id);

		
		
		return $this->model_task_sparepart->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('task_sparepart_export');

		$this->model_task_sparepart->export('task_sparepart', 'task_sparepart');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('task_sparepart_export');

		$this->model_task_sparepart->pdf('task_sparepart', 'task_sparepart');
	}
        
        public function get_logistic_maker($logistic_equipment_name){
            $logistic_maker= $this->model_task_sparepart->get_selected_by_name($logistic_equipment_name);
            
            $lists = "<option value=''>Select Equipment Maker</option>";
            foreach ($logistic_maker as $data) {
                $lists .= "<option value='" . $data->logistic_sparepart_equipment_maker . "'>" . $data->logistic_sparepart_equipment_maker . "</option>";
            }
        
            $callback = array(
                'list_logistic_maker' => $lists
            );
            
            echo json_encode($callback);
        }
        
        public function get_logistic_equipment_type(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            
            $logistic_equipment_type_types= $this->model_task_sparepart->get_selected_by_name_maker($logistic_equipment_name,$logistic_equipment_maker);
            
            $lists = "<option value=''>Select Logistic Equipment Type</option>";
            foreach ($logistic_equipment_type_types as $data) {
                $lists .= "<option value='" . $data->logistic_sparepart_equipment_type . "'>" . $data->logistic_sparepart_equipment_type . "</option>";
            }
        
            $callback = array(
                'list_logistic_equipment_type' => $lists
            );
            
            echo json_encode($callback);
        }
        
         public function get_logistic_sparepart_name(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            $logistic_equipment_type = $this->input->get('logistic_equipment_type'); 
             
            $logistic_sparepart_names= $this->model_task_sparepart->get_selected_by_name_maker_type($logistic_equipment_name,$logistic_equipment_maker,$logistic_equipment_type);
            
            $lists = "<option value=''>Select Logistic Sparepart Name</option>";
            foreach ($logistic_sparepart_names as $data) {
                $lists .= "<option value='" . $data->logistic_sparepart_name . "'>" . $data->logistic_sparepart_name . "</option>";
            }
        
            $callback = array(
                'list_logistic_sparepart_name' => $lists
            );
            
            echo json_encode($callback);
        }
        
        public function get_logistic_sparepart_type(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            $logistic_equipment_type = $this->input->get('logistic_equipment_type'); 
            $task_sparepart_name = $this->input->get('task_sparepart_name'); 
             
            $logistic_sparepart_types= $this->model_task_sparepart->get_selected_by_name_maker_type_name($logistic_equipment_name,$logistic_equipment_maker,$logistic_equipment_type,$task_sparepart_name);
            
            $lists = "<option value=''>Select Logistic Sparepart Type</option>";
            foreach ($logistic_sparepart_types as $data) {
                $lists .= "<option value='" . $data->logistic_sparepart_type . "'>" . $data->logistic_sparepart_type . "</option>";
            }
        
            $callback = array(
                'list_logistic_sparepart_type' => $lists
            );
            
            echo json_encode($callback);
        }
        
         public function get_logistic_sparepart_stock(){
            $logistic_equipment_name =  $this->input->get('logistic_equipment_name');  
            $logistic_equipment_maker = $this->input->get('logistic_equipment_maker');  
            $logistic_equipment_type = $this->input->get('logistic_equipment_type'); 
            $task_sparepart_name = $this->input->get('task_sparepart_name');  
            $task_sparepart_type = $this->input->get('task_sparepart_type');  
            
            $logistic_sparepart_stock= $this->model_task_sparepart->get_selected_by_name_maker_type_name_type($logistic_equipment_name,$logistic_equipment_maker,$logistic_equipment_type,$task_sparepart_name,$task_sparepart_type);
            
            foreach ($logistic_sparepart_stock as $data) {
                $lists = $data->quantity ;
            }
        
            $callback = array(
                'list_logistic_sparepart_stock' => $lists
            );
            
            echo json_encode($callback);
        }
        
}


/* End of file task_sparepart.php */
/* Location: ./application/controllers/administrator/Task Sparepart.php */