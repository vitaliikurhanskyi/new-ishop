<?php


namespace app\controllers;

use app\models\User;

/** @property User $model */
class UserController extends AppController
{

    public function signupAction()
    {
        if(User::checkAuth()) {
            redirect(base_url());
        }

        if(!empty($_POST)) {
            $data = $_POST;
            $this->model->load($data);
//            dd($data);
//            dd($this->model->attributes, 1);
            if(!$this->model->validate($data) || !$this->model->checkUnique()) {
                $this->model->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $this->model->attributes['password'] = password_hash($this->model->attributes['password'], PASSWORD_DEFAULT);
                if($this->model->save('user')) {
                    $_SESSION['success'] = ___('user_signup_success_register');
                    //redirect(base_url());
                } else {
                    $_SESSION['errors'] = ___('user_signup_error_register');
                }

            }
            redirect();
        }

        $this->setMeta(___('tpl_signup'));

    }

}