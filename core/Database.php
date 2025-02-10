<?php
namespace Core;

use PDO;
use PDOException;

class Database
{
    private static $instance = null;
    private static $connection;

    public static function connect($config)
    {
        if (self::$instance === null) {
            try {
                self::$connection = new PDO(
                    "pgsql:host={$config['db_host']};port={$config['db_port']};dbname={$config['db_name']}",
                    $config['db_user'],
                    $config['db_pass'],
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
                self::$instance = new self();
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }
        return self::$instance;
    }

    public static function getConnection()
    {
        if (!self::$connection) {
            throw new \Exception("Database connection is not established. Call connect() first.");
        }
        return self::$connection;
    }
}
?>
