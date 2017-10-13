<?php

class PagesModel extends AppModel {
    
    public function findOneBySlug($slug) {
        $item = $this->_findOne(
            'web_pages',
            array('page_slug' => '=' . $slug)
        );
        return $item;
    }
    
    public function findAll() {
        $pages = $this->_find(
            'web_pages',
            array('page_title' => '*'),
            array('page_order')
        );
        $pagesGrouped = array(
            'Aanleveren'   => array(),
            'FAQ'          => array(),
            'Over Postfly' => array(),
            'Contact'      => array(),
        );
        foreach ($pages as $page) {
            $pagesGrouped[$page['page_section']][] = $page;
        }
        return $pagesGrouped;
    }
    
}
