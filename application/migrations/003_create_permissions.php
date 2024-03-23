<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_permissions extends CI_Migration {

	public function up(): void
	{
		$this->dbforge->add_field(array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => '100',
				'unique'     => true,
			),
		));
		$this->dbforge->add_key('id', TRUE);
		$this->dbforge->create_table('permissions');
	}

	public function down(): void
	{
		$this->dbforge->drop_table('permissions');
	}
}
