<?php

class PricesModel extends AppModel {
    
    public function find($formaatid) {
        return $this->_find(
            'web_prices',
            array(
                '_k2_formaatid' => '=' . $formaatid,
                'aantal'        => '*',
                'pr_code'       => '*',
            ),
            array('aantal')
        );
    }
    
}
