<?php

// Requiere de los headers de la API
require_once(__DIR__ . '/config/headers.php');

// Requiere del manager de la API
require_once(__DIR__ . '/controllers/managers/api.php');

// Requiere del manager de rutas
require_once(__DIR__ . '/controllers/managers/route.php');


$route = RouteManager::getRouteEnd(
    // URL de la consulta, eliminamos el primer caracter '/'
    substr(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), 1),
    // Ruta base
    require(__DIR__ . '/config/routeRoot.php')
);

if (!$route) {
    ApiManager::exitError(RouteManager::getStatus(), RouteManager::getError());
}

var_dump($route);
