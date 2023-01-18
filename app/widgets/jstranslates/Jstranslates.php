<?php

namespace app\widgets\jstranslates;

class Jstranslates
{
    public $template;

    public function __construct()
    {
        $this->template = __DIR__ . '/jstranslates_tpl.php';
        echo $this->template;
    }
}