<?php
define("ROOT_URI",  "/yaf");
define("APP_PATH",  dirname(__FILE__));
define("VIEW_PATH",  APP_PATH . "/application/views/");
$app = new Yaf_Application(APP_PATH . "/conf/application.ini");
$app->bootstrap()
    ->run();