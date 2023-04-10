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
     * this function is to get the list of all the missions
     * it return an array  
     */
    public function getAllMissions () : array
    {
        $query = "SELECT * FROM mission"; // this is the sql query
        $datas = [];

        $statement = $this->conn->query($query);
        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        }

        return $datas;
    }


    /**
     * this function is to get one mission and it return an array if the element is present
     * or a boolean "False" if not
     * @var string id 
     */
    public function getOneMission (string $id) : array | bool
    {
        $query = "SELECT * FROM mission WHERE idMission = :idMission"; // here is the sql query

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":idMission",$id);
        $statement->execute();

        $result = $statement -> fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    /**
     * this function is to add a mission it takes in input a list of data an return a string
     * @var array $datas
     */
    public function AddMission (array $datas) : string
    {
        // below is the sql query
        $query = "INSERT INTO mission (lieu,dateMission,titre,annexe,descriptions,statut,rapportId,employeId) VALUES (:lieu, :dateMission, :titre, :annexe, :descriptions, :statut, :rapportId, :employeId)";
        try {
            $statement = $this->conn->prepare($query);
            $statement->execute($datas);

            return $this->conn->lastInsertId();

        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }


    /**
     * this function is to update a mission in my database it takes in input the list
     * of data to update and the id of the mission to update and return a string
     * @var array $datas
     * @var string $id
     */
    public function updateMission (array $datas, string $id) : string
    {
        // below is the sql query to update the data.
        $query = "UPDATE mission SET lieu = :lieu, dateMission = :dateMission, titre = :titre, annexe = :annexe, descriptions = :descriptions,employeId = :employeId WHERE idMission = :idMission";

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":lieu",$datas["lieu"]);
        $statement -> bindValue(":dateMission",$datas["dateMission"]);
        $statement -> bindValue(":titre",$datas["titre"]);
        $statement -> bindValue(":annexe",$datas["annexe"]);
        $statement -> bindValue(":descriptions",$datas["descriptions"]);
        $statement -> bindValue(":employeId",$datas["employeId"]);
        $statement -> bindValue(":idMission",$id);
        $statement->execute();

        return $this->conn->lastInsertId();
    }


    /**
     * this function is to update the statut of a mission in my database it takes in input the list
     * of data to update and the id of the mission to update and return a string
     * @var int $statut
     * @var string $id
     */
    public function updateStatutMission (int $statut, string $id) : string
    {
        // below is the sql query to update the data.
        $query = "UPDATE mission SET statut = :statut WHERE idMission = :idMission";

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":statut",$statut);
        $statement -> bindValue(":idMission",$id);
        $statement->execute();

        return $this->conn->lastInsertId();
    }

     /**
     * this function is to update the repportid of a mission in my database it takes in input the list
     * of data to update and the id of the mission to update and return a string
     * @var int $rapportId
     * @var string $id
     */
    public function updateRapportMission (int $rapportId, string $id) : string
    {
        // below is the sql query to update the data.
        $query = "UPDATE mission SET rapportId = :rapportId WHERE idMission = :idMission";

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":rapportId",$rapportId);
        $statement -> bindValue(":idMission",$id);
        $statement->execute();

        return $this->conn->lastInsertId();
    }


    /**
     * this function is to delete a data it take as input the id of the mission to delete
     * @var string $id
     */
    public function deleteMission (string $id)
    {
        //this is the query to delete the material of the id gived to the function
        $query = "DELETE FROM mission WHERE idMission = :idMission";

        $statement = $this->conn->prepare($query);
        $statement -> bindValue(":idMission",$id);
        $statement->execute();

        $result = $statement -> rowCount();

        return $result;
    }
}