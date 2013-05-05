<?php
	require_once("db.php");
	require_once("login/checklogin.php");
	require_once("login/registration.php");
	require_once("dashboard/dashboard.php");
	require_once("profile/profile.php");
	
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
					$un = $request[1];
					//echo json_encode($un);
					getCat($un);
					break;
				case 'getTask':
					$un = $request[1];
					//echo json_encode("get");
					getTask($un);
					break;
				case 'catTask':
					$un = $request[1];
					//echo json_encode("cat");
					catTask($un);
					break;
				//dashboard
				//profile======================================================================
				case 'getUserName':
					$un = $request[1];
					getUserName($un);
					break;
				case 'getEmail':
					$un = $request[1];
					//echo json_encode($un);
					getEmail($un);
					break;
				case 'getAvatar':
					$un = $request[1];
					//echo json_encode("get");
					getAvatar($un);
					break;
				case 'getNamaLengkap':
					$un = $request[1];
					//echo json_encode("cat");
					getNamaLengkap($un);
					break;
				case 'getTanggalLahir':
					$un = $request[1];
					//echo json_encode($un);
					getTanggalLahir($un);
					break;
				case 'getProfil1Form':
					$un = $request[1];
					//echo json_encode("get");
					getProfil1Form($un);
					break;
				case 'getTugasSelesai':
					$un = $request[1];
					//echo json_encode("cat");
					getTugasSelesai($un);
					break;
				//profile============================================================================
				default:
					echo json_encode("Masuk Else.");
					break;
				
				
				
			}
			break;
		default: 
			echo json_encode("Masuk Else.");
			break;
	}
	
?>