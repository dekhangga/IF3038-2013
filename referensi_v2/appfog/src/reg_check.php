<?php

include 'koneksi.php';

$u = $_GET["u"];
$e = $_GET["e"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/regCheck", 'POST', array("u" => $u, "e" => $e)), true);

$count = $result['count'];
$count2 = $result['count2'];

echo "$count;$count2;$e";
?>
