<?php

namespace App\Controllers;

use App\Core\Render;

class Controller
{
    protected string $action;
    protected string $defaultAction = 'index';
    protected Render $render;


    public function __construct(Render $render)
    {
        $this->render = $render;
    }


    public function runAction(string $action)
    {
        $this->action = $action ?: $this->defaultAction;
        dump($this->action);
        $method = 'action' . ucfirst($this->action);
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            die("404 Нет такого экшена");
        }
    }
}