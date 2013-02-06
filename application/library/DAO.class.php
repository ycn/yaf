<?php
class DAO extends PDO
{
    private static $instance;

    public function __construct($dsn, $username='', $password='', $driver_options=array()) {
        set_exception_handler(array(__CLASS__, 'exception_handler'));
        parent::__construct($dsn, $username, $password, $driver_options);
        restore_exception_handler();
    }

    public static function exception_handler($exception) {
        die('Uncaught exception: ' . $exception->getMessage());
    }

    public static function instance($dsn=false, $username='', $password='', $driver_options=array()) {
        if (!empty(self::$instance)) {
            return self::$instance;
        }

        self::$instance = new self($dsn, $username, $password, $driver_options);

        return self::$instance;
    }

}
?>