<?php

namespace app\controllers;

use core\Controller;
use app\models\AppModel;
use core\App;
use app\widgets\language\Language;

class AppController extends Controller {

	public function __construct($route) {
		parent::__construct($route);
		new AppModel();

		App::$app->setProperty('languages', Language::getLanguages());
		dd(App::$app->getProperty('languages'), true);
	}

}