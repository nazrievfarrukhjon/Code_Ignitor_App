<?php
defined('BASEPATH') or exit('No direct script access allowed');

class UserController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		// Load necessary models, libraries, helpers, etc.
		$this->load->model('User');
		// Add any additional initialization code here
	}

	public function index(): void
	{
		$data['users'] = $this->User->all();
		$this->load->view('user/index', $data);
	}

	public function userById($userId): void
	{
		$data['user'] = $this->User->userById($userId);

		$this->load->view('user/index', $data);
	}

	public function create(): void
	{
		$this->User;
		$this->load->view('user/create');
	}

	public function store(): void
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');

		$data = array(
			'name' => $name,
			'email' => $email
		);

		$this->User->create($data);
	}

	public function edit($user_id): void
	{
		// Show form to edit an existing user
		$data['user'] = $this->User_model->get_user($user_id);
		$this->load->view('user/edit', $data);
	}

	public function update($userId): void
	{
		$bodyParams = file_get_contents('php://input');
		$bodyParams = json_decode($bodyParams);

		$name = isset($bodyParams->name) ? $bodyParams->name : null;
		$email = isset($bodyParams->email) ? $bodyParams->email : null;

		$data = array();
		if ($name !== null) {
			$data['name'] = $name;
		}
		if ($email !== null) {
			$data['email'] = $email;
		}

		if (!empty($data)) {
			$this->User->update($userId, $data);
		}

	}

	public function delete($userId)
	{
		$this->User->delete($userId);
	}

}
