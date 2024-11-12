<?php 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
class Database {
    private static $connection;
    public function __construct() {
        self::$connection = new PDO($_ENV['DB_DSN'], $_ENV['DB_USER'], $_ENV['DB_PASS']);
    }

    public static function openLink() {
        return self::$connection;
    }

    public static function closeLink() {
        self::$connection = null; 
    }
}