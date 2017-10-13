<?php

// Shopping Cart controller
class CartController extends AppController {

    // Controller setup
    var $name       = 'Cart';
    var $uses       = array('PromoModel');
    var $helpers    = array('Asset', 'Html', 'Javascript', 'Ajax', 'Form', 'Ogone', 'User', 'Generic');
    var $components = array('RequestHandler', 'Session');

    public function deleteFile() {
        $filePath = dirname(__FILE__) . '/../webroot/jsonfiles/' . $this->params['url']['path'];
        if (file_exists($filePath)) {
            @unlink($filePath);
        }
        die('OK');
    }

    // Show the contents of the shopping cart
    public function show() {

        // Set the page title
        $this->pageTitle = 'Winkelwagen';
        $this->set('page','cart');

        // Unset the promocode
        $promo = $this->Session->read('promo');

        // Check if we have a post request
        if ($this->RequestHandler->isPost()) {

            // Get the form parameters
            $params = $this->params['data'];

            // Check for a promocode in the form data
            if (isset($params['promocode']) && !empty($params['promocode'])) {

                // Validate it and add it to the session
                $promo = $this->PromoModel->find($params['promocode']);

                // Add a message if it's an invalid promo code
                if (!$promo) {
                    $this->set('promocode_error', 'Ongeldige promocode: ' . $params['promocode']);
                }

                // Save it into the session
                $this->Session->write('promo', ($promo) ? $promo : '');

                // Read it from the session
                $promo = $this->Session->read('promo');

            } else {

                // Remove from session
                $this->Session->delete('promo');
                $promo = '';

            }

        }

        // Bereken de totale prijs
        $korting      = 0.00;
        $totaalEx     = 0.00;
        $totaalVat    = 0.00;
        $totaalInc    = 0.00;
        $deliveryDate = '';
        $classes      = array();


        // Prijs excl.
        foreach ($_SESSION['Orders'] as $order) {
            $totaalEx += floatval($order['totaal']);
            $classes[] = $order['class'];
        }

        // Add the files for each order
        foreach ($_SESSION['Orders'] as $key => $order) {

            // Start with no files
            $order['files'] = array();

            // Get the uploaded files for the order
            $filePath = dirname(__FILE__) . '/../webroot/jsonfiles/' .  $order['order_guid'] . '/*.*';
            foreach (glob($filePath) as $file) {
                $order['files'][] = array(
                    'file' => basename($file),
                    'size' => filesize($file),
                    'id'   => md5($file),
                );
            }

            // Add it back to the session
            $_SESSION['Orders'][$key] = $order;

        }

        // Find the delivery date
        if (count($classes) > 0) {
            $deliveryDates = $this->ClassesModel->findDeliveryDates($classes);
            if (count($deliveryDates) > 0) {
                $deliveryDate = strtotime($deliveryDates[0]['planned_afhaaldate_uc']);
            }
        }

        // Bereken de korting via de promocode
        if ($promo) {
            if ($promo['promo_type'] == '%') {
                $korting = $totaalEx * ($promo['promo'] / 100.0);
            } else {
                $korting = floatval($promo['promo']);
            }
            $totaalEx = $totaalEx - $korting;
        }

        // BTW
        $server    = str_replace('.local', '', $_SERVER['SERVER_NAME']);
        $server    = substr($server, strlen($server) - 2);
        $totaalVat = (($server == 'nl') ? 0.21 : 0.21) * $totaalEx;
        //$totaalVat = 0.21 * $totaalEx;

        // Prijs incl.
        $totaalInc = $totaalEx + $totaalVat;

        // Save the total in the session
        $_SESSION['prijs_totaal_ex'] = $totaalEx;
        $_SESSION['prijs_totaal']    = $totaalInc;

        // Add the template variables
        $this->set('promo',        $this->Session->read('promo'));
        $this->set('orders',       $_SESSION['Orders']);
        $this->set('korting',      $korting);
        $this->set('totaal_ex',    $totaalEx);
        $this->set('totaal_vat',   $totaalVat);
        $this->set('totaal_inc',   $totaalInc);
        $this->set('deliveryDate', $deliveryDate);

    }

    // Add an item to the shopping cart
    public function add() {

        // Check if we have a post request
        if ($this->RequestHandler->isPost()) {

            // Get the form parameters
            $params = $this->params['data'];


            // Add the order to the session
            if (isset($params['product_name'])) {

                // Create an empty array
                if (!isset($_SESSION['Order'])) {
                    $_SESSION['Order'] = array();
                }

                if($_SESSION['Order']['formatBannerB'] != '')
                {
                    $newName = $params['product_name'] . ' - ' . $_SESSION['Order']['formatBannerB'] . 'cm x ' . $_SESSION['Order']['formatBannerH'] . 'cm';
                }
                else
                {
                    $newName = $params['product_name'];
                }

                // Complete the order
                $_SESSION['Order'] = array_merge(array(
                    'naam'            => $newName,
                    'prijs'           => $params['prijs_subtotaal'],
                    'afwerkingsprijs' => $params['prijs_afwerking'],
                    'totaal'          => $params['prijs_subtotaal'] + $params['prijs_afwerking'],
                    'levertermijn'    => $params['levertermijn'],
                    'pr_code'         => $params['pr_code'],
                    'aantal'          => $params['aantal'],
                    'opties'          => $params['product_finishing'],
                    'order_guid'      => md5(uniqid(php_uname('n'), true)),
                ), $_SESSION['Order']);


                // Add it to the list of orders
                $_SESSION['Orders'][] = $_SESSION['Order'];

                // Cleanup
                unset($_SESSION['Order']);

            }

        }

        // Show the shopping cart
        $this->redirect(array('action' => 'show'));

    }

    // Delete an item from the cart
    public function delete() {

        // Remove an item from the shopping cart
        $i = intval($this->params['id']);
        unset($_SESSION['Orders'][$i]);

        // Show the shopping cart
        $this->redirect(array('action' => 'show'));

    }

}
