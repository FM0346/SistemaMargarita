<?php

namespace models\api;

/**
 * Clase modelo del resultado de la api
 * 
 * @property int $status Estado del resultado 1 válido, 0 inválido - con error
 * @property null|array $data Información relevante del resultado 
 * @property null|string $error Mensaje de error del resultado
 */
class Status
{
    // * Propiedades 
    private $status = 1;
    private $data = NULL;
    private $error = NULL;

    // * Getters 

    /**
     * Obtiene el resultado de $status 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Get the value of data
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Get the value of error
     */
    public function getError()
    {
        return $this->error;
    }
}
