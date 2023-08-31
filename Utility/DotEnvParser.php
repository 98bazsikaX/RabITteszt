<?php

class DotEnvParser{
    private static array $values = array();
    private static array $lines = [];

    public static function __constructStatic(): void
    {
        $file = fopen("../.env","r+");
        self::$lines = fread($file,filesize('../.env')).explode('\n');
        foreach (self::$lines as $line){
            [$key,$value] = $line.explode('=');
            self::$values[$key] = $value;
        }
    }

    public static function getByKey($key):string{
        //TODO: fix mocking;
        /* DATABASE_URL=localhost
            DATABASE_PORT=3306
            DATABASE_USER=root
         */
        $toReturn = "";
        switch ($key){
            case 'DATABASE_URL':
                $toReturn = 'localhost';
                break;
            case 'DATABASE_PORT';
                $toReturn = '3306';
                break;
            case 'DATABASE_USER':
                $toReturn = 'root';
                break;
        }
        return $toReturn;
    }
}