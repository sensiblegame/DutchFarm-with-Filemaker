<?php

class AssetsController extends AppController {

	public $name       = 'Assets';
	public $helpers    = array();
	public $uses       = array();
	public $components = array('RequestHandler');
    public $autoRender = false;

    public function beforeFilter(){
    	parent::beforeFilter();
    }
    
    public function display() {
        
        // Get the parameters
        $args          = func_get_args();
        $forceDownload = array_shift($args);
        $modid         = array_shift($args);
        $filename      = array_shift($args);
        $url           = $this->rebuildUrl($args, $_GET);
        
        // Check for a cached version
        $cacheid = sha1($modid . '|' . $url);
        
        // Load the model and display the asset
        $this->loadModel('AssetsModel');
        $this->AssetsModel->display($cacheid, $url, $forceDownload, $filename);
        
	}
	
	// Rebuild the url given as a parameter to the display function
	private function rebuildUrl($path, $args) {
	    
	    // Remove the url from the arguments
	    unset($args['url']);
	    
	    // Return the rebuilded url
	    return '/' . join('/', $path) . '?' . http_build_query($args);
	    
	}
	
}
