<?php

use core\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);

Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);

//PRODUCTS CONTROLLER
Router::add('^(?P<lang>[a-z]+)?/?product/(?P<slug>[a-z0-9_-]+)/?$', ['controller' => 'Product', 'action' => 'view']);

Router::add('^(?P<lang>[a-z]+)?/?$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^123$', ['controller' => '123', 'action' => 'dex']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
