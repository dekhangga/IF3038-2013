function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block')
        e.style.display = 'none';
    else
        e.style.display = 'block';
}

function changecolor(a){
    color1 = "#039646";
    color2 = "#603cba";
    color3 = "#44a3aa";
    if (a == 1) {
        document.getElementById("header").style.backgroundColor = color1 ;
    } else if (a == 2) {
        document.getElementById("header").style.backgroundColor = color2 ;
    } else {
        document.getElementById("header").style.backgroundColor = color3 ; 
    }
}
var loginForm = document.getElementById("login_form");
function add_category() {
    var t = "<li>";
    t += "<a href ='#' onclick='catchange(10)' id='newCategoryAdded'>";
    t += document.getElementById("add_category_name").value;
    t += "</a>";
    t += "</li>";
    document.getElementById("category_item").innerHTML += t;
}


function signup() {
    if (regValid == 1) {
        window.location.href = "src/Dashboard.html";
    }
    else {
        alert("Fill your registration form correctly");
    }
}

function finishTask(i) {
    if (i == 1) {
        document.getElementById("curtask1").style.opacity = "0";
        document.getElementById("curtask2").style.top = "20px";
        document.getElementById("curtask3").style.top = "200px";
        document.getElementById("curtask4").style.top = "380px";
        document.getElementById("curtask5").style.top = "560px";
    }

    else {
        if (i == 2) {
            document.getElementById("curtask2").style.opacity = "0";
            document.getElementById("curtask3").style.top = "200px";
            document.getElementById("curtask4").style.top = "380px";
            document.getElementById("curtask5").style.top = "560px";
        }
        else {
            if (i == 3) {
                document.getElementById("curtask3").style.opacity = "0";
                document.getElementById("curtask4").style.top = "380px";
                document.getElementById("curtask5").style.top = "560px";
            }
            else if (i == 4) {
                document.getElementById("curtask4").style.opacity = "0";
                document.getElementById("curtask5").style.top = "560px";
            }
            else if (i == 5) {
                document.getElementById("curtask5").style.opacity = "0";
            }
        }
    }
}

function checkTaskName() {
    var taskName = document.getElementById('task_name_input').value;
    var taskNameValid = 0;
    var iChars = "~=-_^&.\\|*|,\":<>[]{}`\';()@&$#%";
    for (var i = 0; i < taskName.length; i++) {
        if (iChars.indexOf(taskName.charAt(i)) != -1) {
            taskNameValid = 1;
            break;
        }
    }

    if ((taskName.length > 25) || (taskNameValid == 1) || (taskName == "")) {
        //tidak valid
        document.getElementById('taskname_validation').src = "../img/no.png";
    }
    else {
        //valid
        document.getElementById('taskname_validation').src = "../img/yes.png";
    }
    document.getElementById('taskname_validation').style.display = "block";
}

function checkTaskAttachment() {
    var attachmentName = document.getElementById('attachment_upload').value;
    var dot = ".";
    if (attachmentName.indexOf(dot) != -1) {
        //valid
        document.getElementById('task_attachment_validation').src = "../img/yes.png";
    }
    else {
        //not valid
        document.getElementById('task_attachment_validation').src = "../img/no.png";
    }
    document.getElementById('task_attachment_validation').style.display = "block";
}

function addRow(tableID) {

                var table = document.getElementById(tableID);

                var rowCount = table.rows.length;
                var row = table.insertRow(rowCount);

                var colCount = table.rows[0].cells.length;

                for(var i=0; i<colCount; i++) {

                    var newcell = row.insertCell(i);

                    newcell.innerHTML = table.rows[0].cells[i].innerHTML;
                    //alert(newcell.childNodes);
                    switch(newcell.childNodes[0].type) {
                        case "text":
                                newcell.childNodes[0].value = "";
                                break;
                        case "checkbox":
                                newcell.childNodes[0].checked = false;
                                break;
                        case "select-one":
                                newcell.childNodes[0].selectedIndex = 0;
                                break;
                    }
                }
            }

