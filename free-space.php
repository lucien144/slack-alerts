<?php
require __DIR__ . '/bootstrap.php';

$freeSpace = round( (disk_free_space('.') / $units['M']), 2);

if ($freeSpace <= 1024 / 2) {
	slack::alert('*Warning!* Free space on the server is smaller than 0.5G!');
} else

if ($freeSpace <= 1024 * 1) {
	slack::alert('*Warning!* Free space on the server is smaller than 1G!');
} else

if ($freeSpace <= 1024 * 5) {
	slack::alert('*Warning!* Free space on the server is smaller than 5G!');
} else

if ($freeSpace <= 1024 * 10) {
	slack::alert('*Warning!* Free space on the server is smaller than 10G!');
}

//slack::alert($export);