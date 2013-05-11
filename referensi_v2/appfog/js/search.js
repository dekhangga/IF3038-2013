$(function() {
	/**
	* the element
	*/
	var $ui 		= $('#search_form');
	var $nav		= $('#nav_search_form');
	
	/**
	* on focus and on click display the dropdown, 
	* and change the arrow image
	*/
	$ui.find('#search_box').bind('focus click',function(){
		$ui.find('.sb_dropdown')
		   .show();
	});
	
	/**
	* on mouse leave hide the dropdown, 
	* and change the arrow image
	*/
	$ui.bind('mouseleave',function(){
		$ui.find('.sb_dropdown')
		   .hide();
	});
	
	/**
	* selecting all checkboxes
	*/
	$ui.find('.sb_dropdown').find('label[for="all"]').prev().bind('click',function(){
		$(this).parent().siblings().find(':checkbox').attr('checked',true);//.attr('disabled',this.checked);
	});
	
	$nav.find('.nav_search_filter').find('label[for="all"]').prev().bind('click',function(){
		$(this).parent().siblings().find(':checkbox').attr('checked',true);//.attr('disabled',this.checked);
	});
});

function redirect() {
	var query = document.getElementById("search_box").value;
	var username = document.getElementById("username").checked;
	var category = document.getElementById("category").checked;
	var task = document.getElementById("task").checked;
	
	document.getElementById("left").innerHtml = "query = "+query+", username = "+username+", category = "+category+", task = "+task;
	
//	window.location = "search_results.php?q="+query+"|"+username+"|"+category+"|"task;
}