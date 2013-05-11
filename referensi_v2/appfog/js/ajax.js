function createObject() {
    var request_type;
    var browser = navigator.appName;
    if (browser == "Microsoft Internet Explorer") {
        request_type = new ActiveXObject("Microsoft.XMLHTTP");
    } else {
        request_type = new XMLHttpRequest();
    }
    return request_type;
}

function logincheck() {
    if ((document.getElementById("login_username").value == "admin") && (document.getElementById("login_password").value == "adminadmin"))
        window.location.href = "src/dashboard.php";
    else
    {
        alert("Wrong username or password 1");
        document.getElementById("login_username").value = "";
        document.getElementById("login_password").value = "";
        return false;
    }
}


function logincheckajax()
{
    var xmlhttp = createObject();
    user = document.getElementById("login_username").value;
    pass = document.getElementById("login_password").value;
    rm = document.getElementById("remember_me_check").value;

    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var loginmessage = xmlhttp.responseText;
            if (loginmessage == 1)
            {
                window.location.href = "src/dashboard.php";
            }
            else
            {
                alert(loginmessage + rm);
                document.getElementById("login_username").value = "";
                document.getElementById("login_password").value = "";
                return false;
            }
        }
    }

    xmlhttp.open("GET", "src/logincheck.php?u="+user+"&p="+pass+"&rm="+rm,true);
    xmlhttp.send();
}

function getSuggest(){
    
    var xhtml = createObject();
    
     xhtml.onreadystatechange = function() {
            if (xhtml.readyState == 4 && xhtml.status == 200) 
            {
                validresponse = xhtml.responseText ;
                document.getElementById("listassignee").innerHTML = xhtml.responseText;  
            }
    }
   
    xhtml.open("GET","addtask_suggest.php?",true) ;
    xhtml.send() ;
}

function getSuggestse(){
    
    var xhtml = createObject();
    
     xhtml.onreadystatechange = function() {
            if (xhtml.readyState == 4 && xhtml.status == 200) 
            {
                validresponse = xhtml.responseText ;
                document.getElementById("listsearch").innerHTML = xhtml.responseText;  
            }
    }
   
    xhtml.open("GET","addtask_suggest.php?",true) ;
    xhtml.send() ;
}

function getSuggesttag(){
    
    var xhtml = createObject();
    
     xhtml.onreadystatechange = function() {
            if (xhtml.readyState == 4 && xhtml.status == 200) 
            {
                validresponse = xhtml.responseText ;
                document.getElementById("listtag").innerHTML = xhtml.responseText;  
            }
    }
   
    xhtml.open("GET","tag_suggest.php?",true) ;
    xhtml.send() ;
}

var regValid = 0;
function regCheck() {

    var xhtml = createObject() ;
     
    var username = document.getElementById("reg_username").value;
    var password = document.getElementById("reg_password").value;
    var confirm = document.getElementById("reg_confirm").value;
    var name = document.getElementById("reg_name").value;
    var email = document.getElementById("reg_email").value;
    var birthdate = document.getElementById("reg_birthdate").value;
    var avatar = document.getElementById("avatar_upload").value;
    //alert(username + " " + password+ " " + confirm + " " +email + " " + birthdate + " " +avatar);
    
    xhtml.onreadystatechange = function() {
            if (xhtml.readyState == 4 && xhtml.status == 200) 
            {
                validresponse = xhtml.responseText ;
                validresponse = validresponse.split(";");
            }
    }
   
    xhtml.open("GET","src/reg_check.php?u="+username+"&e="+email,true) ;
    xhtml.send() ;
    
    
    //check username
   

    if ((username.length > 4) && (username != password) && (validresponse[0] == 0) ) {
        document.getElementById("username_validation").src = "img/yes.png";
        regValid = 1;
    }
    
    else {
        document.getElementById("username_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("username_validation").style.display = "block";

    //check password
    if ((password.length > 7) && (password != username) && (password != email)) {
        document.getElementById("password_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("password_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("password_validation").style.display = "block";

    //check confirm
    if (confirm != password) {
        document.getElementById("confirm_validation").src = "img/no.png";
        regValid = 0;
    }
    if (password.length > 7) {
        document.getElementById("confirm_validation").src = "img/yes.png";
        regValid = 1;
    }
    document.getElementById("confirm_validation").style.display = "block";

    //check name
    if (name.indexOf(' ') >= 0) {
        document.getElementById("name_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("name_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("name_validation").style.display = "block";

    //check email
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if ((email == password) || (email.search(emailRegEx) == -1) || (validresponse[1] == 1)) {
        document.getElementById("email_validation").src = "img/no.png";
        document.getElementById("login_username").value = validresponse ;
        regValid = 0;
    }
    else {
        document.getElementById("email_validation").src = "img/yes.png";
        regValid = 1;
    }
    document.getElementById("email_validation").style.display = "block";

    //check birthday
    if (birthdate != "") {
        document.getElementById("birthdate_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("birthdate_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("birthdate_validation").style.display = "block";

    //check avatar
    var extension = avatar.split('.');
    if ((extension[1] == "jpg") || (extension[1] == "jpeg")) {
        document.getElementById("avatar_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("avatar_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("avatar_validation").style.display = "block";
}

function regCheckx() {
    var validresponse;
    var html = createObject();

    var username = document.getElementById("reg_username").value;
    var password = document.getElementById("reg_password").value;
    var confirm = document.getElementById("reg_confirm").value;
    var name = document.getElementById("reg_name").value;
    var email = document.getElementById("reg_email").value;
    var birthdate = document.getElementById("reg_birthdate").value;
    var avatar = document.getElementById("avatar_upload").value;
    //alert(username + " " + password+ " " + confirm + " " +email + " " + birthdate + " " +avatar);

    //check username


    if ((username.length > 4) && (username != password) && (validresponse[0] == "0")) {
        document.getElementById("username_validation").src = "img/yes.png";
        document.getElementById("login_username").value = validresponse[0];
        regValid = 1;
    }
    else {
        document.getElementById("username_validation").src = "img/no.png";
        document.getElementById("login_username").value = validresponse[0];
        regValid = 0;
    }
    document.getElementById("username_validation").style.display = "block";

    //check password
    if ((password.length > 7) && (password != username) && (password != email)) {
        document.getElementById("password_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("password_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("password_validation").style.display = "block";

    //check confirm
    if (confirm != password) {
        document.getElementById("confirm_validation").src = "img/no.png";
        regValid = 0;
    }
    if (password.length > 7) {
        document.getElementById("confirm_validation").src = "img/yes.png";
        regValid = 1;
    }
    document.getElementById("confirm_validation").style.display = "block";

    //check name
    if (name.indexOf(' ') >= 0) {
        document.getElementById("name_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("name_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("name_validation").style.display = "block";

    //check email
    var emailRegEx = /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i;
    if ((email == password) || (email.search(emailRegEx) == -1) || (validresponse[1] == "1")) {
        document.getElementById("email_validation").src = "img/no.png";
        regValid = 0;
    }
    else {
        document.getElementById("email_validation").src = "img/yes.png";
        regValid = 1;
    }
    document.getElementById("email_validation").style.display = "block";

    //check birthday
    if (birthdate != "") {
        document.getElementById("birthdate_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("birthdate_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("birthdate_validation").style.display = "block";

    //check avatar
    var extension = avatar.split('.');
    if ((extension[1] == "jpg") || (extension[1] == "jpeg")) {
        document.getElementById("avatar_validation").src = "img/yes.png";
        regValid = 1;
    }
    else {
        document.getElementById("avatar_validation").src = "img/no.png";
        regValid = 0;
    }
    document.getElementById("avatar_validation").style.display = "block";
}