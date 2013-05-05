<?php
	require_once("db.php");
	require_once("login/checklogin.php");
	require_once("dashboard/dashboard.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr($_SERVER['PATH_INFO'], 1));
	//echo json_encode("Masuk.");
	
	switch ($method) 
	{
		case 'GET': 
			switch ($request[0]):
			{
				case 'checklogin':
					$u = $request[1];
					$p = $request[2];
					check($u, $p);
					break;
				//dashboard
				case 'ubahStatus':
					$nomor = $request[1];
					ubahStatus($nomor);
					break;
				case 'getCat':
					getCat();
					break;
				case 'getTask':
					getTask();
					break;
				case 'catTask':
					$n = $request[1];
					catTask($n);
					break;
				default:
					echo json_encode("Masuk Else.");
					break;
				//dashboard
			}
			break;
		default: 
			echo json_encode("Masuk Else.");
			break;
	}
	
?>