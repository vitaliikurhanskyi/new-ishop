<?php

namespace app\models;

use RedBeanPHP\R;

class Main extends \core\Model {


	public function get_names(): array {

		return R::findAll('name');

	}


}