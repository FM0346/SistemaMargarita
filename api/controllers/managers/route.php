<?php

// Requiere de la clase BaseModel - base de todos los modelos
require_once(dirname(__DIR__, 2) . '/helpers/base_manager.php');

// Requiere de la clase RouteNode
require_once(dirname(__DIR__, 2) . '/models/routes/route_node.php');

/** 
 * Permite encontrar el controlador relacionado a la ruta 
 * 
 * @property ?RouteLeaf $routeEnd Nulo o final de la ruta, contiene la información
 * del controlador y método respectivo
 */
class RouteManager extends Manager
{
    /**
     * Obtiene el final de la ruta dado un $url y un RouteNode $route
     * 
     * @param string $url;
     * @param RouteNode $route
     * 
     * @return null|RouteNode ruta final o nulo en caso de error
     */

    public static function getRouteEnd($url, $route)
    {
        // Obtiene el camino de rutas a a seguir
        $path = explode('/', $url);

        foreach ($path as $partialPath) {
            // Si no puede seguir con la ruta, retornamos el error
            if (!($nextRoute = $route->getChildPath($partialPath))) {
                self::setErrorWithCode($route->getStatus(), $route->getError());
                return NULL;
            }
            $route = $nextRoute;
        }

        return $route;
    }
}
