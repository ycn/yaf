<?php
class Cookie
{
    const Session   = 0;
    const OneDay    = 86400;
    const OneWeek   = 604800;
    const OneMonth  = 2592000;
    const HalfYear  = 15811200;
    const OneYear   = 31536000;

    public static function isEmpty($name) {
        return empty($_COOKIE[$name]);
    }

    public static function get($name, $default='') {
        return isset($_COOKIE[$name]) ?
                                $_COOKIE[$name] :
                                $default;
    }

    public static function set($name, $value, $expire=self::Session, $path='/', $domain=false) {
        $ret = false;

        if (!headers_sent()) {
            if (!$domain) {
                $domain = $_SERVER['HTTP_HOST'];
            }

            if (is_numeric($expire)) {
                if ($expire > 0) {
                    $expire += time();
                } else {
                    $expire = 0;
                }
            } else {
                $expire = strtotime($expire);
            }

            $ret = setcookie($name, $value, $expire, $path, $domain);
            if ($ret) {
                $_COOKIE[$name] = $value;
            }
        }

        return $ret;
    }

    public static function del($name, $path='/', $domain=false) {
        $ret = false;

        if (!headers_sent()) {
            if (!$domain) {
                $domain = $_SERVER['HTTP_HOST'];
            }

            $ret = setcookie($name, '', time() - 3600, $path, $domain);
            if ($ret) {
                unset($_COOKIE[$name]);
            }
        }

        return $ret;
    }

}
?>