<?php

namespace models\routes;

/** 
 * Contiene la estructura de un camino final de un controlador,
 * manteniendo la información hacia el controlador y método a utilizar
 * 
 * @property string $controllerRoute Ruta del controlador
 * @property string $className Nombre de la clase del controlador
 * @property string $methodName Nombre del método de la clase del controlador
 */
class RouteEnd
{
    // * Propiedades

    private $route;
    private $class;
    private $method;


    // * Constructor

    /**
     * Constructor:
     * asigna por defecto las propiedades de la clase
     * 
     * @param string $route
     * @param string $class
     * @param string $method
     */
    function __construct($route = '', $class = '', $method = '')
    {
        $this->setRoute($route);
        $this->setClass($class);
        $this->setMethod($method);
    }


    // * Getters

    /**
     * Obtiene el valor de $route
     * 
     * @return APIError|string 
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Obtiene el valor de $class
     * 
     * @return APIError|string 
     */
    public function getClass()
    {
        return $this->class;
    }

    /**
     * Obtiene el valor de $method
     * 
     * @return APIError|string 
     */
    public function getMethod()
    {
        return $this->method;
    }


    // * Setters

    /**
     * Asigna el valor de $route
     *
     * @param string $route
     * 
     * @return APIError|void 
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * Asigna el valor de $class
     *
     * @param string $class
     * 
     * @return APIError|void 
     */
    public function setClass($class)
    {
        $this->class = $class;
    }

    /**
     * Asigna el valor de $method
     *
     * @param string $method
     * 
     * @return APIError|void
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }
}
