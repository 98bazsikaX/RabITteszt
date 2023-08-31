<?php
include_once 'ViewInterface.php';

class IndexView implements ViewInterface
{

    public function renderView($params): string
    {
        return "index";
    }
}