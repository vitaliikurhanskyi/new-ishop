<?php

namespace app\widgets\language;

use RedBeanPHP\R;
use core\app;

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

        //dd($languages, true);

		$lang = App::$app->getProperty('lang');

		if($lang && array_key_exists($lang, $languages)) {
		    $key = $lang;
        } else if(!$lang) {
            $key = key($languages);
        } else {
		    $lang = htmlspecialchars($lang);
		    throw new \Exception("Not found language: {$lang}", 404);
        }

		$lang_info = $languages[$key];
		$lang_info['code'] = $key;

		return $lang_info;

		//var_dump($key);

	}
}