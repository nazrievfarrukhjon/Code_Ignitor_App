<?php

use Modules\Statistics;

class StatsController extends CI_Controller {
	public function __construct() {
		parent::__construct();

		$this->load->model('User');
		$this->load->database();
	}

	public function stats(): void
	{
		$locationId = $this->input->get('location_id');
		$levelId = $this->input->get('level_id');

		echo json_encode([
			'stats' =>
				(new Statistics(
					$this,
					$locationId,
					$levelId,
					$otherFilters = []
				))->stats()
		]);

	}

}
