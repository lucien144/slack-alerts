<?php
require __DIR__ . '/bootstrap.php';

$freeSpace = round( (disk_free_space('.') / $units['G']), 2);

switch (TRUE) {
	case ($freeSpace <= 0.5):
		slack::alert(':rotating_light: *Warning!* Free space on the server is smaller than 0.5G!');
		break;

	case ($freeSpace <= 1):
		slack::alert(':warning: *Warning!* Free space on the server is smaller than 1G!');
		break;

	case (defined("WARNING_TRESHOLD") && $freeSpace <= WARNING_TRESHOLD):
		slack::alert(sprintf(':warning: *Warning!* Free space on the server is smaller than %sG!', WARNING_TRESHOLD));
		break;
}