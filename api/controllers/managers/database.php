<?php

// Requiere de los recursos globales
require_once(dirname(__DIR__, 1) . '/config/globals.php');


/**
 * Permite la conexión con la base de datos, 
 * ejecución y obtención de datos de consultas SQL
 */
class DatabaseManager
{
    // Propiedades

    /** Credenciales de la base de datos */
    private static ?array $credential = NULL;

    /** Conexión con la base de datos */
    private static ?PDO $connection = NULL;

    /** Statement de la conexión */
    private static ?PDOStatement $statement = NULL;

    /** Información obtenida de las consultas */
    private static array $data = [];

    /** Mensaje de error en caso exista */
    private static ?string $error = NULL;

    // Getters

    /** @return array Contenido obtenido de las consultas */
    public static function getData(): array
    {
        return self::$data;
    }

    /** @return ?string Mensaje de error en caso exista */
    public static function getError(): ?string
    {
        return self::$error;
    }

    // Métodos

    /** 
     * Obtiene las credenciales de una base de datos
     * 
     * @param string $db Nombre clave de la base de datos
     */
    private static function getCredential(string $db): void
    {
        // Obtiene las credenciales generales de las base de datos
        $credentials = json_decode(
            file_get_contents(__DIR__. '/db_credentials.json'),
            true
        );

        // Obtiene las credenciales de la base de datos dado las credenciales generales
        try {
            self::$credential = $credentials[$db];
        } catch (PDOException $error) {
            // Error si no se pudo obtener las credenciales
            self::$error = 'No se pudo obtener las credenciales de la base de datos ' . $db;
        }
    }

    /**
     * Crea una conexión con una base de datos
     * 
     * @param string $db Nombre clave de la base de datos
     */
    private static function getConnection(string $db): void
    {
        // Obtiene las credenciales de la base de datos
        self::getCredential($db);

        // Caso de error retorna
        if (self::$error) return;

        // Crea la conexión con la base de datos
        try {
            self::$connection = new PDO(
                self::$credential['dsn'],
                self::$credential['username'],
                self::$credential['password'],
            );
        } catch (PDOException $error) {
            // Caso de error no se pudiera crea la conexión
            self::$error = 'No se pudo conectar a la base de datos ' . $db;
        }

        // Destruye los datos de las credenciales
        self::$credential = NULL;
    }

    /** Destruye la conexión con la base de datos */
    private static function destroyConnection(): void
    {
        self::$connection = NULL;
        self::$statement = NULL;
        self::$credential = NULL;
    }

    /**
     * Ejecuta una consulta parametrizada en una base de datos
     * 
     * @param string $db Nombre clave de la base de datos
     * @param string $query Consulta SQL
     * @param ?array $params parametros de la consulta SQL
     */
    public static function executeQuery(string $db, string $query, array $params = []): void
    {
        // Destruye los resultados anteriores
        self::$data = [];
        self::$error = NULL;

        // Obtiene la conexión con la base de datos
        self::getConnection($db);

        // Caso de error retorna
        if (self::$error) return;

        try {
            //Crea el statement por medio de la conexión
            self::$statement = self::$connection->prepare($query);

            // Ejecuta la consulta con los parametros
            if (!self::$statement->execute($params))
                // Caso de error al momento de ejecutar la consulta
                self::$error = 'Sucedió un error al momento de ejecutar la consulta';
        } catch (PDOException $error) {
            self::setErrorMessageWithCode($error->getCode(), $error->getMessage());
        }

        self::destroyConnection();
    }

    /**
     * Ejecuta una consulta parametrizada en una base de datos
     * y obtiene los datos recibidos de la consulta
     * 
     * @param string $db Nombre clave de la base de datos
     * @param string $query Consulta SQL
     * @param ?array $params parametros de la consulta SQL
     */
    public static function executeQueryData(string $db, string $query, ?array $params): void
    {
        // Destruye los resultados anteriores
        self::$data = [];
        self::$error = NULL;

        // Obtiene la conexión con la base de datos
        self::getConnection($db);

        // Caso de error retorna
        if (self::$error) return;

        try {
            //Crea el statement por medio de la conexión
            self::$statement = self::$connection->prepare($query);

            // Ejecuta la consulta con los parametros
            if (self::$statement->execute($params))
                self::$data = self::$statement->fetchAll(PDO::FETCH_ASSOC);
            else self::$error = 'Sucedió un error al momento de ejecutar la consulta';
        } catch (PDOException $error) {
            // 
            self::setErrorMessageWithCode($error->getCode(), $error->getMessage());
        }
    }


    // Asigna el mensaje de error en base a un código de error
    private static function setErrorMessageWithCode(mixed $code, string $originalMessage): void
    {
        /** 
         * Mensaje original en caso que sea necesario
         * self::$error = utf8_encode($originalMessage);
         */
        switch ($code) {
            case '7':
                self::$error = 'No se pudo conectar a la base de datos';
                break;
            case '42703':
                self::$error = 'Nombre de campo desconocido';
                break;
            case '23505':
                self::$error = 'Dato con campo único existente';
                break;
            case '42P01':
                self::$error = 'Nombre de tabla desconocido';
                break;
            case '23503':
                self::$error = 'Registro utilizado por otro, no se puede eliminar';
                break;
            default:
                self::$error = 'Ocurrió un error al conectar con la base de datos';
        }
    }
}
