<%-- 
    Document   : profile
    Created on : Apr 12, 2013, 1:42:56 PM
    Author     : Sigit Aji Nugroho
--%>

<%@page contentType="text/html" pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
    <head>
        <%--<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">--%>
        <title>Next: Profile</title>
        <link rel="stylesheet" href="css/calendar.css">
		<script src="js/calendar.js" > </script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="stylesheet" type="text/css" href="css/profile.css">
        
        <%--<script type="text/javascript" src="js/popup.js"></script>--%>
	<script type="text/javascript">
            var ambil = <%
            if (request.getParameter("username") == null) {
                out.println('"'+(String)session.getAttribute("userLoginSession")+'"');
            } else {
                out.println('"'+request.getParameter("username")+'"');
            }
            %>
            
            function prepare() {
                calendar.set("date");
            }
            
            function getUserName(){
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
                        document.getElementById("username24").innerHTML=xmlhttp.responseText;					
                    }
		};
								
                xmlhttp.open("GET","getUserName?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
            function getEmail(){
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
			document.getElementById("email").innerHTML=xmlhttp.responseText;					
                    }
		}
								
                xmlhttp.open("GET","getEmail?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
	
            function getAvatar(){
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
                        document.getElementById("avatarnya").innerHTML=xmlhttp.responseText;	
                    }
		}
								
		xmlhttp.open("GET","getAvatar?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
	
            function getNamaLengkap(){
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
			document.getElementById("namalengkap").innerHTML=xmlhttp.responseText;			
                    }
		}
								
		xmlhttp.open("GET","getNamaLengkap?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
	
            function getTanggalLahir(){
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
			document.getElementById("tanggallahir").innerHTML=xmlhttp.responseText;					
                    }
		}
								
		xmlhttp.open("GET","getTanggalLahir?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
	
            function getProfil1Form(){
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
			document.getElementById("listProfilBox").innerHTML=xmlhttp.responseText;					
                    }
		}
								
		xmlhttp.open("GET","getProfil1Form?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
	
            function getTugasSelesai(){
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
			document.getElementById("listProfilBox2").innerHTML=xmlhttp.responseText;					
                    }
		}
								
		xmlhttp.open("GET","getTugasSelesai?user="+ambil,true);
		xmlhttp.send();
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
            function burn(){
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
			document.getElementById("saveep").innerHTML=xmlhttp.responseText;					
                    }
		}
		
                var picon = document.getElementById("passic").src;
		
		var lokasi = window.location.href.substring(0,window.location.href.lastIndexOf("/")) + "/pict/centang.png";	/*-------------------------*/		
                
		
                xmlhttp.open("GET","editProfile?fn="+fn+"&bd="+bd+"&cp="+cp+"&user="+ambil,true);
                xmlhttp.send();
		
		
		//alert(xmlhttp.responseText);
		//alert(xmlhttp.status);
            }
            
            function nama_valid()
            {   
		var name = document.edit.fn.value;
				
		if(name.match(/([a-zA-Z])+([ \t\r\n\v\f])+([a-zA-Z])/))
		{   
                    document.getElementById("nameic").src="pict/centang.png";
		}
		else
		{   
                    document.getElementById("nameic").src="pict/canceled.png";
		}
            }
            
            function avatar_valid()
            {
		var ekstensi = document.edit.na.value;
					
		if((ekstensi.lastIndexOf(".jpg") != -1) || (ekstensi.lastIndexOf(".jpeg") != -1) )
		{
                    document.getElementById("avaic").src="pict/centang.png";
		}
		else
		{
                    document.getElementById("avaic").src="pict/canceled.png";
		}
            }
            
            function date_valid()
            {
                document.getElementById("dateic").src="pict/centang.png";
            }
            
            function pass_valid()
            {   
		var userpass = document.edit.cp.value;
			
		if((userpass != "<%out.print(session.getAttribute("userLoginSession"));%>") && (userpass.length >= "8"))
		{   
                    document.getElementById("passic").src="pict/centang.png";
		}
		else
		{
                    document.getElementById("passic").src="pict/canceled.png";
		}
            }
				
            function conf_valid()
            {
		var userpass = document.edit.cp.value;
		var confpass = document.edit.ccp.value;
		
		if(confpass == userpass)
		{
                    document.getElementById("confic").src="pict/centang.png";
		}
		else
		{
                    document.getElementById("confic").src="pict/canceled.png";
		}
            }
            
            function logi()
            {	
		
                var picon = document.getElementById("passic").src;
		var cicon = document.getElementById("confic").src;
		var nicon = document.getElementById("nameic").src;
		var aicon = document.getElementById("avaic").src;
		var dicon = document.getElementById("dateic").src;

		var lokasi = window.location.href.substring(0,window.location.href.lastIndexOf("/")) + "/pict/centang.png";	/*-------------------------*/		
                var lokasi2 = window.location.href.substring(0,window.location.href.lastIndexOf("/")) + "/pict/blank.png";
                
		if ((picon == lokasi) && (cicon == lokasi) && (nicon == lokasi) && (aicon == lokasi) && (dicon == lokasi))
		{
                    document.getElementById("saveep").disabled = false;
                    alert("enable");
		}
                if ((picon == lokasi2) && (cicon == lokasi2) && (nicon == lokasi) && (aicon == lokasi) && (dicon == lokasi))
		{
                    document.getElementById("saveep").disabled = false;
                    alert("password tidak berubah.");
		}
                else{
                    document.getElementById("saveep").disabled = true;
                    alert("disable");
                }
            }
                                
	</script>
    <?jsp include 'header.jsp'; ?>
    </head>
    <body onload ="prepare();getUserName();getAvatar();getNamaLengkap();getTanggalLahir();getEmail();getProfil1Form();getTugasSelesai();">
        <%@ include file="header.jsp" %>
        <div id="content">
            <div id="profheader">
		<div id="username24">
			
		</div>
		<div id="avatarnya">
			
		</div>
		<div id="namalengkap">
				
		</div>
		<div id="tanggallahir">
				
		</div>
		<div id="email">
					
		</div>
		<div id="editprof" onClick="popup('popUpDiv');">
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
            
            <div id="blanket" "></div>
            <div id="popUpDiv" ">
                <div id="newcategory">
                    <div id="closecat">
                        <a href="#" onClick="popup('popUpDiv')" >CLOSE</a>
                    </div>
                    <div id="cattitle">EDIT PROFILE</div>
                    <div id="elcategory">
                        <form name="edit" action="editProfile.jsp" method ="post" en>
                            
                            <label>Full Name</label>
                            <input name="fn" placeholder="nama lengkap" onKeyUp="nama_valid()" onChange="logi()"/>
                            <img src="pict/blank.png" alt="icon5" id="nameic" />
                            
                            <label>Upload new avatar</label>
                            <input type="file" name="na" onChange="avatar_valid()" onChange="logi()"/>
                             <img src="pict/blank.png" alt="icon7" id="avaic" />
                            
                            <label>Change birth date</label>
                            <input type="text" name="bd" id="date" onMouseDown="date_valid()" onChange="logi()"/>
                            <img src="pict/blank.png" alt="icon8" id="dateic"  />
                            
                            
                            <label>Change password</label>
                            <input name="cp" type="password" placeholder="changepassword" onKeyUp="pass_valid()" onChange="logi()"/>
                            <img src="pict/blank.png" alt="icon3" id="passic" />
                            
                            <label>Confirm change password</label>
                            <input name="ccp" type="password" placeholder="confirmpassword" onKeyUp="conf_valid()" onChange="logi()"/>
                            <img src="pict/blank.png" alt="icon4" id="confic" />
                            
                            <input class= "submitreg" id="saveep" name="save" type="submit" value="SAVE"/>
                        </form>
                    </div>
                    <div id="jump"><div id="calendar" class="calendar-box"></div></div>
                    
                    <%--
                    <div id="closecat">
                        <a href="#" onClick="popup('popUpDiv')" >CLOSE</a>
                    </div>--%>
                </div>
            </div>
            
	</div>
    </body>
</html>
