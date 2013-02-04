<?php
class ErrorController extends Yaf_Controller_Abstract {
    public function errorAction($exception) {
        // $exception = $this->getRequest()->getException();
        try {
            throw $exception;
        } catch (Yaf_Exception_LoadFailed $e) {
            header("HTTP/1.0 404 Not Found");
        } catch (Yaf_Exception $e) {
            header("HTTP/1.0 500 Internal Server Error");
        }

        $this->getView()->e = $exception;
        $this->getView()->e_class = get_class($exception);
        $this->getView()->e_string_trace = $exception->getTraceAsString();

        $params = $this->getRequest()->getParams();
        unset($params['exception']);
        $this->getView()->params = array_merge(
            array(),
            $params,
            $this->getRequest()->getPost(),
            $this->getRequest()->getQuery()
        );
    }
}
?>