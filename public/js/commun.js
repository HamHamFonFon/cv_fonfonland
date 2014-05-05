/*
* Scripts JS communs à toute l'application 
*/
$(document).ready(function(){
	var positionElementInPage = $('.navbar').offset().top;
	$(window).scroll(
	    function() {
	        if ($(window).scrollTop() >= positionElementInPage) {
	            // fixed
	            $('.navbar').addClass("floatable");
	        } else {
	            // relative
	            $('.navbar').removeClass("floatable");
	        }
	    }
	);
});