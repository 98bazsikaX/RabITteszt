<?php
include_once 'advertisement.php';
include_once 'UserService.php';
include_once 'ServiceInterface.php';

class AdvertisementService implements ServiceInterface
{
    private mysqli $connection;
    private UserService $userService;
    private array $config;

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
        $this->userService = new UserService();
    }

    public function getAllAdvertisements(): array
    {
        if ($this->connection->connect_error) {
            die("Connection Error! code: " . $this->connection->connect_errno);
        }
        $query = "SELECT * FROM advertisements";
        $queryResult = $this->connection->query($query);
        if (!$queryResult) {
            return [];
        }
        $returnValue = array();

        while ($row = mysqli_fetch_array($queryResult, MYSQLI_ASSOC)) {
            $toAdd = new Advertisement();
            $userId = intval($row['userid']);
            $user = $this->userService->getUserById($userId);
            $toAdd->id = intval($row['id']);
            $toAdd->user = $user;
            $toAdd->title = $row['title'];
            $returnValue[] = $toAdd;
        }
        return $returnValue;

    }

    public function getAdvertisementById($id): ?Advertisement
    {
        $allAds = $this->getAllAdvertisements();
        foreach ($allAds as $ad) {
            if ($ad->id == $id) {
                return $ad;
            }
        }
        return null;
    }

    public function getAdsByUserId($userId): array
    {
        $allAds = $this->getAllAdvertisements();
        $toReturn = [];
        foreach ($allAds as $ad) {
            if ($ad->user->id == $userId) {
                $toReturn[] = $ad;
            }
        }
        return $toReturn;
    }


    public function __destruct()
    {
        $this->connection->close();
    }

}