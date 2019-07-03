<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Survey Type Controller
*| --------------------------------------------------------------------------
*| Survey Type site
*|
*/
class Survey_type extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_survey_type');
	}

	/**
	* show all Survey Types
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('survey_type_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['survey_types'] = $this->model_survey_type->get($filter, $field, $this->limit_page, $offset);
		$this->data['survey_type_counts'] = $this->model_survey_type->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/survey_type/index/',
			'total_rows'   => $this->model_survey_type->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Survey Type List');
		$this->render('backend/standart/administrator/survey_type/survey_type_list', $this->data);
	}
	
	/**
	* Add new survey_types
	*
	*/
	public function add()
	{
		$this->is_allowed('survey_type_add');

		$this->template->title('Survey Type New');
		$this->render('backend/standart/administrator/survey_type/survey_type_add', $this->data);
	}

	/**
	* Add New Survey Types
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('survey_type_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('name_survey_type', 'Survey Type', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_survey_type' => $this->input->post('name_survey_type'),
			];

			
			$save_survey_type = $this->model_survey_type->store($save_data);

			if ($save_survey_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_survey_type;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/survey_type/edit/' . $save_survey_type, 'Edit Survey Type'),
						anchor('administrator/survey_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/survey_type/edit/' . $save_survey_type, 'Edit Survey Type')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/survey_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/survey_type');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Survey Types
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('survey_type_update');

		$this->data['survey_type'] = $this->model_survey_type->find($id);

		$this->template->title('Survey Type Update');
		$this->render('backend/standart/administrator/survey_type/survey_type_update', $this->data);
	}

	/**
	* Update Survey Types
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('survey_type_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('name_survey_type', 'Survey Type', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'name_survey_type' => $this->input->post('name_survey_type'),
			];

			
			$save_survey_type = $this->model_survey_type->change($id, $save_data);

			if ($save_survey_type) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/survey_type', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/survey_type');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/survey_type');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Survey Types
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('survey_type_delete');

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
            set_message(cclang('has_been_deleted', 'survey_type'), 'success');
        } else {
            set_message(cclang('error_delete', 'survey_type'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Survey Types
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('survey_type_view');

		$this->data['survey_type'] = $this->model_survey_type->join_avaiable()->find($id);

		$this->template->title('Survey Type Detail');
		$this->render('backend/standart/administrator/survey_type/survey_type_view', $this->data);
	}
	
	/**
	* delete Survey Types
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$survey_type = $this->model_survey_type->find($id);

		
		
		return $this->model_survey_type->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('survey_type_export');

		$this->model_survey_type->export('survey_type', 'survey_type');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('survey_type_export');

		$this->model_survey_type->pdf('survey_type', 'survey_type');
	}
}


/* End of file survey_type.php */
/* Location: ./application/controllers/administrator/Survey Type.php */