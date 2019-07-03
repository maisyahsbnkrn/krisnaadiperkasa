<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Keterangan Controller
*| --------------------------------------------------------------------------
*| Keterangan site
*|
*/
class Keterangan extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_keterangan');
	}

	/**
	* show all Keterangans
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('keterangan_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['keterangans'] = $this->model_keterangan->get($filter, $field, $this->limit_page, $offset);
		$this->data['keterangan_counts'] = $this->model_keterangan->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/keterangan/index/',
			'total_rows'   => $this->model_keterangan->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Keterangan List');
		$this->render('backend/standart/administrator/keterangan/keterangan_list', $this->data);
	}
	
	/**
	* Add new keterangans
	*
	*/
	public function add()
	{
		$this->is_allowed('keterangan_add');

		$this->template->title('Keterangan New');
		$this->render('backend/standart/administrator/keterangan/keterangan_add', $this->data);
	}

	/**
	* Add New Keterangans
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('keterangan_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_keterangan = $this->model_keterangan->store($save_data);

			if ($save_keterangan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_keterangan;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/keterangan/edit/' . $save_keterangan, 'Edit Keterangan'),
						anchor('administrator/keterangan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/keterangan/edit/' . $save_keterangan, 'Edit Keterangan')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/keterangan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/keterangan');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Keterangans
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('keterangan_update');

		$this->data['keterangan'] = $this->model_keterangan->find($id);

		$this->template->title('Keterangan Update');
		$this->render('backend/standart/administrator/keterangan/keterangan_update', $this->data);
	}

	/**
	* Update Keterangans
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('keterangan_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'trim|required|max_length[255]');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'keterangan' => $this->input->post('keterangan'),
			];

			
			$save_keterangan = $this->model_keterangan->change($id, $save_data);

			if ($save_keterangan) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/keterangan', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/keterangan');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/keterangan');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Keterangans
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('keterangan_delete');

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
            set_message(cclang('has_been_deleted', 'keterangan'), 'success');
        } else {
            set_message(cclang('error_delete', 'keterangan'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Keterangans
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('keterangan_view');

		$this->data['keterangan'] = $this->model_keterangan->join_avaiable()->find($id);

		$this->template->title('Keterangan Detail');
		$this->render('backend/standart/administrator/keterangan/keterangan_view', $this->data);
	}
	
	/**
	* delete Keterangans
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$keterangan = $this->model_keterangan->find($id);

		
		
		return $this->model_keterangan->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('keterangan_export');

		$this->model_keterangan->export('keterangan', 'keterangan');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('keterangan_export');

		$this->model_keterangan->pdf('keterangan', 'keterangan');
	}
}


/* End of file keterangan.php */
/* Location: ./application/controllers/administrator/Keterangan.php */