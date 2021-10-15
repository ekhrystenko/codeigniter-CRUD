<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class User_controller
 */
class User_controller extends CI_Controller
{
	/**
	 * User_controller constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
		$this->load->helper('url');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Search Form';

		$this->load->view('layouts/header', $data);
		$this->load->view('index', $data);
		$this->load->view('layouts/footer');
	}

	public function getResult()
	{
		$search = $this->input->get('search');
		$date = $this->input->get('date');
		$query = $this->user_model->getUsers($search);

		echo json_encode([
			'date' => $date,
			'query' => $query
		]);
	}

	public function create()
	{
		$html = $this->load->view('create','',true);
		$response['html'] = $html;
		echo json_encode($response);
	}

	public function store()
	{
		if ($this->form_validation->run() == true) {

			$user = [
				'name' => $this->input->post('name'),
				'email' => $this->input->post('email'),
				'role_id' => $this->input->post('role'),
				'created_at' => date('Y-m-d H:i:s')
			];

			$this->user_model->create($user);

			$response = [
				'status' => 1,
				'message' => "<div class='alert alert-success text-center'>Пользователь под именем " . $user['name'] . " добавлен!</div>",
				'redirect' => base_url()
			];

		} else {
			$response = [
				'status' => 0,
				'name' => strip_tags(form_error('name')),
				'email' => strip_tags(form_error('email')),
				'role' => strip_tags(form_error('role'))
			];
		}
		echo json_encode($response);
	}

	public function edit()
	{
		echo 'edit';
	}

	public function update($id)
	{
		echo 'update';
//		$this->user_model->update($id);
	}

	public function destroy($id)
	{
		if ($id) {
			$this->user_model->delete($id);

			$response = [
				'message' => "<div class='alert alert-danger text-center'>Пользователь удален!</div>",
				'redirect' => base_url()
			];
		}
		echo json_encode($response);
	}

	public function createFactory()
	{
		$this->user_model->createFactory();
	}
	public function destroyFactory()
	{
		$this->user_model->destroyFactory();
	}
}
