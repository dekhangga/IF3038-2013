<?php
	function autocompletesearch($data)
	{
		$length = strlen($data);
		$result = queryAll("SELECT username FROM pengguna WHERE LEFT(username, :length) = :data", array('length' => $length, 'data' => $data));
		if ($result)
		{
			$output = $result;
		}
		else
		{
			$output = "";
		}
		echo json_encode($output);
	}
	
	function search($cari, $filter)
	{
		$length = strlen($data);
		
		if($filter=="semua")
		{
	
			$query1 = "SELECT * FROM kategori WHERE nama_kategori LIKE :cari";
			$result = queryAll($query1, array('cari' => "%".$cari."%"));
			if ($result)
			{
				echo json_encode($result);
			}
			else
			{
				echo json_encode("");
			}
			/*
			$query2 = "SELECT * FROM tugas NATURAL JOIN kategori WHERE nama_tugas LIKE :cari";
			$result = queryAll($query1, array('cari' => $cari.'%'));
			if ($result)
			{
				echo json_encode($result);
			}
			else
			{
				echo json_encode("");
			}
			
			$query3 = "SELECT * FROM tugas NATURAL JOIN kategori WHERE tag LIKE :cari";
			$result = queryAll($query1, array('cari' => $cari.'%'));
			if ($result)
			{
				echo json_encode($result);
			}
			else
			{
				echo json_encode("");
			}
			*/
		}
		
		echo json_encode($output);
	}
?>