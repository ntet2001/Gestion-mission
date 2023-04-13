$(document).ready(function (){

	$.get("http://localhost/gestion_missions/missions/",
	function (data, textStatus) {
		
        for (let index = 0; index < data.length; index++) {
            let opt = document.createElement("option");
            let attrib = document.createAttribute("value");
            let contenu = document.createTextNode("- " + data[index].idMission + " "+ data[index].titre);
            attrib.value = data[index].idMission;
            opt.setAttributeNode(attrib);
            opt.appendChild(contenu);
            
            let titre = document.getElementById("titre2"); 
            titre.appendChild(opt);
        }
	});

});