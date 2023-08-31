<?php
include_once 'ViewInterface.php';

class IndexView implements ViewInterface
{

    public function renderView($dataSource): string
    {
        return "index";
    }
}