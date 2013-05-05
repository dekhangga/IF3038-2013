<head >			<!------memanggil showUserLogin saat load body-------->	

        <link rel="stylesheet" href="../css/css.css">
        <link rel="stylesheet" href="../css/dash.css">
        <script type="text/javascript" src="../js/popup.js"></script>
        <script type="text/javascript" src="../header/headerController.js"></script>
			
<!-------------------------------------------------dashboard------------------------------->			

                     <div class="header">
			<div id="logo">
			    <a href="../dashboard/">
			    <img src="pict/logo.png">
			    </a>
			</div>
			<div id="border">
			    
			</div>
			<div id="dashboard">
			    <a href="../dashboard/">DASHBOARD</a>
			</div>
			<div id="profile">
			    <a href="../profile/">PROFILE</a>
			</div>
			<div id="search">
            
	            	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get" name="formSearch" onSubmit="tampilSearch()"  >
					    <section class="searchform cf">
                            <input onkeyup="auto_complete_search(this.value.substring(this.value.lastIndexOf('/')+1))" id="cari" class="searchbox" type="search" name="search" placeholder="Search.." required>                           
						</section>                        
						<select name="searchFilter" class="dropdownJo" id="searchFilter"> 	<!--dropdown filter-->
							<option value="semua">Semua</option>
							<option value="username">Username</option>
							<option value="email">Email</option>
							<option value="namalengkap">Nama Lengkap</option>
							<option value="birthdate">Birthdate</option>
							<option value="kategori">Kategori</option>
							<option value="tugas">Tugas</option>
							<option value="tag">Tag</option>                            
							<option value="komentar">Komentar</option>                            
						</select>
						<input type="submit" value="search" class="searchbuttonbox cf">
					</form>
				</div>	<!--end div search-->
			<div id="showLoginHeader">

			</div>	
            
            <div id="showAvatarHeader">

			</div>	
            				    
            
            	<div id="logout" onClick="hapusUserLogin()">		<!---------hapus user login dan waktunya ketika logout ---------->
			    <a href="../">LOGOUT</a>

                
				    </div>
                    

		
		  </div>
		<input id="autosearch" disabled></input>  <!--autocomplete box-->

        
    </head>


