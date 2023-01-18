<?php

namespace app\widgets\jstranslates;

use core\App;

class Jstranslates
{
    public $data;
    public $template;
    public $language;

    public function __construct()
    {
        $this->template = __DIR__ . '/jstranslates_tpl.php';
        $this->language = App::$app->getProperty('language')['code'];
        $this->data = require_once ROOT . '/app/languages/js_' . $this->language . '.php';
        echo $this->getHtml();
    }

    protected function getHtml(): string
    {
        ob_start();
        require_once $this->template;
        return ob_get_clean();
    }
}