<?php
	function ubahStatus($nomor)
	{	
	}
	function getCat()
	{
		$result = queryAll('SELECT * from kategori');
	
		while( $result){
			echo json_encode("<div id=\"categ\" onclick=\"showAddTask();catTask($row[id_kategori]);  \">");
			echo json_encode("<div>".$row['nama_kategori']."</div>");
			echo json_encode("</div>");
		}
	}
	
	function getTask()
	{
		$result = queryAll ('SELECT * from tugas natural join mengerjakan');
		
		while( $result){
			$result2 = queryAll ('SELECT nama_kategori FROM kategori WHERE (id_kategori=:result[id_kategori])');

	        echo json_encode("<a href=\"rinciantugas.php?id_tugas=".$row['id_tugas']."\">");
			echo json_encode("<div id=\"listtask\">");
			echo json_encode("<div>".$row['nama_tugas']."</div>");
			echo json_encode("<div>".$row['deadline']."</div>");
			echo json_encode("<div>tag: ".$row['tag']."</div>");
			if ($row['status']) {
				echo json_encode("<input type=\"checkbox\" name=\"Status\" checked onclick=\"ubahStatus(".$row['id_tugas'].")\">Selesai");
			} else {
				echo json_encode("<input type=\"checkbox\" name=\"Status\" onclick=\"ubahStatus(".$row['id_tugas'].")\">Belum Selesai");
			}
			echo json_encode("<div><button type=\"button\">Delete</button></div>");
		
			echo json_encode("<div>".$row2[0]."</div>");
			echo json_encode("</div></a>");
		}
	}
	
	function catTask($n)
	{
		$result = queryAll("SELECT * from tugas natural join mengerjakan WHERE id_kategori= :n", array("n" => $n));
		$temp=0;
		while( $result){
			$temp+=1;
	        echo json_encode("<a href=\"rinciantugas.php?id_tugas=".$row['id_tugas']."\">");
			echo json_encode("<div id=\"listtask\">");
			echo json_encode("<div>".$row['nama_tugas']."</div>");
			echo json_encode("<div>".$row['deadline']."</div>");
			echo json_encode("<div>tag: ".$row['tag']."</div>");
			
			if ($row['status']) {
				echo json_encode("<input type=\"checkbox\" name=\"Status\" checked onclick=\"ubahStatus(".$row['id_tugas'].")\">Selesai");
			} else {
				echo json_encode("<input type=\"checkbox\" name=\"Status\" onclick=\"ubahStatus(".$row['id_tugas'].")\">Belum Selesai");
			}
			
			echo json_encode("</div></a>");
		}
	}
?>