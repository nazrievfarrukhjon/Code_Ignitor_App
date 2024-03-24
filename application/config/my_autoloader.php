<?php

function dd(...$args): void
{
	if (\is_array($args)) {
		foreach ($args as $arg) {
			if (is_array($arg)) {
				print_r($arg);
			} else {
				var_dump($arg);
			}
		}
	} else {
		var_dump($args);
	}
	die("\n");
}

spl_autoload_register(function ($class) {

	$file = __DIR__ . '/../' . str_replace('\\', '/', $class) . '.php';

	// Check if the file exists
	if (file_exists($file)) {
		require_once $file;
	}
});

/**
 * @throws Exception
 */
function authenticated($ci): void
{
	$email = $ci->input->get('email');
	if ($email) {
		$ci->load->driver('cache');
		$savedToken = $ci->cache->file->get($email)['hashed'];

		$comingToken = $ci->input->get_request_header('Authorization');

		if ($comingToken && strpos($comingToken, 'Bearer ') === 0) {
			$comingToken = substr($comingToken, 7);
		}
		if (!$savedToken || !password_verify($comingToken, $savedToken)) {
			throw new Exception('unauthenticated!', 401);
		}
	} else {
		throw new Exception('provide email!', 422);
	}
}
