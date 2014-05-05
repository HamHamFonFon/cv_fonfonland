$(document).ready(function () {
	// detection du click sur edit
	$("a[href=#editMission]").parent().click(function() {
		// Verification de l existance de la liste deroulante
		if ($("#choixMission").length) {
			// Desactivation du formulaire
			$("#formAdminMissionsEdit input, textarea, select[multiple=multiple]").each(function () {
				$(this).prop("disabled", true);
			});
		}
		
		// Detection d un changement de choix de la liste de missions
		$("#choixMission").change(function () {
			affichageMission($(this).val());
		});
	}); 
	
	// Detection du click sur add
	$("a[href=#addMission]").parent().click(function() {
	   $("#formAdminMissionsAdd input, textarea, select[multiple=multiple]").each(function () {
            $(this).prop("disabled", false);
        });
	});
});

// Affiche les donnees de la mission selectionnee
function affichageMission(idMission) {
	$("#formAdminMissionsEdit input[type!=submit], textarea").each(function () {
		$(this).val("");
		$(this).prop("disabled", true);
	});
	
	// id selectionne
	if (!isNaN(idMission)) {
		var dataJson = jQuery.parseJSON($("#json_mission").val())[idMission];
		$.each(dataJson, function (key, val) {
			$("#"+key).val(val);
			$("#"+key).prop("disabled", false);
			$("input[type=submit]").prop("disabled", false);
		});
	}
}

$(function() {
	$("#formAdminMissionsEdit #date_debut_edit").datepicker({dateFormat: 'dd/mm/yy', firstDay:1 });
	$("#formAdminMissionsEdit #date_fin_edit").datepicker({dateFormat: 'dd/mm/yy', firstDay:1 });
	
	$("#formAdminMissionsAdd #date_debut_add").datepicker({dateFormat: 'dd/mm/yy', firstDay:1 });
	$("#formAdminMissionsAdd #date_fin_add").datepicker({dateFormat: 'dd/mm/yy', firstDay:1 });
});