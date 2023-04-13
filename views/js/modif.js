function onAjoutSentSuccess(data){
	alert(data['message']);
};

function onAjoutSentFailure(data){
	console.log(data.responseJSON['message']);
	const message = document.getElementById("message2");
    message.style.color = "red";
	message.textContent = data.responseJSON['message'];
	
};

function sendAjout(lieu2,dateMission2,titre2,annexe2 ,descriptions2,employe2,idmission){
	const endpoint = "http://localhost/gestion_missions/missions/"+idmission;
    $.ajax({
        url: endpoint,
        crossDomain: 'true',
        type: 'PUT',
        data: JSON.stringify({lieu:lieu2,dateMission:dateMission2,titre:titre2,annexe:annexe2,descriptions:descriptions2,employeId:employe2}),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
    })
    .done(onAjoutSentSuccess)
    .fail(onAjoutSentFailure);
};

const employe2 = document.getElementById("employe2");
employe2.addEventListener('change',function () {
    alert("voici votre choix : "+employe2.value);
},false);

const idMission = document.getElementById("titre2");
let titre2;
let titre;
idMission.addEventListener('change',function () {
    // selectionner le value et la valeur dans le options
    titre2 = idMission.options[idMission.selectedIndex].text.slice(4);
    alert("voici votre choix : "+idMission.value + idMission.options[idMission.selectedIndex].text);
},false);

$(document).ready(function () {
	$('form').submit(function(event) {
		const lieu2 = $("#lieu2").val();
		const dateMission2 = $("#dateMission2").val();
		const annexe2 = $("#annexe2").val();
		const descriptions2 = $("#descriptions2").val();

	    // Send the email
	    sendAjout(lieu2,dateMission2,titre2,annexe2,descriptions2,employe2.value,idMission.value);
		$("#lieu2").val("");
		$("#dateMission2").val("");
		$("#annexe2").val("");
		$("#descriptions2").val("");
		const message = document.getElementById("message2");
		message.textContent = "";
		
	    event.preventDefault();
	});
});
