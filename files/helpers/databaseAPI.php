<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

/**
 * Clase Database
 * Permite la conexión con la API de archivos
 */
class DatabasesAPI
{

    // Métodos 

    /**
     * Realiza una consulta http en la api de bases de datos:
     * ejecuta una consulta $query con parámetros $params en la base de datos $db
     * y regresa como resultado el arreglo obtenido, haya sido exitoso o no
     * 
     * Se espera como resultado un arreglo de la forma
     * 
     * [
     *  status => int,
     *  data => array | null,
     *  error => string | null,
     * ]
     * 
     * Esperando un 'status' 1 y la variable 'data' vacía en caso la consulta sea exitosa
     * un 'status' 0 y un mensaje de error 'error' en caso de no ser exitoso
     */
    public static function ejecutarQuery(string $db, string $query, ?array $params): array
    {
        try {
            // Crea la consulta http de tipo GET
            $dataGET = array('db' => $db, 'consulta' => $query, 'parametros' => $params);
            $ch = curl_init(apiEndpoints::$apiDatabases . '/ejecutar' . '?' . http_build_query($dataGET));

            // Evita que al ejecutar la consulta se imprima el resultado automáticamente
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Obtiene los resultados de la consulta como arreglo y los retorna si son válidos
            $result = json_decode(curl_exec($ch), true);
            if ($result['status'] == 0)
                ApiController::exitError($result['error']);

            return $result;
        } catch (Error $error) {
            ApiController::exitError('No se pudo conectar a la api de la base de datos');
        }
    }

    /**
     * Realiza una consulta http en la api de bases de datos:
     * ejecuta una consulta $query con parámetros $params en la base de datos $db
     * y regresa como resultado el arreglo obtenido, haya sido exitoso o no
     * 
     * Se espera como resultado un arreglo de la forma
     * 
     * [
     *  status => int,
     *  data => array | null,
     *  error => string | null,
     * ]
     * 
     * Esperando un 'status' 1 y un variable 'data' 
     * con un arreglo resultado de la $query en caso la consulta sea exitosa
     * un 'status' 0 y un mensaje de error 'error' en caso de no ser exitoso
     */
    public static function ejecutarObtenerQuery(string $db, string $query, ?array $params): array
    {
        try {
            // Crea la consulta http de tipo GET
            $dataGET = array('db' => $db, 'consulta' => $query, 'parametros' => $params);
            $ch = curl_init(apiEndpoints::$apiDatabases . '/ejecutar-obtener' . '?' . http_build_query($dataGET));

            // Evita que al ejecutar la consulta se imprima el resultado automáticamente
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Obtiene los resultados de la consulta como arreglo y los retorna si son válidos
            $result = json_decode(curl_exec($ch), true);
            if ($result['status'] == 0)
                ApiController::exitError($result['error']);

            return $result;
        } catch (Error $e) {
            ApiController::exitError('No se pudo conectar a la api de la base de datos');
        }
    }
}
