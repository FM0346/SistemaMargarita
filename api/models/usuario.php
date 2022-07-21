<?php

// Requiere de la base de los modelos
require_once(dirname(__DIR__, 1) . '/helpers/base_model.php');

/** Mantiene la información relacionada a usuarios */
class Usuario extends BaseModel
{
    // Propiedades

    public ?string $codigo_usuario = null;
    private ?int $id_imagen = null;
    private ?string $nombre_completo = null;
    private ?string $correo = null;
    private ?string $dui = null;
    private ?string $telefono = null;
    private ?string $nombre_usuario = null;
    private ?string $contrasenia = null;

    /** Mensaje en caso de error */
    private ?string $error = null;

    function setUser(
        string $codigo_usuario,
        int $imagen,
        string $nombre_completo,
        string $correo,
        string $dui,
        string $telefono,
        string $nombre_usuario,
        string $contrasenia
    ) {
        // Valida codigo_usuario
        if (self::validBoolean($error = self::validID($usuario))) {
            $this->error = $error;
        }

        if (self::validBoolean($error = self::validID($usuario))) {
            $this->error = 'ID de imagen no válido';
            return;
        }
        // Valida nombre_completo
        if (self::validateAlphabetic($nombre_completo, 1, 100) == false) {
            $this->error = 'ID de imagen no válido';
            return;
        }
        ApiController::exitError('Nombre completo no válido');

        // Valida correo
        if (self::validateEmail($correo) == false)
            ApiController::exitError('Correo no válido');

        // Valida dui
        if (self::validateDUI($dui) == false)
            ApiController::exitError('DUI no válido');

        // Valida telefono
        if (self::validatePhone($telefono) == false)
            ApiController::exitError('Teléfono no válido');

        // Valida nombre_usuario
        if (self::validateAlphanumericSpaceless($nombre_usuario, 1, 50) == false)
            ApiController::exitError('Nombre de usuario no válido');

        if (self::validatePassword($contrasenia) == false)
            ApiController::exitError('Contraseña no válida');



        $this->codigo_usuario = $codigo_usuario;
        $this->id_imagen = $id_imagen;
        $this->nombre_completo = $nombre_completo;
        $this->correo = $correo;
        $this->dui = $dui;
        $this->telefono = $telefono;
        $this->nombre_usuario = $nombre_usuario;
        $this->contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
    }

    public function setUser()
    {
    }

    public function getData(): array
    {
        return [
            'codigo_usuario' => $this->codigo_usuario, 'id_imagen' =>  $this->id_imagen,
            'nombre_completo' => $this->nombre_completo, 'correo' => $this->correo,
            'telefono' => $this->telefono, 'dui' => $this->dui,
            'nombre_usuario' => $this->nombre_usuario, 'contrasenia' => $this->contrasenia
        ];
    }
}
