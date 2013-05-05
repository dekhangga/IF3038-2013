<?php
	if (!isset($_GET['url'])) 
	{
		die();
	}
	
	$url = urldecode($_GET['url']);
	$url = 'http://' . str_replace('http://', '', $url);
	echo file_get_contents($url);
?>