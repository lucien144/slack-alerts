<?php
try {
	if (!file_exists(__DIR__ . '/config.php')) {
		throw new Exception('Configuration not found.');
	}

	require __DIR__ . '/config.php';
	require __DIR__ . '/slack.lib.php';

	if (!defined('SLACK_ENDPOINT')) {
		throw new Exception('Missing {SLACK_ENDPOINT} configuration.');
	}

	slack::$endpoint = SLACK_ENDPOINT;

	$units = [
		'B' => 1,
		'K' => 1024,
		'M' => 1024 * 1024,
		'G' => 1024 * 1024 * 1024,
		'T' => 1024 * 1024 * 1024 * 1024,
	];
} catch (\Throwable $e) {
	echo $e->getMessage();
	exit(1);
}