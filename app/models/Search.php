<?php


namespace app\models;


use RedBeanPHP\R;

class Search extends AppModel
{
    public function get_count_search_products($search, $lang)
    {
        return R::getCell("SELECT COUNT(*) FROM product p JOIN product_description pd on p.id = pd.product_id WHERE p.status = 1 AND pd.language_id = ? AND pd.title LIKE ?", [$lang['id'], "%{$search}%"]);
    }

    public function get_search_products($search, $lang, $start, $perpage): array
    {
        return R::getAll("SELECT p.*, pd.* FROM product p JOIN product_description pd ON p.id = pd.product_id WHERE p.status = 1 AND pd.language_id = ? AND pd.title LIKE ? LIMIT $start, $perpage", [$lang['id'], "%{$search}%"]);
    }
}