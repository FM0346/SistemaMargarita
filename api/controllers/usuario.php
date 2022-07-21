<?php

// Requiere de los recursos globales
require_once(dirname(__DIR__) . '/config/globals.php');

// Requiere de los modelos a utilizar
require_once(dirname(__DIR__, 1) . '/models/usuario.php');

/** Clase con las funciones relacionadas a usuario */
class Usuario
{
    // * Propiedades

    /** Almacena el resultado obtenido */
    private Result $result;

    // Getters

    /** @return Result Resultado del método*/
    public function getResult(): Result
    {
        return $this->result;
    }

    // Métodos

    public function isFirstUser(): void
    {
        // Realiza la consulta en la base de datos;
        $query = "SELECT count(id_usuario) FROM usuarios.usuario WHERE estado_eliminado = false";
        $params = [];
        DatabaseManager::executeQueryData('SistemaMargarita', $query, $params);
    }
}
