<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Absensi Controller
*| --------------------------------------------------------------------------
*| Absensi site
*|
*/
class Absensi extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_absensi');
	}

	/**
	* show all Absensis
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('absensi_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['absensis'] = $this->model_absensi->get($filter, $field, $this->limit_page, $offset);
		$this->data['absensi_counts'] = $this->model_absensi->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/absensi/index/',
			'total_rows'   => $this->model_absensi->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Absensi List');
		$this->render('backend/standart/administrator/absensi/absensi_list', $this->data);
	}
	
	/**
	* Add new absensis
	*
	*/
	public function add()
	{
		$this->is_allowed('absensi_add');

		$this->template->title('Absensi New');
		$this->render('backend/standart/administrator/absensi/absensi_add', $this->data);
	}

	/**
	* Add New Absensis
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('absensi_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('nama_guru', 'Nama Guru', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('mapel', 'Mapel', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('create_date', 'Create Date', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_guru' => $this->input->post('nama_guru'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'mapel' => $this->input->post('mapel'),
				'status' => $this->input->post('status'),
				'create_date' => $this->input->post('create_date'),
			];

			
			$save_absensi = $this->model_absensi->store($save_data);

			if ($save_absensi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_absensi;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/absensi/edit/' . $save_absensi, 'Edit Absensi'),
						anchor('administrator/absensi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/absensi/edit/' . $save_absensi, 'Edit Absensi')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/absensi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/absensi');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Absensis
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('absensi_update');

		$this->data['absensi'] = $this->model_absensi->find($id);

		$this->template->title('Absensi Update');
		$this->render('backend/standart/administrator/absensi/absensi_update', $this->data);
	}

	/**
	* Update Absensis
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('absensi_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('nama_guru', 'Nama Guru', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('nama_siswa', 'Nama Siswa', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('mapel', 'Mapel', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('status', 'Status', 'trim|required|max_length[255]');
		$this->form_validation->set_rules('create_date', 'Create Date', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'nama_guru' => $this->input->post('nama_guru'),
				'nama_siswa' => $this->input->post('nama_siswa'),
				'mapel' => $this->input->post('mapel'),
				'status' => $this->input->post('status'),
				'create_date' => $this->input->post('create_date'),
			];

			
			$save_absensi = $this->model_absensi->change($id, $save_data);

			if ($save_absensi) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/absensi', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/absensi');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/absensi');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Absensis
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('absensi_delete');

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
            set_message(cclang('has_been_deleted', 'absensi'), 'success');
        } else {
            set_message(cclang('error_delete', 'absensi'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Absensis
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('absensi_view');

		$this->data['absensi'] = $this->model_absensi->join_avaiable()->find($id);

		$this->template->title('Absensi Detail');
		$this->render('backend/standart/administrator/absensi/absensi_view', $this->data);
	}
	
	/**
	* delete Absensis
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$absensi = $this->model_absensi->find($id);

		
		
		return $this->model_absensi->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('absensi_export');

		$this->model_absensi->export('absensi', 'absensi');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('absensi_export');

		$this->model_absensi->pdf('absensi', 'absensi');
	}
}


/* End of file absensi.php */
/* Location: ./application/controllers/administrator/Absensi.php */