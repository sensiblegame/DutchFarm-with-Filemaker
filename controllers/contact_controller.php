<?php

// Contact controller
class ContactController extends AppController {

	public $name       = 'Contact';
	public $helpers    = array('Asset', 'Html', 'Javascript', 'User', 'Form');
	public $uses       = array('ContactSubmissionsModel', 'EmailsModel');
	public $components = array('Session', 'RequestHandler');

    public function us() {
        
        // Get the form data
        $params = $this->params['form'];
        
        // Setup the validation
        $this->set('result', false);
        $errors    = array();
        $validator = Validation::getInstance();
        
        // Set the title
        $this->pageTitle = 'Contacteer Ons';
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {
            if (empty($params['onderwerp'])) {
                $errors[] = 'Onderwerp is een verplicht veld';
            }
            if (empty($params['emailInfo'])) {
                $errors[] = 'Email is een verplicht veld';
            } else {
                if (!$validator->email($params['emailInfo'])) {
                    $errors[] = 'Email is geen correct email adres';
                }
            }
            if (empty($params['berichtInfo'])) {
                $errors[] = 'Bericht is een verplicht veld';
            }
        }

        // Check if there are errors
        if (count($errors) == 0 && $this->RequestHandler->isPost()) {
            
            // Construct the content
            $content = '';
            foreach ($_POST as $key => $value) {
                $content .= '<p>' . $key . ': ' . nl2br($value) . '</p>' . PHP_EOL;
            }
            
            // Add an email
            $this->EmailsModel->addGeneric(
                $this->settings['contact_email'],
                $_POST['emailInfo'],
                'Contactformulier',
                $content,
                $this->settings
            );
            
            // Set the result
            $this->set('result', true);
            
        }
        
        // Add the errors to the template
        $this->set('error', implode('<br/>', $errors));
        
    }
    
    public function subscribe() {
        
        // Get the type from the url
        $type = $this->params['type'];
        
        // Get the form data
        $params = $this->params['form'];
        
        // Set the page title
        if ($type == 'nieuwsbrief') {
            $this->pageTitle = 'Nieuwsbrief inschrijven';
        } elseif ($type == 'offerte') {
            $this->pageTitle = 'Offerte aanvragen';
        } elseif ($type == 'samplewaaier') {
            $this->pageTitle = 'Samplewaaier aanvragen';
        } else {
            $this->redirect('/');
        }
        
        // Error checking
        $this->set('result', false);
        $errors    = array();
        $validator = Validation::getInstance();
        
        // Check if there is a post request
        if ($this->RequestHandler->isPost()) {
            
            // Field validation
            if (empty($params['name_first'])) {
                $errors[] = 'Voornaam is een verplicht veld';
            }
            if (empty($params['name_last'])) {
                $errors[] = 'Achternaam is een verplicht veld';
            }
            if (empty($params['email'])) {
                $errors[] = 'Email is een verplicht veld';
            } else {
                if (!$validator->email($params['email'])) {
                    $errors[] = 'Email is geen correct email adres';
                }
            }
            if ($type != 'nieuwsbrief') {
                if (empty($params['company_name'])) {
                    $errors[] = 'Bedrijfsnaam is een verplicht veld';
                }
                if (empty($params['address'])) {
                    $errors[] = 'Adres is een verplicht veld';
                }
                if (empty($params['zipcode'])) {
                    $errors[] = 'Postcode is een verplicht veld';
                }
                if (empty($params['city'])) {
                    $errors[] = 'Plaats is een verplicht veld';
                }
                if (empty($params['phone'])) {
                    $errors[] = 'Telefoon is een verplicht veld';
                }
                if ($type != 'samplewaaier') {
                    if (empty($params['message'])) {
                        $errors[] = 'Bericht is een verplicht veld';
                    }
                }
            }
            
            // Only send an email when no errors
            if (count($errors) == 0) {
            
                // Add it to the database
                $this->ContactSubmissionsModel->add($this->params['form']);
            
                // Construct the content
                $content = '';
                foreach ($this->params['form'] as $key => $value) {
                    $content .= '<p>' . $key . ': ' . nl2br($value) . '</p>' . PHP_EOL;
                }
            
                // Add an email
                $this->EmailsModel->addGeneric(
                    $this->settings['contact_email'],
                    $this->params['form']['email'],
                    'Contactformulier - ' . $type,
                    $content,
                    $this->settings
                );
            
                // Set the result
                $this->set('result', true);
                
            }
            
        }
        
        // Set the template variables
        $this->set('error', implode('<br/>', $errors));
        $this->set('type', $type);

	}
	
}
