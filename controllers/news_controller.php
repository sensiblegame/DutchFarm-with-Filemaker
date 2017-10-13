<?php

// News controller
class NewsController extends AppController {
    
    // Controller setup
	public $name       = 'News';
	public $helpers    = array('Asset', 'Html', 'Javascript', 'Date', 'Time', 'User');
	public $uses       = array('NewsModel');
	public $components = array('Session', 'RequestHandler');

    // Show the list of news items
	public function home() {
	    
	    // Load the list of news items
        $this->set('news', $this->NewsModel->find($_SERVER['SERVER_NAME']));

	    // Set the page variables
		$this->set('page', 'over-postfly');
		$this->pageTitle = "Nieuws";
		
	}

    // Show a news item
    public function show() {
        
        // Get the slug
        $slug = $this->params['slug'];
        $item = $this->NewsModel->findOneBySlug($_SERVER['SERVER_NAME'], $slug);
        
        if (!$item) {
            $this->redirect('/nieuws');
        }
        
        // Find the news item
        $this->set('newsitem', $item);
        
        
        
        // Set the page title
        $this->pageTitle = $item['news_title'];
        
    }

}
