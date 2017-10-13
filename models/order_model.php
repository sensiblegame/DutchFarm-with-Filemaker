<?php

class OrderModel extends AppModel {

    public function findOrder($orderId) {
        return $this->_findOne(
            'web_opdrachten',
            array(
                'idOpdracht' => $orderId,
            )
        );
    }

    public function findOrderLines($orderId) {
        return $this->_find(
            'web_opdrachten_lines',
            array(
                'idOpdracht' => $orderId,
            )
        );
    }

    public function findWeeklyOrder($customerId) {
        return $this->_findOne(
            'web_opdrachten',
            array(
                'idKlant'                                     => $customerId,
                'idFactuur'                                   => '=',
                'web_opdrachten_klant::wekelijkse_factuur_jn' => '=ja',
                'status'                                      => '=ontvangen',
            ),
            array(
                '-CreationDate',
            )
        );
    }

    public function add($data, $settings) {

        // Calculate the extra costs
        $extra_costs = 0;
        if ($data['betalingType'] == 'Online') {
            $extra_costs += floatval(str_replace(',', '.', $settings['prijs_online_betaling']));
        }
        if ($data['betalingType'] == 'Rembours') {
            //$extra_costs += floatval(str_replace(',', '.', $settings['prijs_rembours']));
            $extra_costs += floatval((floatval($settings['prijs_rembours']) / 100) * $_SESSION['prijs_totaal']);
        }

        // Mark the promocode as used if it's not a multi one
        if (isset($data['promo']) && $data['promo']) {
            $promo = $data['promo'];
            if ($promo['is_multi'] != '1') {
                $this->_edit(
                    'web_promo',
                    array(
                        'RECORD_ID' => $promo['RECORD_ID'],
                        'is_active' => ''
                    )
                );
            }
        }

        // Add the order and return it
        return $this->_add(
            'web_opdrachten',
            array(
                'loginstad'            => $data['id_stad'],
                'idKlant'              => $data["LoginSession"]['customerid'],
                'CreationDate_werkbon' => strftime('%m-%d-%Y'),
                'CreationTime_werkbon' => strftime('%H:%M'),
                'idKlant_Fact'         => $data['invoiceId'],
                'idKlant_Lever'        => $data['deliveryId'],
                'Ontvangen'            => $this->getShortServerName(),
                'betaling'             => $data['betalingType'],
                'promo_code'           => isset($data['promo']) ? $data['promo']['promo_code'] : '',
                'levering'             => $data['delivery_method'] == 'afhalen' ? $settings['prijs_afhaling'] : $settings['prijs_levering'],
                'LeverHoe'             => $data['delivery_method'] == 'afhalen' ? 'Wordt opgehaald' : 'Levering',
                'is_from_website'      => 1,
                'extra_kosten'         => str_replace(',', '.', $extra_costs),
                'neutraal_verpakt'     => $data['neutraal_verpakt'],
                'Opmerkingen'          => $data['tmp']['opmerkingen'],
            )
        );

    }

    // Add an order line
    public function addOrderLine($order, $orderline) {
        return $this->_add(
            'web_opdrachten_lines',
            array(
                'idOpdracht'             => $order['idOpdracht'],
                'prijs_afwerking'        => $orderline['afwerkingsprijs'],
                'pr_code'                => $orderline['pr_code'],
                'aantal'                 => $orderline['aantal'],
                'afwerking'              => $orderline['opties'],
                'benoem'                 => $orderline['naam'],
                'prijs_zonder_afwerking' => $orderline['prijs'],
                'levertermijn'           => $orderline['levertermijn'],
            )
        );
    }

    // Update an order
    public function edit($order) {
        return $this->_edit('web_opdrachten', $order);
    }

    // Get the short server name
    private function getShortServerName() {
        $server = $_SERVER['SERVER_NAME'];
        $server = str_replace('.local', '', $server);
        $server = str_replace('dev.', '', $server);
        $server = str_replace('www.', '', $server);
        return $server;
    }

}
