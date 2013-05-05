<?php
	require_once("db.php");
	require_once("login/checklogin.php");
	require_once("login/registration.php");
	require_once("dashboard/dashboard.php");
	
	$method = $_SERVER['REQUEST_METHOD'];
	$request = explode("/", substr($_SERVER['PATH_INFO'], 1));
	//echo json_encode("Masuk.");
	
	switch ($method) 
	{
		case 'GET': 
			switch ($request[0])
			{
				case 'checklogin':
					$u = $request[1];
					$p = $request[2];
					check($u, $p);
					break;
				//register
				case 'register':
					switch ($request[1])
					{
						case 'user':
							$u = $request[2];
							checkUsername($u);
							break;
						case 'email':
							$e = $request[2];			
							checkEmail($e);
							break;
						case 'insertReg':
							$user = $request[2];
							$pwd = $request[3];
							$nama = $request[4];
							$tgl = $request[5];
							$email = $request[6];
							$avatar = $request[7];							
							registration($user, $pwd, $nama, $tgl, $email, $avatar);
							break;
						default:
							echo json_encode("Masuk Else.");
							break;
					}
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
				//search result
				case 'auto_complete_search':
					$data = $request[1];
					//echo json_encode("Masuk auto.");
					autocompletesearch($data);
					break;
				case 'search':
					$cari = $request[1];
					$filter = $request[2];
					echo json_encode("Masuk cari.");
					//search($cari, $filter);
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