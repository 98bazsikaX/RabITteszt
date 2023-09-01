<?php

/**
 * An interface used for polymorphism purposes
 */
interface ViewInterface
{
    /**
     * @param $dataSource a service to feed the view data
     * @return string html code of the view/page as a string
     */
    public function renderView($dataSource):string;
}