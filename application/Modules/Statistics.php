<?php

namespace Modules;

class Statistics
{
	private $ci;
	private int $locationId;
	private int $levelId;

	private array $otherFilters;


	public function __construct($ci,  int $locationId, int $levelId, array $otherFilters = [])
	{
		$this->ci = $ci;
		$this->levelId = $levelId;
		$this->locationId = $locationId;
		$this->otherFilters = $otherFilters;

	}

	public function stats(): array
	{
		$this->ci->db->select('*')->from('stats');

		$this->ci->db->group_start();
		$this->ci->db->where('level_id <', $this->levelId);
		$this->ci->db->or_where('location_id', $this->locationId);
		$this->ci->db->group_end();

		if (isset($this->otherFilters['sortBy']) && isset($this->otherFilters['sortDirection'])) {
			$this->ci->db->order_by($this->otherFilters['sortBy'], $this->otherFilters['sortDirection']);
		}

		$query = $this->ci->db->get();
		$this->log();

		return $query->result_array();
	}

	/**
	 * @return void
	 */
	public function log(): void
	{
		$storedQueries = $this->ci->db->queries;

		$logMessage = "Executed Queries:\n";
		$logMessage .= implode("\n", $storedQueries) . "\n";

		$logFilePath = APPPATH . 'logs/db_queries.log'; // Path to the log file

		if (!file_exists($logFilePath)) {
			if (!is_dir(dirname($logFilePath))) {
				mkdir(dirname($logFilePath), 0777, true);
			}

			file_put_contents($logFilePath, '');
		}

		file_put_contents($logFilePath, $logMessage, FILE_APPEND);
	}


}
