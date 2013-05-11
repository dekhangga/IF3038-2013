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
		<script type="text/javascript" src="../js/catselector.js"> </script> 		
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
		<title> do.Metro </title>
	</head>
	
	<body>
		<?php include 'request.php'?>
		<?php
			$curr_username = $_COOKIE['username'];
			$query = $_GET['q'];
			$filter = $_GET['f'];
			
			// Get current page or set a default
			if (isset($_GET['page']) && is_numeric($_GET['page'])) {
			   // cast var as int
			   $page = (int) $_GET['page'];
			} else {
			   // default page
			   $page = 1;
			}
			
			// Jumlah row per page
			$rowsperpage = 10;
			
			// the offset of the list, based on current page 
			$offset = ($page - 1) * $rowsperpage;
			
			$args = array("username" => $curr_username, "query" => $query, "filter" => $filter, "offset" => $offset, "rowsperpage" => $rowsperpage);
			
			$results = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/searchClassified", 'POST', $args), true);
			$profile = $results['profile'];
			
			$numrows = $results['rows'];
			
			// Total page
			$totalpages = ceil($numrows / $rowsperpage);
			
			// if current page is greater than total pages...
			if ($page > $totalpages) {
			   // set current page to last page
			   $page = $totalpages;
			}
			// if current page is less than first page...
			if ($page < 1) {
			   // set current page to first page
			   $page = 1;
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
						<?php echo "<img id='header_img' src='../img/avatar/".$profile['avatar']."'>";?>
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
							<input id="nav_search_box" name="search_query" type="text" value="">
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
				<?php if ($filter == "category") {
					echo "
					<div class='search_result' id='searchtitle'>
						Category
					</div>
					<br>";
						  
					$category = $results['category'];
					foreach($category as $row) {
						echo "
						<div class='search_result'>
							<div class='left dynamic_content_left'>Name</div>
							<div class='left dynamic_content_right'>".$row['namakat']."</div>
							<br>
						</div>	
						<br>";
					}
				} else if ($filter == "task") {
					echo "
					<div class='search_result' id='searchtitle'>
						Task
					</div>
					<br>";
						  
					$task = $results['task'];
					foreach($task as $row) {
						echo "
						<div class='search_result'>
							<div class='left dynamic_content_left'>Task Name</div>
							<div class='left dynamic_content_right'> <a href='taskdetail_file.html'> ".$row['namatask']." </a> </div>
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
					
				} else if ($filter == "user") {
					echo "
					<div class='search_result' id='searchtitle'>
						Username
					</div>
					<br>";
					
					$user = $results['user'];
					foreach($user as $row) {
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
				}
				
				/* --- Pagination linksss --- */
				$range = 5;
				
				echo "<div id='search_page'>";
				// if not on page 1, don't show back links
				if ($page > 1) {
				   // show << link to go back to page 1
				   echo " <a href='{$_SERVER['PHP_SELF']}?f=$filter&q=$query&page=1'><<</a> ";
				   // get previous page num
				   $prevpage = $page - 1;
				   // show < link to go back to 1 page
				   echo " <a href='{$_SERVER['PHP_SELF']}?f=$filter&q=$query&page=$prevpage'><</a> ";
				}
				
				// loop to show links to range of pages around current page
				for ($x = ($page - $range); $x < (($page + $range) + 1); $x++) {
				   // if it's a valid page number...
				   if (($x > 0) && ($x <= $totalpages)) {
					  // if we're on current page...
					  if ($x == $page) {
						 // 'highlight' it but don't make a link
						 echo " [<b>$x</b>] ";
					  // if not current page...
					  } else {
						 // make it a link
						 echo " <a href='{$_SERVER['PHP_SELF']}?f=$filter&q=$query&page=$x'>$x</a> ";
					  }
				   }
				}
								 
				// if not on last page, show forward and last page links        
				if ($page != $totalpages) {
				   // get next page
				   $nextpage = $page + 1;
					// echo forward link for next page 
				   echo " <a href='{$_SERVER['PHP_SELF']}?f=$filter&q=$query&page=$nextpage'>></a> ";
				   // echo forward link for lastpage
				   echo " <a href='{$_SERVER['PHP_SELF']}?f=$filter&q=$query&page=$totalpages'>>></a> ";
				}
				
				echo "</div><br>";
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