<?php
	function check($username, $password)
	{
		$result = query("SELECT * from pengguna WHERE username = :username AND password = :password", array('username' => $username, 'password' => $password));
		if ($result)
		{
			$output = 1;
		}
		else
		{
			$output = 0;
		}
		
		echo json_encode($output);
	}
?>