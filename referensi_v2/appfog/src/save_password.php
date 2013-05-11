<?php include 'request.php' ?>
<?php
	$q = $_GET['q'];
	$continue = strtok($q,"|");
	$newpass = strtok("|");
	
	$user = $_COOKIE['username'];
	
	$pass = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/updatePassword", 'POST', array("user" => $user, "continue" => $continue, "newpass" => $newpass)), true);
	
	echo "
		<span id='left'>
			<span id='change_password'>
				<button class='link_tosca' id='change_pass_button' onclick='change_pass()'> Change Password </button>";
			if ($pass == $newpass && $continue == 1)
				echo "You input the same password as your old one !";
	echo "
			</span>
		</span>
		<span id='right'>
			<span id='form_change_password'>
			</span>
		</span>
	";
?>