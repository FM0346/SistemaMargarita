<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

/** 
 * Clase apiController
 * Mantiene las propiedades y métodos 
 * utilizados para retonar una respuesta
 */
class ApiController
{
    // Propiedades
    private static array $result = [
        'status' => 0,
        'data' => null,
        'error' => null
    ];

    private static ?array $controller;
    private static ?string $controllerRoute;
    private static ?string $controllerAction;

    // Métodos del arreglo resultado $result

    // Asigna un string $error en el arreglo resultado $result
    private static function setError(?string $error): void
    {
        self::$result['error'] = $error;
    }

    // Asigna un arreglo $data en el arreglo resultado $result
    private static function setData(?array $data): void
    {
        self::$result['data'] = $data;
    }

    // Asigna un estado $status en el arreglo resultado $result
    private static function setStatus(?int $status): void
    {
        self::$result['status'] = $status;
    }

    // Termina el programa retornando el arreglo resultado
    private static function exitResult(): array
    {
        // Indica que el tipo de contenido a retornar será de tipo json
        header('Content-Type: application/json');
        exit(json_encode(
            self::$result,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        ));
    }

    // Asigna un string $error en el arreglo $result  y luego retorna el arreglo resultado
    public static function exitError(?string $error): void
    {
        self::setStatus(0);
        if ($error != null) self::setError('Error: ' . $error);
        self::exitResult();
    }

    // Asigna un arreglo $data en el arreglo $result y luego retorna el arreglo resultado
    public static function exitData(?array $data): void
    {
        self::setStatus(1);
        self::setData($data);
        self::exitResult();
    }

    // Métodos del enrutamiento de acciones

    // Ejecuta una acción en un controlador
    private static function doAction(): void
    {
        try {
            require('./controllers/' . self::$controllerRoute);
        } catch (Error $e) {
            ApiController::exitError("Controlador '" . self::$controllerRoute . "' no encontrado");
        }

        try {
            $function = self::$controllerAction;
            ApiController::exitData($function());
        } catch (Error $e) {
            ApiController::exitError(
                "Acción '"
                    . self::$controllerAction
                    . "' no encontrada o error desconocido en el controlador '"
                    . self::$controllerRoute . "'"
            );
        }
    }

    // Obtiene en un arreglo el controlador y la función a ejecutar en base a una ruta $route
    private static function getControllerAction(string $route): void
    {
        // Requiere de un arreglo de controladores para ejecutar acciones
        self::$controller = require('./helpers/controllerDictionary.php');
        // Genera un arreglo de strings, una ruta que vamos a seguir en el arreglo de controladores
        $controllerRoute = explode("/", $route);
        $controllerRouteSize = sizeof($controllerRoute);
        // Intentamos obtener el controlador y la acción a ejecutar
        for ($i = 1; $i < $controllerRouteSize; $i++) {
            if (array_key_exists($controllerRoute[$i], self::$controller) === false)
                ApiController::exitError("Acción no encontrada");

            self::$controller = self::$controller[$controllerRoute[$i]];
        }
        if (array_key_exists('action', self::$controller) === false)
            ApiController::exitError("Acción no encontrada");


        // Divide el controlador, dando un arreglo de la forma [controllerRoute, controllerAction];  
        self::$controller = explode("@", self::$controller['action']);
        $controllerSize = sizeof(self::$controller);

        if ($controllerSize != 2)
            ApiController::exitError("Acción no encontrada");

        self::$controllerRoute = self::$controller[0];
        self::$controllerAction = self::$controller[1];
    }


    // Obtiene y ejecuta una acción (función) de un controlador
    public static function getAction(string $route): void
    {
        self::getControllerAction($route);
        self::doAction();
    }
}
