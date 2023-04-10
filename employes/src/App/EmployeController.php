<?php

class EmployeController 
{
    private $query;

    public function __construct(Database $database)
    {
        $this->query = new ConnectionQuery($database);
    }
    public function processRequest (string $method, string $id = null) : void
    {
        if ($id) {

            $this->processRessourceRequest($method,$id);
            
        }else{

            $this->processCollectionRequest($method);
        }
    }

    private function processRessourceRequest(string $method, string $id)
    {  
        if (!$this->query->getOneEmploye($id)){
            http_response_code(404);
            echo json_encode(["message" => "pas d'employe"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($this->query->getOneEmploye($id));  
                break;
            default :
                http_response_code(405);
                header("Allow method GET only");
                break;
        }
        
    }


    private function processCollectionRequest(string $method)
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->query->getAllEmploye());     
            break;
            
            default :
                http_response_code(405);
                header("Allow method GET only");
            break;
        }

    }
}