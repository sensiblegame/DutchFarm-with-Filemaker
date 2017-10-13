<?php

class SettingsModel extends AppModel {

    public function find($server) {
        $server = str_replace('.local', '', $server);
        $server = str_replace('dev.', 'www.', $server);
        $server = ($server == 'localhost') ? 'www.postfly.be' : $server;
        $settings = $this->_findOne(
            'web_settings', array('url' => '=' . $server)
        );
        $settings['vat'] = ($server == 'www.postfly.nl') ? 0.21 : 0.21;
        //$settings['vat'] = 0.21;
        return $settings;
    }

}
