<?php

class NewsModel extends AppModel {
    
    public function findRandomImage($server) {
        $server = str_replace('.local', '', $server);
        $server = ($server == 'localhost') ? 'BE' : $server;
        $server = substr($server, strlen($server) - 2);
        $news   = $this->_find(
            'web_news',
            array('news_land' => '=' . $server),
            array('-news_date')
        );
        $news = array_slice($news, 0, 3);

        shuffle($news);
        return $news[0];
    }
    
    public function find($server) {
        $server = str_replace('.local', '', $server);
        $server = ($server == 'localhost') ? 'BE' : $server;
        $server = substr($server, strlen($server) - 2);
        
        return $this->_find(
            'web_news',
            array('news_land' => '=' . $server),
            array('-news_date')
        );
    }
    
    public function findOneBySlug($server, $slug) {
        $server = str_replace('.local', '', $server);
        $server = ($server == 'localhost') ? 'BE' : $server;
        $server = substr($server, strlen($server) - 2);
        $item = $this->_findOne(
            'web_news',
            array(
                'news_slug_aec' => '=' . $slug,
                'news_land' => '=' . $server
            )
        );
        return $item;
    }
    
}
