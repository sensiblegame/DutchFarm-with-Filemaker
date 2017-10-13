<?php

class UserHelper extends AppHelper {

    public function isLoggedIn() {
        return isset($_SESSION['LoginSession']);
    }
    
    public function hasOrders() {
        return $this->orderCount() > 0;
    }
    
    public function orderCount() {
        if (!isset($_SESSION['Orders'])) {
            return 0;
        }
        return count($_SESSION['Orders']);
    }

}
