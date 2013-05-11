<?php
include "request.php";

$id=$_GET["id"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/changeStat", 'POST', array("id" => $id)), true);
echo $result[0];
?> 