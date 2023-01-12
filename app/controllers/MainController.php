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

        //var_dump(Language::get('tpl_search'));

        //__('tpl_search');

		//Slides in main page
		$slides = R::findAll('slider');

		$lang_id = App::$app->getProperty('language')['id'];

		//dd(App::$app->getProperty('language')['id'], 1);
		
		$products = $this->model->getHits($lang_id , 6);

		//dd($products, 1);

		$this->set(compact('slides', 'products'));

		$this->setMeta(___('main_index_meta_title'), ___('main_index_meta_description'), ___('main_index_meta_keywords'));

	}

}