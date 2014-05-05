/**
 * Script JS uniquement pour la page emplois
 */
$(document).ready(function(){
	// On masque par defaut tous les elements
	$(".list-group-item-heading").nextAll().hide();
	
	// Detection du clic sur un element
	$(".list-group-item").on('click', function(e) {
		
		$(".list-group-item-heading").nextAll().slideUp();
		
		var idEmploiEnfants = "#"+$(this)[0].id+"> .groupe_missions";
		if ($(idEmploiEnfants).is(':hidden')) {
			$(idEmploiEnfants).slideDown();
			//$(idEmploiEnfants).hover(function (){ $(this).css('cursor', 'auto'); });
		} 
	});
});
