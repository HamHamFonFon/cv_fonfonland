$(document).ready(function () {
	$('td').on('click', function(e) {
		var codeCouleur = $(this)[0].style.backgroundColor;
		$("#codeClick").html(codeCouleur);
	});
});