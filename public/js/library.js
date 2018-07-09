$(document).ready(function(){
	$(".issue").click(function() {
		window.location.href = "/book/public/book/issuebook";  
	});
	$(".return").click(function() {
		window.location.href = "/book/public/book/returnbook";       
	});
	$(".availability").click(function() {
		window.location.href = "/book/public/book/checkavailability";       
	});
});

