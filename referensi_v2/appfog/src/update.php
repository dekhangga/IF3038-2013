
<?php
include "request.php";
include "koneksi.php";

$id=$_GET["id"];
$deadline=$_GET["deadline"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/update?id=$id&deadline=$deadline",'GET',array()),true);
//$simpan = mysql_query("update tugas set deadline='$deadline' where id= '$id'");
//$tugas="select * from tugas where id= '$id'";
//$hasil=mysql_query($tugas);
foreach($result as $rlt){
echo $rlt['deadline'];
}

?> 