<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

/**
 * Clase DatabaseManager
 * Permite la  creación de archivos en carpeta y con la base de datos
 */
class FileManager
{

    // Obtiene un archivo de una ruta determinada
    public static function obtenerArchivo(string $route, string $filename): void
    {
        $finalRoute = $route . '/' . $filename;
        if (file_exists($finalRoute) == false) {
            header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
            exit;
        }

        header('Content-type: ' . mime_content_type($finalRoute));
        readfile($finalRoute);
    }

    // Sube un archivo de una ruta determinada
    public static function eliminarArchivo(string $route, string $filename): void
    {
        $finalRoute = $route . '/' . $filename;
        if (file_exists($finalRoute) == false) ApiController::exitError('No se pudo eliminar, ruta de archivo inexistente');
        // Elimina el archivo
        unlink($finalRoute);
    }

    // Sube un archivo a una ruta en específco con un nombre único con prefijo
    public static function subirArchivo(mixed $file, string $route, string $filename): void
    {
        // Se le asigna un nombre de archivo único, guardando con tipo jpg
        $finalRoute = $route . '/' . $filename;
        // Intenta mover el archivo a la ruta final designada
        if (file_exists($finalRoute) == true) @unlink($finalRoute);
        if (move_uploaded_file($file['tmp_name'], $finalRoute) == false) ApiController::exitError('No se pudo subir el archivo');
    }
}
