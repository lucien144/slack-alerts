<?php
require __DIR__ . '/config.php';
require __DIR__ . '/slack.lib.php';
slack::$endpoint = SLACK_ENDPOINT;

$units = [
	'B' => 1,
	'K' => 1024,
	'M' => 1024 * 1024,
	'G' => 1024 * 1024 * 1024,
	'T' => 1024 * 1024 * 1024 * 1024,
];