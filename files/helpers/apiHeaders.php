<?php

// Permite el acceso de todos los origenes
header("Access-Control-Allow-Origin: *");
// Permite el uso de todos los métodos GET, POST, PUT, DELETE
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
// Elimina los reportes de advertencias y notificaciones
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE);
