<?php

// Requiere de los archivos globales para utilizar módulos
require_once('./helpers/apiGlobals.php');

/**
 * Clase DatabaseManager
 * Permite la conexión y creación de queries con la base de datos
 * obteniendo las credenciales desde el archivo credentials.json
 */
class DatabaseManager
{
    // Propiedades
    private static ?array $dbCredential = null;
    private static ?PDO $dbConnection = null;
    private static ?PDOStatement $dbStatement = null;
    private static ?string $dbErrorMessage = null;

    // Métodos

    /** 
     * Obtiene las credenciales de la base de datos $dbName 
     * por medio del archivo credentials.json
     *
     * En caso de error muere el programa con el mensaje de errors
     */
    private static function getDBCredential(string $dbName): void
    {
        //$dbCredentials debe contener un arreglo
        $dbCredentials = json_decode(file_get_contents('./helpers/dbcredentials.json'), true);
        if (array_key_exists($dbName, $dbCredentials) === false)
            ApiController::exitError("No se pudo conectar a la base de datos");
        self::$dbCredential = $dbCredentials[$dbName];
    }

    // Asigna a null las credenciales $dbCredential
    private static function destroyDBCredential(): void
    {
        self::$dbCredential = null;
    }

    /**
     * Obtiene las credenciales $dbCredential de la base de datos $dbName
     * crea la conexión $dbConnection y destruye las credenciales
     *
     * En caso de error asigna el error y muere el programa
     */
    private static function getDBConnection(string $dbName): void
    {
        try {
            self::getDBCredential($dbName);
            self::$dbConnection = new PDO(
                self::$dbCredential['dsn'],
                self::$dbCredential['username'],
                self::$dbCredential['password'],
            );
            self::destroyDBCredential();
        } catch (PDOException $error) {
            self::destroyDBCredential();
            self::setErrorMessageWithCode($error->getCode(), $error->getMessage());
            ApiController::exitError(self::$dbErrorMessage);
        }
    }

    // Asigna a null la conexión y el statement con la base de datos $dbConnection
    private static function destroyConnection(): void
    {
        self::$dbConnection = null;
        self::$dbStatement = null;
    }

    /**
     * Obtiene la conexión de la base de datos $dbName
     * ejecuta una query $query con parametros $params en ella 
     * y destruye la conexión
     *
     * En caso de error asigna el error y muere el programa
     */
    public static function executeQuery(string $dbName, string $query, array $params): void
    {
        try {
            self::getDBConnection($dbName);
            self::$dbStatement = self::$dbConnection->prepare($query);
            if (self::$dbStatement->execute($params) === false)
                ApiController::exitError("No se pudo ejecutar la consulta en la base de datos");
            self::destroyConnection($dbName);
        } catch (PDOException $error) {
            self::destroyConnection($dbName);
            self::setErrorMessageWithCode($error->getCode(), $error->getMessage());
            ApiController::exitError(self::$dbErrorMessage);
        }
    }

    /**
     * Obtiene la conexión de la base de datos $dbName
     * ejecuta una query $query con parametros $params en ella 
     * obtiene los resultados de la query
     * destruye la conexión
     * y retorna los resultados
     *
     * En caso de error asigna el error y muere el programa
     */
    public static function getQueryData(string $dbName, string $query, ?array $params): ?array
    {
        try {
            self::getDBConnection($dbName);
            self::$dbStatement = self::$dbConnection->prepare($query);
            if (self::$dbStatement->execute($params) === false)
                ApiController::exitError("No se pudo ejecutar la consulta en la base de datos");
            $queryData = self::$dbStatement->fetchAll(PDO::FETCH_ASSOC);
            self::destroyConnection($dbName);
            return $queryData;
        } catch (PDOException $error) {
            self::destroyConnection($dbName);
            self::setErrorMessageWithCode($error->getCode(), $error->getMessage());
            ApiController::exitError(self::$dbErrorMessage);
        }
    }


    // Asigna el mensaje de error en base a un código de error
    private static function setErrorMessageWithCode(mixed $code, string $originalMessage): void
    {
        /** 
         * Mensaje original en caso que sea necesario
         * self::$dbErrorMessage = utf8_encode($originalMessage);
         */
        switch ($code) {
            case '7':
                self::$dbErrorMessage = 'No se pudo conectar a la base de datos';
                break;
            case '42703':
                self::$dbErrorMessage = 'Nombre de campo desconocido';
                break;
            case '23505':
                self::$dbErrorMessage = 'Dato con campo único existente';
                break;
            case '42P01':
                self::$dbErrorMessage = 'Nombre de tabla desconocido';
                break;
            case '23503':
                self::$dbErrorMessage = 'Registro utilizado por otro, no se puede eliminar';
                break;
            default:
                self::$dbErrorMessage = 'Ocurrió un error al conectar con la base de datos';
        }
    }
}
