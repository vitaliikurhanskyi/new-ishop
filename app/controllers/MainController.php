<?php

namespace app\controllers;

use app\models\Main;
use core\Controller;
use RedBeanPHP\R;

/** @property Main $model */
class MainController extends Controller {

	//public false|string $layout = 'default';

	public function indexAction() {
		//echo "In Main Controller";
		//$this->layout = 'default';
		//$names = ['Vasy', 'Pety', 'Galy'];

		//$names = R::findAll('name');

		$names = $this->model->get_names();

		$one_name = R::getRow('SELECT * FROM name WHERE id = 2');

		$this->setMeta('Main Page', 'ddescription', 'kkeywordsss');
		//$this->set(['test' => 'TEST VAR', 'name' => 'John']);
		$this->set(compact('names'));
	}

}