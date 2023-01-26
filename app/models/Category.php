<?php


namespace app\models;


use core\App;
use RedBeanPHP\R;

class Category extends AppModel
{

    public function get_category($slug, $lang): array
    {
        return R::getRow("SELECT c.*, cd.* FROM category c JOIN category_description cd ON c.id = cd.category_id WHERE c.slug = ? AND cd.language_id = ?", [$slug, $lang['id']]);
    }

    public function get_ids($id): string
    {
        $lang = App::$app->getProperty('language')['code'];
        $categories = App::$app->getProperty("categories_{$lang}");
        $ids = '';
        foreach ($categories as $key => $value) {
            if($value['parent_id'] == $id) {
                $ids .= $key . ',';
                $ids .= $this->get_ids($key);
            }
        }
        return $ids;
    }

    public function get_categories_products($ids, $lang): array
    {
        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd ON p.id = pd.product_id WHERE p.status = 1 AND p.category_id IN ($ids) AND pd.language_id = ?", [$lang]);
    }

}