<?php
include_once(realpath(dirname(__FILE__) . '/../Utility/DotEnvParser.php'));
include_once 'user.php';

/**
 *
 */
class UserService
{
    /*only using a mysqli object, since it results in a cleaner code
      if I create the connection in the constructor, and destroy it in the destructor
    */
    /**
     * @var mysqli|false
     */
    private mysqli $connection;

    /**
     *
     */
    public function __construct()
    {
        $dbUrl = DotEnvParser::getByKey('DATABASE_URL');
        $dbUser = DotEnvParser::getByKey('DATABASE_USER');
        $dbPassword = DotEnvParser::getByKey('DATABASE_PASSWORD');
        $dbName = DotEnvParser::getByKey('DATABASE_NAME');
        $this->connection = mysqli_connect($dbUrl, $dbUser, $dbPassword); //the connection is tested in the functions using that
        $this->connection->select_db($dbName);
    }

    /**
     * @return array
     */
    public function getAllUsers(): array
    {
        if ($this->connection->connect_error) {
            die("Connection Error! code: " . $this->connection->connect_errno);
        }
        $query = "SELECT * FROM users";
        $queryResult = $this->connection->query($query);
        if (!$queryResult) {
            return [];
        }
        $returnValue = array();
        while ($row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
            $toAdd = new User();
            $toAdd->id = $row['id'];
            $toAdd->name = $row['name'];
            $returnValue[] = $toAdd; //phpstorm suggested doing this instead of the array_push() function
        }
        return $returnValue;
    }

    /**
     * @param $id
     * @return User|null
     */
    public function getUserById($id):?User
    {
        $allUsers = $this->getAllUsers();
        foreach ($allUsers as $user) {
            if ($user->id == $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * @param $name
     * @return array
     */
    public function getUsersByName($name):array
    {
        $allUsers = $this->getAllUsers();
        $toReturn = [];
        foreach ($allUsers as $user) {
            if ($user->name === $name) {
                $toReturn[] = $user;
            }
        }
        return $toReturn;
    }

    /**
     *
     */
    public function __destruct()
    {
        $this->connection->close();
    }

}