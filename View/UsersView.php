<?php
include_once 'ViewInterface.php';

class UsersView implements ViewInterface
{

    public function renderView($dataSource): string
    {
        return "users";
    }
}