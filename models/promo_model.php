<?php

class PromoModel extends AppModel {
    
    public function find($promoCode) {
        return $this->_findOne(
            'web_promo',
            array(
                'promo_code'     => '=' . $promoCode,
                'valid_promo_uc' => '=1',
            )
        );
 	}
   
}