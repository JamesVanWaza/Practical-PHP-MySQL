<?php 
	include_once 'html5req.php';
	echo "<pre>";
	/** Returns a list of hashing algorithms */
	print_r(hash_algos());
	echo "</pre>";
?>