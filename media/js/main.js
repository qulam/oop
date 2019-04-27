/* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
  document.getElementById("mySidenav").style.width = "250px";
  document.getElementById("main").style.marginLeft = "250px";
}

/* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft = "0";
}

$(document).ready(function(){
	$(document).on('click', '.menu_arrow_icon', function(e){
		e.preventDefault();
		$(this).closest('li').find('ul').slideToggle(150);
		$(this).find('i').removeAttr('class');
		$(this).find('.fa').toggleClass('fa fa-angle-down');
	});
});


// For example ajax method ..(look at ajax url !)
$(document).ready(function(){
	$(document).on('click', '.myBtn', function(){
		$.ajax({
			url : '../blogs/ajax',
			data : {
				post : 'Hello world',
			},
			method : 'POST',
			dataType : 'html',
			success : function(data){
				console.log(data);
			},
			error : function(err){
				alert(err.responseText);
			}
		});
	});
});