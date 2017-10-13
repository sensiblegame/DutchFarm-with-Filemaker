<?php

// Pages controller
class PagesController extends AppController {

    // Controller setup
    public $name       = 'Pages';
    public $helpers    = array('Asset', 'Html', 'Javascript', 'User', 'Form');
    public $uses       = array('PagesModel');
    public $components = array('Session', 'RequestHandler');
    
    // Display a page
    public function display() {
        
        // Get the slug
        $slug = $this->params['slug'];
        $item = $this->PagesModel->findOneBySlug($slug);
        
        if (!$item) {
            $this->redirect('/');
        }
        
        // Find the news item
        $this->set('pageitem', $item);
        
        // Set the page title
        $this->pageTitle = $item['page_title'];
        
    }
    
}
