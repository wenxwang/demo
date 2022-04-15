<?php
namespace mvc\db;

use PDO;
use PDOException;

/**
 * PDO单例
 */
class Db
{
    private static $pdo = null;

    // 禁止外部实例
    private function __construct()
    {
        return false;
    }

    // 禁止克隆
    private function __clone()
    {
        //
    }

    public static function pdo()
    {
        if (self::$pdo instanceof self) {
            return self::$pdo;
        }

        try {
            $dsn = sprintf('mysql:host=%s;dbname=%s;charset=utf8', DB_HOST, DB_NAME);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC);

            return self::$pdo = new PDO($dsn, DB_USER, DB_PASS, $option);
        } catch (PDOException $e) {
            die($e->getMessage());
        }
    }
}