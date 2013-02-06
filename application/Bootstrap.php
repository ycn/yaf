<?php
include APP_PATH . '/application/library/DAO.class.php';
include APP_PATH . '/application/library/Logger.class.php';

class Bootstrap extends Yaf_Bootstrap_Abstract{

    private $environ;
    private $config;
    private $db;

    public function _initConfig(Yaf_Dispatcher $dispatcher) {
        $app = Yaf_Application::app();
        $this->environ = $app->environ();
        $this->config = $app->getConfig();

        Yaf_Registry::set("environ", $this->environ);
        Yaf_Registry::set("config", $this->config);
    }

    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        $config = new Yaf_Config_Ini(APP_PATH . '/conf/routes.ini');
        if ( isset($config->routes) ) {
            $dispatcher->getRouter()->addConfig($config->routes);
        }
    }

    public function _initDatabase(Yaf_Dispatcher $dispatcher) {
        $db_params = $this->config->db->params;

        $this->db = DAO::instance(
                        $db_params->dsn,
                        $db_params->user,
                        $db_params->password, array(
                            PDO::ATTR_PERSISTENT => $db_params->persistence,
                            PDO::MYSQL_ATTR_INIT_COMMAND => sprintf("SET NAMES '%s'", $db_params->charset)
                        ));

        if ($this->environ == 'product') {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } else {
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        Yaf_Registry::set("db", $this->db);
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher) {

    }    
}