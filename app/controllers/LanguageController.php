<?php

namespace app\controllers;

use core\App;

class LanguageController extends AppController
{

	public function changeAction()
	{
		$lang = $_GET['lang'] ? $_GET['lang'] : NULL;

		//dd(App::$app->getProperty('languages'), 1);
		
		// var_dump($_SERVER['HTTP_REFERER']);

		// exit;

		if($lang) {
			if(array_key_exists($lang, App::$app->getProperty('languages'))) {
				// отрезаем базовый url	
				$url = trim(str_replace(PATH, '', $_SERVER['HTTP_REFERER']), '/');

				// разбиваем на 2 части... 1-я - возможный бывший язык
				$url_parts = explode('/', $url, 2);

				// Ищем первую часть (бывший язык, в масиве языков)
				if(array_key_exists($url_parts[0], App::$app->getProperty('languages'))) {
					// присваеваем первой части новый язык, если он не являеться базовым
					if($lang != App::$app->getProperty('language')['code']) {
						$url_parts[0] = $lang;
					} else {
						// если это базовый язык - удалим язык с url
						array_shift($url_parts);
					}
					
				} else {
					// Запрос не существующего языка
					if($lang != App::$app->getProperty('language')['code']) {
						array_unshift($url_parts, $lang);
					}
				}

				$url = PATH . '/' . implode('/', $url_parts);
				redirect($url);
			}
		}

		redirect();

	}

}