<?php

class OgoneHelper extends AppHelper {

    public function submitUrl() {
        if (self::isDevServer()) {
            $url = 'https://secure.ogone.com/ncol/test/orderstandard.asp';
        } else {
            $url = 'https://secure.ogone.com/ncol/prod/orderstandard.asp';
        }
        return $this->output($url);
    }
    
    private static function isDevServer() {
        $server = $_SERVER['SERVER_NAME'];
        return (strpos($server, 'dev.') !== false || strpos($server, '.local') !== false);
    }
    
    public static function getPsID() {
        $server = $_SERVER['SERVER_NAME'];
        return strpos($server, '.be') !== false ? 'matthys' : 'matthys2';
    }
    
    public static function getSecretKey() {
        $server = $_SERVER['SERVER_NAME'];
        if (self::isDevServer()) {
            return (strpos($server, '.be') !== false) ? 'J/RH8a8yb9KJ<EWHXt\\' : 'd§0tk)P0z/jXIsL3oYE';
        } else {
            return (strpos($server, '.be') !== false) ? 'm8tthysBEp0stfly@' : 'm8tthys2NLp0stfly';
        }
    }
    
}
