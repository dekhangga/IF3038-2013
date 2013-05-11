<?php include 'request.php' ?>
<?php
	$username = $_COOKIE['username'];
	$avatar = $_FILES['avatar']['name'];
	
	SendRequest("http://pabotmania.ap01.aws.af.cm/changeAvatar", 'POST', array("username" => $username, "avatar" => $avatar));
	
	if ($_FILES['avatar']['error'] > 0) {
		echo "Return Code: " . $_FILES["avatar"]["error"] . "<br>";
	} else {
		move_uploaded_file($_FILES["avatar"]["tmp_name"], "../img/avatar/" . $_FILES["avatar"]["name"]);
	}

	header("Location:profile.php?user=".$username);
?>