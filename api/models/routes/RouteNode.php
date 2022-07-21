<?php

namespace models\routes;

/** 
 * Contiene la estructura un nodo de un camino/ruta de la API
 * 
 * @property null|RouteEnd $routeEnd Fin de la ruta
 * @property array $routePath Arreglo de caminos 
 */
class RouteNode
{
    // * Propiedades

    private $state;
    private $routeEnd;
    private $routePath;

    // * Constructor 

    /**
     * Constructor:
     * asigna por defecto las propiedades de la clase
     * 
     * @param null|RouteEnd $routeEnd 
     * @param array $routePath
     */
    function __construct($routeEnd = NULL, $routePath = [])
    {
        $this->state = new Status();
        $this->setRouteEnd($routeEnd);
        $this->setRoutePath($routePath);
    }

    // * Getters

    /**
     * Obtiene el valor de $routeEnd
     * 
     * @return null|RouteEnd
     */
    public function getRouteEnd()
    {
        return $this->routeEnd;
    }

    /**
     * Obtiene el valor de $routePath
     * 
     * @return array 
     */
    public function getRoutePath()
    {
        return $this->routePath;
    }

    /**
     * @return null|RouteNode
     */
    public function getChildPath($pathName)
    {
        // Dato invalido, mensaje de error
        if (!Validator::validRoute($pathName)) {
            return NULL;
        }

        // Camino inexistente, mensaje de error
        if (!array_key_exists($pathName, $this->routePath)) {
            $this->setErrorWithCode(404, 'Ruta no existente');
            return NULL;
        }

        // Camino válido, retornamos
        return $this->routePath[$pathName];
    }

    // * Setters

    /**
     * Asigna y obtiene el valor de $routeEnd
     */
    public function setRouteEnd($routeEnd)
    {
        // Dato invalido, mensaje de error
        if ($routeEnd != NULL && get_class($routeEnd) != 'RouteNode') {
            $this->setErrorWithCode(500, 'Fin de ruta inválido');
            return NULL;
        }

        // Dato válido, asignamos y retornamos
        return $this->routeEnd = $routeEnd;
    }

    /**
     * Asigna y obtiene el valor de $routePath
     */
    public function setRoutePath($routePath)
    {
        // Dato inválido, mensaje de error
        foreach ($routePath as $routeChild) {
            //Validamos que los caminos hijo sean de clase RouteNode
            if (@get_class($routeChild) != 'RouteNode') {
                $this->setErrorWithCode(500, 'Camino de ruta inválido');
                return NULL;
            }
        }

        // Dato válido, asignamos y retornamos
        return $this->routePath = $routePath;
    }

    /**
     * Asigna y obtiene un valor hijo a $routePath
     */
    public function setChildPath($pathName, &$pathNode)
    {
        // Dato inválido, mensaje de error
        if (!Validator::validRoute($pathName)) {
            $this->setErrorWithCode(500, 'Nombre de ruta hijo inválido');
            return NULL;
        }

        // Dato válido, asignamos y retornamos
        return $this->routePath[$pathName] = $pathNode;
    }
}
