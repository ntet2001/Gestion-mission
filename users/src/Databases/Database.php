<?php

class Database 
{
    /**
     * here is the connection constructor
     */
    public function __construct(private string $host, private string $dbname, private string $user, private string $password)
    {}

    /**
     * here is my public function getconnection who return a PDO
     */

    public function getConnection () : PDO
    {
        try {

            $dsn = "mysql:host=".$this->host.";dbname=".$this->dbname.";port=3308";
            return new PDO ($dsn,$this->user,$this->password,[PDO::ATTR_EMULATE_PREPARES => FALSE,PDO::ATTR_STRINGIFY_FETCHES => false]);
            echo "Connected to $this->dbname at $this->host successfully.";

        } catch (PDOException $pe) {
            http_response_code(500);
            echo json_encode([
                "error" => "Could not connect to the database $this->dbname :" . $pe->getMessage()
            ]);
        }
    }

}