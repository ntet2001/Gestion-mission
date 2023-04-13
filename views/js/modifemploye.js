$(document).ready(function (){

	$.get("http://localhost/gestion_missions/employes/",
	function (data, textStatus) {
		
        for (let index = 0; index < data.length; index++) {
            let opt = document.createElement("option");
            let attrib = document.createAttribute("value");
            let contenu = document.createTextNode(data[index].nomEmploye + " " + data[index].prenomEmploye + " " + data[index].idEmploye);
            attrib.value = data[index].idEmploye;
            opt.setAttributeNode(attrib);
            opt.appendChild(contenu);
            
            let employe2 = document.getElementById("employe2");
            employe2.appendChild(opt);
        }
	});

});