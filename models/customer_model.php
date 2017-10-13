<?php

class CustomerModel extends AppModel {
    
    public function checkLogin($login, $password) {
        $result = $this->_findOne(
            'web_login',
            array(
                'email'    => '=="' . $login . '"',
                'paswoord' => empty($password) ? '=' : '=="' . $password . '"',
            )
        );
        return $result;
    }
    
    public function findOne($id) {
        return $this->_findOne(
            'web_klant',
            array(
                'idKlant' => '=' . $id,
            )
        );
    }
    
    public function findByEmail($email) {
        return $this->_findOne(
            'web_klant',
            array(
                'email' => '=="' . $email . '"',
            )
        );
    }
    
    public function findOrders($id) {
        return $this->_find(
            'web_opdrachten_customer',
            array(
                'idKlant'   => $id,
                'idWerkbon' => '*',
            ),
            array(
                '-CreationDate_werkbon',
                '-CreationDate',
            )
        );
    }
    
    public function updateLoginStats($params) {
        $data = array(
            'RECORD_ID'           => $params['RECORD_ID'],
            'login_laatste_datum' => strftime('%m-%d-%Y %H:%M:%S'),
            'login_count'         => $params['login_count'] + 1,
        );
        return $this->_edit('web_klant', $data);
    }
    
    public function edit($params) {
        $data = array(
            'RECORD_ID'           => $params['RECORD_ID'],
            'Klant'               => ($params['customer_type'] == 'Bedrijf') ? $params['company'] : $params['name'],
            'Contactpersoon'      => ($params['customer_type'] == 'Bedrijf') ? $params['name'] : '',
            'straat'               => $params['street'],
            'code'                => $params['postal_code'],
            'plaats'              => $params['city'],
            'email'               => $params['email'],
            'btwnummer'           => $params['vat'],
            'tel'                 => $params['phone'],
            'land'                => $params['country'],
            'bedrijf_jn'          => ($params['customer_type'] == 'Bedrijf') ? 'ja' : 'nee',
            'nieuwsbrief_jn'      => (isset($params['newsletter']) && $params['newsletter'] == 1) ? 'ja' : 'nee',
            'sms_jn'              => (isset($params['sms']) && $params['sms'] == 1 ) ? 'ja' : 'nee',
            'digitale_factuur_jn' => (isset($params['digitale_factuur_jn']) && $params['digitale_factuur_jn'] == 1) ? 'ja' : 'nee',
        );
        if (!empty($params['password'])) {
            $data['paswoord'] = $params['password'];
        }
        return $this->_edit('web_klant', $data);
    }

    public function add($data) {
        $customer = $this->_add(
            'web_klant',
            array(
                'Klant'               => ($data['customer_type'] == 'Bedrijf') ? $data['company'] : $data['name'],
                'Contactpersoon'      => ($data['customer_type'] == 'Bedrijf') ? $data['name'] : '',
                'straat'               => $data['street'],
                'code'                => $data['postal_code'],
                'plaats'              => $data['city'],
                'email'               => $data['email'],
                'btwnummer'           => $data['vat'],
                'tel'                 => $data['phone'],
                'land'                => $data['country'],
                'paswoord'            => $data['password'],
                'bedrijf_jn'          => ($data['customer_type'] == 'Bedrijf') ? 'ja' : 'nee',
                'nieuwsbrief_jn'      => isset($data['newsletter']) && $data['newsletter'] == '1' ? 'ja' : 'nee',
                'sms_jn'              => isset($data['sms']) && $data['newsletter'] == '1' ? 'ja' : 'nee',
                'digitale_factuur_jn' => isset($data['digitale_factuur_jn']) && $data['newsletter'] == '1' ? 'ja' : 'nee',
                'loginstad'           => $data['id_stad'],
            )
        );
        $this->_add(
            'web_adres_levering',
            array(
                'idKlant'      => $customer['idKlant'],
                'idKlantLever' => $customer['idKlant'],
            )
        );
        $this->_add(
            'web_adres_factuur',
            array(
                'idKlant'     => $customer['idKlant'],
                'idKlantFact' => $customer['idKlant'],
            )
        );
        return $customer;
    }
    
    public function addDeliveryAddress($id, $data) {
        $data['idKlant'] = $id;
        return $this->_add(
            'web_adres_levering',
            array(
                'idKlant'        => $data['idKlant'],
                'idKlantLever'   => $data['idKlant'],
                'lever_klant'    => $data['name'],
                'lever_contact'  => $data['contact'],
                'lever_tel'      => $data['phone'],
                'lever_adres'    => $data['street'],
                'lever_postcode' => $data['postal_code'],
                'lever_plaats'   => $data['city'],
                'lever_land'     => $data['country'],
            )
        );
    }
    
    public function addInvoiceAddress($id, $data) {
        $data['idKlant'] = $id;
        return $this->_add(
            'web_adres_factuur',
            array(
                'idKlant'     => $data['idKlant'],
                'idKlantFact' => $data['idKlant'],
                'Klant'       => $data['name'],
                'contact'     => $data['contact'],
                'tel'         => $data['phone'],
                'adres'       => $data['street'],
                'postcode'    => $data['postal_code'],
                'plaats'      => $data['city'],
                'land'        => $data['country'],
                'btwnr'       => $data['vat'],
            )
        );
    }
    
    public function findLeverAdressen($id) {
        return $this->_find(
            'web_adres_levering',
            array(
                'idKlant' => '=' . $id
            ),
            array(
                '-CreationDate',
                '-CreationTime',
                /*'lever_klant',
                'lever_adres',
                'lever_postcode',
                'lever_plaats',
                'lever_land',*/
            )
        );
    }
    
    public function findFactuurAdressen($id) {
        return $this->_find(
            'web_adres_factuur',
            array(
                'idKlant' => '=' . $id
            ),
            array(
                'Klant',
                'adres',
                'postcode',
                'plaats',
                'land',
            )
        );
    }
   
}
