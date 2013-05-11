function catchange(catnum){
		if (catnum == 0) {
			document.getElementById("curtask1").style.opacity = "1";
			document.getElementById("curtask1").style.top = "20px";
			document.getElementById("curtask2").style.opacity = "1";
			document.getElementById("curtask2").style.top = "200px";
			document.getElementById("curtask3").style.opacity = "1";
			document.getElementById("curtask3").style.top = "380px";
			document.getElementById("curtask4").style.opacity = "1";
			document.getElementById("curtask4").style.top = "560px";
			document.getElementById("curtask5").style.opacity = "1";
			document.getElementById("curtask5").style.top = "740px";
			document.getElementById("kuliah").style.color = "#6FBEC6";
			document.getElementById("proyek").style.color = "#6FBEC6";
			document.getElementById("tugas").style.color = "#6FBEC6";
			document.getElementById("lomba").style.color = "#6FBEC6";
			document.getElementById("category_title").style.backgroundColor = "#ff5645";
			document.getElementById("lomba").style.backgroundColor = "#fff";
			document.getElementById("kuliah").style.backgroundColor = "#fff";
			document.getElementById("proyek").style.backgroundColor = "#fff";
			document.getElementById("tugas").style.backgroundColor = "#fff";
			
			document.getElementById("add_task_link").style.display = "none";
		}
		
		else {if (catnum == 1) {
			document.getElementById("curtask3").style.opacity = "0";
			document.getElementById("curtask4").style.opacity = "0";
			document.getElementById("curtask5").style.opacity = "0";
			document.getElementById("curtask1").style.opacity = "1";
			document.getElementById("curtask1").style.top = "20px";
			document.getElementById("curtask2").style.opacity = "1";
			document.getElementById("curtask2").style.top = "200px";
			document.getElementById("kuliah").style.backgroundColor = "#ff5645";
			document.getElementById("kuliah").style.color = "#fff";
			document.getElementById("proyek").style.color = "#6FBEC6";
			document.getElementById("tugas").style.color = "#6FBEC6";
			document.getElementById("lomba").style.color = "#6FBEC6";
			document.getElementById("lomba").style.backgroundColor = "#fff";
			document.getElementById("proyek").style.backgroundColor = "#fff";
			document.getElementById("tugas").style.backgroundColor = "#fff";
			document.getElementById("category_title").style.backgroundColor = "#007bc1";
			
			document.getElementById("add_task_link").style.display = "block";
		}
		else {
			if (catnum==2) {
				document.getElementById("curtask1").style.opacity = "0";
				document.getElementById("curtask2").style.opacity = "0";
				document.getElementById("curtask3").style.opacity = "0";
				document.getElementById("curtask4").style.opacity = "1";
				document.getElementById("curtask4").style.top = "20px";
				document.getElementById("curtask5").style.opacity = "1";
				document.getElementById("curtask5").style.top = "200px";
				document.getElementById("proyek").style.backgroundColor = "#ff5645";
				document.getElementById("proyek").style.color = "#fff";
				document.getElementById("kuliah").style.color = "#6FBEC6";
				document.getElementById("tugas").style.color = "#6FBEC6";
				document.getElementById("lomba").style.color = "#6FBEC6";
				document.getElementById("lomba").style.backgroundColor = "#fff";
				document.getElementById("kuliah").style.backgroundColor = "#fff";
				document.getElementById("tugas").style.backgroundColor = "#fff";
				document.getElementById("category_title").style.backgroundColor = "#007bc1";
				
				document.getElementById("add_task_link").style.display = "block";
			}
			else if (catnum == 4) {
				document.getElementById("curtask1").style.opacity = "0";
				document.getElementById("curtask2").style.opacity = "0";
				document.getElementById("curtask4").style.opacity = "0";
				document.getElementById("curtask5").style.opacity = "0";
				document.getElementById("curtask3").style.opacity = "1";
				document.getElementById("curtask3").style.top = "20px";
				document.getElementById("lomba").style.backgroundColor = "#ff5645";
				document.getElementById("lomba").style.color = "#fff";
				document.getElementById("proyek").style.color = "#6FBEC6";
				document.getElementById("kuliah").style.color = "#6FBEC6";
				document.getElementById("tugas").style.color = "#6FBEC6";
				document.getElementById("kuliah").style.backgroundColor = "#fff";
				document.getElementById("proyek").style.backgroundColor = "#fff";
				document.getElementById("tugas").style.backgroundColor = "#fff";
				document.getElementById("category_title").style.backgroundColor = "#007bc1";
				
				document.getElementById("add_task_link").style.display = "block";
			}
			else if (catnum == 3){
				document.getElementById("curtask1").style.opacity = "0";
				document.getElementById("curtask2").style.opacity = "0";
				document.getElementById("curtask3").style.opacity = "0";
				document.getElementById("curtask4").style.opacity = "0";
				document.getElementById("curtask5").style.opacity = "0";
				document.getElementById("tugas").style.backgroundColor = "#ff5645";
				document.getElementById("tugas").style.color = "#fff";
				document.getElementById("proyek").style.color = "#6FBEC6";
				document.getElementById("lomba").style.color = "#6FBEC6";
				document.getElementById("kuliah").style.color = "#6FBEC6";
				document.getElementById("lomba").style.backgroundColor = "#fff";
				document.getElementById("kuliah").style.backgroundColor = "#fff";
				document.getElementById("proyek").style.backgroundColor = "#fff";
				document.getElementById("category_title").style.backgroundColor = "#007bc1";
				
				document.getElementById("add_task_link").style.display = "block";
			}
		}
	}
}
	
function add_category2() {
	add_category();
	var taskcatlist = document.getElementsByClassName("taskcat");
	var selc = document.getElementById("catselector");
	var newcat = document.getElementById("add_category_name").value;
	selc.innerHTML += '<option value="' + taskcatlist.length + '">' + newcat +'</option>';
	
	var content = document.getElementById("dynamic_content");
	var curcatnum = taskcatlist.length+1;
	content.innerHTML += '<div class="taskcat" id="taskcat' + curcatnum + '">Task di Category ' + curcatnum + '</div>';
	catchange(curcatnum);
	}