<?php

namespace models\api;

use ApiManager;
use helpers\Validator;

/**
 * Clase modelo de estados http y mensaje opcional
 * 
 * @property int $status Estado
 * - Ver más: https://developer.mozilla.org/es/docs/Web/HTTP/Status 
 * @property null|string $message Mensaje opcional relacionado al estado
 */
class Status
{
    // * Propiedades 
    private $status = 200;
    private $message = NULL;

    // * Getters 

    /** 
     * Obtiene el valor de $status
     * 
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /** 
     * Obtiene el valor de $status
     * 
     * @return null|string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    // * Setters

    /** 
     * Asigna y obtiene el valor de $status
     *
     * @param int $status
     */
    public function setStatus($status)
    {
        if (!Validator::validStatus($status)) {
            ApiManager::exitError(500, 'Status inválido');
        }

        $this->status = $status;
    }

    /**
     * Asigna y obtiene el valor de $error
     * 
     * @param null|string $message
     */
    public function setMessage($message)
    {
        if (!Validator::validStatusMessage($message)) {
            ApiManager::exitError(500, 'Mensaje de status inválido');
        }

        $this->message = $message;
    }

    // * Métodos generales

    /**
     * Asigna el valor de $status y el valor de $message (opcional)
     *       
     * @param int $status
     * @param string|null $message
     */
    public function setStatusWithMessage($status, $message = NULL)
    {
        // Asignamos el estado
        $this->setStatus($status);

        // Asignamos el mensaje en caso exista
        if ($message) {
            $this->setMessage($message);
            return;
        }

        // Asignamos un mensaje por defecto dependiendo del estado
        switch ($status) {
            case 200:
                $this->setMessage('OK');
                break;
            case 201:
                $this->setMessage('Creación exitosa');
                break;
            case 400:
                $this->setMessage('No se pudo procesar la consulta');
                break;
            case 401:
                $this->setMessage('Sin autorización');
                break;
            case 403:
                $this->setMessage('No tiene los permisos para acceder a esta función');
                break;
            case 500:
                $this->setMessage('El servidor se encontró con un error inmanejable');
                break;
            default:
                $this->setMessage(NULL);
                break;
        }
    }
}
