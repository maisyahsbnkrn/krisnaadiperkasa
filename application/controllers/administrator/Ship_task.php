<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/**
*| --------------------------------------------------------------------------
*| Ship Task Controller
*| --------------------------------------------------------------------------
*| Ship Task site
*|
*/
class Ship_task extends Admin	
{
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('model_ship_task');
	}

	/**
	* show all Ship Tasks
	*
	* @var $offset String
	*/
	public function index($offset = 0)
	{
		$this->is_allowed('ship_task_list');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['ship_tasks'] = $this->model_ship_task->get($filter, $field, $this->limit_page, $offset);
		$this->data['ship_task_counts'] = $this->model_ship_task->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/ship_task/index/',
			'total_rows'   => $this->model_ship_task->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Ship Task List');
		$this->render('backend/standart/administrator/ship_task/ship_task_list', $this->data);
	}
        
        public function logistic_equipment($offset = 0)
	{
		$this->is_allowed('logistic_equipment');

		$filter = $this->input->get('q');
		$field 	= $this->input->get('f');

		$this->data['logistic_equipments'] = $this->model_logistic_equipment->get($filter, $field, $this->limit_page, $offset);
		$this->data['logistic_equipment_counts'] = $this->model_logistic_equipment->count_all($filter, $field);

		$config = [
			'base_url'     => 'administrator/ship_task/ship_task_get_equipment/',
			'total_rows'   => $this->model_logistic_equipment->count_all($filter, $field),
			'per_page'     => $this->limit_page,
			'uri_segment'  => 4,
		];

		$this->data['pagination'] = $this->pagination($config);

		$this->template->title('Select Logistic Equipment ->');
		$this->render('backend/standart/administrator/ship_task/ship_task_get_equipment', $this->data);
	}
	
	/**
	* Add new ship_tasks
	*
	*/
	public function add()
	{
		$this->is_allowed('ship_task_add');

		$this->template->title('Ship Task New');
		$this->render('backend/standart/administrator/ship_task/ship_task_add', $this->data);
	}
        
        public function get_logistic_equipment()
	{
		$this->is_allowed('ship_task_get_equipment');

		$this->template->title('Select Logistic Equipment');
		$this->render('backend/standart/administrator/ship_task/ship_task_get_equipment', $this->data);
	}

	/**
	* Add New Ship Tasks
	*
	* @return JSON
	*/
	public function add_save()
	{
		if (!$this->is_allowed('ship_task_add', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}

		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('order_number', 'Order Number', 'trim|required');
		$this->form_validation->set_rules('schedule', 'Schedule', 'trim|required');
                $this->form_validation->set_rules('location', 'Location', 'trim|required');
		$this->form_validation->set_rules('scope_type[]', 'Scope Type', 'trim|required');
		// $this->form_validation->set_rules('notes', 'Notes', 'trim|required');
		$this->form_validation->set_rules('engineer[]', 'Engineer', 'trim|required');
		

		if ($this->form_validation->run()) {
		
			$save_data = [
				'company' => $this->input->post('company'),
				'ship_name' => $this->input->post('ship_name'),
				'order_number' => $this->input->post('order_number'),
				'schedule' => $this->input->post('schedule'),
				'location' => $this->input->post('location'),
				'scope_type' => implode(',', (array) $this->input->post('scope_type')),
				'survey_type' => implode(',', (array) $this->input->post('survey_type')),
				'survey_engineer_fee' => $this->input->post('survey_engineer_fee'),
				'survey_ticket_fee' => $this->input->post('survey_ticket_fee'),
				'survey_transport_fee' => $this->input->post('survey_transport_fee'),
				'survey_speedboat_fee' => $this->input->post('survey_speedboat_fee'),
				'survey_dailyallowance_fee' => $this->input->post('survey_dailyallowance_fee'),
				'installation' => $this->input->post('installation'),
//				'logistic_equipment' => $this->input->post('logistic_equipment'),
				'installation_engineer_fee' => $this->input->post('installation_engineer_fee'),
				'installation_ticket_fee' => $this->input->post('installation_ticket_fee'),
				'installation_transport_fee' => $this->input->post('installation_transport_fee'),
				'installation_speedboat_fee' => $this->input->post('installation_speedboat_fee'),
				'installation_dailyallowance_fee' => $this->input->post('installation_dailyallowance_fee'),
				'repair' => $this->input->post('repair'),
//				'logistic_sparepart' => $this->input->post('logistic_sparepart'),
				'repair_engineer_fee' => $this->input->post('repair_engineer_fee'),
				'repair_ticket_fee' => $this->input->post('repair_ticket_fee'),
				'repair_transport_fee' => $this->input->post('repair_transport_fee'),
				'repair_speedboat_fee' => $this->input->post('repair_speedboat_fee'),
				'repair_dailyallowance_fee' => $this->input->post('repair_dailyallowance_fee'),
				'notes' => $this->input->post('notes'),
				'engineer' => implode(',', (array) $this->input->post('engineer')),
                                'status' =>'1',
			];

			
			$save_ship_task = $this->model_ship_task->store($save_data);

			if ($save_ship_task) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $save_ship_task;
					$this->data['message'] = cclang('success_save_data_stay', [
						anchor('administrator/ship_task/edit/' . $save_ship_task, 'Edit Ship Task'),
						anchor('administrator/ship_task', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_save_data_redirect', [
						anchor('administrator/ship_task/edit/' . $save_ship_task, 'Edit Ship Task')
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_task');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_task');
				}
			}

		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
		/**
	* Update view Ship Tasks
	*
	* @var $id String
	*/
	public function edit($id)
	{
		$this->is_allowed('ship_task_update');

		$this->data['ship_task'] = $this->model_ship_task->find($id);

		$this->template->title('Ship Task Update');
		$this->render('backend/standart/administrator/ship_task/ship_task_update', $this->data);
	}

	/**
	* Update Ship Tasks
	*
	* @var $id String
	*/
	public function edit_save($id)
	{
		if (!$this->is_allowed('ship_task_update', false)) {
			echo json_encode([
				'success' => false,
				'message' => cclang('sorry_you_do_not_have_permission_to_access')
				]);
			exit;
		}
		
		$this->form_validation->set_rules('company', 'Company', 'trim|required');
		$this->form_validation->set_rules('ship_name', 'Ship Name', 'trim|required');
		$this->form_validation->set_rules('order_number', 'Order Number', 'trim|required');
		$this->form_validation->set_rules('schedule', 'Schedule', 'trim|required');
		$this->form_validation->set_rules('scope_type[]', 'Scope Type', 'trim|required');
		$this->form_validation->set_rules('notes', 'Notes', 'trim|required');
		$this->form_validation->set_rules('engineer', 'Engineer', 'trim|required');
		
		if ($this->form_validation->run()) {
		
			$save_data = [
				'company' => $this->input->post('company'),
				'ship_name' => $this->input->post('ship_name'),
				'order_number' => $this->input->post('order_number'),
				'schedule' => $this->input->post('schedule'),
				'location' => $this->input->post('location'),
				'scope_type' => implode(',', (array) $this->input->post('scope_type')),
				'survey_type' => implode(',', (array) $this->input->post('survey_type')),
				'survey_engineer_fee' => $this->input->post('survey_engineer_fee'),
				'survey_ticket_fee' => $this->input->post('survey_ticket_fee'),
				'survey_transport_fee' => $this->input->post('survey_transport_fee'),
				'survey_speedboat_fee' => $this->input->post('survey_speedboat_fee'),
				'survey_dailyallowance_fee' => $this->input->post('survey_dailyallowance_fee'),
				'installation' => $this->input->post('installation'),
				'logistic_equipment' => $this->input->post('logistic_equipment'),
				'installation_engineer_fee' => $this->input->post('installation_engineer_fee'),
				'installation_ticket_fee' => $this->input->post('installation_ticket_fee'),
				'installation_transport_fee' => $this->input->post('installation_transport_fee'),
				'installation_speedboat_fee' => $this->input->post('installation_speedboat_fee'),
				'installation_dailyallowance_fee' => $this->input->post('installation_dailyallowance_fee'),
				'repair' => $this->input->post('repair'),
				'logistic_sparepart' => $this->input->post('logistic_sparepart'),
				'repair_engineer_fee' => $this->input->post('repair_engineer_fee'),
				'repair_ticket_fee' => $this->input->post('repair_ticket_fee'),
				'repair_transport_fee' => $this->input->post('repair_transport_fee'),
				'repair_speedboat_fee' => $this->input->post('repair_speedboat_fee'),
				'repair_dailyallowance_fee' => $this->input->post('repair_dailyallowance_fee'),
				'notes' => $this->input->post('notes'),
				'engineer' => $this->input->post('engineer'),
			];

			
			$save_ship_task = $this->model_ship_task->change($id, $save_data);

			if ($save_ship_task) {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = true;
					$this->data['id'] 	   = $id;
					$this->data['message'] = cclang('success_update_data_stay', [
						anchor('administrator/ship_task', ' Go back to list')
					]);
				} else {
					set_message(
						cclang('success_update_data_redirect', [
					]), 'success');

            		$this->data['success'] = true;
					$this->data['redirect'] = base_url('administrator/ship_task');
				}
			} else {
				if ($this->input->post('save_type') == 'stay') {
					$this->data['success'] = false;
					$this->data['message'] = cclang('data_not_change');
				} else {
            		$this->data['success'] = false;
            		$this->data['message'] = cclang('data_not_change');
					$this->data['redirect'] = base_url('administrator/ship_task');
				}
			}
		} else {
			$this->data['success'] = false;
			$this->data['message'] = validation_errors();
		}

		echo json_encode($this->data);
	}
	
	/**
	* delete Ship Tasks
	*
	* @var $id String
	*/
	public function delete($id = null)
	{
		$this->is_allowed('ship_task_delete');

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
            set_message(cclang('has_been_deleted', 'ship_task'), 'success');
        } else {
            set_message(cclang('error_delete', 'ship_task'), 'error');
        }

		redirect_back();
	}

		/**
	* View view Ship Tasks
	*
	* @var $id String
	*/
	public function view($id)
	{
		$this->is_allowed('ship_task_view');

//		$this->data['ship_task'] = $this->model_ship_task->join_avaiable()->find($id);
                $this->data['ship_task'] = $this->model_ship_task->join_avaiable()->find($id);
		$this->template->title('Ship Task Detail');
		$this->render('backend/standart/administrator/ship_task/ship_task_view', $this->data);
	}
	
	/**
	* delete Ship Tasks
	*
	* @var $id String
	*/
	private function _remove($id)
	{
		$ship_task = $this->model_ship_task->find($id);

		
		
		return $this->model_ship_task->remove($id);
	}
	
	
	/**
	* Export to excel
	*
	* @return Files Excel .xls
	*/
	public function export()
	{
		$this->is_allowed('ship_task_export');

		$this->model_ship_task->export('ship_task', 'ship_task');
	}

	/**
	* Export to PDF
	*
	* @return Files PDF .pdf
	*/
	public function export_pdf()
	{
		$this->is_allowed('ship_task_export');

		$this->model_ship_task->pdf('ship_task', 'ship_task');
	}
        
         public function get_survey_type(){
            $survey_type= $this->model_ship_task->get__survey_type();
            $lists = "<option value=''>Select Survey Type</option>";
            foreach ($survey_type as $data) {
                $lists .= "<option value='" . $data->name_survey_type . "'>" . $data->name_survey_type . "</option>";
            }
        
            $callback = array(
                'list_survey_type' => $lists
            );
            
            echo json_encode($callback);
        }
        
            public function printDuty($parameter) {
                $sentParam = array("order_number" => $parameter,"user_login" => ucwords(clean_snake_case(get_user_data('full_name'))),"date_current" =>date("F d, Y"));
                $rpt=$this->MY_Model->reportShow("application/views/reports/rpt_duty.jrxml", $sentParam);
                sysout($rpt);
            }
            
            public function printInvoice($parameter) {
                $sentParam = array("order_number" => $parameter,"date_current" =>date("F d, Y"));
                $rpt=$this->MY_Model->reportShow("application/views/reports/rpt_invoice.jrxml", $sentParam);
                sysout($rpt);
            }
            
             public function get_dataTarif(){
                $jenis_survey =  $this->input->get('jenis_survey');  
                $company = $this->input->get('company');
                $data_territory = $this->model_ship_task->getTerritory($company);
                $tarif_survey= $this->model_ship_task->getSelectedTarif($jenis_survey);

                foreach ($data_territory as $data) {
                    $jenis_territory = $data->territory ;
                }
                
                foreach ($tarif_survey as $data) {
                    if($jenis_territory ==1){
                        $lists = $data->ind ;
                    }
                    else{
                         $lists = $data->usd ;
                    }
                    
                }

                $callback = array(
                    'list_tarif_survey' => $lists
                );

                echo json_encode($callback);
            }
            
             public function getInstallationTarif(){
                $company = $this->input->get('company');
                $data_territory = $this->model_ship_task->getTerritory($company);
                $tarif= $this->model_ship_task->get_installationTarif();

                foreach ($data_territory as $data) {
                    $jenis_territory = $data->territory ;
                }
                
                foreach ($tarif as $data) {
                    if($jenis_territory ==1){
                        $lists = $data->ind ;
                    }
                    else{
                         $lists = $data->usd ;
                    }
                    
                }

                $callback = array(
                    'list_tarif_installation' => $lists
                );

                echo json_encode($callback);
            }
            
            public function getRepairTarif(){
                $company = $this->input->get('company');
                $data_territory = $this->model_ship_task->getTerritory($company);
                $tarif= $this->model_ship_task->get_RepairTarif();

                foreach ($data_territory as $data) {
                    $jenis_territory = $data->territory ;
                }
                
                foreach ($tarif as $data) {
                    if($jenis_territory ==1){
                        $lists = $data->ind ;
                    }
                    else{
                         $lists = $data->usd ;
                    }
                    
                }

                $callback = array(
                    'list_tarif_repair' => $lists
                );

                echo json_encode($callback);
            }

}


/* End of file ship_task.php */
/* Location: ./application/controllers/administrator/Ship Task.php */