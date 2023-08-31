<?php
include_once(realpath(dirname(__FILE__) . "/../Model/ServiceInterface.php"));

class Route
{
    private array $path;
    private ViewInterface $view;
    private ?ServiceInterface $dataSource;

    /**
     * @param array $path possible paths provided to a view
     * @param ViewInterface $view
     * @param ?ServiceInterface $dataSource source of the datas being used in the veiws, nullable if none is used
     */
    public function __construct(array $path, ViewInterface $view, ?ServiceInterface $dataSource)
    {
        $this->path = $path;
        $this->view = $view;
        $this->dataSource = $dataSource;
    }

    /**
     * @return ?ServiceInterface
     */
    public function getDataSource(): ?ServiceInterface
    {
        return $this->dataSource;
    }

    /**
     * @param ServiceInterface $dataSource
     * @return Route
     */
    public function setDataSource(ServiceInterface $dataSource): Route
    {
        $this->dataSource = $dataSource;
        return $this;
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