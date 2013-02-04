<?php
class Bootstrap extends Yaf_Bootstrap_Abstract{

    public function _initConfig(Yaf_Dispatcher $dispatcher) {
        $config = Yaf_Application::app()->getConfig();
        Yaf_Registry::set("config", $config);
    }

    public function _initRoute(Yaf_Dispatcher $dispatcher) {
        $config = new Yaf_Config_Ini(APP_PATH . '/conf/routes.ini');
        if ( isset($config->routes) ) {
            $dispatcher->getRouter()->addConfig($config->routes);
        }
    }

    public function _initPlugin(Yaf_Dispatcher $dispatcher) {

    }
}