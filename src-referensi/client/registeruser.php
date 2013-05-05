<?php
	
	$user=$_GET["user"];
	$con = mysqli_connect("localhost","root","","progin_405_13510003");
	
	if(mysqli_connect_errno($con)){
		echo "error gan";	
	}	
	
	$query = "SELECT * from pengguna WHERE username = '$user'";
	$result = mysqli_query($con,$query);

	$row = mysqli_fetch_array($result);
	if ($user == $row['username']){
		echo false;	
	}else{
		echo true;	
	}
	
	mysqli_close($con);	


?>