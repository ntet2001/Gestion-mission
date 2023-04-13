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
     * this function is to get the list of all the users
     * it return an array  
     */
    public function getAllUsers () : array
    {
        $query = "SELECT * FROM utilisateur"; // this is the sql query
        $datas = [];

        $statement = $this->conn->query($query);
        while ($row = $statement -> fetch(PDO::FETCH_ASSOC)) {
            $datas[] = $row;
        }

        return $datas;
    }

}