<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

// Conjunto de funciones relacionadas al la base de datos

/**
 * Ejecuta una consulta y retorna un arreglo 
 * 'data' vacío en caso de éxito.
 */
function ejecutarConsulta(): array
{
    if (isset($_GET['db']) == false) {
        ApiController::exitError('base de datos no definida');
    }

    if (isset($_GET['consulta']) == false) {
        ApiController::exitError('consulta no definida');
    }

    if (isset($_GET['parametros']) == false) {
        ApiController::exitError('Parametros no definidos');
    }

    DatabaseManager::executeQuery($_GET['db'], $_GET['consulta'], $_GET['parametros']);
    return [];
}

/**
 * Ejecuta una consulta y retorna los resultados 
 * obtenidos en el arreglo 'data' en caso de éxito 
 */
function ejecutarObtenerConsulta(): array
{
    if (isset($_GET['db']) == false) {
        ApiController::exitError('base de datos no definida');
    }

    $db = $_GET['db'];

    if (isset($_GET['consulta']) == false) {
        ApiController::exitError('consulta no definida');
    }

    $query = $_GET['consulta'];
    $query = str_replace("'?'", '?', $query);

    $params = null;
    if (isset($_GET['parametros']) == true) {
        $params = $_GET['parametros'];
    }

    $result = DatabaseManager::getQueryData($db, $query, $params);
    return $result;
}
