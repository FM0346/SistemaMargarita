<?php

/** 
 * Clase ApiManager, contiene funciones estáticas para manejar la api
 */
class ApiManager
{
    public static function exitError($status, $error)
    {
        // http_response_code($status);
        header('Content-Type: application/json');

        $resultJSON = ['status' => $status, 'error' => $error];
        exit(json_encode(
            $resultJSON,
            JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_NUMERIC_CHECK
        ));
    }
}
