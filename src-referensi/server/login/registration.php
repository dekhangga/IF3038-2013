<?php
	function checkUsername($username)
	{
		$result = query("SELECT * from pengguna WHERE username = :username", array('username' => $username));
		if ($result)
		{
			$output = 0;
		}
		else
		{
			$output = 1;
		}
		
		echo json_encode($output);
	}

	function checkEmail($email)
	{
		$result = query("SELECT * from pengguna WHERE email = :email", array('email' => $email));
		if ($result)
		{
			$output = 0;
		}
		else
		{
			$output = 1;
		}
		
		echo json_encode($output);
	}
		
	function registration($user, $pwd, $nama, $tgl, $email, $avatar)
	{
		query2("INSERT INTO pengguna (username,password,nama_lengkap,tanggal_lahir,email,avatar) VALUES (:user, :pwd, :nama, :tgl, :email, :avatar)", array('user' => $user, 'pwd' => $pwd, 'nama' => $nama, 'tgl' => $tgl, 'email' => $email, 'avatar' => $avatar));
		$output = 1;
		echo json_encode($output);
	}
?>