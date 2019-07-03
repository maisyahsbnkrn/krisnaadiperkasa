<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Logistic Sparepart Controller
*| --------------------------------------------------------------------------
*| Logistic Sparepart site
*|
*/
class Logistic_sparepart extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_logistic_sparepart');
	}

	/**
	* show all Logistic Spareparts
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('logistic_sparepart_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logistic_spareparts'] = $this->model_logistic_sparepart->get($filter, $field, $this->limit_page, $offset);
		$this->data['logistic_sparepart_counts'] = $this->model_logistic_sparepart->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/logistic_sparepart/index/',
			'total_rows'   => $this->model_logistic_sparepart->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Logistic Sparepart List');
		$this->render('backend/standart/administrator/logistic_sparepart/logistic_sparepart_list', $this->data);
	}
	
	/**
	* Add new logistic_spareparts
	*
	*/
	public function add()
	{
		$this->is_allowed('logistic_sparepart_add');

		$this->template->title('Logistic Sparepart New');
		$this->render('backend/standart/administrator/logistic_sparepart/logistic_sparepart_add', $this->data);
	}

	/**
	* Add New Logistic Spareparts
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('logistic_sparepart_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('logistic_equipment_name', 'Equipment Name', 'trim|required');
		$this->form_validation->set_rules('logistic_maker', 'Equipment Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_equipment_type', 'Equipment Type', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_type', 'Type', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_sparepart_equipment_name'       => $this->input->post('logistic_equipment_name'),
				'logistic_sparepart_equipment_maker'                => $this->input->post('logistic_maker'),
				'logistic_sparepart_equipment_type'       => $this->input->post('logistic_equipment_type'),
				'logistic_sparepart_name'       => $this->input->post('logistic_sparepart_name'),
				'logistic_sparepart_type'       => $this->input->post('logistic_sparepart_type'),
				'price' => $this->input->post('price'),
//				'logistic_sparepart_serial_number' => $this->input->post('logistic_sparepart_serial_number'),
				'unit' => $this->input->post('unit'),
				'quantity' => $this->input->post('quantity'),
			];

			
			$save_logistic_sparepart = $this->model_logistic_sparepart->store($save_data);

			if ($save_logistic_sparepart) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_logistic_sparepart;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/logistic_sparepart/edit/' . $save_logistic_sparepart, 'Edit Logistic Sparepart'),
						anchor('administrator/logistic_sparepart', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/logistic_sparepart/edit/' . $save_logistic_sparepart, 'Edit Logistic Sparepart')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_sparepart');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_sparepart');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Logistic Spareparts
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('logistic_sparepart_update');

		$this->data['logistic_sparepart'] = $this->model_logistic_sparepart->find($id);

		$this->template->title('Logistic Sparepart Update');
		$this->render('backend/standart/administrator/logistic_sparepart/logistic_sparepart_update', $this->data);
	}

	/**
	* Update Logistic Spareparts
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('logistic_sparepart_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('logistic_sparepart_equipment_name', 'Equipment Name', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_equipment_maker', 'Equipment Maker', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_equipment_type', 'Equipment Type', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_name', 'Name', 'trim|required');
		$this->form_validation->set_rules('logistic_sparepart_type', 'Type', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'logistic_sparepart_equipment_name' => $this->input->post('logistic_sparepart_equipment_name'),
				'logistic_sparepart_equipment_maker' => $this->input->post('logistic_sparepart_equipment_maker'),
				'logistic_sparepart_equipment_type' => $this->input->post('logistic_sparepart_equipment_type'),
				'logistic_sparepart_name' => $this->input->post('logistic_sparepart_name'),
				'logistic_sparepart_type' => $this->input->post('logistic_sparepart_type'),
				// 'logistic_sparepart_part_number' => $this->input->post('logistic_sparepart_part_number'),
				'price' => $this->input->post('price'),
				'unit' => $this->input->post('unit'),
				'quantity' => $this->input->post('quantity'),
			];

			
			$save_logistic_sparepart = $this->model_logistic_sparepart->change($id, $save_data);

			if ($save_logistic_sparepart) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/logistic_sparepart', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/logistic_sparepart');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/logistic_sparepart');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Logistic Spareparts
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('logistic_sparepart_delete');

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
            set_message(cclang('has_been_deleted', 'logistic_sparepart'), 'success');
        } else {
            set_message(cclang('error_delete', 'logistic_sparepart'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Logistic Spareparts
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('logistic_sparepart_view');

		$this->data['logistic_sparepart'] = $this->model_logistic_sparepart->join_avaiable()->find($id);

		$this->template->title('Logistic Sparepart Detail');
		$this->render('backend/standart/administrator/logistic_sparepart/logistic_sparepart_view', $this->data);
	}
	
	/**
	* delete Logistic Spareparts
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$logistic_sparepart = $this->model_logistic_sparepart->find($id);

		
		
		return $this->model_logistic_sparepart->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('logistic_sparepart_export');

		$this->model_logistic_sparepart->export('logistic_sparepart', 'logistic_sparepart');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('logistic_sparepart_export');

		$this->model_logistic_sparepart->pdf('logistic_sparepart', 'logistic_sparepart');
	}
        
         public function get_logistic_sparepart_type(){
            $logistic_sparepart_name    =  $this->input->get('logistic_sparepart_name');   
            $logistic_sparepart_type    =  $this->model_logistic_sparepart->get_selected_by_name($logistic_sparepart_name);
            
            $lists = "<option value=''>Select Sparepart Type</option>";
            foreach ($logistic_sparepart_type as $data) {
                $lists .= "<option value='" . $data->logistic_sparepart_type_types . "'>" . $data->logistic_sparepart_type_types . "</option>";
            }
        
            $callback = array(
                'list_logistic_sparepart_type' => $lists
            );
            
            echo json_encode($callback);
        }
}


/* End of file logistic_sparepart.php */
/* Location: ./application/controllers/administrator/Logistic Sparepart.php */