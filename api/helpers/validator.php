<?php

namespace helpers;

/**
 * Contiene métodos estáticos parar realizar validaciones 
 */
class Validator extends CharValidator
{
    /**
     * Método para sanear un arreglo $arr
     *  
     * @param array $arr
     * 
     * @return array
     */
    public static function trimArray($arr)
    {
        // Aplica trim a cada elemento del arreglo en caso sea de tipo string
        foreach ($arr as $index => $field) {
            if (gettype($arr[$index]) == 'string') {
                $form[$index] = trim($field);
            }
        }

        return $form;
    }

    /**
     * Método para validar una sección de una ruta
     * - Caracteres válidos: letras, números y guiones [a-z, A-Z, 0-9, -]
     *  
     * @param string $val
     * 
     * @return bool|string retorna true si es válido, caso contrario mensaje de error
     */
    public static function validRoute($val)
    {
        // Si el string tiene tamaño 0 -> error
        if (!strlen($val)) return 'Ruta vacía';

        // Si el string tiene caracteres invalidos -> error
        $invalidChars = array_reduce(
            str_split($val),
            function (int $acc, string $char) {
                return self::isAlphaNumeric($char) || $char == '-' ? $acc : $acc + 1;
            },
            0
        );
        if ($invalidChars) return 'Ruta contiene caracteres inválidos';

        // Validado -> true
        return true;
    }


    /** 
     * Método para validar un usuario
     *
     * @param string $val
     * 
     * @return bool|string retorna true si es válido, caso contrario mensaje de error
     */
    public static function validUser($val)
    {
        // Si no es un nombre de usuario o correo válido -> 
        $validUsername = self::validUsername($val);
        $validEmail = self::validEmail($val);
        if ($validUsername !== true && $validEmail !== true) {
            return 'Formato de usuario incorrecto';
        }

        // Validado -> true
        return true;
    }


    /** 
     * Método para validar un nombre de usuario
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de nombre usuario
     * @return string Mensaje de error en caso suceda
     */
    public static function validUsername(string $val): bool | string
    {
        if (strlen($val) == 0) return 'Nombre de usuario no debe estar vacío';
        if (strlen($val) > 50) return 'Nombre de usuario debe contener menos de 50 caracteres';
        if (str_contains($val, ' ')) return 'Nombre de usuario no puede contener espacios';
        if (!self::isAlpha($val[0]))
            return 'Nombre de usuario debe comenzar con una letra sin tilde';
        $invalidChars = array_reduce(
            explode($val, ''),
            function (int $acc, string $val) {
                return self::isAlpha($val) || self::isNumber($val) || $val == '_' ? $acc : $acc + 1;
            },
            0
        );
        if ($invalidChars) return 'Nombre de usuario contiene caracteres inválidos';
        return true;
    }

    /** 
     * Método para validar un correo electrónico
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de correo electrónico
     * @return string Mensaje de error en caso suceda
     */
    public static function validEmail(string $val): bool | string
    {
        if (strlen($val) == 0) return 'Correo no debe estar vacío';
        if (strlen($val) > 250) return 'Correo debe contener menos de 256 caracteres';
        if (!filter_var($val, FILTER_VALIDATE_EMAIL)) return 'Correo debe ser un correo válido';
        return true;
    }

    /** 
     * Método para validar una contraseña
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de contraseña
     * @return string Mensaje de error en caso suceda
     */
    public static function validPassword(string $val): bool | string
    {
        if (strlen($val) == 0) return 'Contraseña no debe estar vacía';
        if (strlen($val) > 50) return 'Contraseña debe contener menos de 50 caracteres';
        return true;
    }
}
