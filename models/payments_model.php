<?php

class PaymentsModel extends AppModel {
    
    public function add($result, $idOpdracht, $data) {
        $data['_k2_werkbonid'] = $idOpdracht;
        $data['action']        = $result;
        unset($data['url']);
        return $this->_add('web_payments', $data);
    }
   
}
