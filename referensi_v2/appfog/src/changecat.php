<?php
include "request.php";

$id = $_GET["id"];
$curr_username = $_COOKIE['username'];
$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/changeCat", 'POST', array("id" => $id, "username" => $curr_username)), true);
$hasil = $result['tugas'];
$login = $result['login'];
$i = 1;

echo "<div style=\"display:block;\" id=\"add_links\"><center><a href=\"addtask.php?idkat=".$id."\"><span class='link_blue'>Add Task</span></a></center></div>";

foreach($hasil as $row) {
	$idtask=$row['id'];
	echo "<br>";
	echo "<div class=\"task_view\" id=\"curtask".$i."\">";
	$i++;
	if ($row['idcreator'] == $login['id']) {
		echo "<img src=\"../img/done.png\" id=\"finish_".$idtask."\" onclick=\"deletetask(".$idtask.")\" class=\"task_done_button\" alt=\" \"/>";
	}
	echo "<div id=\"task_name_ltd\" class=\"left dynamic_content_left\">Nama Task</div>";
	echo "<div id=\"task_name_rtd\" class=\"left dynamic_content_right\">";
	echo "<a href=\"detail.php?id=".$idtask."\"> ";
	echo $row['namatask'];
	echo "</a> </div> <br><br>";
	echo "<div class=\"left dynamic_content_left\">Deadline</div><div class=\"left dynamic_content_right\">";
	echo $row['deadline'];
	echo "</div><br><br>";
	echo "<div class=\"left dynamic_content_left\">Status</div><div id=\"status\" class=\"left dynamic_content_right\">";
	
	if ($row['status'] == 1) {
		echo "Selesai";
	} else {
		echo "Belum Selesai";
	}
	
	echo "</div>";
	echo "<input id=\"edit_task_button\" class=\"changestat\" onclick=\"changestat(".$idtask.")\" type=\"button\" value=\"Ubah\">";
	echo "<br><br>	<div class=\"left dynamic_content_left\">Tag</div> <div class=\"left dynamic_content_right\"> ";
	
	$tag = $row['tag'];
	echo "<b>".$tag[0]."</b>";
	if (count($tag) > 0) {
		for($i = 1; $i < count($tag); $i++) {
			echo " | ";
			echo "<b>".$tag[$i]." </b>";
		}
	}

	echo "</div><br><div class=\"task_view_category\"> </div><br></div>";
}
?> 