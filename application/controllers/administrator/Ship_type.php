<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Ship Type Controller
*| --------------------------------------------------------------------------
*| Ship Type site
*|
*/
class Ship_type extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_ship_type');
	}

	/**
	* show all Ship Types
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('ship_type_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['ship_types'] = $this->model_ship_type->get($filter, $field, $this->limit_page, $offset);
		$this->data['ship_type_counts'] = $this->model_ship_type->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/ship_type/index/',
			'total_rows'   => $this->model_ship_type->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ship Type List');
		$this->render('backend/standart/administrator/ship_type/ship_type_list', $this->data);
	}
	
	/**
	* Add new ship_types
	*
	*/
	public function add()
	{
		$this->is_allowed('ship_type_add');

		$this->template->title('Ship Type New');
		$this->render('backend/standart/administrator/ship_type/ship_type_add', $this->data);
	}

	/**
	* Add New Ship Types
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('ship_type_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('ship_type_name', 'Type', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'ship_type_name' => $this->input->post('ship_type_name'),
			];

			
			$save_ship_type = $this->model_ship_type->store($save_data);

			if ($save_ship_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_ship_type;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/ship_type/edit/' . $save_ship_type, 'Edit Ship Type'),
						anchor('administrator/ship_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/ship_type/edit/' . $save_ship_type, 'Edit Ship Type')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_type');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Ship Types
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('ship_type_update');

		$this->data['ship_type'] = $this->model_ship_type->find($id);

		$this->template->title('Ship Type Update');
		$this->render('backend/standart/administrator/ship_type/ship_type_update', $this->data);
	}

	/**
	* Update Ship Types
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('ship_type_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('ship_type_name', 'Type', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'ship_type_name' => $this->input->post('ship_type_name'),
			];

			
			$save_ship_type = $this->model_ship_type->change($id, $save_data);

			if ($save_ship_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/ship_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_type');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Ship Types
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('ship_type_delete');

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
            set_message(cclang('has_been_deleted', 'ship_type'), 'success');
        } else {
            set_message(cclang('error_delete', 'ship_type'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Ship Types
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('ship_type_view');

		$this->data['ship_type'] = $this->model_ship_type->join_avaiable()->find($id);

		$this->template->title('Ship Type Detail');
		$this->render('backend/standart/administrator/ship_type/ship_type_view', $this->data);
	}
	
	/**
	* delete Ship Types
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$ship_type = $this->model_ship_type->find($id);

		
		
		return $this->model_ship_type->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('ship_type_export');

		$this->model_ship_type->export('ship_type', 'ship_type');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('ship_type_export');

		$this->model_ship_type->pdf('ship_type', 'ship_type');
	}
}


/* End of file ship_type.php */
/* Location: ./application/controllers/administrator/Ship Type.php */