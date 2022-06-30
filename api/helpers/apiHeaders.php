<?php
//permite el acceso de todos los origenes
header("Access-Control-Allow-Origin: *");
//permite el uso de todos los métodos GET, POST, PUT, DELETE
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
//indica que el tipo de contenido a retornar será de tipo json
header('Content-Type: application/json');
//elimina los reportes de errores
//error_reporting(0);
