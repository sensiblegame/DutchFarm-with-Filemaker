<?php

class AssetHelper extends AppHelper {
    
    public $helpers = array('Html');
    
    public function url($record, $field, $forceDownload=false, $filename='file') {
        if (empty($record[$field])) {
            return '';
        }
        $forceDownload = ($forceDownload) ? '1' : '0';
        return $this->Html->url(
            array(
                'controller' => 'assets',
                'action' => 'display',
                $forceDownload . '/' . $record['MODIF_ID'] . '/' . $filename . '/' . $record[$field]
            )
        );
    }
    
    public function image($record, $field, $attributes=array()) {
        return $this->output(
            $this->Html->image(
                array(
                    'controller' => 'assets',
                    'action' => 'display',
                    '0/' . $record['MODIF_ID'] . '/image/' . $record[$field]
                ),
                $attributes
            )
        );
    }
    
    public function bgimage($record, $field, $attributes=array()) {
        return $this->output(
            Router::url(
                array(
                    'controller' => 'assets',
                    'action' => 'display',
                    '0/' . $record['MODIF_ID'] . '/image/' . $record[$field]
                ),
                $attributes
            )
        );
    }    
}
