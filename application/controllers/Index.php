<?php
class IndexController extends Yaf_Controller_Abstract {
    public function indexAction() {
        $this->getView()->assign("content", "Welcome");
    }

    public function helloAction() {
        $this->getView()->assign("content", "Hello World");
    }
}
?>