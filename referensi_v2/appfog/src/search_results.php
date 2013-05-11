<?php

if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
    header('Location:../index.php') ; 
}

?>
<!DOCTYPE html>
<html>	
	<head>
		<link href='../css/desktop_style.css' rel='stylesheet' type='text/css'>
		<link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
		<script type="text/javascript" src="../js/base_search.js"></script>
		<script type="text/javascript" src="../js/search.js"></script> 
		<script type="text/javascript" src="../js/animation.js"> </script>
		<script type="text/javascript" src="../js/ajax.js"> </script>
		<script type="text/javascript" src="../js/catselector.js"> </script> 		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title> do.Metro </title>
	</head>
	
	<body>
		<?php include 'request.php'?>
		<?php
			$curr_username = $_COOKIE['username'];
			$query = $_GET['search_query'];
			
			$args = array();
			$args['username'] = $curr_username;
			$args['query'] = $query;
			if (isset($_GET['username']))
				$args['u'] = "on";
			if (isset($_GET['category']))
				$args['c'] = "on";
			if (isset($_GET['task']))
				$args['t'] = "on";
				
			$search_results = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/searchResults", 'POST', $args), true);
			$profile = $search_results['profile'];
			
			if (isset($_GET['username'])) {
				$numrows_user = $search_results['rowsu'];
				$username = $search_results['user'];
			}
			
			if (isset($_GET['category'])) {
				$numrows_category = $search_results['rowsc'];
				$category = $search_results['category'];
			}
			
			if (isset($_GET['task'])) {
				$numrows_task = $search_results['rowst'];
				$task = $search_results['task'];
			}
		?>
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
						<?php echo "<img id='header_img' src='../img/".$profile['avatar']."'>";?>
						<div id="header_profile">
							&nbsp;&nbsp;<?php echo $profile['username'];?>
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
					<?php echo "<img id='profile_picture' src='../img/avatar/".$profile['avatar']."'>";?>
					<div id="profile_info">
						<?php echo $profile['username'];?>
					</div>
				</div>
				<?php echo "</a>" ?>
				<div id="nav_search">
					<form id="nav_search_form" action="search_results.php" method="get">
						<div id="nav_search_change" class="section">
							&nbsp;Change Keyword
							<input id="nav_search_box" name="search_query" type="text" value="" list="listsearch" onkeydown="javascript:getSuggestse();">
							    <datalist id="listsearch">
								</datalist>
						</div>
						<div class="section">
							<ul class="nav_search_filter">
								<li id="nav_filter"><b>Filter</b></li>
								<li><input type="checkbox"/><label for="all"><strong>Select All</strong></label></li>
								<li><input type="checkbox" name="username"/><label for="Username">Username</label></li>
								<li><input type="checkbox" name="category"/><label for="Category">Category</label></li>
								<li><input type="checkbox" name="task"/><label for="Task">Task</label></li>
							</ul>
						</div>
						<div id="nav_search_button" class="section">
							<button type="submit" id="blue_button" value>Search</button>
						</div>
					</form>
				</div>
			</div>
			<div id="dynamic_content">
				<br>
				<?php if (isset($category)) {
					echo "
					<div class='search_result' id='searchtitle'>
						Category
					</div>
					<br>";
						  
					foreach($category as $c) {
						echo "
						<div class='search_result'>
							<div class='left dynamic_content_left'>Name</div>
							<div class='left dynamic_content_right'>".$c['namakat']."</div>
							<br>
						</div>	
						<br>";
					}
					
					if ($numrows_category > 5) {
						echo "
						<a href='search_classified.php?filter=category&q=".$query."'>
							<button type='submit' id='aqua_button'>View more</button>
						</a>
						<br>
						<br>";
					}
				}
				?>
				<?php if (isset($task)) {
					echo "
					<div class='search_result' id='searchtitle'>
						Task
					</div>
					<br>";
						  
					foreach($task as $row) {
						echo "
						<div class='search_result'>
							<div class='left dynamic_content_left'>Task Name</div>
							<div class='left dynamic_content_right'> <a href='detail.php?id=".$row['id']."'> ".$row['namatask']." </a> </div>
							<br>
							<div class='left dynamic_content_left'>Deadline</div>
							<div class='left dynamic_content_right'> ".$row['deadline']." </div>
							<br>
							<div class='left dynamic_content_left'>Tag</div>
							<div class='left dynamic_content_right'>
								";
							$row_tag = $row['tag'];
							echo $row_tag[0];
							if (count($row_tag) > 1) {
								for ($i = 1; $i < count($row_tag); $i++)
									echo ", ".$row_tag[$i];
							}
						echo "
							</div>
							<br>
							<div class='left dynamic_content_left'>Status</div>
							";
							
							if ($row['status'] == 0)
								echo "<div class='left dynamic_content_right' id='red'> Ongoing </div>";
							else
								echo "<div class='left dynamic_content_right' id='green'> Done </div>";
							
						$namakat = $row['namakat'];
						
						echo "
							<div class='search_result_category'> ".$namakat." </div>
							<br><br>
						</div>	
						<br>";
					}
					
					if ($numrows_task > 5) {
						echo "
						<a href='search_classified.php?f=task&q=".$query."'>
							<button type='submit' id='aqua_button'>View more</button>
						</a>
						<br>
						<br>";
					}
				}
				?>
				<?php if(isset($username)) {
					echo "
					<div class='search_result' id='searchtitle'>
						Username
					</div>
					<br>";
						  
					foreach ($username as $row) {
						echo "
						<div class='search_result'>
							<div class='left dynamic_content_left'>Username</div>
							<div class='left dynamic_content_right'> <a href='profile.php?user=".$row['username']."'> ".$row['username']." </a> </div>
							<br>
							<div class='left dynamic_content_left'>Full Name</div>
							<div class='left dynamic_content_right'> ".$row['fullname']." </div>
							<br>
							<div class='left dynamic_content_left'>Avatar</div>
							<div class='left dynamic_content_right'> <img id='user_avatar' src='../img/avatar/".$row['avatar']."'></img> </div>
							<br>
							<br>
						</div>	
						<br>";
					}
					
					if ($numrows_user > 5) {
						echo "
						<a href='search_classified.php?f=user&q=".$query."'>
							<button type='submit' id='aqua_button'>View more</button>
						</a>
						<br>
						<br>";
					}
				}
				?>
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