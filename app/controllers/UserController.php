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
            dd($data);
            dd($this->model->attributes, 1);
        }

        $this->setMeta(___('tpl_signup'));

    }

}