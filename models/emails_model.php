<?php

class EmailsModel extends AppModel {
    
    public function add($idOpdracht) {
        $data = array(
            'idOpdracht' => $idOpdracht,
            'status'     => '0',
        );
        return $this->_add('web_emails', $data);
    }
    
    public function addGeneric($to, $replyTo, $subject, $content, $settings) {
        
        // Create the email
        $body = $settings['email_template_simple'];
        $body = str_replace('$$CONTENT$$', $content, $body);
        
        // Add the email to autosender
        $data = array(
            'from_name' => $settings['contact_naam'],
            'from'      => $settings['contact_email'],
            'to'        => $to,
            'reply_to'  => $replyTo,
            'subject'   => $subject,
            'htmlBody'  => $body,
            'status'    => '0',
        );
        return $this->_add('web_emails', $data);
        
    }
    
}
