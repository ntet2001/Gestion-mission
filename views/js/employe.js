$(document).ready(function (){

	$.get("http://localhost/gestion_missions/employes/",
	function (data, textStatus) {
		
        for (let index = 0; index < data.length; index++) {
            let opt = document.createElement("option");
            let attrib = document.createAttribute("value");
            let contenu = document.createTextNode(data[index].nomEmploye + " " + data[index].prenomEmploye);
            attrib.value = data[index].idEmploye;
            opt.setAttributeNode(attrib);
            opt.appendChild(contenu);
            
            let employe = document.getElementById("employe1"); 
            employe.appendChild(opt);
        }
	});

});