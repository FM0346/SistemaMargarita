<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');


class PrimerUsuario
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

    function __construct(
        mixed $imagen,
        string $nombre_completo,
        string $correo,
        string $dui,
        string $telefono,
        string $nombre_usuario,
        string $contrasenia
    ) {

        $codigo_usuario = uniqid('USER');

        // Valida codigo_usuario
        if (Validator::validateAlphanumericSpaceless($codigo_usuario, 1, 50) == false)
            ApiController::exitError('Código usuario no válido');

        // Valida nombre_completo
        if (Validator::validateAlphabetic($nombre_completo, 1, 100) == false)
            ApiController::exitError('Nombre completo no válido');

        // Valida correo
        if (Validator::validateEmail($correo) == false)
            ApiController::exitError('Correo no válido');

        // Valida dui
        if (Validator::validateDUI($dui) == false)
            ApiController::exitError('DUI no válido');

        // Valida telefono
        if (Validator::validatePhone($telefono) == false)
            ApiController::exitError('Teléfono no válido');

        // Valida nombre_usuario
        if (Validator::validateAlphanumericSpaceless($nombre_usuario, 1, 50) == false)
            ApiController::exitError('Nombre de usuario no válido');

        if (Validator::validatePassword($contrasenia) == false)
            ApiController::exitError('Contraseña no válida');


        // Valida y sube imagen en caso exista
        $query =
            'SELECT arch.id_archivo FROM archivos.archivo as arch 
            WHERE  arch.url_path = ? AND arch.id_archivo_padre = 
            (SELECT mn_arch.id_archivo FROM archivos.menu_archivo AS mn_arch WHERE mn_arch.url_path = ?)';
        $params = ['emptyUser.jpg', 'archivos/imagenes/usuarios'];
        $queryData = DatabasesAPI::ejecutarObtenerQuery('SistemaMargarita', $query, $params);

        $id_imagen = $queryData['data'][0]['id_archivo']; // Imagen base

        // Imagen agregada en caso de que exista
        if (isset($imagen) == true) {

            if (Validator::validateImageFile($imagen, 1000, 1000) == false)
                ApiController::exitError('Imagen no válida, límites [1000px,1000px]');

            $queryData =
                FileAPI::subirImagen($imagen, '/imagenes/primer-usuario/subir', $codigo_usuario . '.jpg');
            // Se cambia el id_imagen por la imagen actual
            $id_imagen = $queryData['data']['id_archivo'];
        }

        if (Validator::validateNaturalNumber($id_imagen) == false)
            ApiController::exitError('ID imagen no válida');

        $this->codigo_usuario = $codigo_usuario;
        $this->id_imagen = $id_imagen;
        $this->nombre_completo = $nombre_completo;
        $this->correo = $correo;
        $this->dui = $dui;
        $this->telefono = $telefono;
        $this->nombre_usuario = $nombre_usuario;
        $this->contrasenia = password_hash($contrasenia, PASSWORD_DEFAULT);
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
