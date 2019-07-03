<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Job Status Controller
*| --------------------------------------------------------------------------
*| Job Status site
*|
*/
class Job_status extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_job_status');
	}

	/**
	* show all Job Statuss
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('job_status_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['job_statuss'] = $this->model_job_status->get($filter, $field, $this->limit_page, $offset);
		$this->data['job_status_counts'] = $this->model_job_status->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/job_status/index/',
			'total_rows'   => $this->model_job_status->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Job Status List');
		$this->render('backend/standart/administrator/job_status/job_status_list', $this->data);
	}
	
	/**
	* Add new job_statuss
	*
	*/
	public function add()
	{
		$this->is_allowed('job_status_add');

		$this->template->title('Job Status New');
		$this->render('backend/standart/administrator/job_status/job_status_add', $this->data);
	}

	/**
	* Add New Job Statuss
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('job_status_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('job_status', 'Job Status', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'job_status' => $this->input->post('job_status'),
			];

			
			$save_job_status = $this->model_job_status->store($save_data);

			if ($save_job_status) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_job_status;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/job_status/edit/' . $save_job_status, 'Edit Job Status'),
						anchor('administrator/job_status', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/job_status/edit/' . $save_job_status, 'Edit Job Status')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/job_status');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/job_status');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Job Statuss
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('job_status_update');

		$this->data['job_status'] = $this->model_job_status->find($id);

		$this->template->title('Job Status Update');
		$this->render('backend/standart/administrator/job_status/job_status_update', $this->data);
	}

	/**
	* Update Job Statuss
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('job_status_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('job_status', 'Job Status', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'job_status' => $this->input->post('job_status'),
			];

			
			$save_job_status = $this->model_job_status->change($id, $save_data);

			if ($save_job_status) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/job_status', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/job_status');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/job_status');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Job Statuss
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('job_status_delete');

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
            set_message(cclang('has_been_deleted', 'job_status'), 'success');
        } else {
            set_message(cclang('error_delete', 'job_status'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Job Statuss
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('job_status_view');

		$this->data['job_status'] = $this->model_job_status->join_avaiable()->find($id);

		$this->template->title('Job Status Detail');
		$this->render('backend/standart/administrator/job_status/job_status_view', $this->data);
	}
	
	/**
	* delete Job Statuss
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$job_status = $this->model_job_status->find($id);

		
		
		return $this->model_job_status->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('job_status_export');

		$this->model_job_status->export('job_status', 'job_status');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('job_status_export');

		$this->model_job_status->pdf('job_status', 'job_status');
	}
}


/* End of file job_status.php */
/* Location: ./application/controllers/administrator/Job Status.php */