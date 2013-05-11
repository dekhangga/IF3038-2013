<?php
$q=$_GET["q"];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/deleteCat", 'POST', array("id" => $q)), true);

if ($result[0] == "Oke"){
     echo "Sukses menghapus data <br />
           <a href=\"dashboard.php\">Lihat Dashboard</a>";
} else {
     echo "Terjadi kesalahan";
}
?> 