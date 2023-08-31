<?php
include_once 'advertisement.php';
include_once(realpath(dirname(__FILE__) . '/../Utility/DotEnvParser.php'));
include_once 'UserService.php';

class AdvertisementService
{
    private mysqli $connection;
    private UserService $userService;

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

    public function getAdvertisementsByUserId($userId): array
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