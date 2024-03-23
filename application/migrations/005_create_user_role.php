<?php

defined('BASEPATH') or exit('No direct script access allowed');


class Migration_Create_user_role extends CI_Migration
{

	public function up(): void
	{
		$sql = "
			CREATE TABLE IF NOT EXISTS user_role (
    			user_id INT(10) UNSIGNED,
    			role_id INT(10) UNSIGNED,
    			PRIMARY KEY (user_id, role_id),
    			FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    			FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE CASCADE
			)";
		$this->db->query($sql);
	}

	public function down(): void
	{
		$this->dbforge->drop_table('user_role');
	}

}
