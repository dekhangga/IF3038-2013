<?php

if (($_COOKIE['username'] == '') && ($_COOKIE['password'] == '')) {
    header('Location:../index.php') ; 
}
?>
<!DOCTYPE html>
<?php
include 'request.php';
$idkat = $_GET['idkat'];
$curr_username = $_COOKIE['username'];

$result = json_decode(SendRequest("http://pabotmania.ap01.aws.af.cm/addTask", 'POST', array("username" => $curr_username, "idkat" => $idkat)), true);
$login = $result['login'];
?>


<html>
    <head>
        <link href='../css/desktop_style.css' rel='stylesheet' type='text/css'>
        <link rel="shortcut icon" type="image/x-icon" href="../img/favicon.ico">
		<script type="text/javascript" src="../js/base_search.js"></script>
		<script type="text/javascript" src="../js/search.js"></script> 
        <script type="text/javascript" src="../js/edit_task.js"></script> 
        <script type="text/javascript" src="../js/animation.js"></script> 
        <script type="text/javascript" src="../js/ajax.js"></script> 
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >		
        <title> do.Metro </title>

        <script language="javascript">
            function deleteRow(tableID) {
                try {
                    var table = document.getElementById(tableID);
                    var rowCount = table.rows.length;

                    for (var i = 0; i < rowCount; i++) {
                        var row = table.rows[i];
                        var chkbox = row.cells[0].childNodes[0];
                        if (null != chkbox && true == chkbox.checked) {
                            if (rowCount <= 1) {
                                alert("Cannot delete all the rows.");
                                break;
                            }
                            table.deleteRow(i);
                            rowCount--;
                            i--;
                        }


                    }
                } catch (e) {
                    alert(e);
                }
            }
        </script>
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
					<div class="header_menu_button current_header_menu">
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
            </div>
			<?php
				$namakat = $result['namakat'];
			?>
            <div id="dynamic_content">
                <div id="add_task_container">
                    <div id="add_task_header" class="left top30 dynamic_content_head">
						<span class="link_tosca"><?php echo "Kategori : " .$namakat; ?></span>
						<br>
						<br>
                        Add New Task
					<div id="addtask">
                    <form id="addtask_form" method="post" action="addtask_add.php" enctype="multipart/form-data">
                        <div id="row1_addtask" class="left top30 dynamic_content_row">
                            <div id="task_name_lat" class="left dynamic_content_left">Task Name</div>
                            <div id="task_name_rat" class="left dynamic_content_right">
                                <input id="task_name_input" onkeydown="javascript:checkTaskName();" type="text" name="task_name_input" class="left">
                                <img src="../img/yes.png" id="taskname_validation" class="left signup_form_validation" alt="validation image"/>
                            </div>
                        </div>

                        <div id="row2_addtask" class="left top10 dynamic_content_row">
                            <div id="deadline_lat" class="left dynamic_content_left">Deadline</div>
                            <div id="deadline_rat" class="left dynamic_content_right">
                                <input id="deadline_input" type="date" name="deadline_input">
                            </div>
                        </div>

                        <div id="row3_addtask" class="left top10 dynamic_content_row">
                            <div id="assignee_lat" class="left dynamic_content_left">Assignee</div>
                            <div id="assignee_rat" class="left dynamic_content_right">
                                <TABLE id="dataTable" width="290px" border="0.5">
                                    <TR>
                                        <TD><INPUT type="checkbox" name="chk"/></TD>
                                        <TD>
                                            <input type="text" name="assignee[]" autocomplete="off" list="listassignee" onkeydown="javascript:getSuggest();">
                                            <datalist id="listassignee">
                                            </datalist>
                                        </TD>
                                    </TR>
                                </TABLE>
								<input id="more_assignee_button" type="button" value="More Assignee" class="link_blue_rect" onclick="addRow('dataTable')"/>
								<input id="del_assignee_button" type="button" value="Remove Assignee" class="link_blue_rect" onclick="deleteRow('dataTable')"/>
                            </div>
                        </div>

                        <div id="row4_addtask" class="left top10 dynamic_content_row">
                            <div id="tag_lat" class="left dynamic_content_left">Tag</div>
                            <div id="tag_rat" class="left dynamic_content_right">
                                <input type="text" id="tag_input" name="tag_input">

                            </div>
                        </div>

                        <div id="row5_addtask" class="left top10 dynamic_content_row">
                            <div id="attachment_lat" class="left dynamic_content_left">Attachment</div>
                            <div id="attachment_rat" class="left dynamic_content_right">
								<TABLE id="dataTable2" width="290px" border="0.5">
                                    <TR>
                                        <TD><INPUT type="checkbox" name="chk"/></TD>
                                        <TD>
											<input type="file" id="at_upload" onchange="javascript:checkTaskAttachment();" name="at_upload[]"/>
											<img src="../img/yes.png" id="task_attachment_validation" class="left signup_form_validation" alt="validation image"/>  
                                        </TD>
                                    </TR>
                                </TABLE>
								<input id="more_assignee_button" type="button" value="More Attachment" class="link_blue_rect" onclick="addRow('dataTable2')"/>
								<input id="del_assignee_button" type="button" value="Remove Attachment" class="link_blue_rect" onclick="deleteRow('dataTable2')"/>
                            </div>
                        </div>

                        <div id="row6_addtask" class="left top10 dynamic_content_row">
                            <div id="attachment_lat" class="left dynamic_content_left"></div>
                            <div id="attachment_rat" class="left dynamic_content_right">
                                
                                    <?php
                                        echo "<input type=\"hidden\" name=\"idkat\" id=\"idkat\" value=\"".$idkat."\">";
                                    ?>
                            </div>
                        </div>

                        <div id="row7_addtask" class="left top10 dynamic_content_row">
                            <input id="add_task_button" type="submit" value="Add Task" class="link_blue_rect">
                        </div>
						
                    </form>
					</div>
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


