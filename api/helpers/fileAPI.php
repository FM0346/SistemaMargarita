<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

/**
 * Clase Database
 * Permite la conexión con la API de archivos
 * además de la subida de archivos y obtener sus id
 */
class FileAPI
{

    // Métodos 

    /**
     * Realiza una consulta http en la api de archivos:
     * Sube un archivo y lo añade a la base de datos 'SistemaMargarita'
     * dentro de la ruta 
     * 
     * Se espera como resultado un arreglo de la forma
     * 
     * [
     *  status => int,
     *  data => array | null,
     *  error => string | null,
     * ]
     * 
     * Esperando un 'status' 1 y la variable 'data' con un arreglo conteniendo
     * un entero 'id_imagen' con el id del archivo añadido en la db
     * un 'status' 0 y un mensaje de error 'error' en caso de no ser exitoso
     */
    public static function subirImagen(mixed $img, string $route, string $filename): array
    {
        // Valida la imagen

        try {
            // Crea la consulta http de tipo POST
            $ch = curl_init(apiEndpoints::$apiFiles . $route);
            $img = new CURLFile($img['tmp_name'], mime_content_type($img['tmp_name']));
            $dataPOST = array('imagen' => $img, 'nombre' => $filename);

            curl_setopt($ch, CURLOPT_POST, 1); // Consulta http de tipo POST
            curl_setopt($ch, CURLOPT_POSTFIELDS, $dataPOST); // datos en POST
            // Evita que al ejecutar la consulta se imprima el resultado automáticamente
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Obtiene los resultados de la consulta como arreglo y los retorna si son válidos
            $result = json_decode(curl_exec($ch), true);
            if ($result['status'] == 0)
                ApiController::exitError($result['error']);

            return $result;
        } catch (Error $e) {
            ApiController::exitError('No se pudo conectar a la api de archivos');
        }
    }

    /**
     * Realiza una consulta http en la api de archivos:
     * Obtiene la información de una imagen (id, ruta) dado su id o ruta
     * dentro de la ruta 
     * 
     * Se espera como resultado un arreglo de la forma
     * 
     * [
     *  status => int,
     *  data => array | null,
     *  error => string | null,
     * ]
     * 
     * Esperando un 'status' 1 y la variable 'data' con un arreglo conteniendo
     * un entero 'id' con el id del archivo añadido en la db
     * un 'status' 0 y un mensaje de error 'error' en caso de no ser exitoso
     */
    public static function obtenerInfoImagen(int $id, string $route): array
    {
        // Valida la imagen

        try {
            // Crea la consulta http de tipo GET
            $dataGET = array('id' => $id);
            $ch = curl_init(apiEndpoints::$apiDatabases . $route . '/obtener-informacion' . '?' . http_build_query($dataGET));

            // Evita que al ejecutar la consulta se imprima el resultado automáticamente
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            // Obtiene los resultados de la consulta como arreglo y los retorna si son válidos
            $result = json_decode(curl_exec($ch), true);
            if ($result['status'] == 0)
                ApiController::exitError($result['error']);

            return $result;
        } catch (Error $e) {
            ApiController::exitError('No se pudo conectar a la api de archivos');
        }
    }
}
