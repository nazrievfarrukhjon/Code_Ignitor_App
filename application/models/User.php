<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function all()
	{
		return $this->db->get('users')->result();
	}

	public function userById(int $userId)
	{
		return $this->db
			->where('id', $userId)
			->get('users')
			->row();
	}

	public function create($data)
	{
		$this->db->insert('users', $data);
		return $this->db->insert_id();
	}

	public function update($userId, $data): void
	{
		$this->db
		->where('id', $userId)
		->update('users', $data);
	}

	public function delete($userId)
	{
		$this->db
			->where('id', $userId)
			->delete('users');
	}

}
