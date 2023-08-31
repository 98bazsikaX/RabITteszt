<?php

class Route
{
    private array $path;
    private ViewInterface $view;

    /**
     * @param array $path possible paths provided to a view
     * @param ViewInterface $view
     */
    public function __construct(array $path, ViewInterface $view)
    {
        $this->path = $path;
        $this->view = $view;
    }

    /**
     * @return array
     */
    public function getPath(): array
    {
        return $this->path;
    }

    /**
     * @param array $path
     * @return Route
     */
    public function setPath(array $path): Route
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return ViewInterface
     */
    public function getView(): ViewInterface
    {
        return $this->view;
    }

    /**
     * @param ViewInterface $view
     * @return Route
     */
    public function setView(ViewInterface $view): Route
    {
        $this->view = $view;
        return $this;
    }

}