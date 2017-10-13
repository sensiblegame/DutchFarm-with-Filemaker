<?php

// For the homepage
Router::connect('/', array('controller' => 'order',  'action' => 'home'));

// For the orders
Router::connect('/order/finish/:result', array('controller' => 'order', 'action' => 'finish'));

// For the shopping cart
Router::connect('/cart', array('controller' => 'cart',   'action' => 'show'));
Router::connect('/cart/delete/:id', array('controller' => 'cart',   'action' => 'delete'));

// User routes
Router::connect('/login',          array('controller' => 'user', 'action' => 'login'));
Router::connect('/lostpassword',   array('controller' => 'user', 'action' => 'lostpassword'));
Router::connect('/logout',         array('controller' => 'user', 'action' => 'logout'));
Router::connect('/newuser',        array('controller' => 'user', 'action' => 'add'));
Router::connect('/profile',        array('controller' => 'user', 'action' => 'update'));
Router::connect('/user/order/:id', array('controller' => 'user', 'action' => 'order'));

// Route for contact
Router::connect('/contact/nieuwsbrief',  array('controller' => 'contact', 'action' => 'subscribe', 'type' => 'nieuwsbrief'));
Router::connect('/contact/offerte',      array('controller' => 'contact', 'action' => 'subscribe', 'type' => 'offerte'));
Router::connect('/contact/samplewaaier', array('controller' => 'contact', 'action' => 'subscribe', 'type' => 'samplewaaier'));

// Route for news
Router::connect('/nieuws', array('controller' => 'news',   'action' => 'home'));
Router::connect('/nieuws/:slug', array('controller' => 'news',   'action' => 'show'));
// Router::connect('/sponsoring', array('controller' => 'pages', 'action' => 'display', 'path' => 'sponsoring'));
// Router::connect('/contact', array('controller' => 'pages', 'action' => 'display', 'path' => 'contact'));
// Router::connect('/aanleveren', array('controller' => 'pages', 'action' => 'display', 'path' => 'aanleveren'));

// Generic routes
Router::connect('/assets/*', array('controller' => 'assets', 'action' => 'display'));
Router::connect('/p/:slug', array('controller' => 'pages', 'action' => 'display'));

// Products
Router::connect('/print/:slug', array('controller' => 'products', 'action' => 'showClass'));
Router::connect('/banner/:slug', array('controller' => 'products', 'action' => 'showClassBanner'));
