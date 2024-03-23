<?php

class RolePermissionController extends CI_Controller {
	public function add_role_permission($role_name, $permission_name) {
		$this->load->model('Role_');
		$this->load->model('Permission_');

		$role_id = $this->Role_model->get_role_id($role_name);
		$permission_id = $this->Permission_model->get_permission_id($permission_name);

		// Insert role_permission mapping
	}
}
