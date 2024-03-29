<?php

define("DEBUG", 1);
define("ROOT", dirname(__DIR__));
define("WWW", ROOT . '/public');
define("APP", ROOT . '/app');
define("CORE", ROOT . '/vendor/core');
define("HELPERS", ROOT . '/vendor/core/helpers');
define("CACHE", ROOT . '/tmp/cache');
define("LOGS", ROOT . '/tmp/logs');
define("CONFIG", ROOT . '/config');
define("LAYOUT", 'ishop');
define("PATH", 'http://new-ishop.loc');
define("ADMIN", 'http://new-ishop.loc/admin');
define("NO_IMAGE", '/public/uploads/no_image.jpg');
define("WISHLIST_LIMIT", 5);

require_once ROOT . '/vendor/autoload.php';


