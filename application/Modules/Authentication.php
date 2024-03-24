<?php

namespace Modules;

use CI_Loader;
use Exception;

class Authentication
{
	private string $password;
	private string $email;
	private $ci;

	public function __construct(
		string $email,
		string $password,
			   $ci
	)
	{
		$this->email = $email;
		$this->password = $password;
		$this->ci = $ci;
	}

	/**
	 * @throws Exception
	 */
	public function login(): void
	{
		$this->ci->load->model('User');
		$storedPassword = $this->ci->User->passwordByEmail($this->email);
		if ($storedPassword !== null) {
			if (password_verify($this->password, $storedPassword)) {
				$randomTempToken =  bin2hex(random_bytes(32));
				$hashedTempPass = password_hash($randomTempToken, PASSWORD_DEFAULT);

				//$this->ci->load->library('session');
				//$this->ci->session->set_userdata($this->email, $randomTempToken);

				$this->ci->load->driver('cache');
				$this->ci->cache->file->save($this->email, ['plain' => $randomTempToken, 'hashed' => $hashedTempPass], 3600);
			} else {
				throw new Exception('incorrect credentials');
			}
		} else {
			throw new Exception('user not found');

		}
	}


	/**
	 * @throws Exception
	 */
	public function token(): string
	{
		$this->ci->load->model('User');
		return $this->ci->User->passwordByEmail($this->email);
	}


	public function register(
		string $name,
		int $locationId,
		int $levelId
	): void {

		$passwordHash = password_hash($this->password, PASSWORD_DEFAULT);

		$data = array(
			'name' => $name,
			'email' => $this->email,
			'password' => $passwordHash,
			'location_id' => $locationId,
			'level_id' => $levelId
		);

		$this->ci->load->model('User');
		$this->ci->User->create($data);
	}

	//todo use one
	public function tempToken(): string
	{
		//
		//$this->ci->load->library('session');
		//$tempFromSession = $this->ci->session->userdata($this->email);

		//
		$this->ci->load->driver('cache');
		return $this->ci->cache->file->get($this->email)['plain'];
	}
}
