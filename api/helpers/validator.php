<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

class Validator
{

    /** 
     * Método para sanear todos los campos de un formulario (quitar los espacios en blanco al principio y al final).
     *
     * Parámetros: $fields (arreglo con los campos del formulario).
     *   
     * Retorno: arreglo con los campos saneados del formulario.
     */
    public static function trimForm($fields)
    {
        foreach ($fields as $index => $value) {
            $value = trim($value);
            $fields[$index] = $value;
        }
        return $fields;
    }

    /** 
     * Método para validar un número natural como por ejemplo 
     * llave primaria, llave foránea, entre otros.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateNaturalNumber(int $value): bool
    {
        // Se verifica que el valor sea un número entero mayor o igual a uno.
        return filter_var($value, FILTER_VALIDATE_INT, ['min_range' => 1]) ? true : false;
    }

    /**
     * Método para validar un correo electrónico.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateEmail(string $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) ? true : false;
    }

    /** 
     * Método para validar una cadena de texto 
     * (letras, digitos, espacios en blanco y signos de puntuación).
     *
     * Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */

    public static function validateString(string $value, int $minimum, int $maximum): bool
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        return preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s\,\;\.]{' . $minimum . ',' . $maximum . '}$/', $value) ? true : false;
    }

    /**
     * Método para validar un dato alfabético (letras y espacios en blanco).
     *
     * Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateAlphabetic(string $value, int $minimum, int $maximum): bool
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        return preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ\s]{' . $minimum . ',' . $maximum . '}$/', $value) ? true : false;
    }

    /**
     * Método para validar un dato alfabético (letras).
     *
     * Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */

    public static function validateAlphabeticSpaceless(string $value, int $minimum, int $maximum): bool
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        return preg_match('/^[a-zA-ZñÑáÁéÉíÍóÓúÚ]{' . $minimum . ',' . $maximum . '}$/', $value) ? true : false;
    }

    /** 
     * Método para validar un dato alfanumérico (letras, dígitos y espacios en blanco).
     *
     * Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateAlphanumeric(string $value, int $minimum, int $maximum): bool
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        return preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ\s]{' . $minimum . ',' . $maximum . '}$/', $value) ? true : false;
    }

    /** 
     * Método para validar un dato alfanumérico (letras, dígitos y espacios en blanco).
     *
     * Parámetros: $value (dato a validar), $minimum (longitud mínima) y $maximum (longitud máxima).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateAlphanumericSpaceless(string $value, int $minimum, int $maximum): bool
    {
        // Se verifica el contenido y la longitud de acuerdo con la base de datos.
        return preg_match('/^[a-zA-Z0-9ñÑáÁéÉíÍóÓúÚ]{' . $minimum . ',' . $maximum . '}$/', $value) ? true : false;
    }

    /** 
     * Método para validar un dato monetario.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateMoney(string $value): bool
    {
        // Se verifica que el número tenga una parte entera y como máximo dos cifras decimales.
        return preg_match('/^[0-9]+(?:\.[0-9]{1,2})?$/', $value) ? true : false;
    }

    /** 
     * Método para validar una contraseña.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validatePassword(string $value): bool
    {
        // Se verifica la longitud mínima.
        // ! valor temporal entre 1 y 50
        return (strlen($value) > 0 && strlen($value) <= 50);
    }

    /** 
     * Método para validar el formato del DUI (Documento Único de Identidad).
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateDUI(string $value): bool
    {
        // Se verifica que el número tenga el formato 00000000-0.
        return preg_match('/^[0-9]{8}[-][0-9]{1}$/', $value) ? true : false;
    }

    /** 
     * Método para validar un número telefónico.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validatePhone(string $value): bool
    {
        // Se verifica que el número tenga el formato 0000-0000 y que inicie con 2, 6 o 7.
        return preg_match('/^[2,6,7]{1}[0-9]{3}[-][0-9]{4}$/', $value) ? true : false;
    }

    /**
     * Método para validar una fecha.
     *
     * Parámetros: $value (dato a validar).
     *   
     * Retorno: booleano (true si el valor es correcto o false en caso contrario).
     */
    public static function validateDate(string $value): bool
    {
        // Se dividen las partes de la fecha y se guardan en un arreglo en el siguiene orden: año, mes y día.
        $date = explode('-', $value);
        return checkdate($date[1], $date[2], $date[0]) ? true : false;
    }

    /** 
     * Método para validar un archivo de imagen.
     *
     * Parámetros: $file (archivo de un formulario), $maxWidth (ancho máximo para la imagen) y 
     * $maxHeigth (alto máximo para la imagen).
     *   
     * Retorno: booleano (true si el archivo es correcto o false en caso contrario).
     */
    public static function validateImageFile(mixed $file, int $maxWidth, int $maxHeigth): bool
    {
        // Se verifica si el archivo existe
        if ($file == null) return false;
        // Se comprueba si el archivo tiene un tamaño menor o igual a 2MB
        if ($file['size'] > 2097152) return false;
        // Se obtienen las dimensiones de la imagen y su tipo.
        list($width, $height, $type) = getimagesize($file['tmp_name']);
        // Se verifica si la imagen cumple con las dimensiones máximas.
        if ($width > $maxWidth || $height > $maxHeigth) return false;
        // Se comprueba si el tipo de imagen es permitido (2 - JPG y 3 - PNG)
        if (($type == 2 || $type == 3) == false) return false;
        return true;
    }
}
