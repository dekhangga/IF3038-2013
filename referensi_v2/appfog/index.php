<?php

if (isset($_COOKIE['username']) && isset($_COOKIE['password'])) {
    header('Location:src/dashboard.php') ; 
}

?>

<!DOCTYPE html>
<html>
    <!--
    <IFRAME name="iframe" src="src/header.html" width='100%' height='auto' marginwidth=0 marginheight=0 hspace=0 vspace=0 frameborder=0 scrolling=auto></IFRAME>
    -->

    <head>
        <link href='css/desktop_style_hanif.css' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="js/animation.js"></script> 
        <script type="text/javascript" src="js/ajax.js"></script> 
        <link rel="shortcut icon" type="image/x-icon" href="img/favicon.ico">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8" >
        <title> do.Metro </title>
    </head>

    <body>
        <!-- Web Header -->
        <header>
            <div id="header_container"> 
                <div class="left">
                    <img src="img/logo.png" alt="logo"/>
                </div>
            </div>
            <div class="thin_line"></div>
        </header>

        <!-- Web Content -->
        <section>
            <div id="index_left">
                <div id="tutorial_container">
                    <div>
                        <img id="tutorial_image" src="img/tutorial.png" alt="tutorial_pic"/>
                    </div>
                    <div id="tutorial">
                        <span class="judul"><strong>Your Trusted Partner</strong></span>
                        <br>
                        <br> 
                        More than 3.5 million people use <span class="blue">do.Metro</span> to get things done.
                        <br>
                        Whether you're organizing your business, sharing a shopping list with a loved one or simply keeping track of your daily life, <span class="blue">do.Metro</span> is the best to-do list for you, your team or your family.  
                        <br>
                    </div>
                </div>
            </div>
            <div id="index_right">
                <div id="login_form_container">
                    <form id="login_form" method="post" action="javascript:logincheckajax()">
                        <label> Username </label> <input type="text" id="login_username" name="userusername"/>
                        <br/><label> Password </label> <input type="password" id="login_password" name="userpassword"/> 
                        <div id="login_button_submit" class="right link_red top10" onclick="javascript:this.parentNode.submit()"> LOGIN </div>
                        <input type="checkbox" id="remember_me_check" name="rememberme" value="1"/> <label id="remember_me"> Remember me</label>
                    </form>
                </div>

                <div class="signup_label">
                    <strong>Have No Account ?</strong> 
                </div>
                <div id="signup_form_container"> 
                    <form id="signup_form" method="post" action="src/insert_reg.php" enctype="multipart/form-data" >
                        <label> Username </label>	
                        <input type="text" name="username" onkeydown="javascript:regCheck();" id="reg_username" title="Username should be at least 5 characters long" required>
                        <img src="img/yes.png" id="username_validation" class="signup_form_validation" alt="validation image">
                        <span id="uscek" class="signup_form_validation"></span>
                        <label> Password </label> 	
                        <input type="password" name="password" onkeydown="javascript:regCheck();" id="reg_password" title="Password should be at least 8 characters long" required>
                        <img src="img/no.png" id="password_validation" class="signup_form_validation" alt="validation image">

                        <label> Confirm </label> 	
                        <input type="password" name="confirm_password" onkeydown="javascript:regCheck();" id="reg_confirm" title="Confirmation password should be the same with Password" required>
                        <img src="img/no.png" id="confirm_validation" class="signup_form_validation" alt="validation image">

                        <label> Name </label>
                        <input type="text" name="long_name" id="reg_name" onkeydown="javascript:regCheck();" title="Your name should be at least consists first name and last name" required>
                        <img src="img/yes.png" id="name_validation" class="signup_form_validation" alt="validation image">

                        <label> Email </label> 		
                        <input type="text" name="email" id="reg_email" onkeydown="javascript:regCheck();" title="Email should be written in the right format" required>
                        <img src="img/yes.png" id="email_validation" class="signup_form_validation" alt="validation image">

                        <label> Birth Date </label>
                        <input type="date" name="birth_date" onchange="javascript:regCheck();" id="reg_birthdate" title="YYYY-MM-DD">
                        <img src="img/yes.png" id="birthdate_validation" class="signup_form_validation" alt="validation image">

                        <label> Avatar </label>
                        <input type="file" onchange="javascript:regCheck();" name="avatar_upload" id="avatar_upload"/> 
                        <img src="img/yes.png" id="avatar_validation" class="signup_form_validation" alt="validation image">

                       <div id="signup_button_submit" class="right link_red top10" title="Semua elemen form harus diisi dengan benar dahulu." onclick="javascript:this.parentNode.submit()"> SIGN UP </div>
                   
                    </form>
                </div>
            </div>
        </section>

        <!-- Footer Section -->
        <div class="thin_line"></div>
        <footer>
            <div id="footer_container"> 
                <br><br>
                About &nbsp;&nbsp;&nbsp; FAQ &nbsp;&nbsp;&nbsp; Feedback &nbsp;&nbsp;&nbsp; Terms &nbsp;&nbsp;&nbsp; Privacy &nbsp;&nbsp;&nbsp; Copyright 
                <br>
                Eurilys 2013
            </div>
        </footer>
    </body>

    <!-- ini nanti jadiin footer -->
</html>