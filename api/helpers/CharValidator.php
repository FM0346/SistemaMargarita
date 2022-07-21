<?php

namespace helpers;

/** 
 * Contiene métodos estáticos para validaciones de caracteres
 */
class CharValidator
{
    /** 
     * Valida si un string es un carácter (tamaño 1)
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter
     */
    public static function isCharacter($val)
    {
        return strlen($val) == 1;
    }

    /** 
     * Valida si un carácter es un espacio
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (espacio)
     */
    public static function isSpace($val)
    {
        if (!self::isCharacter($val)) return false;
        return $val == ' ';
    }

    /** 
     * Valida si un carácter es una carácter especial
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (especial)
     */
    public static function isSpecial(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        $validChars = [
            '@',
            '!',
            '#',
            '$',
            '%',
            '&',
            "'",
            '*',
            '+',
            '-',
            '/',
            '=',
            '?',
            '^',
            '_',
            '`',
            '{',
            '|',
            '}',
            '~',
            '.',
        ];
        return array_key_exists($val, $validChars);
    }

    /** 
     * Valida si un carácter es una letra mayúlcula en el alfabeto inglés
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra mayúscula en inglés)
     */
    public static function isUpperAlpha(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return $val >= 'A' && $val <= 'Z';
    }

    /** 
     * Valida si un carácter es una letra mayúlcula en el alfabeto español
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra mayúscula en español)
     */
    public static function isUpperAlphaEsp(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        $validChars = ['Á', 'É', 'Í', 'Ó', 'Ú', 'Ñ'];
        return ($val >= 'A' && $val <= 'Z') || array_key_exists($val, $validChars);
    }

    /** 
     * Valida si un carácter es una letra minúscula en el alfabeto inglés
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra minúscula en inglés)
     */
    public static function isLowerAlpha(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return ($val >= 'a' && $val <= 'z');
    }

    /** 
     * Valida si un carácter es una letra minúscula en el alfabeto español
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra minúscula en español)
     */
    public static function isLowerAlphaEsp(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        $validChars = ['á', 'é', 'í', 'ó', 'ú', 'ñ'];
        return ($val >= 'a' && $val <= 'z') || array_key_exists($val, $validChars);
    }

    /** 
     * Valida si un carácter es una letra  en el alfabeto inglés
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra en inglés)
     */
    public static function isAlpha(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return self::isUpperAlpha($val) || self::isLowerAlpha($val);
    }

    /** 
     * Valida si un carácter es una letra en el alfabeto español
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (letra en español)
     */
    public static function isAlphaEsp(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return self::isUpperAlphaEsp($val) || self::isLowerAlphaEsp($val);
    }

    /** 
     * Valida si un carácter es un número
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (numérico)
     */
    public static function isNumber(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return $val >= '0' && $val <= '9';
    }

    /** 
     * Valida si un carácter es un alfanumérico en el alfabeto inglés
     *
     * @param string $val Dato a validar
     * 
     * @return bool Validación de carácter (alfanumérico en inglés)
     */
    public static function isAlphaNumeric(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return self::isAlpha($val) || self::isNumber($val);
    }

    /** 
     * Valida si un string es un carácter es un alfanumérico en el alfabeto español
     *
     * @param string $val Dato a validar
     *
     * @return bool Validación de carácter (alfanumérico en español)
     */
    public static function isAlphaNumericEsp(string $val): bool
    {
        if (!self::isCharacter($val)) return false;
        return self::isAlphaEsp($val) || self::isNumber($val);
    }
}
