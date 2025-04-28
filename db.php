<?php

class DB
{
    static private $connection;
    const DB_TYPE = "mysql";
    const DB_HOST = "localhost";
    const DB_NAME = "mpp";
    CONST USER_NAME = "root";
    CONST USER_PASSWORD = "";

    static public function getConnection() 
    {
        if (static::$connection == null)
        {
            try
            {
                static::$connection = new PDO(self::DB_TYPE
                .":host=".self::DB_HOST
                .";dbname=".self::DB_NAME,
                self::USER_NAME,
                self::USER_PASSWORD,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_EMULATE_PREPARES => false,
                ]
                );
            } catch (PDOException $e)
            {
                throw new Exception("Connection failed: " . $e->getMessage());
            }
        }
        return static::$connection;
    }
    static public function execute($sql, $data = null)
{
    try {
        $connection = DB::getConnection();
        $statement = $connection->prepare($sql);

        if ($data) {
            $statement->execute($data);
        } else {
            $statement->execute();
        }


        if (stripos($sql, 'INSERT') === 0) {
            return $connection->lastInsertId(); // Return last inserted ID for INSERT
        } elseif (stripos($sql, 'SELECT') === 0) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $statement->rowCount();
        }
    } catch (PDOException $e) {
        error_log("Database error: " . $e->getMessage() . " in query: " . $sql);
        throw $e;
    }
}
}