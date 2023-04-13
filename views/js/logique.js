$(document).ready(function (){

	$.get("http://localhost/gestion_missions/missions/",
	function (data, textStatus) {
		
        for (let index = 0; index < data.length; index++) {
            const row = document.createElement("tr");
            Object.keys(data[index]).forEach(key => {
                const column = document.createElement("td");
                const contenu = document.createTextNode(data[index][key]);
                column.appendChild(contenu);
                row.appendChild(column);
              });
            let consulter = document.getElementById("consulter");
            consulter.appendChild(row);
        }
	});

});