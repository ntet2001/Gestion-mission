<?php

class MissionController 
{
    private $query;

    public function __construct(Database $database)
    {
        $this->query = new ConnectionQuery($database);
    }
    public function processRequest (string $method, string $id = null, string $service = null, $valeurService = null) : void
    {
        if ($id) {

            if ($service) {
                $this->processRessourceRequest2($method,$id,$service,$valeurService);
            }

            $this->processRessourceRequest1($method,$id);
            
        }else{

            $this->processCollectionRequest($method);
        }
    }

    private function processRessourceRequest1(string $method, string $id)
    {  
        if (!$this->query->getOneMission($id)){
            http_response_code(404);
            echo json_encode(["message" => "pas de mission"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($this->query->getOneMission($id));  
                break;
            
            case "PUT":
                $datas = (array) json_decode(file_get_contents('php://input',true));

                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["lieu"] == "" || $datas["dateMission"] == "" || $datas["titre"] == "" || $datas["annexe"] == "" || $datas["descriptions"] == "" || $datas["employeId"] == ""){

                    http_response_code(405);
                    echo json_encode(["message" => "les donnees ne doivent pas etre null"]);
                }else{

                    $mission = new Mission($datas["lieu"],$datas["dateMission"],$datas["titre"],$datas["annexe"],$datas["descriptions"],null,null,$datas["employeId"]);
                }


                echo json_encode(["message" => "la mission d'id = $id mis a jour",
                "id" => $this->query->updateMission($mission->infoMission(),$id)]);
                break;

            case "DELETE":
                echo json_encode(["message" => "la mission d'id = $id est supprimer",
                "rows" => $this->query->deleteMission($id)]);
                break;
            default :
                http_response_code(405);
                header("Allow method GET,PUT and DELETE only");
                break;
        }
        
    }

    private function processRessourceRequest2(string $method, string $id, string $service,$valeurService)
    {  
        if (!$this->query->getOneMission($id)){
            http_response_code(404);
            echo json_encode(["message" => "la mission n'existe pas"]);
            return;
        }

        switch ($method) {
            case "PUT":
                switch ($service) {
                    case "statut":
                        if (is_numeric($valeurService) && ($valeurService == 0 || $valeurService == 1)) {
                            echo json_encode(["message" => "statut changer","id" => $this->query->updateStatutMission($valeurService,$id)]);
                        }else{
                            echo json_encode(["message" => "le statut doit etre 0 ou 1"]);
                        }
                        
                    break;
                    
                    case "rapport":
                        if (is_numeric($valeurService)) {
                            echo json_encode(["message" => "rapport ajouter","id" => $this->query->updateRapportMission($valeurService,$id)]);
                        }else{
                            echo json_encode(["message" => "l'id du rapport doit etre un nombre"]);
                        }
                    break;

                    default:
                        http_response_code(405);
                        echo json_encode(["message" => "Allow services statut and rapport only"]);
                        header("Allow services statut and rapport only");
                    break;
                }
            break;

            default :
                http_response_code(405);
                header("Allow method PUT only");
                break;
        }
        
    }

    private function processCollectionRequest(string $method)
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->query->getAllMissions());     
            break;
            
            case "POST" :
                // je dois contruire la mission a partir de $datas et j'appelle creer mission
                $datas = (array) json_decode(file_get_contents('php://input',true));
                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["lieu"] == "" || $datas["dateMission"] == "" || $datas["titre"] == "" || $datas["annexe"] == "" || $datas["descriptions"] == "" || $datas["employeId"] == ""){

                    http_response_code(405);
                    echo json_encode(["message" => "les donnees ne doivent pas etre null"]);
                }else{

                    $missions = $this->query->getAllMissions();
                    foreach ($missions as $key => $value) {
                       
                        if ($value["employeId"] == $datas["employeId"] ) {
                            echo json_encode(["message" => "l'employe est deja assigner a une mission"]);
                            http_response_code(405);
                            exit;
                        }
                    }
                    $mission = new Mission($datas["lieu"],$datas["dateMission"],$datas["titre"],$datas["annexe"],$datas["descriptions"],0,null,$datas["employeId"]);
                }

                echo json_encode(["message" => $this->query->AddMission($mission->infoMission())]);
                http_response_code(201);
            break; 

            default :
                http_response_code(405);
                header("Allow method GET and POST only");
            break;
        }

    }
}