<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Hari Controller
*| --------------------------------------------------------------------------
*| Hari site
*|
*/
class Hari extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_hari');
	}

	/**
	* show all Haris
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('hari_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['haris'] = $this->model_hari->get($filter, $field, $this->limit_page, $offset);
		$this->data['hari_counts'] = $this->model_hari->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/hari/index/',
			'total_rows'   => $this->model_hari->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Hari List');
		$this->render('backend/standart/administrator/hari/hari_list', $this->data);
	}
	
	/**
	* Add new haris
	*
	*/
	public function add()
	{
		$this->is_allowed('hari_add');

		$this->template->title('Hari New');
		$this->render('backend/standart/administrator/hari/hari_add', $this->data);
	}

	/**
	* Add New Haris
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('hari_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('hari', 'Hari', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'hari' => $this->input->post('hari'),
			];

			
			$save_hari = $this->model_hari->store($save_data);

			if ($save_hari) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_hari;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/hari/edit/' . $save_hari, 'Edit Hari'),
						anchor('administrator/hari', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/hari/edit/' . $save_hari, 'Edit Hari')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/hari');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/hari');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Haris
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('hari_update');

		$this->data['hari'] = $this->model_hari->find($id);

		$this->template->title('Hari Update');
		$this->render('backend/standart/administrator/hari/hari_update', $this->data);
	}

	/**
	* Update Haris
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('hari_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('hari', 'Hari', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'hari' => $this->input->post('hari'),
			];

			
			$save_hari = $this->model_hari->change($id, $save_data);

			if ($save_hari) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/hari', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/hari');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/hari');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Haris
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('hari_delete');

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
            set_message(cclang('has_been_deleted', 'hari'), 'success');
        } else {
            set_message(cclang('error_delete', 'hari'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Haris
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('hari_view');

		$this->data['hari'] = $this->model_hari->join_avaiable()->find($id);

		$this->template->title('Hari Detail');
		$this->render('backend/standart/administrator/hari/hari_view', $this->data);
	}
	
	/**
	* delete Haris
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$hari = $this->model_hari->find($id);

		
		
		return $this->model_hari->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('hari_export');

		$this->model_hari->export('hari', 'hari');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('hari_export');

		$this->model_hari->pdf('hari', 'hari');
	}
}


/* End of file hari.php */
/* Location: ./application/controllers/administrator/Hari.php */