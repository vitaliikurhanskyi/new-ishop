<?php


namespace app\models;


use core\App;
use RedBeanPHP\R;
use Valitron\Validator;

class User extends AppModel
{

    public array $attributes = [
        'email' => '',
        'password' => '',
        'name' => '',
        'address' => '',
    ];

    public array $rules = [
        'required' => ['email', 'password', 'name', 'address'],
        'email' => ['email',],
        'lengthMin' => [
            ['password', 6],
        ],
        'optional' => ['email', 'password'],
    ];

    public array $labels = [
        'email' => 'tpl_signup_email_input',
        'password' => 'tpl_signup_password_input',
        'name' => 'tpl_signup_name_input',
        'address' => 'tpl_signup_address_input',
    ];

    public static function checkAuth(): bool
    {
        return isset($_SESSION['user']);
    }

    public function checkUnique($text_error = ''): bool
    {
        $user = R::findOne('user', 'email = ?', [$this->attributes['email']]);
        if ($user) {
            $this->errors['unique'][] = $text_error ?: ___('user_signup_error_email_unique');
            return false;
        }
        return true;
    }

    public function login($is_admin = false): bool
    {
        $email = post('email');
        $password = post('password');
        if ($email && $password) {
            if ($is_admin) {
                $user = R::findOne('user', "email = ? AND role = 'admin'", [$email]);
            } else {
                $user = R::findOne('user', "email = ?", [$email]);
            }

            if ($user) {
                if (password_verify($password, $user->password)){
                    foreach ($user as $k => $v) {
                        if(!$k != 'password') {
                            $_SESSION['user'][$k] = $v;
                        }
                    }
                    return true;
                }
            }
        }
        return false;
    }

    // methods from Model (test)

    public function load($post = true)
    {
        $data = $post ? $_POST : $_GET;
        foreach ($this->attributes as $name => $value) {
            if(isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function validate($data): bool
    {
        Validator::langDir(APP . '/languages/validator/lang');
        Validator::lang(App::$app->getProperty('language')['code']);
        $validator = new Validator($data);
        $validator->rules($this->rules);
        $validator->labels($this->getLabels());
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getLabels(): array
    {
        $labels = [];
        foreach ($this->labels as $k => $v) {
            $labels[$k] = ___($v);
        }
        return $labels;
    }

    public function save($table): int|string
    {
        $tbl = R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            if($value != '') {
                $tbl->$name = $value;
            }
        }
        return R::store($tbl);
    }

    public function update($table, $id): int|string
    {
        $tbl = R::load($table, $id);
        foreach ($this->attributes as $name => $value) {
            if($value != '') {
                $tbl->$name = $value;
            }
        }
        return R::store($tbl);
    }

    public function get_count_orders($user_id): int
    {
        return R::count('orders', 'user_id = ?', [$user_id]);
    }

    public function get_user_orders($start, $perpage, $user_id): array
    {
        return R::getAll("SELECT * FROM orders WHERE user_id = ? ORDER BY id DESC LIMIT $start, $perpage", [$user_id]);
    }

    public function get_user_order($id): array
    {
        return R::getAll("SELECT o.*, op.* FROM orders o JOIN order_product op ON o.id = op.order_id WHERE o.id = ?", [$id]);
    }

    public function get_count_files(): int
    {
        return R::count('order_download', 'user_id = ? AND status = 1', [$_SESSION['user']['id']]);
    }

    public function get_user_files($start, $perpage, $lang): array
    {
        return R::getAll("SELECT od.*, d.*, dd.* FROM order_download od JOIN download d on d.id = od.download_id JOIN download_description dd on d.id = dd.download_id WHERE od.user_id = ? AND od.status = 1 AND  dd.language_id = ? LIMIT $start, $perpage", [$_SESSION['user']['id'], $lang['id']]);
    }

    public function get_user_file($id, $lang): array
    {
        return R::getRow("SELECT od.*, d.*, dd.* FROM order_download od JOIN download d ON d.id = od.download_id JOIN download_description dd ON d.id = dd.download_id WHERE od.user_id = ? AND od.status = 1 AND od.download_id = ?  AND dd.language_id = ?", [$_SESSION['user']['id'], $id, $lang['id']]);
    }


}