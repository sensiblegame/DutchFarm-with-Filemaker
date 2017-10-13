<?php

class ContactSubmissionsModel extends AppModel {
    
    public function add($data) {
    	$data['source'] = $_SERVER['SERVER_NAME'];
        return $this->_add('web_contact_submissions', $data);
    }
    
}
