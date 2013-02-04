<?php
class IndexController extends Yaf_Controller_Abstract {
    public function indexAction() {
        $json = Yaf_Application::app()->getConfig("application");
        $this->getView()->assign("content", "Welcome");
        $this->getView()->assign("json", json_encode($json));
    }

    public function helloAction() {
        $this->getView()->assign("content", "Hello World");
    }
}
?>