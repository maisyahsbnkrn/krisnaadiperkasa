<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Scope Types Controller
*| --------------------------------------------------------------------------
*| Scope Types site
*|
*/
class Scope_types extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_scope_types');
	}

	/**
	* show all Scope Typess
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('scope_types_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['scope_typess'] = $this->model_scope_types->get($filter, $field, $this->limit_page, $offset);
		$this->data['scope_types_counts'] = $this->model_scope_types->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/scope_types/index/',
			'total_rows'   => $this->model_scope_types->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Scope Types List');
		$this->render('backend/standart/administrator/scope_types/scope_types_list', $this->data);
	}
	
	/**
	* Add new scope_typess
	*
	*/
	public function add()
	{
		$this->is_allowed('scope_types_add');

		$this->template->title('Scope Types New');
		$this->render('backend/standart/administrator/scope_types/scope_types_add', $this->data);
	}

	/**
	* Add New Scope Typess
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('scope_types_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('name_scope_type', 'Name Scope Type', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_scope_type' => $this->input->post('name_scope_type'),
			];

			
			$save_scope_types = $this->model_scope_types->store($save_data);

			if ($save_scope_types) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_scope_types;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/scope_types/edit/' . $save_scope_types, 'Edit Scope Types'),
						anchor('administrator/scope_types', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/scope_types/edit/' . $save_scope_types, 'Edit Scope Types')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/scope_types');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/scope_types');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Scope Typess
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('scope_types_update');

		$this->data['scope_types'] = $this->model_scope_types->find($id);

		$this->template->title('Scope Types Update');
		$this->render('backend/standart/administrator/scope_types/scope_types_update', $this->data);
	}

	/**
	* Update Scope Typess
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('scope_types_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('name_scope_type', 'Name Scope Type', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_scope_type' => $this->input->post('name_scope_type'),
			];

			
			$save_scope_types = $this->model_scope_types->change($id, $save_data);

			if ($save_scope_types) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/scope_types', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/scope_types');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/scope_types');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Scope Typess
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('scope_types_delete');

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
            set_message(cclang('has_been_deleted', 'scope_types'), 'success');
        } else {
            set_message(cclang('error_delete', 'scope_types'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Scope Typess
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('scope_types_view');

		$this->data['scope_types'] = $this->model_scope_types->join_avaiable()->find($id);

		$this->template->title('Scope Types Detail');
		$this->render('backend/standart/administrator/scope_types/scope_types_view', $this->data);
	}
	
	/**
	* delete Scope Typess
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$scope_types = $this->model_scope_types->find($id);

		
		
		return $this->model_scope_types->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('scope_types_export');

		$this->model_scope_types->export('scope_types', 'scope_types');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('scope_types_export');

		$this->model_scope_types->pdf('scope_types', 'scope_types');
	}
}


/* End of file scope_types.php */
/* Location: ./application/controllers/administrator/Scope Types.php */