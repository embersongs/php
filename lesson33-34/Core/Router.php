<?php

namespace App\Core;

class Router
{
    private array $routes = [];
    private array $params = [];
    private array $paramNames = [];

    public function addRoute(string $method, string $path, array $handler): void
    {
        $pattern = $this->convertPathToRegex($path);
        $this->routes[$method][$pattern] = [
            'handler' => $handler,
            'paramNames' => $this->paramNames,
            'originalPath' => $path
        ];
        $this->paramNames = [];
    }

    private function convertPathToRegex(string $path): string
    {
        $this->paramNames = [];

        // Находим все параметры
        preg_match_all('/\{([a-zA-Z_][a-zA-Z0-9_]*)(?::([^}]+))?\}/', $path, $matches, PREG_SET_ORDER);

        $pattern = preg_quote($path, '/');

        foreach ($matches as $match) {
            $paramName = $match[1];
            $this->paramNames[] = $paramName;

            // Если указан тип параметра, используем его
            if (isset($match[2])) {
                $type = $match[2];
                switch ($type) {
                    case 'int':
                    case 'number':
                        $regex = '(\d+)';
                        break;
                    case 'string':
                        $regex = '([^\/]+)';
                        break;
                    case 'slug':
                        $regex = '([a-z0-9-]+)';
                        break;
                    case 'uuid':
                        $regex = '([0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12})';
                        break;
                    default:
                        $regex = '([^\/]+)';
                }
            } else {
                // По умолчанию - любые символы кроме слеша
                $regex = '([^\/]+)';
            }

            // Заменяем {name} или {name:type} на регулярное выражение
            $pattern = str_replace(preg_quote($match[0], '/'), $regex, $pattern);
        }

        return '/^' . $pattern . '$/';
    }

    public function resolve(string $method, string $uri): ?array
    {
        $uri = strtok($uri, '?');

        if ($uri !== '/') {
            $uri = rtrim($uri, '/');
        }

        if (empty($uri)) {
            $uri = '/';
        }

        foreach ($this->routes[$method] ?? [] as $pattern => $routeData) {
            if (preg_match($pattern, $uri, $matches)) {
                array_shift($matches);

                $params = [];
                foreach ($routeData['paramNames'] as $index => $name) {
                    $params[$name] = $matches[$index] ?? null;

                    // Автоматическое преобразование типов
                    if (is_numeric($params[$name])) {
                        $params[$name] = (int) $params[$name];
                    }
                }

                $this->params = $params;
                return $routeData['handler'];
            }
        }

        return null;
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function getParam(string $name, $default = null)
    {
        return $this->params[$name] ?? $default;
    }

    public function route(string $method, string $uri): void
    {
        $handler = $this->resolve($method, $uri);

        if ($handler === null) {
            http_response_code(404);
            echo "404 Not Found - Route not found";
            return;
        }

        [$controllerClass, $action] = $handler;

        if (!class_exists($controllerClass)) {
            http_response_code(500);
            echo "500 Internal Server Error - Controller not found";
            return;
        }

        $controller = new $controllerClass();

        if (!method_exists($controller, $action)) {
            http_response_code(500);
            echo "500 Internal Server Error - Action not found";
            return;
        }

        // Передаем параметры в порядке объявления в маршруте
        $params = array_values($this->params);
        call_user_func_array([$controller, $action], $params);
    }
}

