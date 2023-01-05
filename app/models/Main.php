<?php

namespace app\models;

use \RedBeanPHP\R;

class Main extends \core\Model {

	// public function get_names(): array {
	// 	return R::findAll('name');
	// }

    public function getHits($lang, $limit): array
    {
        //return R::getAll("SELECT p.* , pd.* FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND p.hit = 1 AND pd.language_id = ? LIMIT $limit", [$lang]);
		return R::getAll("SELECT * FROM product JOIN product_description ON product.id = product_description.product_id WHERE product.status = 1 AND product.hit = 1 AND product_description.language_id = ? LIMIT $limit", [$lang]);
    }

}