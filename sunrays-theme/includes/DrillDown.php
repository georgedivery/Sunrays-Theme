<?php 
require_once('SafetyNet.php');

$server_root = realpath(dirname(__FILE__) . '/../..');

if( isset( $_GET['start'] ) && !empty( $_GET['start'] ) ) {
	$start = $server_root . safePath($_GET['start']);
	
	drillDown($start, $server_root);
}

function drillDown($start) {
	global $server_root;

	$subs = array_filter(glob($start . '*'), 'is_dir');

	$subs = array_values($subs);

	if( count($subs) === 1 && !isIgnoredPath(str_replace($server_root, '', $subs[0])) ) {
		drillDown($subs[0] . '/', $server_root);
	} else {
		$result = str_replace($server_root, '', $start);

		echo $result;
	}
}
