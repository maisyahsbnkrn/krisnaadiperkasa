<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Contract Controller
*| --------------------------------------------------------------------------
*| Contract site
*|
*/
class Contract extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_contract');
	}

	/**
	* show all Contracts
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('contract_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['contracts'] = $this->model_contract->get($filter, $field, $this->limit_page, $offset);
		$this->data['contract_counts'] = $this->model_contract->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/contract/index/',
			'total_rows'   => $this->model_contract->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Contract List');
		$this->render('backend/standart/administrator/contract/contract_list', $this->data);
	}
	
	/**
	* Add new contracts
	*
	*/
	public function add()
	{
		$this->is_allowed('contract_add');

		$this->template->title('Contract New');
		$this->render('backend/standart/administrator/contract/contract_add', $this->data);
	}

	/**
	* Add New Contracts
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('contract_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('contract_name', 'Name', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'contract_name' => $this->input->post('contract_name'),
			];

			
			$save_contract = $this->model_contract->store($save_data);

			if ($save_contract) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_contract;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/contract/edit/' . $save_contract, 'Edit Contract'),
						anchor('administrator/contract', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/contract/edit/' . $save_contract, 'Edit Contract')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/contract');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/contract');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Contracts
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('contract_update');

		$this->data['contract'] = $this->model_contract->find($id);

		$this->template->title('Contract Update');
		$this->render('backend/standart/administrator/contract/contract_update', $this->data);
	}

	/**
	* Update Contracts
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('contract_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('contract_name', 'Name', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'contract_name' => $this->input->post('contract_name'),
			];

			
			$save_contract = $this->model_contract->change($id, $save_data);

			if ($save_contract) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/contract', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/contract');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/contract');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Contracts
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('contract_delete');

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
            set_message(cclang('has_been_deleted', 'contract'), 'success');
        } else {
            set_message(cclang('error_delete', 'contract'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Contracts
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('contract_view');

		$this->data['contract'] = $this->model_contract->join_avaiable()->find($id);

		$this->template->title('Contract Detail');
		$this->render('backend/standart/administrator/contract/contract_view', $this->data);
	}
	
	/**
	* delete Contracts
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$contract = $this->model_contract->find($id);

		
		
		return $this->model_contract->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('contract_export');

		$this->model_contract->export('contract', 'contract');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('contract_export');

		$this->model_contract->pdf('contract', 'contract');
	}
}


/* End of file contract.php */
/* Location: ./application/controllers/administrator/Contract.php */