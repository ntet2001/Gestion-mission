function onAjoutSentSuccess(data){
	alert(data['message']);
};

function onAjoutSentFailure(data){
	console.log(data.responseJSON['message']);
	const message = document.getElementById("message1");
    message.style.color = "red";
	message.textContent = data.responseJSON['message'];
	
};

function sendAjout(lieu1,dateMission1,titre1,annexe1 ,descriptions1,employe1){
	const endpoint = "http://localhost/gestion_missions/missions/"
    $.ajax({
        url: endpoint,
        crossDomain: 'true',
        type: 'POST',
        data: JSON.stringify({lieu:lieu1,dateMission:dateMission1,titre:titre1,annexe:annexe1,descriptions:descriptions1,employeId:employe1 }),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
    })
    .done(onAjoutSentSuccess)
    .fail(onAjoutSentFailure);
};

const employe1 = document.getElementById("employe1");
employe1.addEventListener('change',function () {
    alert("voici votre choix : "+employe1.value);
},false);

$(document).ready(function () {
	$('form').submit(function(event) {
		const lieu1 = $("#lieu1").val();
		const dateMission1 = $("#dateMission1").val();
		const titre1 = $("#titre1").val();
		const annexe1 = $("#annexe1").val();
		const descriptions1 = $("#descriptions1").val();

	    // Send the email
	    sendAjout(lieu1,dateMission1,titre1,annexe1 ,descriptions1,employe1.value);
		$("#lieu1").val("");
		$("#dateMission1").val("");
		$("#titre1").val("");
		$("#annexe1").val("");
		$("#descriptions1").val("");
		const message = document.getElementById("message1");
		message.textContent = "";
		
	    event.preventDefault();
	});
});
