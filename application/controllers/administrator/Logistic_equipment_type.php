<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Logistic Equipment Type Controller
*| --------------------------------------------------------------------------
*| Logistic Equipment Type site
*|
*/
class Logistic_equipment_type extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_logistic_equipment_type');
	}

	/**
	* show all Logistic Equipment Types
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('logistic_equipment_type_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logistic_equipment_types'] = $this->model_logistic_equipment_type->get($filter, $field, $this->limit_page, $offset);
		$this->data['logistic_equipment_type_counts'] = $this->model_logistic_equipment_type->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/logistic_equipment_type/index/',
			'total_rows'   => $this->model_logistic_equipment_type->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Logistic Equipment Type List');
		$this->render('backend/standart/administrator/logistic_equipment_type/logistic_equipment_type_list', $this->data);
	}
	
	/**
	* Add new logistic_equipment_types
	*
	*/
	public function add()
	{
		$this->is_allowed('logistic_equipment_type_add');

		$this->template->title('Logistic Equipment Type New');
		$this->render('backend/standart/administrator/logistic_equipment_type/logistic_equipment_type_add', $this->data);
	}

	/**
	* Add New Logistic Equipment Types
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('logistic_equipment_type_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('logistic_equipment_type_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type_maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type_types', 'Type', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_equipment_type_name' => $this->input->post('logistic_equipment_type_name'),
				'logistic_equipment_type_maker' => $this->input->post('logistic_equipment_type_maker'),
				'logistic_equipment_type_types' => $this->input->post('logistic_equipment_type_types'),
			];

			
			$save_logistic_equipment_type = $this->model_logistic_equipment_type->store($save_data);

			if ($save_logistic_equipment_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_logistic_equipment_type;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/logistic_equipment_type/edit/' . $save_logistic_equipment_type, 'Edit Logistic Equipment Type'),
						anchor('administrator/logistic_equipment_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/logistic_equipment_type/edit/' . $save_logistic_equipment_type, 'Edit Logistic Equipment Type')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_equipment_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_equipment_type');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Logistic Equipment Types
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('logistic_equipment_type_update');

		$this->data['logistic_equipment_type'] = $this->model_logistic_equipment_type->find($id);

		$this->template->title('Logistic Equipment Type Update');
		$this->render('backend/standart/administrator/logistic_equipment_type/logistic_equipment_type_update', $this->data);
	}

	/**
	* Update Logistic Equipment Types
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('logistic_equipment_type_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('logistic_equipment_type_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type_maker', 'Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type_types', 'Type', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_equipment_type_name' => $this->input->post('logistic_equipment_type_name'),
				'logistic_equipment_type_maker' => $this->input->post('logistic_equipment_type_maker'),
				'logistic_equipment_type_types' => $this->input->post('logistic_equipment_type_types'),
			];

			
			$save_logistic_equipment_type = $this->model_logistic_equipment_type->change($id, $save_data);

			if ($save_logistic_equipment_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/logistic_equipment_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_equipment_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_equipment_type');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Logistic Equipment Types
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('logistic_equipment_type_delete');

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
            set_message(cclang('has_been_deleted', 'logistic_equipment_type'), 'success');
        } else {
            set_message(cclang('error_delete', 'logistic_equipment_type'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Logistic Equipment Types
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('logistic_equipment_type_view');

		$this->data['logistic_equipment_type'] = $this->model_logistic_equipment_type->join_avaiable()->find($id);

		$this->template->title('Logistic Equipment Type Detail');
		$this->render('backend/standart/administrator/logistic_equipment_type/logistic_equipment_type_view', $this->data);
	}
	
	/**
	* delete Logistic Equipment Types
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$logistic_equipment_type = $this->model_logistic_equipment_type->find($id);

		
		
		return $this->model_logistic_equipment_type->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('logistic_equipment_type_export');

		$this->model_logistic_equipment_type->export('logistic_equipment_type', 'logistic_equipment_type');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('logistic_equipment_type_export');

		$this->model_logistic_equipment_type->pdf('logistic_equipment_type', 'logistic_equipment_type');
	}
}


/* End of file logistic_equipment_type.php */
/* Location: ./application/controllers/administrator/Logistic Equipment Type.php */