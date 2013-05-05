<html>
	<?php
		include '../header/index.php';
	?>
    <head>
        <title> Next : Profile</title>
		<script src="profileController.js" > </script>
		<link rel="stylesheet" type="text/css" href="../css/css.css">
		<link rel="stylesheet" type="text/css" href="../css/profile.css">
	</head> 
		
		<script>
			/*
			function getProfile(){<!--SIGIT-->
				var xmlhttp;
				if (window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();				
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	
				}
				
				
				xmlhttp.onreadystatechange = function(){
					//alert(xmlhttp.readyState+" "+xmlhttp.status);
					
					if (xmlhttp.readyState==4 && xmlhttp.status==200){				
						//alert(xmlhttp.responseText);
						document.getElementById("content").innerHTML=xmlhttp.responseText;					
					}
				}
								
				xmlhttp.open("GET","getProfile.php?user="+localStorage.userLogin,true);
				xmlhttp.send();
				//alert(xmlhttp.responseText);
				//alert(xmlhttp.status);
			}
			function getProfHeader(){<!--SIGIT-->
				var xmlhttp;
				if (window.XMLHttpRequest){
					xmlhttp = new XMLHttpRequest();				
				}else{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");	
				}
				
				
				xmlhttp.onreadystatechange = function(){
					//alert(xmlhttp.readyState+" "+xmlhttp.status);
					
					if (xmlhttp.readyState==4 && xmlhttp.status==200){				
						//alert(xmlhttp.responseText);
						document.getElementById("profheader").innerHTML=xmlhttp.responseText;					
					}
				}
								
				xmlhttp.open("GET","getProfHeader.php?user="+localStorage.userLogin,true);
				xmlhttp.send();
				//alert(xmlhttp.responseText);
				//alert(xmlhttp.status);
			}*/
			
		</script>
    
	<body onload ="getUserName();getAvatar();getNamaLengkap();getTanggalLahir();getEmail();getProfil1Form();getTugasSelesai();">
		<!--====================================================================-->
		<div id="content">
			<div id="profheader">
				<div id="username">
				
				</div>
				<div id="avatarnya">
				
				</div>
				<div id="namalengkap">
					
				</div>
				<div id="tanggallahir">
					
				</div>
				<div id="email">
					
				</div>
				<div id="editprof">
					EDIT
				</div>

			</div>
			<div id="profil1Form">
				<div id="listProfilBox">
				
				</div>
			</div>
			<div id="tugas_selesai">
				<div id="listProfilBox2">
				
				</div>
			</div>
		</div>
		<!-- ==================================================================-->
		
	</body>
</html>