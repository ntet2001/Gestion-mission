<?php

class MissionController 
{
    private $query;

    public function __construct(Database $database)
    {
        $this->query = new ConnectionQuery($database);
    }
    public function processRequest (string $method, string $id = null, string $service = null) : void
    {
        if ($id) {

            if ($service) {
                $this->processRessourceRequest2($method,$id,$service);
            }

            $this->processRessourceRequest1($method,$id);
            
        }else{

            $this->processCollectionRequest($method);
        }
    }

    private function processRessourceRequest1(string $method, string $id)
    {  
        if (!$this->query->getOneMateriel($id)){
            http_response_code(404);
            echo json_encode(["message" => "product not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($this->query->getOneMateriel($id));  
                break;
            
            case "PUT":
                $datas = (array) json_decode(file_get_contents('php://input',true));

                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["modele"] == "" || $datas["ram"] == "" || $datas["cpu"] == "" || $datas["carteGraphique"] == "" || $datas["rom"] == ""){

                    http_response_code(405);
                    echo json_encode(["error" => "les donnees ne doivent pas etre null"]);
                }else{

                    $materiel = new Materiel($id,$datas["modele"],$datas["ram"],$datas["cpu"],$datas["carteGraphique"],$datas["rom"]);
                }


                echo json_encode(["message" => "le materiel d'id = $id mis a jour",
                "id" => $this->query->updateMateriel($materiel->infoMaterial(),$id)]);
                break;

            case "DELETE":
                echo json_encode(["message" => "le materiel d'id = $id est supprimer",
                "rows" => $this->query->deleteMateriel($id)]);
                break;
            default :
                http_response_code(405);
                header("Allow method GET,PUT and DELETE only");
                break;
        }
        
    }

    private function processRessourceRequest2(string $method, string $id, string $service)
    {  
        if (!$this->query->getOneMateriel($id)){
            http_response_code(404);
            echo json_encode(["message" => "product not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($this->query->getOneMateriel($id));  
                break;
            
            case "PUT":
                $datas = (array) json_decode(file_get_contents('php://input',true));

                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["modele"] == "" || $datas["ram"] == "" || $datas["cpu"] == "" || $datas["carteGraphique"] == "" || $datas["rom"] == ""){

                    http_response_code(405);
                    echo json_encode(["error" => "les donnees ne doivent pas etre null"]);
                }else{

                    $materiel = new Materiel($id,$datas["modele"],$datas["ram"],$datas["cpu"],$datas["carteGraphique"],$datas["rom"]);
                }


                echo json_encode(["message" => "le materiel d'id = $id mis a jour",
                "id" => $this->query->updateMateriel($materiel->infoMaterial(),$id)]);
                break;

            case "DELETE":
                echo json_encode(["message" => "le materiel d'id = $id est supprimer",
                "rows" => $this->query->deleteMateriel($id)]);
                break;
            default :
                http_response_code(405);
                header("Allow method GET,PUT and DELETE only");
                break;
        }
        
    }

    private function processCollectionRequest(string $method)
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->query->getAllMateriels());     
            break;
            
            case "POST" :
                // je dois contruire le materiel a partir de $datas et j'appelle creer materiel
                $datas = (array) json_decode(file_get_contents('php://input',true));

                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["adressemac"] == "" || $datas["modele"] == "" || $datas["ram"] == "" || $datas["cpu"] == "" || $datas["carteGraphique"] == "" || $datas["rom"] == ""){

                    http_response_code(405);
                    echo json_encode(["error" => "les donnees ne doivent pas etre null"]);
                }else{

                    $materiel = new Materiel($datas["adressemac"],$datas["modele"],$datas["ram"],$datas["cpu"],$datas["carteGraphique"],$datas["rom"]);
                }

                echo json_encode(["message" => "le materiel est creer",
                "return" => $this->query->AddMateriel($materiel->infoMaterial())]);
                http_response_code(201);
            break; 

            default :
                http_response_code(405);
                header("Allow method GET and POST only");
            break;
        }

    }
}