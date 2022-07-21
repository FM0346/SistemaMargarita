<?php

// Elimina los reportes de advertencias y notificaciones
//error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);

// Permite el origen desde la api
$http_origin = @$_SERVER['HTTP_ORIGIN'];
if ($http_origin == "http://localhost:9000") {
    header("Access-Control-Allow-Origin: $http_origin");
}
// Permite el uso de credenciales
header("Access-Control-Allow-Credentials: true");

// Permite el uso de todos los métodos GET, POST, PUT, DELETE
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

//Permite el uso de los headers
header('Access-Control-Allow-Headers: X-Requested-With, Origin, Content-Type, X-CSRF-Token, Accept');
