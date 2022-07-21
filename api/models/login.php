<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');


class LoginCredentialsModel
{
    // Propiedades
    private ?string $usuario = null;
    private ?string $contrasenia = null;

    // Propiedades de error
    public array $errors = [];

    public function setCredentials(
        string $usuario,
        string $contrasenia
    ): bool {

        // Valida nombre de usuario
        if (Validator::validBoolean($error = Validator::validUser($usuario)))
            array_push($this->errors, $error);

        // Valida contraseña
        if (Validator::validBoolean($error = Validator::validPassword($contrasenia)))
            array_push($this->errors, $error);

        // Si la cantidad de errores no es nula, retornamos
        if (sizeof($this->errors) != 0) return false;

        // Almacena los resultados en caso estén validados
        $this->usuario = $usuario;
        $this->contrasenia = $contrasenia;
        return true;
    }

    public function getCredentials(): array
    {
        return ['usuario' => $this->usuario, 'contrasenia' => $this->contrasenia];
    }
}
