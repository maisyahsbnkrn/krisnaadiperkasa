<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Unit Controller
*| --------------------------------------------------------------------------
*| Unit site
*|
*/
class Unit extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_unit');
	}

	/**
	* show all Units
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('unit_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['units'] = $this->model_unit->get($filter, $field, $this->limit_page, $offset);
		$this->data['unit_counts'] = $this->model_unit->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/unit/index/',
			'total_rows'   => $this->model_unit->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Unit List');
		$this->render('backend/standart/administrator/unit/unit_list', $this->data);
	}
	
	/**
	* Add new units
	*
	*/
	public function add()
	{
		$this->is_allowed('unit_add');

		$this->template->title('Unit New');
		$this->render('backend/standart/administrator/unit/unit_add', $this->data);
	}

	/**
	* Add New Units
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('unit_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('name_unit', 'Name', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_unit' => $this->input->post('name_unit'),
			];

			
			$save_unit = $this->model_unit->store($save_data);

			if ($save_unit) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_unit;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/unit/edit/' . $save_unit, 'Edit Unit'),
						anchor('administrator/unit', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/unit/edit/' . $save_unit, 'Edit Unit')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/unit');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/unit');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Units
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('unit_update');

		$this->data['unit'] = $this->model_unit->find($id);

		$this->template->title('Unit Update');
		$this->render('backend/standart/administrator/unit/unit_update', $this->data);
	}

	/**
	* Update Units
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('unit_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('name_unit', 'Name', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_unit' => $this->input->post('name_unit'),
			];

			
			$save_unit = $this->model_unit->change($id, $save_data);

			if ($save_unit) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/unit', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/unit');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/unit');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Units
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('unit_delete');

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
            set_message(cclang('has_been_deleted', 'unit'), 'success');
        } else {
            set_message(cclang('error_delete', 'unit'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Units
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('unit_view');

		$this->data['unit'] = $this->model_unit->join_avaiable()->find($id);

		$this->template->title('Unit Detail');
		$this->render('backend/standart/administrator/unit/unit_view', $this->data);
	}
	
	/**
	* delete Units
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$unit = $this->model_unit->find($id);

		
		
		return $this->model_unit->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('unit_export');

		$this->model_unit->export('unit', 'unit');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('unit_export');

		$this->model_unit->pdf('unit', 'unit');
	}
}


/* End of file unit.php */
/* Location: ./application/controllers/administrator/Unit.php */