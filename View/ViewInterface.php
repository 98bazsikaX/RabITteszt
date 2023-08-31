<?php

interface ViewInterface
{
    public function renderView($dataSource):string;
}