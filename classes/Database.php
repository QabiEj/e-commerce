<?php
require_once "vendor/autoload.php";
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->load();

class Database {
    private static $instance = null;
    private $connection = null;

    public function __construct() {
        $this->connection = new mysqli(getenv('MARIADB_HOST'), getenv('MARIADB_USER'), getenv('MARIADB_PASS'), getenv('MARIADB_DB'), getenv('MARIADB_PORT')); 
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self;
        }

        return self::$instance;
    }

    function getConnection() {
        return $this->connection;
    }
}
