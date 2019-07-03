<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Aauth Users Position Controller
*| --------------------------------------------------------------------------
*| Aauth Users Position site
*|
*/
class Aauth_users_position extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_aauth_users_position');
	}

	/**
	* show all Aauth Users Positions
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('aauth_users_position_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['aauth_users_positions'] = $this->model_aauth_users_position->get($filter, $field, $this->limit_page, $offset);
		$this->data['aauth_users_position_counts'] = $this->model_aauth_users_position->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/aauth_users_position/index/',
			'total_rows'   => $this->model_aauth_users_position->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Users Position List');
		$this->render('backend/standart/administrator/aauth_users_position/aauth_users_position_list', $this->data);
	}
	
	/**
	* Add new aauth_users_positions
	*
	*/
	public function add()
	{
		$this->is_allowed('aauth_users_position_add');

		$this->template->title('Users Position New');
		$this->render('backend/standart/administrator/aauth_users_position/aauth_users_position_add', $this->data);
	}

	/**
	* Add New Aauth Users Positions
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('aauth_users_position_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('position_name', 'Position', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'position_name' => $this->input->post('position_name'),
			];

			
			$save_aauth_users_position = $this->model_aauth_users_position->store($save_data);

			if ($save_aauth_users_position) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_aauth_users_position;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/aauth_users_position/edit/' . $save_aauth_users_position, 'Edit Aauth Users Position'),
						anchor('administrator/aauth_users_position', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/aauth_users_position/edit/' . $save_aauth_users_position, 'Edit Aauth Users Position')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/aauth_users_position');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/aauth_users_position');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Aauth Users Positions
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('aauth_users_position_update');

		$this->data['aauth_users_position'] = $this->model_aauth_users_position->find($id);

		$this->template->title('Users Position Update');
		$this->render('backend/standart/administrator/aauth_users_position/aauth_users_position_update', $this->data);
	}

	/**
	* Update Aauth Users Positions
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('aauth_users_position_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('position_name', 'Position', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'position_name' => $this->input->post('position_name'),
			];

			
			$save_aauth_users_position = $this->model_aauth_users_position->change($id, $save_data);

			if ($save_aauth_users_position) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/aauth_users_position', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/aauth_users_position');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/aauth_users_position');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Aauth Users Positions
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('aauth_users_position_delete');

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
            set_message(cclang('has_been_deleted', 'aauth_users_position'), 'success');
        } else {
            set_message(cclang('error_delete', 'aauth_users_position'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Aauth Users Positions
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('aauth_users_position_view');

		$this->data['aauth_users_position'] = $this->model_aauth_users_position->join_avaiable()->find($id);

		$this->template->title('Users Position Detail');
		$this->render('backend/standart/administrator/aauth_users_position/aauth_users_position_view', $this->data);
	}
	
	/**
	* delete Aauth Users Positions
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$aauth_users_position = $this->model_aauth_users_position->find($id);

		
		
		return $this->model_aauth_users_position->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('aauth_users_position_export');

		$this->model_aauth_users_position->export('aauth_users_position', 'aauth_users_position');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('aauth_users_position_export');

		$this->model_aauth_users_position->pdf('aauth_users_position', 'aauth_users_position');
	}
}


/* End of file aauth_users_position.php */
/* Location: ./application/controllers/administrator/Aauth Users Position.php */