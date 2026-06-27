<?php

namespace App\Core;

class Request
{
    protected string $requestString;
    protected string $controllerName;
    protected string $actionName;
    protected int $id;

    protected string $method;
    protected array $params = [];

    public function __construct()
    {
        $this->parceRequest();
    }

    protected function parceRequest(): void
    {
        $this->requestString = $_SERVER['REQUEST_URI'];

        $url = explode('/', $this->requestString);

        $this->controllerName = $url[1];

        if (isset($url[2])) {
            if (is_numeric($url[2])) {
                $id = (int)$url[2];
                $action = 'index';
            } else {
                $action = $url[2];
                $id = isset($url[3]) && is_numeric($url[3]) ? (int)$url[3] : null;
            }
        } else {
            $action = 'index';
            $id = null;
        }
        $this->actionName = $action;
        if (!empty($id)) {
            $this->id = $id;
        }



        $this->method = $_SERVER['REQUEST_METHOD'];

        $this->params = $_REQUEST;


    }

    public function getControllerName(): string
    {
        return $this->controllerName;
    }

    public function getActionName(): string
    {
        return $this->actionName;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getParams(): array
    {
        return $this->params;
    }


}