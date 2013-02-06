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

    public function testDbAction() {
        $params = $this->getRequest()->getParams();
        $username = isset($params['username']) ? $params['username'] : '';

        $result = array();

        if (!empty($username)) {

            $db = Yaf_Registry::get("db");
            $st = $db->prepare("
                    SELECT *
                    FROM user
                    WHERE username=:username
                    ");
            $st->bindParam(':username', $username, PDO::PARAM_STR);
            $st->execute();
            $result = $st->fetch(PDO::FETCH_ASSOC);
            $st->closeCursor();
        }

        header("Content-type: application/json");
        $this->getResponse()->setBody(json_encode($result));
        return False;
    }
}
?>