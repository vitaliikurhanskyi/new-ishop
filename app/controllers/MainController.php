<?php

namespace app\controllers;

use app\models\Main;
use core\App;
use \RedBeanPHP\R;

/** @property Main $model */
class MainController extends AppController {

	//public false|string $layout = 'default';

	public function indexAction() {
		//$this->layout = 'default';
		//$names = R::findAll('name');
		//$names = $this->model->get_names();
		//$this->set(compact('names'));
		//$this->setMeta('Main Page 123', 'ddescription', 'kkeywordsss');
		//$one_name = R::getRow('SELECT * FROM name WHERE id = 2');

		//Slides in main page
		$slides = R::findAll('slider');

		//dd(App::$app->getProperty('language')['id'], 1);
		
		$products = $this->model->getHits(App::$app->getProperty('language')['id'], 6);

		//dd($products, 1);

		$this->set(compact('slides', 'products'));

		$this->setMeta("Главная страница", "description test ...", "keywords test ...");

	}

}