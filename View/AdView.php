<?php
include_once 'ViewInterface.php';

class AdView implements ViewInterface
{

    public function renderView($params): string
    {
        return "AdView";
    }
}