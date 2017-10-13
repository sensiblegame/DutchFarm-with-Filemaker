<?php

// The base controller for our application
class AppController extends Controller {

    // Class variables
    protected $settings;
    public $helpers    = array('Asset', 'Html', 'Javascript', 'Date', 'Time', 'User');
    public $components = array('Session', 'RequestHandler');

    // Executed for each page on the website
    public function beforeFilter(){
        
        // Disable the cache
        $this->disableCache();
        
        // Make sure we have an orders array in the session
        if (!$this->Session->check('Orders')) {
            $this->Session->write('Orders', array());
        }

        // Create the order array in the session
        /*if (!isset($_SESSION['Order'])) {
            $_SESSION['Order'] = array();
        }*/
        
        // Only for non non-ajax requests
        if (!$this->RequestHandler->isAjax()) {
        
            // Get a random header image
            $this->loadModel('ClassesModel');
            $header = $this->ClassesModel->findRandom();
            $this->set('header', $header);

            // Load the settings
            $this->loadSettings();
            
            // Get the list of classes
            $classes = $this->ClassesModel->find();

            // Group the classes
            $groupedClasses = array();
            foreach ($classes as $class) {
                $category = $class['web_classes_categories::category'];
                if (!isset($groupedClasses[$category])) {
                    $groupedClasses[$category] = array();
                }
                $groupedClasses[$category][] = $class;
            }

            $this->set('classes', $classes);
            $this->set('groupedClasses', $groupedClasses);
            
            // Get the list of pages
            $this->loadModel('PagesModel');
            $pages = $this->PagesModel->findAll();
           
            
            $this->set('pages', $pages);
            
            $this->loadModel('CustomerModel');
            if (isset($_SESSION['LoginSession']['customerid'])) {
                $custId   = $_SESSION['LoginSession']['customerid'];
            	$customer = $this->CustomerModel->findOne($custId);
            	$this->set('customer', $customer);
            }
        	
        	$this->loadModel('NewsModel');
        	$this->set('news', $this->NewsModel->find($_SERVER['SERVER_NAME']));
            
        }
    
    }
    

    // Load the settings into the template
    protected function loadSettings() {
        $this->loadModel('SettingsModel');
        $this->settings = $this->SettingsModel->find($_SERVER['SERVER_NAME']);
        $this->set('settings', $this->settings);
    }

}
