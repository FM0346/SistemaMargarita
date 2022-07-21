<?php

// Requiere de la clase Validator - validaciones
require_once(dirname(__DIR__, 2) . '/helpers/validator.php');

// Requiere de la clase BaseModel - base de todos los modelos
require_once(dirname(__DIR__, 2) . '/helpers/base_model.php');

class Result extends Model
{

    // * Propiedades
    private $data;

    // * Constructor

    function __construct($data = [])
    {
        $this->setData($data);
    }

    // * Getters

    /**
     * Obtiene el valor de $data
     * 
     * @return null|array
     */
    public function getData()
    {
        return $this->data;
    }

    // * Setters

    /**
     * Set the value of data
     *
     * @param array $data
     * 
     * @return null|array
     */
    public function setData($data)
    {
        return $this->data = $data;
    }
}
