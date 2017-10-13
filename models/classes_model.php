<?php

class ClassesModel extends AppModel {
    
    public function find() {
        return $this->_find(
            'web_classes',
            array('naam' => '*'),
            array('sort')
        );
    }
    
    public function findProduct($slug) {
    	$result = $this->_find(
            'web_classes',
            array('slug' => $slug),
            array('sort')
        );
        return $result[0];
    }
    
    public function findRandom() {
        return $this->_findRandom(
            'web_classes',
            array()
        );
    }
    
    public function findDeliveryDates($classes) {
        $layout = 'web_classes';
        $conn = $this->_getConnection();
        $cmd  = $conn->newCompoundFindCommand($layout);
        foreach ($classes as $i => $class) {
            $req = $conn->newFindRequest($layout);
            $req->addFindCriterion('_k1_classid', $class);
            $cmd->add($i+1, $req);
        }
        $cmd->addSortRule('planned_afhaaldate_uc', 1, FILEMAKER_SORT_DESCEND);
        $result = $cmd->execute();
        return $this->_processResult($result);
    }
    
}
