<?php

include 'koneksi.php';
include 'request.php';

$u = $_GET["u"] ;
$p = $_GET["p"] ;
$rm = $_GET["rm"] ;

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/logincheck",'POST',array("username"=>$u, "password"=>$p)),true);

//$query = "SELECT * FROM user WHERE username = '$u' and password='$p'";

//$result = mysql_query($query);
//$count = mysql_num_rows($result);
//$tuple = mysql_fetch_array($result);

if ($result['username'] == $u) {
	//console.log("lala");
    $expiredtime = 60 * 60 * 24 * 30;
    if ( $rm == "1") {
        setcookie('username', $u, time()+$expiredtime +'/'+'localhost/FDH');
        setcookie('password', $p, time()+$expiredtime +'/'+'localhost/FDH');
    } else {
        setcookie('username', $u, false +'/'+'localhost/FDH');
        setcookie('username', $p, false +'/'+'localhost/FDH');
    }
    echo "1";
} else {
    echo "Wrong Username or Password";
}
?>
