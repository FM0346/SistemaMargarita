<?php


//requiere del controlador de la api
require_once('./controllers/apiController.php');
//requiere el archivo database para ejecutar queries
require_once('./databases/database.php');

/*
    Controlador login
    conjunto de funciones relacionadas al login
*/

function validarPrimerUsuario(): void
{
    $query = "Select count(id_usuario) from usuarios.usuario";
    $queryData = Database::getQueryData('SistemaMargarita', $query);
    $data = [ 'primer-usuario' => ($queryData[0]['count'] == 0) ];
    ApiController::exitData($data);
}
