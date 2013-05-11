<?php  
include "koneksi.php";
include "request.php";

$id = $_GET['id'];
$idtask = $_GET['stat'];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/del_komen?id=$id&idtask=$idtask",'GET',array()),true);

//$sql = "DELETE FROM komentar WHERE id='$id'";
//$result = mysql_query($sql);
 
//$jumlah ="SELECT COUNT(id) as jumlah FROM komentar where idtask='$idtask'";
					//$resultjml = mysql_query($jumlah);
					
//$rowjml = mysql_fetch_assoc($result);
echo "Jumlah Komentar : ".$result['jumlah']." <br> ";

echo "Menghapus komentar sukses <br>
	<a href=\"detail.php?id=".$idtask."\">Kembali ke Rincian Tugas";
  
?> 