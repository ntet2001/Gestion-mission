function onLoginSentSuccess(data){
	console.log(data['message']);
	localStorage.setItem("login",data['message']);
	document.location.href="http://localhost/gestion_missions/views/admin";
};

function onLoginSentFailure(data){
	console.log(data.responseJSON['message']);
	const message = document.getElementById("message");
	message.textContent = data.responseJSON['message'];
	
};

function sendLogin(login, password){
	const endpoint = "http://localhost/gestion_missions/users/"
    $.ajax({
        url: endpoint,
        crossDomain: 'true',
        type: 'POST',
        data: JSON.stringify({login: login, pass: password}),
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
    })
    .done(onLoginSentSuccess)
    .fail(onLoginSentFailure);
};

$(document).ready(function () {
	$('form').submit(function(event) {
		const login = $("#login").val();
		const password = $("#password").val();
		//const message = document.getElementById("message").textContent;

	    // Send the email
	    sendLogin(login,password)
		$("#login").val("");
		$("#password").val("");
	    event.preventDefault();
	});
});
