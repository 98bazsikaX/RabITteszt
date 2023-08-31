<?php
include_once (realpath(dirname(__FILE__) .'/../Utility/DotEnvParser.php'));
include_once 'user.php';
class UserService
{
    /*only using a mysqli object, since it results in a cleaner code
      if i create the connection in the constructor, and destroy it in the destructor
    */
    private mysqli $connection;

    public function __construct(){
        $dbUrl = DotEnvParser::getByKey('DATABASE_URL');
        $dbUser = DotEnvParser::getByKey('DATABASE_USER');
        $dbPassword = DotEnvParser::getByKey('DATABASE_PASSWORD');
        $dbName = DotEnvParser::getByKey('DATABASE_NAME');
        $this->connection = mysqli_connect($dbUrl,$dbUser,$dbPassword); //the connection is tested in the functions using that
        $this->connection->select_db($dbName);
    }

    public function getAllUsers(){
        if($this->connection->connect_error){
            die("Connection Error! code: " . $this->connection->connect_errno);
        }
        $query = "SELECT * FROM users";
        $queryResult = $this->connection->query($query);
        if(!$queryResult){
            return [];
        }
        $returnValue = array();
        while($row = mysqli_fetch_array($queryResult,MYSQLI_ASSOC)){
            $toAdd = new User();
            $toAdd->id = $row['id'];
            $toAdd->name = $row['name'];
            $returnValue[] = $toAdd;
        }
        return $returnValue;
    }

    public function __destruct()
    {
       $this->connection->close();
    }

}