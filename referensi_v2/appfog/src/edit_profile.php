<?php include 'request.php'?>
<?php
	$username = $_COOKIE['username'];
	$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/profile", 'POST', array("login" => $username, "profile" => $username)), true);
	$profile = $result['profile'];
	
	echo "<div id='upperprof'>
		<img id='profpic' src='../img/avatar/".$profile['avatar']."' alt=''>
		<div id='namauser'>
			<input type='text' class='bio_edit' id='bio_fullname' value='" . $profile['fullname'] . "'>
		</div>
	</div>
	<div id='bio'>
		<span id='left'>
		<b>Username</b>
		<br/>
		<b>Email</b>
		<br/>
		<b>Birthdate</b>
		<br/>
		<button class='link_tosca' id='save_profile_button' onclick=\"save_profile(".$profile['id'].",'".$profile['password']."')\"> Save Changes </button>
		</span>
		<span id='right'>
			: " . $profile['username'] . "
			<br/>
			: <input type='email' class='bio_edit' id='bio_email' value='" . $profile['email'] . "'>
			<br/>
			: <input type='text' class='bio_edit' name='bio_birthdate' id='bio_birthdate' value='" . $profile['birthdate'] . "'>
		</span>
	</div>";
?>