<?php

namespace core;

abstract class Controller {

	public array $data = [];
	public array $meta = ['title' => '', 'keywords' => '', 'description' => ''];
	public false|string $layout = '';
	public string $view = '';
	public object|string $model;

	public function __construct(public $route = []) {
		//debug($this->route);
	}

	public function getModel() {
		$model = 'app\models\\' . $this->route['admin_prefix'] . $this->route['controller'];		
		if(class_exists($model)) {
			$this->model = new $model;
		}
	}

	public function getView() {
	    //dd(App::$app->getProperties(), true);
		$this->view = $this->view ?: $this->route['action'];
		(new View($this->route, $this->layout, $this->view, $this->meta))->render($this->data);
	}

	public function set($data) {
		$this->data = $data;
	}

	public function setMeta($title = '', $description = '', $keywords = '') {
		$this->meta = [
			'title' => $title, 
			'description' => $description, 
			'keywords' => $keywords,
		];
	}

}