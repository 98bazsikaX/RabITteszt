<?php
include_once 'ViewInterface.php';

class IndexView implements ViewInterface
{

    public function renderView($dataSource): string
    {
        return "<h1>Main Page</h1>
                <a href='ads'>Advertisements</a>
                <a href='users'>Users</a>";
    }
}