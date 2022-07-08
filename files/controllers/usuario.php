<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

// Funciones de modificación de archivos del usuario

/**
 * Obtiene la imagen de la ruta ./archivos/imagenes/usuarios.
 * con el nombre $archivo
 */
function obtenerImagen(): void
{
    if (isset($_GET['archivo']) == false) {
        header($_SERVER["SERVER_PROTOCOL"] . " 404 Not Found");
        exit;
    }

    FileManager::obtenerArchivo('./archivos/imagenes/usuarios', $_GET['archivo']);
    exit;
}

/**
 * Sube una imagen tanto en la carpeta ./archivos/imagenes/usuarios
 * como en la base de datos
 * 
 * Retorna el id del archivo (imagen) guardado en la base de datos
 */
function subirImagen(): array
{
    if (isset($_FILES['imagen']) == false)
        ApiController::exitError('Imagen inexistente');

    if (isset($_POST['nombre']) == false)
        ApiController::exitError('Nombre de imagen inexistente');

    // Sube una imgen en formato jpg
    $filename = $_POST['nombre'] . '.jpg';

    // Sube el archivo
    FileManager::subirArchivo($_FILES['imagen'], './archivos/imagenes/usuarios', $filename);

    // Inserta y obtiene el id del valor agregado
    $query =
        'INSERT INTO archivos.archivo(url_path, id_archivo_padre)
        VALUES (?, (SELECT mn_arch.id_archivo FROM archivos.menu_archivo AS mn_arch WHERE mn_arch.url_path = ?) ) 
        RETURNING id_archivo';
    $params = [$filename, 'archivos/imagenes/usuarios'];
    $queryData = DatabasesAPI::ejecutarObtenerQuery('SistemaMargarita', $query, $params);

    // Retorna el id del valor agregado
    $data = ['id_archivo' => $queryData['data'][0]['id_archivo']];
    return $data;
}
