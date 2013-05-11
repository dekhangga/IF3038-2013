<?php

if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
    header('Location:../index.php') ; 
}

include "request.php";

$curr_username = $_COOKIE['username'];
$namakat=$_POST['namakat'];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/insert",'POST',array("username" => $curr_username, "namakat" => $namakat)),true);
?>
<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="../js/edit_task.js"> </script> 
        <script type="text/javascript" src="../js/animation.js"></script> 
		<script>
		window.onunload = function(){
  window.opener.location.reload();
};
		</script>
		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >		
		<title> do.Metro </title>
	</head>
<?php
if ($result == "oke") {
	echo "<script>alert('Berhasil'); history.go(-1); window.close();  </script>";
} else {
	echo "<script>alert('Gagal'); history.go(-1)</script>";
}
?>
</html>