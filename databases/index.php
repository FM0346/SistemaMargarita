<?php
// Incluye los headers de la api
include('./helpers/apiHeaders.php');
// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

// Ejecuta una acción según la url sin los parámetros
ApiController::getAction(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
