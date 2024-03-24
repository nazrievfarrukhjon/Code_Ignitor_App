<?php
defined('BASEPATH') or exit('No direct script access allowed');


class UserController extends CI_Controller
{

	/**
	 * @throws Exception
	 */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('User');
		authenticated($this);
	}

	public function index(): void
	{
		echo json_encode(['users' => $this->User->all()]);

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
		$locationId = $this->input->post('location_id');
		$levelId = $this->input->post('level_id');

		$data = array(
			'name' => $name,
			'email' => $email,
			'location_id' => $locationId,
			'level_id' => $levelId
		);

		$this->User->create($data);
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

	public function delete($userId): void
	{
		$this->User->delete($userId);
	}

}
