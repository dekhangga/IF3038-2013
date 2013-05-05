<?php

	function getUserName($un)
	{	
		$con = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con)){
			echo json_encode("error connect getUserName");	
		}
		$query = "SELECT * FROM pengguna WHERE username='$un'";
		$result = mysqli_query($con,$query);
		$row = mysqli_fetch_array($result);
		/*echo json_encode("<div id=\"username\">");
		echo json_encode("<div>".$row['username']."</div>");
		echo json_encode("</div>");
		*/
		echo json_encode($un);
		mysqli_close($con);	
	}
	
	function getEmail($un)//
	{
		$con1 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con1)){
			echo json_encode("error connect getEmail");	
		}
		$query1 = "SELECT * FROM pengguna WHERE username='$un'";
		$result1 = mysqli_query($con1,$query1);
		$row1 = mysqli_fetch_array($result1);
		echo json_encode("<div id=\"email\">");
		echo json_encode("<div>".$row1['email']."</div>");
		echo json_encode("</div>");
		mysqli_close($con1);	
	}
	
	function getAvatar($un){
		$con2 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con2)){
			echo json_encode("error connect getAvatar");	
		}	
		
		$query2 = "SELECT * FROM pengguna WHERE username='$un'";
		$result2 = mysqli_query($con2,$query2);
		
		$row2 = mysqli_fetch_array($result2);
		echo json_encode("<div id=\"avatarnya\">");
		echo json_encode("<div >" . "<img width=\"200px\" height=\"200px\" src=\"".$row2['avatar']."\">" ."</div>");
		echo json_encode("</div>");
		mysqli_close($con2);	
	}
	
	function getNamaLengkap($un)//
	{
		$con3 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con3)){
			echo json_encode("error connect getNamaLengkap");	
		}
		
		$query3 = "SELECT * FROM pengguna WHERE username='$un'";
		$result3 = mysqli_query($con3,$query3);
		
		$row3 = mysqli_fetch_array($result3);
		echo json_encode("<div id=\"namalengkap\">");
		echo json_encode("<div>".$row3['nama_lengkap']."</div>");
		echo json_encode("</div>");
		
		mysqli_close($con3);	
	}
	
	function getTanggalLahir($un)//
	{
		$con4 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con4)){
			echo json_encode("error connect catTanggalLahir");	
		}
		$query4 = "SELECT * FROM pengguna WHERE username='$un'";
		$result4 = mysqli_query($con4,$query4);
		
		$row4 = mysqli_fetch_array($result4);
		echo json_encode("<div id=\"tanggallahir\">");
		echo json_encode("<div>".$row4['tanggal_lahir']."</div>");
		echo json_encode("</div>");
		mysqli_close($con4);	
	}
	function getProfil1Form($un)
	{
		$con5 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con5)){
			echo json_encode("error connect getProfileForm");	
		}
		$query5 = "SELECT * from tugas natural join mengerjakan WHERE username='$un'";
		$result5 = mysqli_query($con5,$query5);
	
		while( $row5 = mysqli_fetch_array($result5)){
			$query6 = "SELECT nama_kategori FROM kategori WHERE (id_kategori=$row5[id_kategori])";
			$result6 = mysqli_query($con5,$query6);
			$row6 = mysqli_fetch_row($result6);
	        if ($row5['status']==0) {
				echo json_encode("<div id=\"listProfilBox\">");
				echo json_encode("<div>".$row5['nama_tugas']."</div>");
				echo json_encode("<div>".$row5['deadline']."</div>");
				echo json_encode("<div>Belum selesai</div>");
				echo json_encode("<div>tag: ".$row5['tag']."</div>");
				echo json_encode("<div>".$row6[0]."</div>");
				echo json_encode("</div></a>");
			}
		}
		mysqli_close($con5);	
	}
	function getTugasSelesai($un)
	{
		$con7 = mysqli_connect("localhost","root","","progin_439_13508105");
		if(mysqli_connect_errno($con7)){
			echo json_encode("error connect getTugasSelesai");	
		}
		$query7 = "SELECT * from tugas natural join mengerjakan WHERE username='$un'";
		$result7 = mysqli_query($con7,$query7);
		
		while( $row7 = mysqli_fetch_array($result7)){
			$query8 = "SELECT nama_kategori FROM kategori WHERE (id_kategori=$row7[id_kategori])";
			$result8 = mysqli_query($con7,$query8);
			$row8 = mysqli_fetch_row($result8);
	        if ($row7['status']) {
				echo json_encode("<div id=\"listProfilBox2\">");
				echo json_encode("<div>".$row7['nama_tugas']."</div>");
				echo json_encode("<div>".$row7['deadline']."</div>");
				echo json_encode("<div>Selesai</div>");
				echo json_encode("<div>tag: ".$row7['tag']."</div>");
				echo json_encode("<div>".$row8[0]."</div>");
				echo json_encode("</div></a>");
			}
		}
		mysqli_close($con7);	
	}
?>