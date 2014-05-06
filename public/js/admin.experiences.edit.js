$(document).ready(function () {
	// detection du click sur edit
	$("a[href=#editMission]").parent().click(function() {
		// Verification de l existance de la liste deroulante
		if ($("#choixMission").length) {
			// Desactivation du formulaire
			$("#formAdminMissionsEdit input, #formAdminMissionsEdit textarea, #formAdminMissionsEdit select[multiple=multiple]").each(function () {
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
	   $("#formAdminMissionsAdd input, #formAdminMissionsAdd textarea").each(function () {
            $(this).prop("disabled", false);
            
        });
	   //$("#formAdminMissionsAdd select").prop("selected", false);
	   $("#formAdminMissionsAdd select option[selected='selected']").removeAttr("selected"); // on enleve les attribut selected qui peuvent exister
	});
});

// Affiche les donnees de la mission selectionnee
function affichageMission(idMission) {
	
	// Desactivation des elements du formulaire
	$("#formAdminMissionsEdit input[type!=submit], #formAdminMissionsEdit textarea").each(function () {
		$(this).val("");
		$(this).prop("disabled", true);
		
	});
	$("#formAdminMissionsEdit select").prop("disabled", true);
	$("#formAdminMissionsEdit select").prop("selected", false); // si select
	
	// id selectionne
	if (!isNaN(idMission)) {
		var dataJson = jQuery.parseJSON($("#json_mission").val())[idMission];
		$.each(dataJson, function (key, val) {
			if (typeof val == "object") {
				//$("#"+key).find('option:selected').removeAttr("selected"); // on enleve tous les selected
				$("#"+ key +" option[selected='selected']").removeAttr("selected");
				$.each(val, function (keyCp, valCp) {
					$("#"+key + " option[value='"+keyCp+"']").attr("selected", "selected").prop("selected", true);
				});
				
				$("#"+key).prop("disabled", false);
			} else if (typeof val == "string") {
				$("#"+key).val(val);
				$("#"+key).prop("disabled", false);
				
			}
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