<?php
include_once(realpath(dirname(__FILE__) . '/../Utility/config.php'));
include_once 'user.php';
include_once 'ServiceInterface.php';

/**
 *
 */
class UserService implements ServiceInterface
{
    /**
     * only using a mysqli object, since it results in a cleaner code
     *if I create the connection in the constructor, and destroy it in the destructor
     * @var mysqli|false
     */
    private mysqli $connection;

    /**
     * @var string
     */
    private string $config;

    /**
     *
     */
    public function __construct()
    {
        $config = include(realpath(dirname(__FILE__) . '/../Utility/config.php'));
        $dbUrl = $config['DATABASE_URL'];
        $dbUser = $config['DATABASE_USER'];
        $dbPassword = $config['DATABASE_PASSWORD'];
        $dbName = $config['DATABASE_NAME'];
        $this->connection = mysqli_connect($dbUrl, $dbUser, $dbPassword); //the connection is tested in the functions using that
        $this->connection->select_db($dbName);
    }

    /**
     * @return array returns all users found in the database
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
            $toAdd->id = intval($row['id']); //making sure that its an integer
            $toAdd->name = $row['name'];
            $returnValue[] = $toAdd; //phpstorm suggested doing this instead of the array_push() function
        }
        return $returnValue;
    }

    /**
     * @param $id
     * @return User|null returns a user object if found by id, otherwise a null
     */
    public function getUserById($id): ?User
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
     * @return array gets all users by a given name
     */
    public function getUsersByName($name): array
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