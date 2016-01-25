<?php
require __DIR__ . '/bootstrap.php';

$dirs = file_get_contents('du.txt');
$lines = explode("\n", $dirs);

$treshold = 300;
$treshold *= $units['M'];

$freeSpace = round( (disk_free_space('.') / $units['G']), 2);
$usedSpace = round( (disk_total_space('.') / $units['G']) - $freeSpace, 2);

$export = '*Oz Server disk usage report for ' . date('Y/m/d') . ":*\n";
$export .= "- Total free space: *{$freeSpace}G*\n";
$export .= "- Total used space: {$usedSpace}G\n";
$export .= "- List of sites bigger than " . ($treshold / $units['M']) . "M:\n";
foreach ($lines as $line) {
	list($size, $dir) = explode("\t", $line);
	preg_match('/([0-9]+(\.[0-9]*)?)([TGMKB])/', $size, $matches);
	$size = $matches[1];
	$unit = $matches[3];

	$size = $size * $units[$unit];
	if ($size >= $treshold) {
		$export .= "> $line\n";
	}
}
slack::alert($export);