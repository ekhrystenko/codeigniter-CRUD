<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Class Main
 */
class Main extends CI_Controller
{
	/**
	 * Main constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('user_model');
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
		$name = $this->input->get('name');
		$date = $this->input->get('date');
		$query = $this->user_model->getUsers($name);

		echo json_encode([
			'date' => $date,
			'query' => $query
		]);
	}

	public function createUsers()
	{
		$this->user_model->create();
	}

	public function updateUser($id)
	{
		$this->user_model->update($id);
	}

	public function deleteUser($id)
	{
		$this->user_model->delete($id);
	}
}
