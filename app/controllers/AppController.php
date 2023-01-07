<?php

namespace app\controllers;

use core\Controller;
use app\models\AppModel;
use core\App;
use app\widgets\language\Language;

class AppController extends Controller
{

	public function __construct($route)
    {
		parent::__construct($route);
		new AppModel();

		App::$app->setProperty('languages', Language::getLanguages());
		App::$app->setProperty('language', Language::getLanguage(App::$app->getProperty('languages')));
		//dd(App::$app->getProperty('languages'), 1);
		//dd(App::$app->getProperty('language'), 1);
	}

}