<?php
require __DIR__ . '/bootstrap.php';

$dirs = file_get_contents('du.txt');
$lines = explode("\n", $dirs);

$treshold = 300;
$treshold *= $units['M'];

$freeSpace = round((disk_free_space('.') / $units['G']), 2);
$usedSpace = round((disk_total_space('.') / $units['G']) - $freeSpace, 2);

$dirs = [];
foreach ($lines as $line) {
	@list($size, $dir) = @explode("\t", $line);
	if (!preg_match('/^([0-9]+(\.[0-9]*)?)([TGMKB])\s+(.*)$/', $size, $matches)) {
		continue;
	}
	$size = $matches[1];
	$unit = $matches[3];
	$dir = $matches[4];

	$bytes = $size * $units[$unit];
	if ($bytes >= $treshold) {
		$dirs[] = sprintf('- *%s%s* `%s`', $size, $unit, $dir);
	}
}

$leftColumn = sprintf("*Stats*\n - :simple_smile: Total free space: *%s%s*\n - :persevere: Total used space: %s%s", $freeSpace, 'G', $usedSpace, 'G');
$rightColumn = sprintf("*Sites >= %s%s*\n%s", ($treshold / $units['M']), 'M', implode("\n", $dirs));

slack::report('Server report: ' . gethostname(), 'Disk usage report for ' . date('Y/m/d'), $leftColumn, $rightColumn);