<?php

namespace app\controllers;

use app\models\Main;
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
		
		$products = $this->model->getHits(1, 6);

		//dd($products, 1);

		$this->set(compact('slides', 'products'));

	}

}