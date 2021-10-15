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
		$this->form_validation->set_rules('name', 'Имя', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('role', 'Роль', 'required');

		if ($this->form_validation->run() == true) {

			$user['name'] = $this->input->post('name');
			$user['email'] = $this->input->post('email');
			$user['role_id'] = $this->input->post('role');
			$user['created_at'] = date('Y-m-d H:i:s');
//			$this->user_model->create($user);

			$response['status'] = 1;
			$response['message'] = "<div class='alert alert-success text-center'>Пользователь под именем " . $user['name'] . " добавлен!</div>";
		} else {
			$response['status'] = 0;
			$response['name'] = strip_tags(form_error('name'));
			$response['email'] = strip_tags(form_error('email'));
			$response['role'] = strip_tags(form_error('role'));
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
		$name = $this->user_model->getName($id);
		if ($id) {
			$this->user_model->delete($id);
			$response['message'] = "<div class='alert alert-danger text-center'>Пользователь удален!</div>";
			$response['redirect'] = base_url();
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
