<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Ship Controller
*| --------------------------------------------------------------------------
*| Ship site
*|
*/
class Ship extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_ship');
	}

	/**
	* show all Ships
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('ship_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['ships'] = $this->model_ship->get($filter, $field, $this->limit_page, $offset);
		$this->data['ship_counts'] = $this->model_ship->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/ship/index/',
			'total_rows'   => $this->model_ship->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ship List');
		$this->render('backend/standart/administrator/ship/ship_list', $this->data);
	}
	
	/**
	* Add new ships
	*
	*/
	public function add()
	{
		$this->is_allowed('ship_add');

		$this->template->title('Ship New');
		$this->render('backend/standart/administrator/ship/ship_add', $this->data);
	}

	/**
	* Add New Ships
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('ship_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('ship_type', 'Ship Type', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'company' => $this->input->post('company'),
				'pic' => $this->input->post('pic'),
				'contact_number' => $this->input->post('contact_number'),
				'ship_name' => $this->input->post('ship_name'),
				'ship_type' => $this->input->post('ship_type'),
				'management_company' => $this->input->post('management_company'),
				'groos_ton' => $this->input->post('groos_ton'),
				'class' => $this->input->post('class'),
				'flag' => $this->input->post('flag'),
				'imo' => $this->input->post('imo'),
				'mmsi' => $this->input->post('mmsi'),
				'annual_survey' => $this->input->post('annual_survey'),
                                'pic_email' => $this->input->post('pic_email'),
			];

			
			$save_ship = $this->model_ship->store($save_data);

			if ($save_ship) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_ship;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/ship/edit/' . $save_ship, 'Edit Ship'),
						anchor('administrator/ship', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/ship/edit/' . $save_ship, 'Edit Ship')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Ships
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('ship_update');

		$this->data['ship'] = $this->model_ship->find($id);

		$this->template->title('Ship Update');
		$this->render('backend/standart/administrator/ship/ship_update', $this->data);
	}

	/**
	* Update Ships
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('ship_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('ship_type', 'Ship Type', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'company' => $this->input->post('company'),
				'pic' => $this->input->post('pic'),
				'contact_number' => $this->input->post('contact_number'),
				'ship_name' => $this->input->post('ship_name'),
				'ship_type' => $this->input->post('ship_type'),
				'management_company' => $this->input->post('management_company'),
				'groos_ton' => $this->input->post('groos_ton'),
				'class' => $this->input->post('class'),
				'flag' => $this->input->post('flag'),
				'imo' => $this->input->post('imo'),
				'mmsi' => $this->input->post('mmsi'),
				'annual_survey' => $this->input->post('annual_survey'),
				'pic_email' => $this->input->post('pic_email'),
				
			];

			
			$save_ship = $this->model_ship->change($id, $save_data);

			if ($save_ship) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/ship', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Ships
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('ship_delete');

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
            set_message(cclang('has_been_deleted', 'ship'), 'success');
        } else {
            set_message(cclang('error_delete', 'ship'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Ships
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('ship_view');

		$this->data['ship'] = $this->model_ship->join_avaiable()->find($id);

		$this->template->title('Ship Detail');
		$this->render('backend/standart/administrator/ship/ship_view', $this->data);
	}
	
	/**
	* delete Ships
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$ship = $this->model_ship->find($id);

		
		
		return $this->model_ship->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('ship_export');

		$this->model_ship->export('ship', 'ship');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('ship_export');

		$this->model_ship->pdf('ship', 'ship');
	}
}


/* End of file ship.php */
/* Location: ./application/controllers/administrator/Ship.php */