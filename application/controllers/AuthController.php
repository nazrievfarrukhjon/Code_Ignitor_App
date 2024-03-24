<?php

defined('BASEPATH') or exit('No direct script access allowed');

use Modules\Authentication;

class AuthController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * @throws Exception
	 */
	public function loginToken(): void
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$authentication = new Authentication($email, $password, $this);
		$authentication->login();

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['token' => $authentication->tempToken()]));
	}

	public function logout(): void
	{
		$email = $this->input->post('email');
		$this->load->driver('cache');
		$this->cache->file->delete($email);
	}

	public function register(): void
	{
		$name = $this->input->post('name');
		$email = $this->input->post('email');
		$password = $this->input->post('password');
		$locationId = $this->input->post('location_id');
		$levelId = $this->input->post('level_id');

		$authentication = new Authentication($email, $password, $this);
		$authentication->register($name, $locationId, $levelId);

		$this->output
			->set_content_type('application/json')
			->set_output(json_encode(['message' => 'registered']));
	}
}
