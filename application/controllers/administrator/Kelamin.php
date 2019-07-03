<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Kelamin Controller
*| --------------------------------------------------------------------------
*| Kelamin site
*|
*/
class Kelamin extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_kelamin');
	}

	/**
	* show all Kelamins
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('kelamin_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['kelamins'] = $this->model_kelamin->get($filter, $field, $this->limit_page, $offset);
		$this->data['kelamin_counts'] = $this->model_kelamin->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/kelamin/index/',
			'total_rows'   => $this->model_kelamin->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Kelamin List');
		$this->render('backend/standart/administrator/kelamin/kelamin_list', $this->data);
	}
	
	/**
	* Add new kelamins
	*
	*/
	public function add()
	{
		$this->is_allowed('kelamin_add');

		$this->template->title('Kelamin New');
		$this->render('backend/standart/administrator/kelamin/kelamin_add', $this->data);
	}

	/**
	* Add New Kelamins
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('kelamin_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('kelamin', 'Kelamin', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'kelamin' => $this->input->post('kelamin'),
			];

			
			$save_kelamin = $this->model_kelamin->store($save_data);

			if ($save_kelamin) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_kelamin;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/kelamin/edit/' . $save_kelamin, 'Edit Kelamin'),
						anchor('administrator/kelamin', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/kelamin/edit/' . $save_kelamin, 'Edit Kelamin')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kelamin');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kelamin');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Kelamins
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('kelamin_update');

		$this->data['kelamin'] = $this->model_kelamin->find($id);

		$this->template->title('Kelamin Update');
		$this->render('backend/standart/administrator/kelamin/kelamin_update', $this->data);
	}

	/**
	* Update Kelamins
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('kelamin_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('kelamin', 'Kelamin', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'kelamin' => $this->input->post('kelamin'),
			];

			
			$save_kelamin = $this->model_kelamin->change($id, $save_data);

			if ($save_kelamin) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/kelamin', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/kelamin');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/kelamin');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Kelamins
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('kelamin_delete');

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
            set_message(cclang('has_been_deleted', 'kelamin'), 'success');
        } else {
            set_message(cclang('error_delete', 'kelamin'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Kelamins
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('kelamin_view');

		$this->data['kelamin'] = $this->model_kelamin->join_avaiable()->find($id);

		$this->template->title('Kelamin Detail');
		$this->render('backend/standart/administrator/kelamin/kelamin_view', $this->data);
	}
	
	/**
	* delete Kelamins
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$kelamin = $this->model_kelamin->find($id);

		
		
		return $this->model_kelamin->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('kelamin_export');

		$this->model_kelamin->export('kelamin', 'kelamin');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('kelamin_export');

		$this->model_kelamin->pdf('kelamin', 'kelamin');
	}
}


/* End of file kelamin.php */
/* Location: ./application/controllers/administrator/Kelamin.php */