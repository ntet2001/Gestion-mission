$(document).ready(function (){

	$.get("http://localhost/gestion_missions/missions/",
	function (data, textStatus) {
		console.log(data[0].lieu + ", statut: " + textStatus);
	});

});

