<?php

class FormatsModel extends AppModel {
    
    public function find($subclassId) {
        return $this->_find(
            'web_formats',
            array(
                '_k2_subclassid' => '=' . $subclassId,
                'naam'           => '*',
            ),
            array('sort')
        );
    }
    
}
