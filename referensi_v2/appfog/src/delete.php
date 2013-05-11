<?php  
$id = $_GET['id'];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/deleteTask", 'POST', array("id" => $id)), true);
 
if ($result[0] == "Oke"){
     echo "<div class=\"task_view\" id=\"curtask1\">	Sukses menghapus data <br />
           <a href=\"dashboard.php\">Lihat Dashboard</a></div>";
} else {
     echo "Terjadi kesalahan";
}
  
  
?> 