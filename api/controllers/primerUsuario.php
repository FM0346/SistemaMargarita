<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');
// Requiere del modelo primer-usuario
require_once('./models/primerUsuario.php');

// Conjunto de funciones relacionadas al login

/**
 * Valida si no hay usuarios registrados en la base de datos 'SistemaMargarita'
 *
 * Retorna un booleano 'primer-usuario' con 
 * - true si no hay usuarios registrados 
 * - false si hay usuarios registrados
 */
function validarPrimerUsuario(): array
{
    $query = "Select count(id_usuario) from usuarios.usuario";
    $queryData = DatabasesAPI::ejecutarObtenerQuery('SistemaMargarita', $query, null);
    $data = ['primer-usuario' => ($queryData['data'][0]['count'] == 0)];
    return $data;
}

/**
 * Crea el primer usuario si y solo si no hay usuarios 
 * registrados en la base de datos 'SistemaMargarita'
 *
 * Retorna un arreglo vacío en caso de exito
 */
function crearPrimerUsuario(): array
{
    // Valida que sea el primer usuario
    $primerUsuario = validarPrimerUsuario();
    if ($primerUsuario['primer-usuario'] == false)
        ApiController::exitError('Primer usuario previamente creado');

    $_POST = Validator::trimForm($_POST);

    $needData = [
        'nombre_completo',
        'telefono', 'dui', 'correo',
        'nombre_usuario', 'contrasenia'
    ];

    foreach ($needData as &$field) {
        if (isset($_POST[$field]) == false) {
            ApiController::exitError($field . ' inexistente y necesario en el formulario');
        }
    }

    $imagen = null;

    if (isset($_FILES['imagen']) == true) $imagen = $_FILES['imagen'];

    $firstUser = new PrimerUsuario(
        $imagen,
        $_POST['nombre_completo'],
        $_POST['correo'],
        $_POST['dui'],
        $_POST['telefono'],
        $_POST['nombre_usuario'],
        $_POST['contrasenia']
    );

    $data = $firstUser->getData();

    $query =
        'INSERT INTO usuarios.usuario(codigo_usuario, id_imagen, nombre_completo, 
        correo, dui, telefono, nombre_usuario, contrasenia, tipo_usuario)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, 1)';

    $params =
        [
            $data['codigo_usuario'], $data['id_imagen'],
            $data['nombre_completo'], $data['correo'],
            $data['dui'], $data['telefono'],
            $data['nombre_usuario'], $data['contrasenia']
        ];

    DatabasesAPI::ejecutarQuery('SistemaMargarita', $query, $params);
    return [];
}
