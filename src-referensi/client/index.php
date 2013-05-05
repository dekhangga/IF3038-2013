<!-- catatan: -->


<html>
    <head>
        <title> Next : You Can't Do it Alone</title>
		<link rel="stylesheet" href="css/calendar.css">
		<script src="js/calendar.js" > </script>
        <link rel="stylesheet" href="css/css.css">
        <script src="indexController.js" > </script>
    </head>
    <body onLoad="isLogin()">		<!-----------------------panggil isLogin------------------------->
        <div class="header">
            <div id="logo">
                <img src="pict/logo.png">
            </div>
            <div id="login">  
                <section class="loginform cf">
		<form name="login" action="index_submit" method="get" accept-charset="utf-8">
			<ul>
				<li>
					
					<input class="small" type="userID" name="userId" placeholder="yourID" required>
				</li>
				<li>
					
					<input class="small" type="password" name="password" placeholder="password" required></li>
				<li>
					<input class="xsmall" type="button" onClick="validateLogin(this.form)" value="Login">
				</li>
			</ul>
		</form>
	</section>
            </div>
        </div>
        <div class="main">
            <div id="slider">
                <img src="pict/task.png">
            </div>
            <div id="registrasi">
                <div id="regawal">
                    <div id="were">
                    </div>
                    <div id="poctreg" onClick="ShowAkhir()" >
                    </div>
                    <div id="textreg" on>
                        try and be awesome 
                    </div>
                </div>
                 <div id="regakhir" style="DISPLAY: none">
                    <div id="formreg">
                    <form name="registration">
                        <label>username</label>
                        <input name="username" type="text" placeholder="username"  onkeyup="user_validating()" onChange="logingg()" />
						<img src="pict/blank.png" alt="icon2" id="usericon" onchange="isformvalid()" />
                        <label>password</label>
                        <input name="password" type="password" placeholder="password" onKeyUp="pass_validating()" onChange="logingg()" />
                        <img src="pict/blank.png" alt="icon3" id="passicon" />
						<label>confirm password</label>
                        <input name="confirmpass" type="password" placeholder="confirm password" onKeyUp="conf_validating()" onChange="logingg()"  />
						<img src="pict/blank.png" alt="icon4" id="conficon" />
                        <label>nama lengkap</label>
                        <input name="namaleng" placeholder="nama lengkap" onKeyUp="nama_validating()" onChange="logingg()" />
						<img src="pict/blank.png" alt="icon5" id="nameicon" />
                        <label>tanggal lahir</label>
						<input type="text" name="tanggal" id="date" onMouseDown="date_validating()" onChange="logingg()" />
						<img src="pict/blank.png" alt="icon8" id="dateicon"  />
						<script type="text/javascript">
							calendar.set("date");
						</script>
                        <label>email</label>
                        <input name="email" type="email" placeholder="email" onKeyUp="email_validating()" onChange="logingg()" />
						<img src="pict/blank.png" alt="icon6" id="emailicon" />
                            <br><br>
                        <label>avatar</label>
						<input type="file" name="avatar" onChange="avatar_validating();logingg()" />
						<img src="pict/blank.png" alt="icon7" id="avaicon" />
						<br>
                        <input class= "submitreg" id="submitb" name="submit" type="button" value="Submit" onClick="masuk(this.form)" disabled />
                        <input class= "submitreg" name="cancel" type="cancel" onClick="ShowAwal()" value="Cancel">
                    </form>
                </div>
                </div>
               
            </div>
        </div>
		
		<!-- slide -->
		
        <div class="footer">
            Copyright © Ahmad Faiz - Fandi Pradana - Sigit Aji
        </div>
        
    </body>
</html>