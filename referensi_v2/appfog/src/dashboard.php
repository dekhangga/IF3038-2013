<?php

if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
    header('Location:../index.php') ; 
}
?>

<!DOCTYPE html>
<html>
	<!--
	<IFRAME name="iframe" src="src/header.html" width='100%' height='auto' marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto></IFRAME>
	-->
	
	<head>
		<link href='../css/desktop_style.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
		<script type="text/javascript" src="../js/base_search.js"></script>
		<script type="text/javascript" src="../js/search.js"></script> 
		<script type="text/javascript" src="../js/animation.js"> </script>
		<script type="text/javascript" src="../js/catselector.js"> </script> 	
		<script type="text/javascript" src="../js/edit_task.js"> </script> 	
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title> do.Metro </title>
	</head>
	<?php
		include 'request.php';
		$curr_username = $_COOKIE['username'];
		$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/dashboard", 'POST', array("username" => $curr_username)), true);
		$login = $result['login'];
	?>
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
					<a href="dashboard.php"><div class="header_menu_button current_header_menu"> DASHBOARD </div></a>
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
				<div id="short_profile">
					<?php echo "<img id='profile_picture' src='../img/avatar/".$login['avatar']."'>";?>
					<div id="profile_info">
						<?php echo $login['username'] ?>
					</div>
				</div>
				<div id="category_list">
					<div class="link_blue_rect" id="category_title"><a href="#" onclick="catchange(0)">All Categories </a> </div>
					<ul id="category_item">
						<?php
						$kategori = $result['kategori'];
						foreach($kategori as $rowkat) {
							$idkat = $rowkat['id'];
						?>
							<li>
							<?php echo "<a href=\"#\" onclick=\"catchange(".$idkat.")\" id=\"kuliah\">\n";?><?php echo $rowkat['namakat']; ?></a>
							<?php
							if ($rowkat['idcreator'] == $login['id']) {
								echo "<input id=\"kuliah\" onclick=\"deletekat(".$idkat.")\" type=\"button\" value=\"Delete\">";
							}
							?></li>
							
						<?php
						}
						?>
					</ul>
					<div id="add_new_category" onclick="window.open('tambahkat.php', 'PopUpAing',  'width=432,height=270,toolbar=0,scrollbars=0,screenX=200,screenY=200,left=200,top=200');tampilcat();"> TAMBAH KATEGORI </div>
					
				</div>
			</div>
			
			<div id="dynamic_content">
				

				<?php 
				$rowkats = $kategori[0];
				echo "<div style=\"display:none;\" id=\"add_links\"><center><a href=\"addtask.php?idkat=".$rowkats['id']."\">Add Task</a></center></div>"; ?>
				<br><br>
				<br><br>
				
				<?php
				$tugas = $result['tugas'];
				$i = 1;
				$a = 1;
				foreach ($tugas as $row) {
				$idtask=$row['id'];
				?>
				

				<?php echo "<div class=\"task_view\" id=\"curtask".$i."\">"; $i++; ?>
					<?php
					if ($row['idcreator'] == $login['id']) {
						echo "<img src=\"../img/done.png\" id=\"finish_".$idtask."\" onclick=\"deletetask(".$idtask.")\" class=\"task_done_button\" alt=\" \"/>";
					}
					?>
					<div id="task_name_ltd" class="left dynamic_content_left">Nama Task</div>
					<div id="task_name_rtd" class="left dynamic_content_right"> <?php echo "<a href=\"detail.php?id=".$idtask."\" "; ?>"><?php echo $row['namatask']; ?>  </a> </div>
					<br><br>
					<div class="left dynamic_content_left">Deadline</div>
					<div class="left dynamic_content_right"><?php echo $row['deadline']; ?></div>
					<br><br>
					<div class="left dynamic_content_left">Status</div>
					<?php echo "<div id=\"status".$a."\" class=\"left dynamic_content_right\">"; ?>
					<?php if ($row['status'] == 1)
					{
						echo "Selesai";
					}
					else
					{
						echo "Belum Selesai";
					} ?>
					</div>
					<?php echo "<input id=\"edit_task_button\" class=\"changestat\" onclick=\"changestat(".$idtask.",".$a.")\" type=\"button\" value=\"Change\">"; $a++; ?>
					<br><br>
					<div class="left dynamic_content_left">Tag</div>
					<div class="left dynamic_content_right"> 
					<?php
					$tag = $row['tag'];
					echo "<b>".$tag[0]."</b>";
					if (count($tag) > 1) {
						for($i = 1; $i < count($tag); $i++) {
							echo " | ";
							echo "<b>".$tag[$i]." </b>";
						}
					}
					?>
					</div>
					<br>
					<div class="task_view_category"> 
					
					</div>
					<br>
				</div>
				
				<?php
				}
				?>
				<br><br>
				
				<br><br><br><br>				
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

<!-- ini nanti jadiin footer -->
</html>