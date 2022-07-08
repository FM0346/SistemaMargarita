<?php
// Incluye los headers de la api
include('./helpers/apiHeaders.php');
// Requiere del controlador de la api
require('./controllers/apiController.php');

// Ejecuta una acción según la url sin los parámetros
ApiController::getAction(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
