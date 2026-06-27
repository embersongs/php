<?php

namespace App\Core;

class Render
{
    public function render(string $template, array $params = []): string
    {
        return $this->renderTemplate('layouts/main', [
            'menu' => $this->renderTemplate('menu'),
            'content' => $this->renderTemplate($template, $params)
        ]);
    }


    public function renderTemplate(string $template, array $params = []): string
    {
        ob_start();
        extract($params);
        include '../templates/' . $template . '.php';
        return ob_get_clean();
    }
}