<?php
class TestController extends Yaf_Controller_Abstract {
    public function indexAction() {
        $result = array(
            'a' => 'apple',
            'b' => 'banana',
        );

        header("Content-type: application/json");
        $this->getResponse()->setBody(json_encode($result));
        return False;
    }

    public function helloAction() {
        $result = array(
            'a' => 'apple',
            'b' => 'banana',
        );

        header("Content-type: application/json");
        $this->getResponse()->setBody("console.dir(" . json_encode($result) . ");");
        return False;
    }

    public function testRouterAction() {
        $params = $this->getRequest()->getParams();
        $page = isset($params['page']) ? $params['page'] : 1;
        $size = isset($params['size']) ? $params['size'] : 10;
        
        header("Content-type: application/json");
        $this->getResponse()->setBody("page=".$page.", size=".$size);
        return False;
    }
}
?>