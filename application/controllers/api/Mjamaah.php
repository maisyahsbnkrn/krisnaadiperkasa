<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use \Firebase\JWT\JWT;

class Mjamaah extends API
{
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('model_api_mjamaah');
	}

	/**
	 * @api {get} /mjamaah/all Get all mjamaahs.
	 * @apiVersion 0.1.0
	 * @apiName AllMjamaah 
	 * @apiGroup mjamaah
	 * @apiHeader {String} X-Api-Key Mjamaahs unique access-key.
	 * @apiHeader {String} X-Token Mjamaahs unique token.
	 * @apiPermission Mjamaah Cant be Accessed permission name : api_mjamaah_all
	 *
	 * @apiParam {String} [Filter=null] Optional filter of Mjamaahs.
	 * @apiParam {String} [Field="All Field"] Optional field of Mjamaahs : id, nama, tgl_lahir, foto, no_telp, create_date, create_user, update_date, udpate_user, kelamin.
	 * @apiParam {String} [Start=0] Optional start index of Mjamaahs.
	 * @apiParam {String} [Limit=10] Optional limit data of Mjamaahs.
	 *
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of mjamaah.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError NoDataMjamaah Mjamaah data is nothing.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function all_get()
	{
		$this->is_allowed('api_mjamaah_all');

		$filter = $this->get('filter');
		$field = $this->get('field');
		$limit = $this->get('limit') ? $this->get('limit') : $this->limit_page;
		$start = $this->get('start');

		$select_field = ['id', 'nama', 'tgl_lahir', 'foto', 'no_telp', 'create_date', 'create_user', 'update_date', 'udpate_user', 'kelamin'];
		$mjamaahs = $this->model_api_mjamaah->get($filter, $field, $limit, $start, $select_field);
		$total = $this->model_api_mjamaah->count_all($filter, $field);

		$data['mjamaah'] = $mjamaahs;
				
		$this->response([
			'status' 	=> true,
			'message' 	=> 'Data Mjamaah',
			'data'	 	=> $data,
			'total' 	=> $total
		], API::HTTP_OK);
	}

	
	/**
	 * @api {get} /mjamaah/detail Detail Mjamaah.
	 * @apiVersion 0.1.0
	 * @apiName DetailMjamaah
	 * @apiGroup mjamaah
	 * @apiHeader {String} X-Api-Key Mjamaahs unique access-key.
	 * @apiHeader {String} X-Token Mjamaahs unique token.
	 * @apiPermission Mjamaah Cant be Accessed permission name : api_mjamaah_detail
	 *
	 * @apiParam {Integer} Id Mandatory id of Mjamaahs.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 * @apiSuccess {Array} Data data of mjamaah.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError MjamaahNotFound Mjamaah data is not found.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function detail_get()
	{
		$this->is_allowed('api_mjamaah_detail');

		$this->requiredInput(['id']);

		$id = $this->get('id');

		$select_field = ['id', 'nama', 'tgl_lahir', 'foto', 'no_telp', 'create_date', 'create_user', 'update_date', 'udpate_user', 'kelamin'];
		$data['mjamaah'] = $this->model_api_mjamaah->find($id, $select_field);

		if ($data['mjamaah']) {
			
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Detail Mjamaah',
				'data'	 	=> $data
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Mjamaah not found'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	
	/**
	 * @api {post} /mjamaah/add Add Mjamaah.
	 * @apiVersion 0.1.0
	 * @apiName AddMjamaah
	 * @apiGroup mjamaah
	 * @apiHeader {String} X-Api-Key Mjamaahs unique access-key.
	 * @apiHeader {String} X-Token Mjamaahs unique token.
	 * @apiPermission Mjamaah Cant be Accessed permission name : api_mjamaah_add
	 *
 	 * @apiParam {String} Nama Mandatory nama of Mjamaahs.  
	 * @apiParam {String} Tgl_lahir Mandatory tgl_lahir of Mjamaahs.  
	 * @apiParam {String} Foto Mandatory foto of Mjamaahs.  
	 * @apiParam {String} No_telp Mandatory no_telp of Mjamaahs. Input No Telp Max Length : 50. 
	 * @apiParam {String} Create_date Mandatory create_date of Mjamaahs.  
	 * @apiParam {String} Create_user Mandatory create_user of Mjamaahs. Input Create User Max Length : 50. 
	 * @apiParam {String} Update_date Mandatory update_date of Mjamaahs.  
	 * @apiParam {String} Udpate_user Mandatory udpate_user of Mjamaahs. Input Udpate User Max Length : 50. 
	 * @apiParam {String} Kelamin Mandatory kelamin of Mjamaahs. Input Kelamin Max Length : 11. 
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function add_post()
	{
		$this->is_allowed('api_mjamaah_add');

		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('create_date', 'Create Date', 'trim|required');
		$this->form_validation->set_rules('create_user', 'Create User', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('update_date', 'Update Date', 'trim|required');
		$this->form_validation->set_rules('udpate_user', 'Udpate User', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kelamin', 'Kelamin', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'foto' => $this->input->post('foto'),
				'no_telp' => $this->input->post('no_telp'),
				'create_date' => $this->input->post('create_date'),
				'create_user' => $this->input->post('create_user'),
				'update_date' => $this->input->post('update_date'),
				'udpate_user' => $this->input->post('udpate_user'),
				'kelamin' => $this->input->post('kelamin'),
			];
			
			$save_mjamaah = $this->model_api_mjamaah->store($save_data);

			if ($save_mjamaah) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully stored into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

	/**
	 * @api {post} /mjamaah/update Update Mjamaah.
	 * @apiVersion 0.1.0
	 * @apiName UpdateMjamaah
	 * @apiGroup mjamaah
	 * @apiHeader {String} X-Api-Key Mjamaahs unique access-key.
	 * @apiHeader {String} X-Token Mjamaahs unique token.
	 * @apiPermission Mjamaah Cant be Accessed permission name : api_mjamaah_update
	 *
	 * @apiParam {String} Nama Mandatory nama of Mjamaahs.  
	 * @apiParam {String} Tgl_lahir Mandatory tgl_lahir of Mjamaahs.  
	 * @apiParam {String} Foto Mandatory foto of Mjamaahs.  
	 * @apiParam {String} No_telp Mandatory no_telp of Mjamaahs. Input No Telp Max Length : 50. 
	 * @apiParam {String} Create_date Mandatory create_date of Mjamaahs.  
	 * @apiParam {String} Create_user Mandatory create_user of Mjamaahs. Input Create User Max Length : 50. 
	 * @apiParam {String} Update_date Mandatory update_date of Mjamaahs.  
	 * @apiParam {String} Udpate_user Mandatory udpate_user of Mjamaahs. Input Udpate User Max Length : 50. 
	 * @apiParam {String} Kelamin Mandatory kelamin of Mjamaahs. Input Kelamin Max Length : 11. 
	 * @apiParam {Integer} id Mandatory id of Mjamaah.
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function update_post()
	{
		$this->is_allowed('api_mjamaah_update');

		
		$this->form_validation->set_rules('nama', 'Nama', 'trim|required');
		$this->form_validation->set_rules('tgl_lahir', 'Tgl Lahir', 'trim|required');
		$this->form_validation->set_rules('foto', 'Foto', 'trim|required');
		$this->form_validation->set_rules('no_telp', 'No Telp', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('create_date', 'Create Date', 'trim|required');
		$this->form_validation->set_rules('create_user', 'Create User', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('update_date', 'Update Date', 'trim|required');
		$this->form_validation->set_rules('udpate_user', 'Udpate User', 'trim|required|max_length[50]');
		$this->form_validation->set_rules('kelamin', 'Kelamin', 'trim|required|max_length[11]');
		
		if ($this->form_validation->run()) {

			$save_data = [
				'nama' => $this->input->post('nama'),
				'tgl_lahir' => $this->input->post('tgl_lahir'),
				'foto' => $this->input->post('foto'),
				'no_telp' => $this->input->post('no_telp'),
				'create_date' => $this->input->post('create_date'),
				'create_user' => $this->input->post('create_user'),
				'update_date' => $this->input->post('update_date'),
				'udpate_user' => $this->input->post('udpate_user'),
				'kelamin' => $this->input->post('kelamin'),
			];
			
			$save_mjamaah = $this->model_api_mjamaah->change($this->post('id'), $save_data);

			if ($save_mjamaah) {
				$this->response([
					'status' 	=> true,
					'message' 	=> 'Your data has been successfully updated into the database'
				], API::HTTP_OK);

			} else {
				$this->response([
					'status' 	=> false,
					'message' 	=> cclang('data_not_change')
				], API::HTTP_NOT_ACCEPTABLE);
			}

		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> validation_errors()
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}
	
	/**
	 * @api {post} /mjamaah/delete Delete Mjamaah. 
	 * @apiVersion 0.1.0
	 * @apiName DeleteMjamaah
	 * @apiGroup mjamaah
	 * @apiHeader {String} X-Api-Key Mjamaahs unique access-key.
	 * @apiHeader {String} X-Token Mjamaahs unique token.
	 	 * @apiPermission Mjamaah Cant be Accessed permission name : api_mjamaah_delete
	 *
	 * @apiParam {Integer} Id Mandatory id of Mjamaahs .
	 *
	 * @apiSuccess {Boolean} Status status response api.
	 * @apiSuccess {String} Message message response api.
	 *
	 * @apiSuccessExample Success-Response:
	 *     HTTP/1.1 200 OK
	 *
	 * @apiError ValidationError Error validation.
	 *
	 * @apiErrorExample Error-Response:
	 *     HTTP/1.1 403 Not Acceptable
	 *
	 */
	public function delete_post()
	{
		$this->is_allowed('api_mjamaah_delete');

		$mjamaah = $this->model_api_mjamaah->find($this->post('id'));

		if (!$mjamaah) {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Mjamaah not found'
			], API::HTTP_NOT_ACCEPTABLE);
		} else {
			$delete = $this->model_api_mjamaah->remove($this->post('id'));

			}
		
		if ($delete) {
			$this->response([
				'status' 	=> true,
				'message' 	=> 'Mjamaah deleted',
			], API::HTTP_OK);
		} else {
			$this->response([
				'status' 	=> false,
				'message' 	=> 'Mjamaah not delete'
			], API::HTTP_NOT_ACCEPTABLE);
		}
	}

}

/* End of file Mjamaah.php */
/* Location: ./application/controllers/api/Mjamaah.php */