<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Company Controller
*| --------------------------------------------------------------------------
*| Company site
*|
*/
class Company extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_company');
	}

	/**
	* show all Companys
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('company_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['companys'] = $this->model_company->get($filter, $field, $this->limit_page, $offset);
		$this->data['company_counts'] = $this->model_company->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/company/index/',
			'total_rows'   => $this->model_company->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Company List');
		$this->render('backend/standart/administrator/company/company_list', $this->data);
	}
	
	/**
	* Add new companys
	*
	*/
	public function add()
	{
		$this->is_allowed('company_add');

		$this->template->title('Company New');
		$this->render('backend/standart/administrator/company/company_add', $this->data);
	}

	/**
	* Add New Companys
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('company_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('owner', 'Owner', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('contract', 'Contract', 'trim|required');
		$this->form_validation->set_rules('territory', 'Territory', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run()) {
		
			$save_data = [
				'name' => $this->input->post('name'),
				'owner' => $this->input->post('owner'),
				'address' => $this->input->post('address'),
				'contract' => $this->input->post('contract'),
				'territory' => $this->input->post('territory'),
                                'email' => $this->input->post('email'),
								'npwp' => $this->input->post('npwp'),
								'telepon' => $this->input->post('telepon'),
								'fax' => $this->input->post('fax'),
			];

			
			$save_company = $this->model_company->store($save_data);

			if ($save_company) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_company;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/company/edit/' . $save_company, 'Edit Company'),
						anchor('administrator/company', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/company/edit/' . $save_company, 'Edit Company')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/company');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/company');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Companys
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('company_update');

		$this->data['company'] = $this->model_company->find($id);

		$this->template->title('Company Update');
		$this->render('backend/standart/administrator/company/company_update', $this->data);
	}

	/**
	* Update Companys
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('company_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('name', 'Name', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('owner', 'Owner', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('address', 'Address', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('contract', 'Contract', 'trim|required');
		$this->form_validation->set_rules('territory', 'Territory', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');

		if ($this->form_validation->run()) {
		
			$save_data = [
				'name' => $this->input->post('name'),
				'owner' => $this->input->post('owner'),
				'address' => $this->input->post('address'),
				'contract' => $this->input->post('contract'),
				'territory' => $this->input->post('territory'),
                                'email' => $this->input->post('email'),
								'npwp' => $this->input->post('npwp'),
								'telepon' => $this->input->post('telepon'),
								'fax' => $this->input->post('fax'),
			];

			
			$save_company = $this->model_company->change($id, $save_data);

			if ($save_company) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/company', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/company');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/company');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Companys
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('company_delete');

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
            set_message(cclang('has_been_deleted', 'company'), 'success');
        } else {
            set_message(cclang('error_delete', 'company'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Companys
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('company_view');

		$this->data['company'] = $this->model_company->join_avaiable()->find($id);

		$this->template->title('Company Detail');
		$this->render('backend/standart/administrator/company/company_view', $this->data);
	}
	
	/**
	* delete Companys
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$company = $this->model_company->find($id);

		
		
		return $this->model_company->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('company_export');

		$this->model_company->export('company', 'company');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('company_export');

		$this->model_company->pdf('company', 'company');
	}
}


/* End of file company.php */
/* Location: ./application/controllers/administrator/Company.php */