function edit_profile() {		
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("profile_left").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","edit_profile.php",true);
	xmlhttp.send();
}

function save_profile(id, password) {
	var fullname = document.getElementById("bio_fullname").value;
	var email = document.getElementById('bio_email').value;
	var birthdate = document.getElementById('bio_birthdate').value;
	var valid = 1;	
	
	//check email
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if ((email == "") || (email == password) || (email.search(emailRegEx) == -1)) {
        valid = 0;
    }
	
	//check birthday
    if (birthdate == "") {
        valid = 0;
    }
	
	if (valid == 0)
		alert("There is something wrong on your input !");
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("profile_left").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","save_profile.php?q="+valid+"|"+id+"|"+fullname+"|"+email+"|"+birthdate,true);
	xmlhttp.send();
}

function change_pass() {
	document.getElementById("change_password").innerHTML = "<b>New Password<br>Confirm Password</b><br><button class='link_tosca' id='save_pass_button' onclick='save_pass()'> Save New Password </button>";
	document.getElementById("form_change_password").innerHTML = ": <input type='password' class='bio_edit' id='bio_changepass'><br/>: <input type='password' class='bio_edit' id='bio_confirmpass'>";
}

function save_pass(password) {
	var new_pass = document.getElementById("bio_changepass").value;
	var confirm_pass = document.getElementById("bio_confirmpass").value;
	var cont;
	
	if (new_pass == "" && confirm_pass == "") {
		alert("You didn't change your password !");
		cont = 0;
	} else if (new_pass != "" && confirm_pass == "") {
		alert("You didn't confirm your new password !");
		cont = 0;
	} else if (new_pass == "" && confirm_pass != "") {
		alert("You didn't put any new password but you confirmed one !");
		cont = 0;
	} else if (new_pass != confirm_pass) {
		alert("The confirmed new password doesn't match your new password !");
		cont = 0;
	} else {
		cont = 1;
	}
	
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	}
	else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			document.getElementById("change_pass").innerHTML = xmlhttp.responseText;
		}
	}
	
	xmlhttp.open("GET","save_password.php?q="+cont+"|"+confirm_pass,true);
	xmlhttp.send();
}

function change_avatar() {
	document.getElementById("change_ava").innerHTML = "<b>Avatar</b><br><button type='submit' class='link_tosca' id='save_profile_button'> Submit Avatar </button>";
	document.getElementById("new_avatar").innerHTML = ": <input type='file' id='avatar' name='avatar' accept=image/*>";
}