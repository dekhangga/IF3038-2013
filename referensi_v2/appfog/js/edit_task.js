
window.onload=function(){SomeJavaScriptCode};

function edit_task(str) {
	var deadline = document.getElementById("deadline_rtd").innerHTML;
	document.getElementById("deadline_rtd").innerHTML = '<input type="date" id="deadline"></input>';
	document.getElementById("deadline").value = deadline;
	document.getElementById("edit_task_button").style.display = 'none';
	document.getElementById("save_button_td").style.display = 'block';
	document.getElementById("edit_ass").style.display = 'block';
	document.getElementById("edit_tag").style.display = 'block';
	document.getElementById("delete_ass").style.display = 'block';
	                            
}

	
			
function addRows(id) {

                {
if (id=="")
  {
  document.getElementById("inputass").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("inputass").innerHTML=xmlhttp.responseText;
    }
  }

var x = document.getElementById("assignee").value;
xmlhttp.open("GET","edit_task.php?id="+id+"&assignee="+x,true);
xmlhttp.send();
}
}

function editTag(id) {

                {
if (id=="")
  {
  document.getElementById("tag_rtd").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("tag_rtd").innerHTML=xmlhttp.responseText;
    }
  }

var x = document.getElementById("tag_input").value;
xmlhttp.open("GET","edit_tag.php?id="+id+"&tag="+x,true);
xmlhttp.send();
}
}
			
			
function changestat(str,stat) {
	{
if (str=="")
  {
  var x = 'status'+stat;
  document.getElementById(x).innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var x = 'status'+stat;
	document.getElementById(x).innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","changestat.php?id="+str,true);
xmlhttp.send();
}
}

function save_edit_task(str) {
	
{
if (str=="")
  {
  document.getElementById("deadline_rtd").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("deadline_rtd").innerHTML=xmlhttp.responseText;
    }
  }

var x = document.getElementById("deadline").value;
xmlhttp.open("GET","update.php?id="+str+"&deadline="+x,true);
xmlhttp.send();
}


	document.getElementById("save_button_td").style.display = 'none';
	document.getElementById("edit_task_button").style.display = 'block';
	document.getElementById("edit_ass").style.display = 'none';
	document.getElementById("edit_tag").style.display = 'none';
	document.getElementById("delete_ass").style.display = 'none';

}

function delAss(str,stat)
{
var xmlhttp;    
if (str=="")
  {
  document.getElementById("assignee_rtd").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("assignee_rtd").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","delass.php?id="+stat+"&nama_user="+str,true);
xmlhttp.send();
}


function add_comment(str,uid) {
if (str=="")
  {
  document.getElementById("comment_rtd").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("comment_rtd").innerHTML=xmlhttp.responseText;
    }
  }
var x = document.getElementById("komentar").value;
xmlhttp.open("GET","proseskomen.php?id="+str+"&komentar="+x+"&uid="+uid,true);
xmlhttp.send();
}

function deletekat(str) {
	{
if (str=="")
  {
  document.getElementById("category_list").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("category_list").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","deletekat.php?id="+str,true);
xmlhttp.send();
}


}

function tampilkat() {
	{
if (str=="")
  {
  document.getElementById("category_list").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("category_list").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","tampilkat.php",true);
xmlhttp.send();
}


}

function deletetask(str) {
	{
if (str=="")
  {
  document.getElementById("dynamic_content").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dynamic_content").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","delete.php?id="+str,true);
xmlhttp.send();
}

}

function del_komen(str,stat) {
	{
if (str=="")
  {
  document.getElementById("comment_rtd").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("comment_rtd").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","del_komen.php?id="+str+"&stat="+stat,true);
xmlhttp.send();
}

}


function catchange(str) {
	{
if (str=="")
  {
  document.getElementById("dynamic_content").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("dynamic_content").innerHTML=xmlhttp.responseText;
    }
  }

xmlhttp.open("GET","changecat.php?id="+str,true);
xmlhttp.send();
}

}