<?php
/**
 * databaseとりまとめクラス
 */
class DatabaseConfig {
    /**
     * コンストラクタ
     */
    public function __construct() {
        //require_once '../../../data/config.php';
        define('__ROOT__', dirname(__FILE__));
        define("DSN", "mysql:host=localhost;dbname=badstore2015");
        define("DBUSER", "root");
        //define("DBPASSWORD", DBPASS);
        define("DBPASSWORD", "");
    }
}
