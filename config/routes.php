<?php

use core\Router;

Router::add('^admin/?$', ['controller' => 'Main', 'action' => 'index', 'admin_prefix' => 'admin']);

Router::add('^admin/(?P<controller>[a-z-]+)/?(?P<action>[a-z-]+)?$', ['admin_prefix' => 'admin']);

Router::add('^$', ['controller' => 'Main', 'action' => 'index']);

Router::add('^123$', ['controller' => '123', 'action' => 'dex']);

Router::add('^(?P<controller>[a-z-]+)/(?P<action>[a-z-]+)/?$');
