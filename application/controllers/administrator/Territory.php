<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Territory Controller
*| --------------------------------------------------------------------------
*| Territory site
*|
*/
class Territory extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_territory');
	}

	/**
	* show all Territorys
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('territory_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['territorys'] = $this->model_territory->get($filter, $field, $this->limit_page, $offset);
		$this->data['territory_counts'] = $this->model_territory->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/territory/index/',
			'total_rows'   => $this->model_territory->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Territory List');
		$this->render('backend/standart/administrator/territory/territory_list', $this->data);
	}
	
	/**
	* Add new territorys
	*
	*/
	public function add()
	{
		$this->is_allowed('territory_add');

		$this->template->title('Territory New');
		$this->render('backend/standart/administrator/territory/territory_add', $this->data);
	}

	/**
	* Add New Territorys
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('territory_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('territory_name', 'Name', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'territory_name' => $this->input->post('territory_name'),
			];

			
			$save_territory = $this->model_territory->store($save_data);

			if ($save_territory) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_territory;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/territory/edit/' . $save_territory, 'Edit Territory'),
						anchor('administrator/territory', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/territory/edit/' . $save_territory, 'Edit Territory')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/territory');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/territory');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Territorys
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('territory_update');

		$this->data['territory'] = $this->model_territory->find($id);

		$this->template->title('Territory Update');
		$this->render('backend/standart/administrator/territory/territory_update', $this->data);
	}

	/**
	* Update Territorys
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('territory_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('territory_name', 'Name', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'territory_name' => $this->input->post('territory_name'),
			];

			
			$save_territory = $this->model_territory->change($id, $save_data);

			if ($save_territory) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/territory', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/territory');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/territory');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Territorys
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('territory_delete');

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
            set_message(cclang('has_been_deleted', 'territory'), 'success');
        } else {
            set_message(cclang('error_delete', 'territory'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Territorys
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('territory_view');

		$this->data['territory'] = $this->model_territory->join_avaiable()->find($id);

		$this->template->title('Territory Detail');
		$this->render('backend/standart/administrator/territory/territory_view', $this->data);
	}
	
	/**
	* delete Territorys
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$territory = $this->model_territory->find($id);

		
		
		return $this->model_territory->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('territory_export');

		$this->model_territory->export('territory', 'territory');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('territory_export');

		$this->model_territory->pdf('territory', 'territory');
	}
}


/* End of file territory.php */
/* Location: ./application/controllers/administrator/Territory.php */