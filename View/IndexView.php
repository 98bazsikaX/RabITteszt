<?php
include_once 'ViewInterface.php';

/**
 *
 */
class IndexView implements ViewInterface
{

    /**
     * @param $dataSource a service to feed the view data
     * @return string html code of the view/page as a string
     */
    public function renderView($dataSource): string
    {
        return "<h1>Main Page</h1>
                <a href='ads'>Advertisements</a>
                <a href='users'>Users</a>";
    }
}