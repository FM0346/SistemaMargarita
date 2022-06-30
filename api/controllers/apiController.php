<?php

/*
    Clase apiController mantiene las propiedades 
    métodos utilizados de forma global
*/

class ApiController
{
    //propiedades
    private static array $result = [
        'status' => 0,
        'data' => null,
        'error' => null
    ];

    private static ?array $controller;
    private static ?string $controllerRoute;
    private static ?string $controllerAction;

    //funciones del arreglo resultado $result

    //asigna un string $error en el arreglo resultado $result
    private static function setError(string $error): void
    {
        self::$result['error'] = $error;
    }

    //asigna un arreglo $data en el arreglo resultado $result
    private static function setData(array $data): void
    {
        self::$result['data'] = $data;
    }

    //asigna un estado $status en el arreglo resultado $result
    private static function setStatus(int $status): void
    {
        self::$result['status'] = $status;
    }

    //termina el programa retornando el arreglo resultado
    private static function exitResult(): array
    {
        exit(json_encode(self::$result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK));
    }

    //asigna un error $error y luego retorna el arreglo resultado
    public static function exitError(string $error): void
    {
        self::setStatus(0);
        self::setError('Error: ' . $error);
        self::exitResult();
    }

    //asigna un arreglo $data y luego retorna el arreglo resultado
    public static function exitData(array $data): void
    {
        self::setStatus(1);
        self::setData($data);
        self::exitResult();
    }

    //funciones del enrutamiento de acciones

    //ejecuta una acción en un controlador
    private static function doAction(): void
    {
        try {
            require('./controllers/' . self::$controllerRoute);
        } catch (Error $e) {
            ApiController::exitError("Controlador '" . self::$controllerRoute . "' no encontrado");
        }

        try {
            $function = self::$controllerAction;
            $function();
        } catch (Error $e) {
            ApiController::exitError("Acción '" . self::$controllerAction . "' no encontrada en el controlador '" . self::$controllerRoute . "'");
        }
    }

    //obtiene en un arreglo el controlador y la función a ejecutar en base a una ruta $route
    private static function getControllerAction(string $route): void
    {
        //requiere de un arreglo de controladores para ejecutar acciones
        self::$controller = require('./helpers/controllerDictionary.php');
        //genera un arreglo de strings, una ruta que vamos a seguir en el arreglo de controladores
        $controllerRoute = explode("/", $route);
        $controllerRouteSize = sizeof($controllerRoute);
        //intentamos obtener el controlador y la acción a ejecutar
        for ($i = 1; $i < $controllerRouteSize; $i++) {
            if (array_key_exists($controllerRoute[$i], self::$controller) === false) {
                ApiController::exitError("Acción no encontrada");
            }
            self::$controller = self::$controller[$controllerRoute[$i]];
        }
        if (array_key_exists('action', self::$controller) === false) {
            ApiController::exitError("Acción no encontrada");
        }

        //divide el controlador, dando un arreglo de la forma [controllerRoute, controllerAction];  
        self::$controller = explode("@", self::$controller['action']);
        $controllerSize = sizeof(self::$controller);

        if ($controllerSize != 2) {
            ApiController::exitError("Acción no encontrada");
        }

        self::$controllerRoute = self::$controller[0];
        self::$controllerAction = self::$controller[1];
    }

    public static function getAction(string $route): void
    {
        self::getControllerAction($route);
        self::doAction();
    }
}
