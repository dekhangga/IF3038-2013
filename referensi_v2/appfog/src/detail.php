<?php
	include 'request.php';
	
	if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
		header('Location:../index.php') ; 
	}
	
	$id = $_GET['id'];
	$curr_username = $_COOKIE['username'];
	
	// number of rows to show per page
	$rowsperpage = 10;

	// get the current page or set a default
	if (isset($_GET['currentpage']) && is_numeric($_GET['currentpage'])) {
	   // cast var as int
	   $currentpage = (int) $_GET['currentpage'];
	} else {
	   // default page num
	   $currentpage = 1;
	} // end if

	// the offset of the list, based on current page 
	$offset = ($currentpage - 1) * $rowsperpage;
	
	$args = array();
	$args['id'] = $id;
	$args['username'] = $curr_username;
	$args['rowsperpage'] = $rowsperpage;
	$args['offset'] = $offset;
	
	$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/detail", 'POST', $args), true);
	$login = $result['login'];
		
?>
<!DOCTYPE html>
<html>
	<head>
		<link href='../css/desktop_style.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
		<script type="text/javascript" src="../js/base_search.js"></script>
		<script type="text/javascript" src="../js/search.js"></script> 
		<script type="text/javascript" src="../js/edit_task.js"> </script> 
		<script type="text/javascript" src="../js/animation.js"> </script> 
		<script type="text/javascript" src="../js/ajax.js"> </script>
		<script type="text/javascript" src="../js/ajax.js"> </script>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >		
		<title> do.Metro </title>
	</head>	
	<body>
		<!-- Web Header -->
		<header>
			<div id="header_container"> 
				<div class="left">
					<a href="dashboard.php"> <img src="../img/logo.png" alt=""> </a>
				</div>
				<form id="search_form" action="search_results.php" method="get" class="sb_wrapper">
					<input id="search_box" name="search_query" type="text" placeholder="Search...">
					<button type="submit" id="search_button" value></button>
					<ul class="sb_dropdown">
						<li class="sb_filter">Filter your search</li>
						<li><input type="checkbox"/><label for="all"><strong>Select All</strong></label></li>
						<li><input type="checkbox" name="username" id="username" /><label for="Username">Username</label></li>
						<li><input type="checkbox" name="category" id="category" /><label for="Category">Category</label></li>
						<li><input type="checkbox" name="task" id="task" /><label for="Task">Task</label></li>
					</ul>
				</form>
				<div class="header_menu"> 
					<a href="dashboard.php"><div class="header_menu_button"> DASHBOARD </div></a>
					<?php
						echo "<a href='profile.php?user=".$curr_username."'>";
					?>
					<div class="header_menu_button">
						<?php echo "<img id='header_img' src='../img/avatar/".$login['avatar']."'>";?>
						<div id="header_profile">
							&nbsp;&nbsp;<?php echo $login['username'];?>
						</div>
					</div>
					</a>
					<a id="logout" href="logout.php"><div class="header_menu_button"> LOGOUT </div></a>
				</div>
			</div>
			<div class="thin_line"></div>
		</header>

		
		<!-- Web Content -->
		<section>
			<div id="navbar">
				<?php echo "<a href='profile.php?user=".$curr_username."'>";?>
				<div id="short_profile">
					<?php echo "<img id='profile_picture' src='../img/avatar/".$login['avatar']."'>";?>
					<div id="profile_info">
						<?php echo $login['username'];?>
					</div>
				</div>
				<?php echo "</a>" ?>
			</div>
			<form>
			<div id="dynamic_content">
				<div id="edit_task_header" class="left top30 dynamic_content_head">
				<?php
				$tugas = $result['tugas'];
				$idtask=$tugas['id'];
				$a = 1;
				?>
					<?php echo $tugas['namatask']; ?>
				</div>
				
				<?php
					$ass1 = $tugas['assignee'];
					$bool = false;
					
					foreach ($ass1 as $row2) {
						if ($row2 == $curr_username) {
							$bool = true;
						}
					}
					
					if ($bool == true) {
						echo "<input id=\"edit_task_button\" class=\"left top30 link_blue_rect\" 
						onclick=\"edit_task(".$tugas['id'].")\" type=\"button\" value=\"Edit Task\">";
					}
				?>
				
				<?php echo "<input id=\"save_button_td\" class=\"left top30 link_blue_rect\" 
					onclick=\"save_edit_task(".$tugas['id'].")\" type=\"button\" value=\"Save\">"; ?>
				
				
				<div id="row1_taskdetail" class="left top30 dynamic_content_row">
					<div id="task_name_ltd" class="left dynamic_content_left">Nama Tugas</div>
					<div id="task_name_rtd" class="left dynamic_content_right"> <?php echo $tugas['namatask']; ?></div>
				</div>
				
				<div id="row2_taskdetail" class="left top10 dynamic_content_row">
					<div class="left dynamic_content_left">Status</div>
					<?php echo "<div id=\"status".$a."\" class=\"left dynamic_content_right\">"; ?>
					<?php if ($tugas['status'] == 1)
					{
						echo "Selesai";
					}
					else
					{
						echo "Belum Selesai";
					} ?>
					</div>
					<?php echo "<input id=\"edit_task_button\" class=\"changestat\" onclick=\"changestat(".$idtask.",".$a.")\" type=\"button\" value=\"Ubah\">"; $a++; ?>
					<br><br>
					</div>
				
				<div id="row3_taskdetail" class="left top10 dynamic_content_row">
					<div id="deadline_ltd" class="left dynamic_content_left">Deadline</div>
					<div id="deadline_rtd" class="left dynamic_content_right">
					<?php 
					echo $tugas['deadline']; 
					?></div>
				</div>
				<div id="row31_taskdetail" class="left top10 dynamic_content_row">
					<div id="attachment_ltd" class="left dynamic_content_left">Attachment</div>
					<div id="attachment_rtd" class="left dynamic_content_right">
					<?php 
					$attach = $result['attachment'];
					foreach ($attach as $row) {
						$temp = (explode(".", $row["filename"]));
						$ext = end($temp);
						
						if (($ext == "pdf") || ($ext == "doc")) {
						
							echo "Download : <a href=\"../attachment/".$row['filename']."\" target=\"_blank\">".$row['filename']."</a><br>"; 
						
						} else if (($ext == "jpg") || ($ext == "jpeg")) {	
						
							echo "<img width=\"300\" src=\"../attachment/".$row['filename']."\"></img><br>"; 
						
						} else if ($ext == "ogg" || $ext == "3gp") {
						
							echo "<video width=\"320\" height=\"240\" controls=\"controls\">
									<source src=\"../attachment/".$row['filename']."\" type=\"video/ogg\">
									Your browser does not support the video tag.
								</video><br>";
						}
					}	
					?>
					</div>
				</div>
				<div id="row4_taskdetail" class="left top10 dynamic_content_row">
					<div id="assignee_ltd" class="left dynamic_content_left">Assignee</div>
					<div id="assignee_rtd" class="left dynamic_content_right">
					<div id="inputass">
					<?php
					$ass2 = $result['assignee'];
					foreach ($ass2 as $rowassignee) {
						echo "<a href=\"profile.php?user=".$rowassignee['nama_user']." \">".$rowassignee['nama_user']."</a>";
						echo "<br>";
					}
					?>
					<div id="edit_ass" style="display:none"> <form> <table>  <tr> <input type="text" id="assignee" autocomplete="off" list="listassignee" onkeydown="javascript:getSuggest();"></input>
						<datalist id="listassignee">
						</datalist>
						</td></tr><tr><td><?php echo "<input id=\"tambah_button\" type=\"button\" onclick=\"addRows(".$id.")\" value=\"Tambah\" />" ?>  </td>    </tr>   </table></form>
					</div>
					<div id="delete_ass" style="display:none"> <?php
						echo "<form action=\"\"> <select id=\"assignees\" onchange=\"delAss(this.value, ".$id.")\"> <option value=\"\">Delete an assignee:</option>";
						$assignee = array();
						foreach ($ass2 as $row) {
							$assignee[] = $row['nama_user'];
						}
						
						foreach ($assignee as $opt) {
							$sel = '';
							if (in_array($opt, $mytitle)) {
								$sel = ' selected="selected" ';
							}
							echo '<option ' . $sel . ' value="' . $opt . '">' . $opt . '</option>';
						}
						echo "</select></form>";
						?>
					</div>
					</div>
					</div>
				</div>
				<div id="row5_taskdetail" class="left top10 dynamic_content_row">
					<div id="tag_ltd" class="left dynamic_content_left">Tag</div>
					<div id="tag_rtd" class="left dynamic_content_right"> 
					
					<?php
					$tag = $result['tag'];
					echo $tag[0];
					
					if (count($tag) > 1) {
						for ($i = 1; $i < count($tag); $i++) {
							echo " | ";
							echo "".$tag[$i]." ";
						}
					}
					?>
					<div id="edit_tag" style="display:none">
						<input type="text" id="tag_input" list="listtag" onkeydown="javascript:getSuggesttag();">
						<datalist id="listtag">
						</datalist>
						<?php echo "<input id=\"tag_button\" type=\"button\" onclick=\"editTag(".$id.")\" value=\"Save Tag\" />"; ?>                    
					</div>

					</div>
				</div>
				</form>
				<div id="row6_taskdetail" class="left top10 dynamic_content_row">
					<div id="comment_ltd" class="left dynamic_content_left">Komentar</div>
					<div id="comment_rtd" class="left dynamic_content_right">
				<?php
				$jumlah = $result['jumlahkom'];
				echo "Jumlah Komentar : ".$jumlah." <br> ";
				$numrows = $jumlah;

				// find out total pages
				$totalpages = ceil($numrows / $rowsperpage);

				// if current page is greater than total pages...
				if ($currentpage > $totalpages) {
				   // set current page to last page
				   $currentpage = $totalpages;
				} // end if
				// if current page is less than first page...
				if ($currentpage < 1) {
				   // set current page to first page
				   $currentpage = 1;
				} // end if

				// get the info from the db 
				$data = $result['komentar'];

				// while there are rows to be fetched...
				foreach($data as $list) {
					echo "<img width=\"30\" height=\"30\" src=\"../img/avatar/".$list['avatar']."\"></img> (".$list['waktu'].") : ";
					echo $list['komentar'];
					if ($list['iduser'] == $curr_username) {
						echo "<input class=\"right top30 link_blue_rect\" type=\"button\" value=\"Delete\" onclick=\"del_komen(".$list['kid'].",".$id.");\"></input>"; 
					}
					echo "<br><hr>";
				} // end while

				/******  build the pagination links ******/
				// range of num links to show
				$range = 5;

				// if not on page 1, don't show back links
				if ($currentpage > 1) {
				   // show << link to go back to page 1
				   echo " <a href='detail.php?id=".$id."&currentpage=1'><<</a> ";
				   // get previous page num
				   $prevpage = $currentpage - 1;
				   // show < link to go back to 1 page
				   echo " <a href='detail.php?id=".$id."&currentpage=$prevpage'><</a> ";
				} // end if 

				// loop to show links to range of pages around current page
				for ($x = ($currentpage - $range); $x < (($currentpage + $range) + 1); $x++) {
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) {
					  // if we're on current page...
					  if ($x == $currentpage) {
						 // 'highlight' it but don't make a link
						 echo " [<b>$x</b>] ";
					  // if not current page...
					  } else {
						 // make it a link
						 echo " <a href='detail.php?id=".$id."&currentpage=$x'>$x</a> ";
					  } // end else
				   } // end if 
				} // end for
								 
				// if not on last page, show forward and last page links        
				if ($currentpage != $totalpages) {
				   // get next page
				   $nextpage = $currentpage + 1;
					// echo forward link for next page 
				   echo " <a href='detail.php?id=".$id."&currentpage=$nextpage'>></a> ";
				   // echo forward link for lastpage
				   echo " <a href='detail.php?id=".$id."&currentpage=$totalpages'>>></a> ";
				} // end if
				/****** end build pagination links ******/
				?>
					</div>
				</div>
				
				<div id="row7_taskdetail" class="left top10 dynamic_content_row">
					<div id="addcomment_ltd" class="left dynamic_content_left">Add Comment</div>
					<div id="addcomment_rtd" class="left dynamic_content_right">
						<?php 
echo "<div id=\"result\" style=\"display:none;\"></div>
<form>
   <table>
        <tr>
			<textarea id=\"komentar\" rows=\"4\" cols=\"50\" ></textarea>
        </td>
        </tr>
        
        <tr>
            <td>
                <input type=\"button\" onclick=\"add_comment(".$idtask.",".$login['id'].")\" value=\"Submit\" />
                <input type=\"reset\" value=\"Reset\" />
            </td>
        </tr>
    </table>
</form>";?>
					</div>
				</div>
			</div>
		</section>
		
		<!-- Footer Section -->
		<div class="thin_line"></div>
		<footer>
			<div id="footer_container"> 
				<br><br>
				About &nbsp;&nbsp;&nbsp; FAQ &nbsp;&nbsp;&nbsp; Feedback &nbsp;&nbsp;&nbsp; Terms &nbsp;&nbsp;&nbsp; Privay &nbsp;&nbsp;&nbsp; Copyright 
				<br>
				do.Metro 2013
			</div>
		</footer>
	</body>
</html>