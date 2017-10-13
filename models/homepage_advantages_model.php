<?php

class HomepageAdvantagesModel extends AppModel {
    
    public function findAll($settingsid) {
        return $this->_find(
            'web_homepage_advantages',
            array(
                '_k2_settingsid'  => '=' . $settingsid,
                'advantage_title' => '*',
            ),
            array('advantage_order')
        );
    }
    
}
