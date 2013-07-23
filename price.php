<?php

if (isset($_GET)) {
	$first 	= $_GET['f'];
	$second = $_GET['s'];
	if ($first > 0 && $second > 0) {
		$change = ($second - $first) / $second * 100;
		echo $change;
	}
}


