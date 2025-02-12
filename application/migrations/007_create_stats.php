<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Create_stats extends CI_Migration
{

	public function up(): void
	{
		$this->load->dbforge();

		$fields = array(
			'id' => array(
				'type' => 'INT',
				'constraint' => 10,
				'unsigned' => TRUE,
				'auto_increment' => TRUE
			),
			'name' => array(
				'type' => 'VARCHAR',
				'constraint' => 100,
			),
			'level_id' => array(
				'type' => 'INT',
				'constraint' => 3,
			),
			'location_id' => array(
				'type' => 'INT',
				'constraint' => 2,
			),
		);

		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('id', TRUE);

		$this->dbforge->create_table('stats', TRUE);
	}

	public function down(): void
	{
		$this->dbforge->drop_table('stats');
	}
}
