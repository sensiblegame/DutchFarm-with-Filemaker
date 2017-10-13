<?php

class FinishingModel extends AppModel {
    
    public function find($prijsid) {
        return $this->_find(
            'web_finishing',
            array(
                '_k2_prijsid' => '=' . $prijsid,
                'naam'        => '*',
            ),
            array('sort')
        );
    }
    
}
