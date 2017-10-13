<?php

class SubclassesModel extends AppModel {
    
    public function find($classId) {
        return $this->_find(
            'web_subclasses',
            array(
                '_k2_classid' => '=' . $classId,
                'naam'        => '*',
            ),
            array('sort')
        );
    }

    public function getDeliveryInfo($subclassid) {
        return $this->_find(
            'web_subclasses_delivery',
            array(
                '_k1_subclassid' => '=' . $subclassid,
            )
        );
    }
    
    public function findOne($subclassId) {
        return $this->_findOne(
            'web_subclasses',
            array(
                '_k1_subclassid' => '=' . $subclassId,
                'naam'        => '*',
            )
        );

    }
    
}
