<?php

// Import the ogone stuff
App::import('vendor', 'ogone');

// Order controller
class OrderController extends AppController {

    // Setup the controller
    var $name       = 'Order';
    var $uses       = array('CustomerModel', 'SubclassesModel', 'FormatsModel', 'PricesModel', 'FinishingModel', 'OrderModel', 'PaymentsModel', 'NewsModel', 'PromoModel', 'EmailsModel', 'HomepageAdvantagesModel');
    var $helpers    = array('Asset', 'Html', 'Javascript', 'Ajax', 'Form', 'Ogone', 'User');
    var $components = array('RequestHandler', 'Session');

    // Default page
    public function home() {

        // Get a random news image
        //$newsItem = $this->NewsModel->findRandomImage($_SERVER['SERVER_NAME']);

        // Get the advantages
        $advantages = $this->HomepageAdvantagesModel->findAll($this->settings['_k1_settingsid']);

        // Set the page parameters
        $this->set('page','home');
        $this->set('randomNews', $newsItem);
        $this->set('advantages', $advantages);
        $this->pageTitle = 'Snel bestel service';

    }

    public function landing($slug) {

    	$class = $this->ClassesModel->findProduct($slug);

    	$this->set('landingItem', $class);
    	$this->set('page', 'home');

    	$this->pageTitle = $class['pagetitle'];


    	$this->render('home');

    }

    // Confirm the order
    public function confirm() {

        // Set the page title
        $this->pageTitle = 'Bestelling afronden';

        // Check if the user is logged in
        if (!isset($_SESSION['LoginSession'])) {
            $_SESSION['in_confirm'] = true;
            $this->redirect('/login');
        }

        // Reset the flag in the session
        unset($_SESSION['in_confirm']);

        // Get the customer id and details
        $custId   = $_SESSION['LoginSession']['customerid'];
        $customer = $this->CustomerModel->findOne($custId);

        // Get the delivery addresses
        $deliveryAddresses = $this->CustomerModel->findLeverAdressen($custId);
        $invoiceAddresses  = $this->CustomerModel->findFactuurAdressen($custId);

        // Special handling for the delivery id
        if (isset($this->params['url']['delivery'])) {
            $this->set('deliveryId', $this->params['url']['delivery']);
            $_POST['deliveryId'] = $this->params['url']['delivery'];
        } else {
            $this->set('deliveryId', '');
        }

        // TODO: calculate the rembours
        if ($customer['rembours_jn'] == 'ja') {
            if (!empty($this->settings['prijs_rembours'])) {
                $priceRembours = (floatval($this->settings['prijs_rembours']) / 100) * $_SESSION['prijs_totaal'];
                $this->set('priceRembours', number_format($priceRembours, 2,',','.'));
            } else {
                $this->set('priceRembours', '');
            }
        } else {
            $this->set('priceRembours', '');
        }


        // Special handling for the invoice id
        if (isset($this->params['url']['invoice'])) {
            $this->set('invoiceId', $this->params['url']['invoice']);
            $_POST['invoiceId'] = $this->params['url']['invoice'];
        } else {
            $this->set('invoiceId', '');
        }


        // Save the remarks to the order
        $_SESSION['tmp']['opmerkingen'] =  $this->data['opmerkingen'];

        // Add the variables to the template
        $this->set('customer', $customer);
        $this->set('deliveryAddresses', $deliveryAddresses);
        $this->set('invoiceAddresses', $invoiceAddresses);

    }

    public function redirectHome() {

        // Save the remarks to the order
        $_SESSION['tmp']['opmerkingen'] =  $this->data['opmerkingen'];

         $this->redirect('/');

    }

    // Create the order
    public function create() {

    	// Get the order data
        $params = array_merge($_SESSION, $this->params['form']);
        $params['id_stad'] = $this->settings['id_stad'];

        // Update the value for neutraal verpakt
        if ($this->params['data']['neutraal_verpakt'] == '1') {
            $params['neutraal_verpakt'] = 'ja';
        } else {
            $params['neutraal_verpakt'] = 'nee';
        }

        // Check if there is an order for the customer from this week if asked for
        $order = false;
        if ($params['betalingType'] == 'WekelijkseFactuur') {
            $order = $this->OrderModel->findWeeklyOrder($params["LoginSession"]['customerid']);
        }

        // No order yet, create one, else append to it
        if (!$order) {
            $order = $this->OrderModel->add($params, $this->settings);
        // } else {

        //     // TODO: add opmerkingen indien wekelijkse factuur
        //     // Stap 0: var_dump($params);
        //     // Stap 1: $order['Opmerkingen'] .= "\n" . $params['opmerkingen'];
        //     // Stap 2: $this->OrderModel->edit($order);

        }
        $_SESSION['OrderFM'] = $order;

        // Add the order lines
        foreach ($_SESSION['Orders'] as $key => $orderline) {
            $orderline = $this->OrderModel->addOrderLine($order, $orderline);
            $_SESSION['Orders'][$key] = array_merge($_SESSION['Orders'][$key], $orderline);
        }

        // Save the order id in the session
        $_SESSION['orderId']      = $order['idOpdracht'];
        $_SESSION['orderWerkbon'] = $order['_idWerkbon'];

        // Add the delivery costs
        $price = $_SESSION['prijs_totaal_ex'];
        if ($params['betalingType'] == 'Online') {
            $price += floatval(str_replace(',', '.', $this->settings['prijs_online_betaling']));
        }
        if ($params['delivery_method'] == 'afhalen') {
            $price += floatval(str_replace(',', '.', $this->settings['prijs_afhaling']));
        } else {
            $price += floatval(str_replace(',', '.', $this->settings['prijs_levering']));
        }
        if ($params['betalingType'] == 'Rembours') {
            // TODO: should be a percentage
            //$price += floatval(str_replace(',', '.', $this->settings['prijs_rembours']));
            $price += (floatval($this->settings['prijs_rembours']) / 100) * $_SESSION['prijs_totaal'];
        }

        // Add the VAT
        $server = str_replace('.local', '', $_SERVER['SERVER_NAME']);
        $server = substr($server, strlen($server) - 2);
        $price  = (($server == 'nl') ? 1.21 : 1.21) * $price;
        //$price  = 1.21 * $price;

        // Check the type of payment that needs to be performed
        if ($params['betalingType'] == 'Online') {

            // Load the helpers
            App::import('Helper', 'Ogone');

            // Create the list of ogone parameters
            $ogoneParams = array(
                'PSPID'          => OgoneHelper::getPsID(),
                'orderID'        => $order['_idWerkbon'],
                'amount'         => round($price * 100, 0),
                'currency'       => 'EUR',
                'language'       => 'nl_NL',
                'CN'             => $order['web_opdrachten_klant::Klant'],
                'EMAIL'          => $order['web_opdrachten_klant::email'],
                'ownerZIP'       => $order['web_opdrachten_klant::code'],
                'owneraddress'   => $order['web_opdrachten_klant::adres'],
                'ownercty'       => $order['web_opdrachten_klant::land'],
                'ownertown'      => $order['web_opdrachten_klant::plaats'],
                'ownertelno'     => $order['web_opdrachten_klant::tel'],
                'TITLE'          => 'Postfly order ' . $order['_idWerkbon'],
                'BGCOLOR'        => '',
                'TXTCOLOR'       => '',
                'TBLBGCOLOR'     => '',
                'TBLTXTCOLOR'    => '',
                'BUTTONBGCOLOR'  => '',
                'BUTTONTXTCOLOR' => '',
                'LOGO'           => '',
                'FONTTYPE'       => '',
                'accepturl'      => Router::url(array('action' => 'finish', 'result' => 'accept'), true),
                'declineurl'     => Router::url(array('action' => 'finish', 'result' => 'decline'), true),
                'exceptionurl'   => Router::url(array('action' => 'finish', 'result' => 'exception'), true),
                'cancelurl'      => Router::url(array('action' => 'finish', 'result' => 'cancel'), true)
            );
            $ogoneParams['SHASign'] = Ogone::SHASign(
                OgoneHelper::getSecretKey(), $ogoneParams
            );

            // Add them to the template
            $this->layout = null;
            $this->set('params', $ogoneParams);

        } else {

            // Add a dummy payment record
            $this->PaymentsModel->add(
                '',
                $order['idOpdracht'],
                array(
                    'PM'     => $params['betalingType'],
                    'IP'     => $_SERVER['REMOTE_ADDR'],
                )
            );

            // Order finished
            $this->redirect('/order/done');

            // // Go straight to the upload page
            // $this->redirect('/order/uploaden');

        }

    }

    // Return from ogone
    public function finish() {

        // Get the customer id and details
        $custId   = $_SESSION['LoginSession']['customerid'];
        $customer = $this->CustomerModel->findOne($custId);

        // Make sure we have a customer
        if (!$customer || count($_SESSION['Orders']) == 0) {
            $this->redirect('/');
        }

        // Get the result from the url
        $result = $this->params['result'];
        if ($result != 'accept' && $result != '') {
            $this->params['url']['amount'] = '0';
        }

        // Save the payment details in the database
        $this->PaymentsModel->add(
            $result, $_SESSION['orderId'], $this->params['url']
        );

        // If success, redirect to the file upload
        if ($result == 'accept' || $result == '') {
            //$this->redirect('/order/uploaden');
            $this->redirect('/order/done');
        } else {
            $_SESSION = array('LoginSession' => $_SESSION['LoginSession']);
        }

        // Add the template variables
        $this->set('result',   $result);
        $this->set('customer', $customer);

    }

    /*
    public function uploaden() {

        // Check that the user is logged in
        if (!isset($_SESSION['LoginSession']) || count($_SESSION['Orders']) == 0) {
            $this->redirect('/');
        }

        // Send the email
        if (!isset($_SESSION['OrderEmailSend'])) {
            $this->EmailsModel->add($_SESSION['OrderFM']['idOpdracht']);
            $_SESSION['OrderEmailSend'] = 1;
        }

        // Set the page title
        $this->pageTitle = 'Bestanden uploaden';

        // Get the customer id and details
        $custId   = $_SESSION['LoginSession']['customerid'];
        $customer = $this->CustomerModel->findOne($custId);

        // Add the variables to the template
        $this->set('customer', $customer);

    }
    */

    public function done() {

        // Check that the user is logged in
        if (!isset($_SESSION['LoginSession'])) {
            $this->redirect('/');
        }

        // Save the remarks to the order
        if (!empty($_SESSION['tmp']['opmerkingen'])) {

            // Append the opmerkingen
            $order       = $_SESSION['OrderFM'];
            //$opmerkingen = $order['Opmerkingen'] . "\r\n\r\n" . $_SESSION['tmp']['opmerkingen'];
            $opmerkingen =  str_replace(array("\r\n", "\r", "\n"), "\r\n", $order['Opmerkingen']) . "\r\n \r\n" . $_SESSION['tmp']['opmerkingen'];

            // Update the record in FileMaker
            $order = $this->OrderModel->edit(array(
                'RECORD_ID'   => $order['RECORD_ID'],
                'Opmerkingen' => trim($opmerkingen),
            ));
            $_SESSION['tmp']['opmerkingen'] = '';

        };



        // Send the email
        if (!isset($_SESSION['OrderEmailSend'])) {
            $this->EmailsModel->add($_SESSION['OrderFM']['idOpdracht']);
            $_SESSION['OrderEmailSend'] = 1;
        }




        // Get the customer details
        $custId   = $_SESSION['LoginSession']['customerid'];
        $customer = $this->CustomerModel->findOne($custId);

        // Move the orders from the jsonfiles folder to the files folder
        foreach ($_SESSION['Orders'] as $order) {

            // Get the source and destination paths
            $src = dirname(__FILE__) . '/../webroot/jsonfiles/' . $order['order_guid'];
            $dst = dirname(__FILE__) . '/../webroot/files/' . $order['idLine'];
			$dst = '/Library/WebServer/postfly/app/webroot/files/' . $order['idLine'];

            // Move the directory
            rename($src, $dst);
            chmod($dst, 0777);


            // Generate the XML file
            $xml = '<?xml version="1.0"?>'
                    .'<JobData '
                    .'StadID="' . $this->settings['id_stad'] . '" '
                    .'JobID="' . $order['idLine'] . '" '
                    .'ClientID="' . $_SESSION['OrderFM']['idKlant'] . '" '
                    .'Name="' . $_SESSION['OrderFM']['web_opdrachten_klant::Klant']  . '" '
                    .'Description="' . $order['Fullartikel'].' : ' . $order['naam'] . '" '
                    .'Class="'. $order['web_opdrachten_lines_prijs_formaat_subclass_class::naam'] .'" '
                    .'Subclass="'. $order['web_opdrachten_lines_prijs_formaat_subclass::naam'] .'" '
                    .'Pages="'. '' .'" '
                    .'ArticleID="'.$order['idArtikel'].'" '
                    .'Price="'.$order['prijs_met_afwerking'].'" '
                    .'Format="'.$order['web_opdrachten_lines_prijs_formaat::naam'].'" '
                    .'Recto="'.''.'" '
                    .'Verso="'.''.'" '
                    .'Quantity="'.$order['aantal'].'" '
                    .'Width="'.$order['web_opdrachten_lines_prijs_formaat::breedte'].'" '
                    .'Height="'.$order['web_opdrachten_lines_prijs_formaat::hoogte'].'" '
                    .'Weight="'.$order['web_opdrachten_lines_prijs_formaat_subclass::grammage'].'" '
                    .'Finish1="' . $order['afwerking'] . '" '
                    .'Levering="'.$_SESSION['OrderFM']['levering'].'" '
                    .'Logo="" />';

            // Save the XML file
            $path = '/Library/WebServer/postfly/app/webroot/files/' . $order['idLine'] . '.xml';
            //$path = dirname(__FILE__) . '/../webroot/files/' . $order['idLine'] . '.xml';
            file_put_contents($path, $xml);
            chmod($path, 0777);

        }

        // Add the template variables
        $this->set('bestelling', $_SESSION['orderWerkbon']);
        $this->set('customer', $customer);

        // Reset the session
        $_SESSION = array(
            'LoginSession' => $_SESSION['LoginSession'],
            'Orders'       => array(),
            'orderWerkbon' => '',
        );

        // Set the page title
        $this->pageTitle = 'Bedankt voor uw bestelling';

    }

}
