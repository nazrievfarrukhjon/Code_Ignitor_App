<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_user_permission extends CI_Migration
{

	public function up(): void
	{
		$sql = "
            CREATE TABLE IF NOT EXISTS user_permission (
                user_id INT(10) UNSIGNED,
                permission_id INT(10) UNSIGNED,
                PRIMARY KEY (user_id, permission_id),
                FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
                FOREIGN KEY (permission_id) REFERENCES permissions(id) ON DELETE CASCADE
            )";
		$this->db->query($sql);

	}

	public function down(): void
	{
		$this->dbforge->drop_table('user_permission');
	}
}
