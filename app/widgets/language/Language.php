<?php

namespace app\widgets\language;

use RedBeanPHP\R;

class Language 
{

	protected $template;
	protected $languages;
	protected $language;

	public function __construct() 
	{
		$this->template = __DIR__ . 'lang_tpl.php';
		$this->run();
	}

	protected function run() 
	{

	}

	public static function getLanguages(): array
	{
		return R::getAssoc("SELECT code, title, base, id FROM language ORDER BY base DESC");
	}

	public static function getLanguage($languages)
	{
		
	}

}