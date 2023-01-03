<?php

namespace app\models;

use \RedBeanPHP\R;

class Main extends \core\Model {

	// public function get_names(): array {
	// 	return R::findAll('name');
	// }

	public function getHits($lang, $limit): array 
	{

		return R::getAll(
			"SELECT p.*, pd.* 
			FROM product p 
			JOIN product_description pd p.id = pd.product_id
			WHERE p.status = 1
			AND p.hit = 1
			AND pd.language_id = ? LIMIT $limit", 
			[$lang]
			);

	}

}