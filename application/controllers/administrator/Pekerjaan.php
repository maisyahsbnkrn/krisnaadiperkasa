<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Pekerjaan Controller
*| --------------------------------------------------------------------------
*| Pekerjaan site
*|
*/
class Pekerjaan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_pekerjaan');
	}

	/**
	* show all Pekerjaans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('pekerjaan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['pekerjaans'] = $this->model_pekerjaan->get($filter, $field, $this->limit_page, $offset);
		$this->data['pekerjaan_counts'] = $this->model_pekerjaan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/pekerjaan/index/',
			'total_rows'   => $this->model_pekerjaan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Pekerjaan List');
		$this->render('backend/standart/administrator/pekerjaan/pekerjaan_list', $this->data);
	}
	
	/**
	* Add new pekerjaans
	*
	*/
	public function add()
	{
		$this->is_allowed('pekerjaan_add');

		$this->template->title('Pekerjaan New');
		$this->render('backend/standart/administrator/pekerjaan/pekerjaan_add', $this->data);
	}

	/**
	* Add New Pekerjaans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('pekerjaan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'pekerjaan' => $this->input->post('pekerjaan'),
			];

			
			$save_pekerjaan = $this->model_pekerjaan->store($save_data);

			if ($save_pekerjaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_pekerjaan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/pekerjaan/edit/' . $save_pekerjaan, 'Edit Pekerjaan'),
						anchor('administrator/pekerjaan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/pekerjaan/edit/' . $save_pekerjaan, 'Edit Pekerjaan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pekerjaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pekerjaan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Pekerjaans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('pekerjaan_update');

		$this->data['pekerjaan'] = $this->model_pekerjaan->find($id);

		$this->template->title('Pekerjaan Update');
		$this->render('backend/standart/administrator/pekerjaan/pekerjaan_update', $this->data);
	}

	/**
	* Update Pekerjaans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('pekerjaan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('pekerjaan', 'Pekerjaan', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'pekerjaan' => $this->input->post('pekerjaan'),
			];

			
			$save_pekerjaan = $this->model_pekerjaan->change($id, $save_data);

			if ($save_pekerjaan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/pekerjaan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/pekerjaan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/pekerjaan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Pekerjaans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('pekerjaan_delete');

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
            set_message(cclang('has_been_deleted', 'pekerjaan'), 'success');
        } else {
            set_message(cclang('error_delete', 'pekerjaan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Pekerjaans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('pekerjaan_view');

		$this->data['pekerjaan'] = $this->model_pekerjaan->join_avaiable()->find($id);

		$this->template->title('Pekerjaan Detail');
		$this->render('backend/standart/administrator/pekerjaan/pekerjaan_view', $this->data);
	}
	
	/**
	* delete Pekerjaans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$pekerjaan = $this->model_pekerjaan->find($id);

		
		
		return $this->model_pekerjaan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('pekerjaan_export');

		$this->model_pekerjaan->export('pekerjaan', 'pekerjaan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('pekerjaan_export');

		$this->model_pekerjaan->pdf('pekerjaan', 'pekerjaan');
	}
}


/* End of file pekerjaan.php */
/* Location: ./application/controllers/administrator/Pekerjaan.php */