<?php

namespace core;

abstract class Controller {

	public array $data = [];
	public array $meta = ['title' => '', 'keywords' => '', 'description' => ''];
	public false|string $layout = '';
	public string $view = '';
	public object|string $model;

	public function __construct(public $route = []) {
		//debug($this->route, 1);
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

    public function isAjax(): bool
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    public function loadView($view, $vars = [])
    {
        extract($vars);
        $prefix = str_replace('\\', '/', $this->route['admin_prefix']);
        require APP . "/views/{$prefix}{$this->route['controller']}/{$view}.php";
        exit;
    }

    public function error_404($folder = 'Error', $view = 404, $response = 404)
    {
        http_response_code($response);
        $this->setMeta(___('tpl_error_404'));
        $this->route['controller'] = $folder;
        $this->view = $view;
    }

}