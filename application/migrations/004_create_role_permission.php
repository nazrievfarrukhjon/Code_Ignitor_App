<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Migration_Create_role_permission extends CI_Migration
{

	public function up(): void
	{
		$sql = "
	CREATE TABLE role_permission (
    	role_id INT(10) UNSIGNED,
    	permission_id INT(10) UNSIGNED,
    	PRIMARY KEY (role_id, permission_id),
    	FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE,
    	FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
	)";
		$this->db->query($sql);

	}

	public function down(): void
	{
		$this->dbforge->drop_table('role_permission');
	}
}
