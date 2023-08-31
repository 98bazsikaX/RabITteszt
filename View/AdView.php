<?php
include_once 'ViewInterface.php';

class AdView implements ViewInterface
{

    public function renderView($dataSource): string
    {
        return "AdView";
    }
}