<?php

class DashboardController extends CI_Controller {
	public function __construct() {
		parent::__construct();
	}

	public function index(): void
	{
		$this->load->helper(['my_helper']);

		if (!user_has_access(1)) {
			echo 'no';

		} else
		echo 'yes';
	}
}
