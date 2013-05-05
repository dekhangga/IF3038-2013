<html>

	<?php
		include '../header/index.php';
	?>
    <head>
        <title> Next : Dashboard</title>
		<script src="dashboardController.js" > </script>
    </head>      
<!----------------------------------------- body ----------------------------------------->                           

    <body onLoad="getTask();getCat();showUserLogin();">
        <div class="main">
            <div id="addcat" onClick="popup('popUpDiv')">
            </div>
            <form id="kirim" action="buattask.php" method="POST">
                <input type="Submit" name= "submit" id="addtask" style="visibility: hidden;" value="" disabled>
            </a>
            <div id="category"> <!-- Sigit-->
			</div><!--akhir-->
			<div id="category2"></div><!-- Sigit-->
            <div id="task">
                <a href="rinciantugas.php">
                <div id="div1">
                    
                </div>
                </a>
            </div>
            
            <div id="blanket" style="display:none;"></div>
            <div id="popUpDiv" style="display: none;">
                <div id="newcategory">
                    <div id="closecat">
                        <a href="#" onClick="popup('popUpDiv')" >CLOSE</a>
                    </div>
                    <div id="cattitle">ADD CATEGORY</div>
                    <div id="elcategory">
                        <form action="#">
                            <label>category name</label>
                            <input name="catname" placeholder="category name">
                            <label>assignee</label>
                            <input name="catass" placeholder="assignee"></br></br>
                            <input class= "submitreg" name="submit" type="submit" value="Submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>

 
    </body>
</html>