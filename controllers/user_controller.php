<?php

// User controller
class UserController extends AppController {
    
    // Controller setup
	var $name       = 'User';
	var $uses       = array('CustomerModel', 'EmailsModel', 'OrderModel');
	var $helpers    = array('Asset', 'Html', 'Javascript', 'Form', 'User', 'Generic');
	var $components = array('RequestHandler', 'Session');
    
    
    // Used to login a customer
    public function login() {
	    
	    // Set the title
	    $this->pageTitle = 'Inloggen';
	    
	    // Check if there is a post request
	    if ($this->RequestHandler->isPost()) {
	        
	        // Check the login
	        $result = $this->CustomerModel->checkLogin(
	            $this->data['Email'], $this->data['Wachtwoord']
	        );
	        
	        // Check if the login is valid
	        if ($result != false) {
                
                // Update the login stats
                $this->CustomerModel->updateLoginStats($result);
                
                // Setup the session
                $this->setupSession($result);

            } else {
                
                // Something went wrong, add an error
                $this->set('error', 'Ongeldige login');
                
            }
	        
	    }
		
	}
	
	// Resend a lost password
	public function lostpassword() {
	    
	    // Set the title
	    $this->pageTitle = 'Wachtwoord vergeten';
	    
	    // Check if there is a post request
	    if ($this->RequestHandler->isPost()) {
	        
	        // Check the login
	        $result = $this->CustomerModel->findByEmail($this->data['Email']);
	        
	        // Check if the login is valid
	        if ($result != false) {
                
                // Add record to web_emails
                $this->EmailsModel->addGeneric(
                    $this->data['Email'],
                    $this->data['Email'],
                    'Uw wachtwoord voor ' . $this->settings['url'],
                    '<p>Beste klant</p><p>Hierbij uw inloggegevens voor <a href="http://' . $this->settings['url'] . '/login">' . $this->settings['url'] . '</a></p><p>Login: ' . $result['email'] . '<br/>Paswoord: ' . $result['paswoord'] . '</p>',
                    $this->settings
                );
                
                // Email was send
                $this->set('result', true);
                
            } else {
                
                // Something went wrong, add an error
                $this->set('error', 'Login werd niet gevonden');
                
            }
	        
	    }
	    
	}
	
	// Show the list of order for a user
	public function orders() {

	    // Only when you are logged in
	    if (!isset($_SESSION['LoginSession'])) {
	        $this->redirect('/');
	    }
        if (!isset($_SESSION['LoginSession']['customerid'])) {
            $this->redirect('/');
        }
        $customerId = $_SESSION['LoginSession']['customerid'];
	    $customer   = $this->CustomerModel->findOne($customerId);
	    
	    // Set the title
	    $this->pageTitle = 'Mijn bestellingen';
	    
	    // Get the list of orders
	    $orders = $this->CustomerModel->findOrders($customerId);

	    // Add it to the template
	    
	    $this->set('orders', $orders);
	    $this->set('customer', $customer);
	    
	}
	
	public function order() {
	    
	    // Get the id for the order
	    $id = $this->params['id'];
	    
        // Get the details for the order
        $order      = $this->OrderModel->findOrder($id);
        $orderLines = $this->OrderModel->findOrderLines($id);
        
        // Redirect when no valid order
        if (!$order || !$orderLines || count($orderLines) == 0) {
            $this->redirect('/user/orders');
        }
                
        // Add them to the template
        $this->pageTitle = 'Bestelling';
        $this->set('order', $order);
        $this->set('orderLines', $orderLines);
	    
	}
	
	// Used to perform a logout
	public function logout() {
	    
	    // Clear the session
	    unset($_SESSION['LoginSession']);
		
		// Redirect to the homepage
		$this->redirect("/");
	    
	}

	// Add a new user
	public function add() {
	    
	    // Set the title
	    $this->pageTitle = 'Ik ben nieuw';
	    
	    // Start with no customer type
	    $this->set('customerType', '');
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {

            // Add the login stad to the parameters
            $params = $this->params['data'];
            $params['id_stad'] = $this->settings['id_stad'];

            // Validate the form
            $errors    = array();
            $validator = Validation::getInstance();
            if (empty($params['email'])) {
                $errors[] = 'Email is een verplicht veld';
            } else {
                if (!$validator->email($params['email'])) {
                    $errors[] = 'Email is geen correct email adres';
                }
                if ($this->CustomerModel->findByEmail($params['email']) !== false) {
                    $errors[] = 'Er is al een gebruiker met dit email adres. Gelieve een ander email adres te kiezen';
                }
            }
            if (empty($params['password'])) {
                $errors[] = 'Wachtwoord is een verplicht veld';
            }
            if (empty($params['customer_type'])) {
                $errors[] = 'Soort klant is een verplicht veld';
            }
            if ($params['customer_type'] == 'Bedrijf') {
                if (empty($params['tav'])) {
                    $errors[] = 'T.a.v. is een verplicht veld';
                }
                if (empty($params['company'])) {
                    $errors[] = 'Bedrijf is een verplicht veld';
                }
            }
            if (empty($params['name'])) {
                $errors[] = 'Naam is een verplicht veld';
            }
            if (empty($params['phone'])) {
                $errors[] = 'Telefoon is een verplicht veld';
            }
            if (empty($params['street'])) {
                $errors[] = 'Straat is een verplicht veld';
            }
            if (empty($params['postal_code'])) {
                $errors[] = 'Postcode is een verplicht veld';
            }
            if (empty($params['country'])) {
                $errors[] = 'Land is een verplicht veld';
            }
            
            // Check for errors
            if (count($errors) > 0) {
                
                // Add the errors to the template
                $this->set('error', implode('<br/>', $errors));
                
            } else {
                
                // Add the customer to the database
                $result = $this->CustomerModel->add($params);
            
                // Add the login data to the session
                if ($result) {
                
                    // Setup the session
                    $this->setupSession($result);

                } else {
                
                    // Something went wrong, add an error
                    $this->set('error', 'Er ging iets verkeerd');
                
                }
            
            }
            
            // Remember the customer type
            $this->set('customerType', $params['customer_type']);
            
        }
	    
	}

	// Update a user
	public function update() {
	    
	    // Set the title
	    $this->pageTitle = 'Profiel Aanpassen';

        // Get the customer id
        if (!isset($_SESSION['LoginSession'])) {
            $this->redirect('/');
        }
        if (!isset($_SESSION['LoginSession']['customerid'])) {
            $this->redirect('/');
        }
        $customerId = $_SESSION['LoginSession']['customerid'];
	    $customer   = $this->CustomerModel->findOne($customerId);
	    
	    // Start with no customer type
	    $this->set('customerType', '');
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {

            // Add the login stad to the parameters
            $params = $this->params['data'];
            $params['id_stad'] = $this->settings['id_stad'];

            // Validate the form
            $errors    = array();
            $validator = Validation::getInstance();
            if (empty($params['email'])) {
                $errors[] = 'Email is een verplicht veld';
            } else {
                if (!$validator->email($params['email'])) {
                    $errors[] = 'Email is geen correct email adres';
                }
            }
            if (empty($params['customer_type'])) {
                $errors[] = 'Soort klant is een verplicht veld';
            }
            if ($params['customer_type'] == 'Bedrijf') {
                if (empty($params['company'])) {
                    $errors[] = 'Bedrijf is een verplicht veld';
                }
            }
            if (empty($params['name'])) {
                $errors[] = 'Naam is een verplicht veld';
            }
            if (empty($params['phone'])) {
                $errors[] = 'Telefoon is een verplicht veld';
            }
            if (empty($params['street'])) {
                $errors[] = 'Straat is een verplicht veld';
            }
            if (empty($params['postal_code'])) {
                $errors[] = 'Postcode is een verplicht veld';
            }
            if (empty($params['country'])) {
                $errors[] = 'Land is een verplicht veld';
            }
            
            // Check for errors
            if (count($errors) > 0) {
                
                // Add the errors to the template
                $this->set('error', implode('<br/>', $errors));
                
            } else {


                // Add the customer to the database
                $params['RECORD_ID'] = $customer['RECORD_ID'];
                $result = $this->CustomerModel->edit($params);
            
                // Add the login data to the session
                if ($result) {
                
                    // Something went wrong, add an error
                    $this->set('error', 'Uw profiel is aangepast');

                } else {
                
                    // Something went wrong, add an error
                    $this->set('error', 'Er ging iets verkeerd');
                
                }
            
            }
            
            // Remember the customer type
            $this->set('customerType', $params['customer_type']);
                        
        } else {
        
            // Load the default user details
            $this->data = array(
                'email'               => $customer['email'],
                'password'            => $customer['paswoord'],
                'customer_type'       => ($customer['bedrijf_jn'] == 'ja') ? 'Bedrijf' : 'Particulier',
                'company'             => $customer['Klant'],
                'vat'                 => $customer['btwnummer'],
                'name'                => ($customer['bedrijf_jn'] == 'ja') ? $customer['Contactpersoon'] : $customer['Klant'],
                'phone'               => $customer['tel'],
                'street'              => $customer['straat'],
                'postal_code'         => $customer['code'],
                'city'                => $customer['plaats'],
                'country'             => $customer['land'],
                'digitale_factuur_jn' => ($customer['digitale_factuur_jn'] == 'ja') ? '1' : '',
                'newsletter'          => ($customer['nieuwsbrief_jn'] == 'ja') ? '1' : '',
                'sms'                 => ($customer['sms_jn'] == 'ja') ? '1' : '',
            );
            $this->set('customerType', $this->data['customer_type']);

        }
        
	    
	}
	
	// Add a new delivery address
	public function deliveryaddress() {
	    
	    // Set the page title
	    $this->pageTitle = 'Nieuw leveradres';

        // Get the customer id
        if (!isset($_SESSION['LoginSession'])) {
            $this->redirect('/');
        }
        if (!isset($_SESSION['LoginSession']['customerid'])) {
            $this->redirect('/');
        }
        $customerId = $_SESSION['LoginSession']['customerid'];
	    $customer   = $this->CustomerModel->findOne($customerId);
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {

            // If the user cancelled, go back to the order/confirm page
            if (isset($this->params['form']['button']) && $this->params['form']['button'] == 'Annuleer') {
                $this->redirect('/order/confirm');
            }

            // Add the login stad to the parameters
            $params = $this->params['data'];
            
            // Validate the form
            $errors    = array();
            $validator = Validation::getInstance();
            if (empty($params['name'])) {
                $errors[] = 'Naam is een verplicht veld';
            }
            if (empty($params['street'])) {
                $errors[] = 'Straat is een verplicht veld';
            }
            if (empty($params['postal_code'])) {
                $errors[] = 'Postcode is een verplicht veld';
            }
            if (empty($params['city'])) {
                $errors[] = 'Plaats is een verplicht veld';
            }
            if (empty($params['country'])) {
                $errors[] = 'Land is een verplicht veld';
            }
            
            // Check for errors
            if (count($errors) > 0) {
                
                // Add the errors to the template
                $this->set('error', implode('<br/>', $errors));
                
            } else {

                // Add the customer to the database
                $result = $this->CustomerModel->addDeliveryAddress($customerId, $params);
                
                // Go back to the confirm screen
                if ($result) {
                    $this->redirect('/order/confirm?delivery=' . $result['idLevering']);
                } else {
                    $this->set('error', 'Er ging iets verkeerd');
                }
            
            }

        }
        
        // Add the variables to the template
        $this->set('customer', $customer);

	}
	
	// Add a new invoice address
	public function invoiceaddress() {
	    
	    // Set the page title
	    $this->pageTitle = 'Nieuw facturatieadres';

        // Get the customer id
        if (!isset($_SESSION['LoginSession'])) {
            $this->redirect('/');
        }
        if (!isset($_SESSION['LoginSession']['customerid'])) {
            $this->redirect('/');
        }
        $customerId = $_SESSION['LoginSession']['customerid'];
	    $customer   = $this->CustomerModel->findOne($customerId);
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {

            // If the user cancelled, go back to the order/confirm page
            if (isset($this->params['form']['button']) && $this->params['form']['button'] == 'Annuleer') {
                $this->redirect('/order/confirm');
            }

            // Add the login stad to the parameters
            $params = $this->params['data'];
            
            // Validate the form
            $errors    = array();
            $validator = Validation::getInstance();
            if (empty($params['name'])) {
                $errors[] = 'Naam is een verplicht veld';
            }
            if (empty($params['street'])) {
                $errors[] = 'Straat is een verplicht veld';
            }
            if (empty($params['postal_code'])) {
                $errors[] = 'Postcode is een verplicht veld';
            }
            if (empty($params['city'])) {
                $errors[] = 'Plaats is een verplicht veld';
            }
            if (empty($params['country'])) {
                $errors[] = 'Land is een verplicht veld';
            }
            if (empty($params['vat'])) {
                $errors[] = 'BTW nummer is een verplicht veld';
            }
            
            // Check for errors
            if (count($errors) > 0) {
                
                // Add the errors to the template
                $this->set('error', implode('<br/>', $errors));
                
            } else {

                // Add the customer to the database
                $result = $this->CustomerModel->addInvoiceAddress($customerId, $params);
                
                // Go back to the confirm screen
                if ($result) {
                    $this->redirect('/order/confirm?invoice=' . $result['idFactadres']);
                } else {
                    $this->set('error', 'Er ging iets verkeerd');
                }
            
            }

        }
        
        // Add the variables to the template
        $this->set('customer', $customer);

	}
	
	// Setup the session
	private function setupSession($result) {

        // Add the login details to the session
        $_SESSION['LoginSession']['customerid']     = $result['idKlant'];
        $_SESSION['LoginSession']['login']          = $result['email'];
        $_SESSION['LoginSession']['weekly_invoice'] = ($result['wekelijkse_factuur_jn'] == 'ja');
        
        // Check als de user order heeft
        if (isset($_SESSION['in_confirm']) && $_SESSION['in_confirm'] === true) {
            $this->redirect('/order/confirm');
        } elseif (isset($_SESSION['Orders']) && count($_SESSION['Orders']) > 0) {
            $this->redirect('/cart');
        } else {
            $this->redirect('/');
        }
        
	}

}