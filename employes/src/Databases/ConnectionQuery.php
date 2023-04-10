<?php 


/**
 * here is the class to query my database
 */
class ConnectionQuery 
{
    private PDO $conn;
    
    public function __construct(Database $database)
    {
        $this->conn = $database -> getConnection();
    }

    /**
     * this function is to get the list of all the agents
     * it return an array  
     */
    public function getAllEmploye () : array
    {
        $query = "SELECT * FROM employe"; // this is the sql query
        $datas = [];

        $statement = $this->conn->query($query);
        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        }

        return $datas;
    }


    /**
     * this function is to get one agent and it return an array if the element is present
     * or a boolean "False" if not
     * @var string id 
     */
    public function getOneEmploye (string $id) : array | bool
    {
        $query = "SELECT * FROM employe WHERE idEmploye = :idEmploye"; // here is the sql query

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":idEmploye",$id);
        $statement->execute();

        $result = $statement -> fetch(PDO::FETCH_ASSOC);

        return $result;
    }

}