<?php

class UsersController 
{
    private $query;

    public function __construct(Database $database)
    {
        $this->query = new ConnectionQuery($database);
    }
    public function processRequest (string $method) : void
    {

        $this->processCollectionRequest($method);
    }


    private function processCollectionRequest(string $method)
    {
        switch ($method) {
            case "POST":
                
                $datas = (array) json_decode(file_get_contents('php://input',true));
                // condition pour verifier si les donnees en entrer ne sont pas null

                if ($datas["login"] == "" || $datas["pass"] == ""){

                    http_response_code(405);
                    echo json_encode(["message" => "les donnees ne doivent pas etre null"]);
                }else{

                    $users = $this->query->getAllUsers();
                    foreach ($users as $key => $value) {
                        
                        if ($value["login"] == $datas["login"] && $value["pass"] == $datas["pass"] ) {
                            echo json_encode(["message" => "connecter"]);
                            http_response_code(200);
                        }else{
                            echo json_encode(["message" => "identifiant incorrect"]);
                            http_response_code(405);
                        }
                    }
                }
            break;
            
            default :
                http_response_code(405);
                header("Allow method POST only");
            break;
        }

    }
}